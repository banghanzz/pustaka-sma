<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\DetailPeminjaman;
use App\Models\Keranjang;

class Dashboard extends Component
{
    public $totalBuku, $sedangDipinjam, $selesaiDipinjam, $bukuRusak;
    public $latestPeminjaman, $sedangDipinjamList;

    public function mount()
    {
        $this->totalBuku = Buku::count();
        $this->sedangDipinjam = DetailPeminjaman::where('status_peminjaman', 'dipinjam')->count();
        $this->selesaiDipinjam = DetailPeminjaman::where('status_peminjaman', 'selesai')->count();
        // $this->bukuRusak = Buku::where('kondisi', 'rusak')->count();
        $this->getLatestPeminjaman();
        $this->getSedangDipinjamList();
    }

    public function render()
    {
        return view('livewire.adminpage.dashboard', [
            'totalBuku' => $this->totalBuku,
            'sedangDipinjam' => $this->sedangDipinjam,
            'selesaiDipinjam' => $this->selesaiDipinjam,
            // 'bukuRusak' => $this->bukuRusak,
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
        $this->sedangDipinjamList = DetailPeminjaman::where('status_peminjaman', 'dipinjam')
            ->orderBy('created_at', 'asc') // Order by oldest first
            ->take(4)
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
            $detail->update([
                'status_peminjaman' => 'selesai',
            ]);
            session()->flash('success', 'Peminjaman selesai.');
            $this->getSedangDipinjamList(); // Refresh data

            $keranjangId = $detail->keranjang_id;
            $this->checkAndCompleteKeranjang($keranjangId);
            
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
