<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
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

    public function downloadPDF()
    {
        $rekapitulasi = ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')->get();
        $totalJumlah = $rekapitulasi->sum(function($bukuRusak) {
            return $bukuRusak->buku->stok;
        });

        $data = [
            'title' => 'Rekapitulasi Data',
            'date' => date('m/d/Y'),
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $totalJumlah,
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + $rekapitulasi->sum('rusak_sedang') + $rekapitulasi->sum('rusak_berat'),
            'currentMonth' => date('F'),
            'currentYear' => date('Y'),
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadView('pdf.rekapitulasi', $data);

        return $pdf->stream('rekapitulasi.pdf');
    }
}
