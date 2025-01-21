<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\Kategori;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class KoleksiBuku extends Component
{
    use WithPagination;

    public $search = ''; // Variabel untuk pencarian
    public $selectedKategori = ''; // Menyimpan kategori yang dipilih
    public $kategoriList; // Menyimpan daftar kategori
    public $selectedBook = null; // Menyimpan buku yang dipilih
    protected $paginationTheme = 'bootstrap'; // Untuk menggunakan Bootstrap pagination

    public function updatingSearch()
    {
        // Reset pagination saat pencarian berubah
        $this->resetPage();
    }

    public function mount()
    {
        $this->kategoriList = Kategori::all();
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

    public function getJumlahDipinjam()
    {
        if ($this->selectedBook) {
            return DB::table('detail_peminjaman')
                ->where('buku_id', $this->selectedBook->id)
                ->where('status_peminjaman', 'dipinjam')
                ->sum('jumlah');
        }
        return 0;
    }

    public function render()
    {
        $buku = Buku::when($this->selectedKategori, function ($query) {
            $query->where('kategori_id', $this->selectedKategori);
        })
        ->where(function ($query) {
            $query->where('judul', 'like', '%' . $this->search . '%')
                  ->orWhere('penulis', 'like', '%' . $this->search . '%');
        })
        ->paginate(10);

        $jumlahDipinjam = $this->getJumlahDipinjam();

        return view('livewire.frontpage.koleksi-buku', compact('buku', 'jumlahDipinjam'));
    }
}
