<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Buku;

class KoleksiBuku extends Component
{
    use WithPagination;

    public $search = ''; // Variabel untuk pencarian
    public $selectedBook = null; // Menyimpan buku yang dipilih
    protected $paginationTheme = 'bootstrap'; // Untuk menggunakan Bootstrap pagination

    public function updatingSearch()
    {
        // Reset pagination saat pencarian berubah
        $this->resetPage();
    }

    public function selectBook($id)
    {
        // Menemukan buku berdasarkan ID dan setel ke selectedBook
        $this->selectedBook = Buku::find($id);
    }

    public function backToKoleksiBuku()
    {
        // Mengatur selectedBook menjadi null untuk kembali ke Koleksi Buku
        $this->selectedBook = null;
    }

    public function render()
    {
        $buku = Buku::where('judul', 'like', '%' . $this->search . '%')
                    ->orWhere('penulis', 'like', '%' . $this->search . '%')
                    ->paginate(10); // 10 buku per halaman

        return view('livewire.frontpage.koleksi-buku', compact('buku'));
    }
}
