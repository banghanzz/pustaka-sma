<?php

namespace App\Livewire;

use App\Models\Buku;
use App\Models\User;
use Livewire\Component;
use App\Models\BukuRusak as ModelsBukuRusak;

class Rekapitulasi extends Component
{
    public $bulan, $tahun, $rekapitulasi;
    public function mount()
    {
        // Set default values to current month and year
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->applyFilter(); // Load initial data
    }

    public function render()
    {
        return view('livewire.adminpage.rekapitulasi', [
            'rekapitulasi' => $this->rekapitulasi,
            'totalJumlah' => $this->rekapitulasi->sum(function($bukuRusak) {
                return $bukuRusak->buku->stok;
            }),
            'totalRusakRingan' => $this->rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $this->rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $this->rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $this->rekapitulasi->sum('rusak_ringan') + 
                           $this->rekapitulasi->sum('rusak_sedang') + 
                           $this->rekapitulasi->sum('rusak_berat'),
        ]);
    }

    public function applyFilter()
    {
        $query = ModelsBukuRusak::with('buku')
            ->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc');

        if ($this->bulan) {
            $query->whereMonth('tanggal_pencatatan', $this->bulan);
        }
        
        if ($this->tahun) {
            $query->whereYear('tanggal_pencatatan', $this->tahun);
        }

        $this->rekapitulasi = $query->get();
        $this->dispatch('dataUpdated');
    }

    public function resetFilter()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->applyFilter();
    }

    public function downloadPDF()
    {
        $query = ModelsBukuRusak::with('buku')
            ->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc');

        // Apply current filters
        if ($this->bulan) {
            $query->whereMonth('tanggal_pencatatan', $this->bulan);
        }
        
        if ($this->tahun) {
            $query->whereYear('tanggal_pencatatan', $this->tahun);
        }

        $rekapitulasi = $query->get();

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
            '12' => 'Desember'
        ];

        $data = [
            'title' => 'Rekapitulasi Data',
            'currentDate' => date('d').' '.$namaBulan[date('m')].' '.date('Y'),
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $rekapitulasi->sum(function($bukuRusak) {
                return $bukuRusak->buku->stok;
            }),
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + 
                           $rekapitulasi->sum('rusak_sedang') + 
                           $rekapitulasi->sum('rusak_berat'),
            'selectedMonth' => $namaBulan[$this->bulan],
            'selectedYear' => $this->tahun,            
            'kepsek' => User::where('roles_id', 2)->first(),
            'pustakawan' => User::where('roles_id', 1)->first(),
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->setPaper('A4', 'portrait');
        $pdf->loadView('pdf.rekapitulasi', $data);

        return response()->streamDownload(
            function () use ($pdf) {
                echo $pdf->stream('', ['Attachment' => false]);
            },
            'rekapitulasi-' . ($this->bulan ?? date('m')) . '-' . ($this->tahun ?? date('Y')) . '.pdf'
        );
    }
}
