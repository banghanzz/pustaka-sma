<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\DetailPeminjaman;
use App\Models\Keranjang;

class Transaksi extends Component
{
    public $detailPeminjaman;

    public function render()
    {
        return view('livewire.adminpage.transaksi', [
            'detailPeminjaman' => $this->detailPeminjaman,
        ]);
    }
    
    public function getDetailPeminjaman()
    {
        $this->detailPeminjaman = DetailPeminjaman::orderBy('id', 'desc')->get();
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
