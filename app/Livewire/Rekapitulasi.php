<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BukuRusak as ModelsBukuRusak;
use App\Models\Buku;

class Rekapitulasi extends Component
{
    public function render()
    {
        return view('livewire.adminpage.rekapitulasi',[
            'rekapitulasi' => ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')->get(),
        ]);
    }
}
