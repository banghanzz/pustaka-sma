<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Buku;

class KoleksiBuku extends Component
{
    use WithPagination;

    public $search = ''; // Variabel untuk pencarian
    protected $paginationTheme = 'bootstrap'; // Untuk menggunakan Bootstrap pagination

    public function updatingSearch()
    {
        // Reset pagination saat pencarian berubah
        $this->resetPage();
    }

    public function render()
    {
        $buku = Buku::where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('penulis', 'like', '%' . $this->search . '%')
                    ->paginate(10); // 8 buku per halaman

        return view('livewire.koleksi-buku', compact('buku'));
    }
}
