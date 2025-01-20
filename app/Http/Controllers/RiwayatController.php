<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPeminjaman;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $riwayatPeminjaman = DetailPeminjaman::whereIn('status_peminjaman', ['selesai', 'dibatalkan'])
            ->whereHas('keranjang', function ($query) use ($userId) {
                $query->where('users_id', $userId);
            })
            ->get();

        return view('frontpage.riwayat', [
            'title' => 'Riwayat',
            'riwayatPeminjaman' => $riwayatPeminjaman,
        ]);
    }
}
