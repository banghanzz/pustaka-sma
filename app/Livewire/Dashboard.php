<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\DetailPeminjaman;
use App\Models\Keranjang;
use App\Models\BukuRusak;

class Dashboard extends Component
{
    public $totalBuku, $sedangDipinjam, $selesaiDipinjam, $totalBukuRusak, $bukuRusakRingan, $bukuRusakSedang, $bukuRusakBerat;
    public $latestPeminjaman, $sedangDipinjamList;

    public function checkOverdueStatus()
    {
        $dipinjam = DetailPeminjaman::where('status_peminjaman', 'dipinjam')->where('tanggal_kembali', '<', now())->get();

        foreach ($dipinjam as $detail) {
            $detail->update(['status_peminjaman' => 'terlambat']);
        }
    }
    
    public function mount()
    {
        $this->checkOverdueStatus();
        $this->totalBuku = Buku::count();
        $this->sedangDipinjam = DetailPeminjaman::where('status_peminjaman', 'dipinjam')->count();
        $this->selesaiDipinjam = DetailPeminjaman::where('status_peminjaman', 'selesai')->count();
        $this->bukuRusakRingan = BukuRusak::sum('rusak_ringan');
        $this->bukuRusakSedang = BukuRusak::sum('rusak_sedang');
        $this->bukuRusakBerat = BukuRusak::sum('rusak_berat');
        $this->totalBukuRusak = $this->bukuRusakRingan + $this->bukuRusakSedang + $this->bukuRusakBerat;
        $this->getLatestPeminjaman();
        $this->getSedangDipinjamList();
    }

    public function render()
    {
        return view('livewire.adminpage.dashboard', [
            'totalBuku' => $this->totalBuku,
            'sedangDipinjam' => $this->sedangDipinjam,
            'selesaiDipinjam' => $this->selesaiDipinjam,
            'bukuRusak' => $this->totalBukuRusak,
            'latestPeminjaman' => $this->latestPeminjaman ?? collect(),
            'sedangDipinjamList' => $this->sedangDipinjamList ?? collect(),
        ]);
    }

    public function getLatestPeminjaman()
    {
        $this->latestPeminjaman = DetailPeminjaman::where('status_peminjaman', 'menunggu')
            ->orderBy('created_at', 'desc')
            ->take(4)
            ->get();
    }

    public function getSedangDipinjamList()
    {
        $this->sedangDipinjamList = DetailPeminjaman::whereIn('status_peminjaman', ['dipinjam', 'terlambat'])
            ->orderBy('tanggal_kembali', 'asc') // Order by oldest first
            ->take(6)
            ->get();
        }

    public function approvePeminjaman($id)
    {
        $detail = DetailPeminjaman::find($id);
        if ($detail) {
            $detail->update([
                'status_peminjaman' => 'dipinjam',
            ]);
            $this->getLatestPeminjaman(); // Refresh data
            return redirect('/admin/dashboard')->with('success', 'Peminjaman disetujui.');
        } else {
            session()->flash('error', 'Detail peminjaman tidak ditemukan.');
        }
    }

    public function cancelPeminjaman($id)
    {
        $detail = DetailPeminjaman::find($id);
        if ($detail) {
            $detail->update([
                'status_peminjaman' => 'dibatalkan',
            ]);
            $this->getLatestPeminjaman(); // Refresh data
            return redirect('/admin/dashboard')->with('success', 'Peminjaman dibatalkan.');
        } else {
            session()->flash('error', 'Detail peminjaman tidak ditemukan.');
        }
    }

    public function completePeminjaman($id)
    {
        $detail = DetailPeminjaman::find($id);
        if ($detail) {
            // Hitung denda berdasarkan hari terlambat
            $tanggalKembali = \Carbon\Carbon::parse($detail->tanggal_kembali);
            $hariTerlambat = floor($tanggalKembali->diffInDays(now()));
            $denda = $hariTerlambat * 500;

            $detail->update([
                'status_peminjaman' => 'selesai',
                'tanggal_pengembalian' => now(),
                'denda' => $denda,
            ]);

            session()->flash('success', 'Peminjaman selesai.');
            $this->getDetailPeminjaman();
        } else {
            session()->flash('error', 'Detail peminjaman tidak ditemukan.');
        }
    }

    public function checkAndCompleteKeranjang($keranjangId)
    {
        $keranjangCheck = Keranjang::find($keranjangId);

        if ($keranjangCheck) {
            $statuses = $keranjangCheck->detailPeminjaman->pluck('status_peminjaman')->all();

            if (count($statuses) > 0 && collect($statuses)->every(function ($status) {
                return in_array($status, ['dibatalkan', 'selesai']);
            })) {
                $keranjangCheck->update(['status_keranjang' => 'completed']);
                session()->flash('success', 'Keranjang berhasil diselesaikan.');
            }
        }
    }
}
