<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DetailPeminjaman;
use App\Models\Keranjang;

class Transaksi extends Component
{
    public $detailPeminjaman;
    public $activeFilter = 'semua';

    public function render()
    {
        return view('livewire.adminpage.transaksi', [
            'detailPeminjaman' => $this->detailPeminjaman,
        ]);
    }

    public function getDetailPeminjaman()
    {
        $query = DetailPeminjaman::orderBy('id', 'desc');

        // Apply filters
        switch ($this->activeFilter) {
            case 'menunggu':
                $query->where('status_peminjaman', 'menunggu');
                break;
            case 'dipinjam':
                $query->where('status_peminjaman', 'dipinjam');
                break;
            case 'selesai':
                $query->where('status_peminjaman', 'selesai');
                break;
            default:
                // 'semua' - no filter needed
                break;
        }

        $this->detailPeminjaman = $query->get();
    }

    public function setFilter($filter)
    {
        $this->activeFilter = $filter;
        $this->getDetailPeminjaman();
    }

    public function mount()
    {
        $this->getDetailPeminjaman();
    }

    public function approvePeminjaman($id)
    {
        $detail = DetailPeminjaman::find($id);
        if ($detail) {
            $detail->update([
                'status_peminjaman' => 'dipinjam',
            ]);
            session()->flash('success', 'Peminjaman disetujui.');
            $this->getDetailPeminjaman(); // Refresh data
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
            session()->flash('success', 'Peminjaman dibatalkan.');

            $keranjangId = $detail->keranjang_id;
            $this->checkAndCompleteKeranjang($keranjangId);

            $this->getDetailPeminjaman(); // Refresh data
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
            $this->getDetailPeminjaman(); // Refresh data

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
            // Ambil semua status dari detail peminjaman dalam keranjang
            $detailPeminjaman = $keranjangCheck->detailPeminjaman;

            // Cek apakah semua status adalah 'dibatalkan' atau 'selesai'
            $allCompleted = $detailPeminjaman->every(function ($detail) {
                return in_array($detail->status_peminjaman, ['dibatalkan', 'selesai']);
            });

            // Jika semua status sudah selesai atau dibatalkan
            if ($allCompleted) {
                $keranjangCheck->update(['status_keranjang' => 'completed']);
                session()->flash('success', 'Keranjang berhasil diselesaikan.');
            }
        }
    }
}
