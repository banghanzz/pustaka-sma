<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Models\BukuRusak as ModelsBukuRusak;
use App\Models\Buku;
use App\Models\User;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        $query = ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc');

        // Set default values for current month and year if no filters are provided
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Apply filters
        $query->whereMonth('tanggal_pencatatan', $bulan)->whereYear('tanggal_pencatatan', $tahun);

        $rekapitulasi = $query->get();
        $totalJumlah = $rekapitulasi->sum(function ($bukuRusak) {
            return $bukuRusak->buku->stok;
        });

        return view('frontpage.rekapitulasi', [
            'title' => 'Rekapitulasi',
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $totalJumlah,
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + $rekapitulasi->sum('rusak_sedang') + $rekapitulasi->sum('rusak_berat'),
            'selectedBulan' => $request->bulan ?? date('m'),
            'selectedTahun' => $request->tahun ?? date('Y'),
        ]);
    }

    public function downloadPDF(Request $request)
    {
        // Get filter values from request
        $bulan = $request->bulan ?? date('m');
        $tahun = $request->tahun ?? date('Y');

        // Apply filters to query
        $rekapitulasi = ModelsBukuRusak::with('buku')
            ->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')
            ->whereMonth('tanggal_pencatatan', $bulan)
            ->whereYear('tanggal_pencatatan', $tahun)
            ->get();

        $totalJumlah = $rekapitulasi->sum(function ($bukuRusak) {
            return $bukuRusak->buku->stok;
        });

        $namaBulan = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember',
        ];

        $data = [
            'title' => 'Rekapitulasi Data',
            'currentDate' => date('d') . ' ' . $namaBulan[date('m')] . ' ' . date('Y'),
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $totalJumlah,
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + $rekapitulasi->sum('rusak_sedang') + $rekapitulasi->sum('rusak_berat'),
            'selectedMonth' => $namaBulan[$bulan],
            'selectedYear' => $tahun,
            'kepsek' => User::where('roles_id', 2)->first(),
            'pustakawan' => User::where('roles_id', 1)->first(),
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadView('pdf.rekapitulasi', $data);

        return $pdf->stream('rekapitulasi-' . $bulan . '-' . $tahun . '.pdf');
    }
}
