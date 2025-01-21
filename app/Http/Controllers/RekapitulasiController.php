<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BukuRusak as ModelsBukuRusak;
use App\Models\Buku;

class RekapitulasiController extends Controller
{
    public function index()
    {
        $rekapitulasi = ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')->get();
        $totalJumlah = $rekapitulasi->sum(function($bukuRusak) {
            return $bukuRusak->buku->stok;
        });

        return view('frontpage.rekapitulasi',[
            'title' => 'Rekapitulasi',
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $totalJumlah,
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + $rekapitulasi->sum('rusak_sedang') + $rekapitulasi->sum('rusak_berat'),
        ]);
    }
}
