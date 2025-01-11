<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('adminpage.dashboard',[
            'title' => 'Dashboard',
        ]);
    }
    public function transaksi()
    {
        return view('adminpage.transaksi',[
            'title' => 'Transaksi Peminjaman',
        ]);
    }
    public function rak()
    {
        return view('adminpage.rak',[
            'title' => 'Rak Buku',
        ]);
    }
    public function kategori()
    {
        return view('adminpage.kategori',[
            'title' => 'Kategori Buku',
        ]);
    }
    public function koleksibuku()
    {
        return view('adminpage.koleksibuku',[
            'title' => 'Koleksi Buku',
        ]);
    }
    public function bukurusak()
    {
        return view('adminpage.bukurusak',[
            'title' => 'Buku Rusak',
        ]);
    }
    public function rekapitulasi()
    {
        return view('adminpage.rekapitulasi',[
            'title' => 'Rekapitulasi',
        ]);
    }
    public function anggota()
    {
        return view('adminpage.anggota',[
            'title' => 'Anggota Perpustakaan',
        ]);
    }
}
