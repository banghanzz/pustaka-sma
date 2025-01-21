<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BukuRusak as ModelsBukuRusak;
use App\Models\Buku;

class Rekapitulasi extends Component
{
    public function render()
    {
        $rekapitulasi = ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')->get();
        $totalJumlah = $rekapitulasi->sum(function($bukuRusak) {
            return $bukuRusak->buku->stok;
        });

        return view('livewire.adminpage.rekapitulasi',[
            'rekapitulasi' => $rekapitulasi,
            'totalJumlah' => $totalJumlah,
            'totalRusakRingan' => $rekapitulasi->sum('rusak_ringan'),
            'totalRusakSedang' => $rekapitulasi->sum('rusak_sedang'),
            'totalRusakBerat' => $rekapitulasi->sum('rusak_berat'),
            'totalRusak' => $rekapitulasi->sum('rusak_ringan') + $rekapitulasi->sum('rusak_sedang') + $rekapitulasi->sum('rusak_berat'),
        ]);
    }
}
