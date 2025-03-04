<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\BukuRusak as ModelsBukuRusak;

class BukuRusak extends Component
{
    public $bulan, $tahun, $bukurusak;
    public $buku_id, $judul, $penulis, $stok, $rusak_ringan, $rusak_sedang, $rusak_berat, $tanggal_pencatatan;
    public $selectedBukuRusak;

    public function mount()
    {
        // Set default values to current month and year
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->applyFilter(); // Load initial data
    }

    public function render()
    {
        return view('livewire.adminpage.bukurusak', [
            'semuaBuku' => Buku::orderBy('judul', 'asc')->get(),
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

        $this->bukurusak = $query->get();
        $this->dispatch('dataUpdated');
    }

    public function resetFilter()
    {
        $this->bulan = date('m');
        $this->tahun = date('Y');
        $this->applyFilter();
    }

    public function store()
    {
        $this->validate([
            'buku_id' => 'required|integer',
            'rusak_ringan' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_berat' => 'required|integer',
            'tanggal_pencatatan' => 'required|date',
        ]);

        ModelsBukuRusak::create([
            'buku_id' => $this->buku_id,
            'rusak_ringan' => $this->rusak_ringan,
            'rusak_sedang' => $this->rusak_sedang,
            'rusak_berat' => $this->rusak_berat,
            'tanggal_pencatatan' => $this->tanggal_pencatatan,
        ]);

        $this->resetInputFields();
        return redirect('/admin/buku-rusak')->with('success', 'Data Buku Rusak berhasil ditambahkan.');
    }

    public function show($id)
    {
        $this->selectedBukuRusak = ModelsBukuRusak::findOrFail($id);
        $this->buku_id = $this->selectedBukuRusak->buku_id;
        $this->judul = $this->selectedBukuRusak->buku->judul;
        $this->penulis = $this->selectedBukuRusak->buku->penulis;
        $this->stok = $this->selectedBukuRusak->buku->stok;
        $this->rusak_ringan = $this->selectedBukuRusak->rusak_ringan;
        $this->rusak_sedang = $this->selectedBukuRusak->rusak_sedang;
        $this->rusak_berat = $this->selectedBukuRusak->rusak_berat;
        $this->tanggal_pencatatan = $this->selectedBukuRusak->tanggal_pencatatan;
    }

    public function update()
    {
        $this->validate([
            'rusak_ringan' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_berat' => 'required|integer',
            'tanggal_pencatatan' => 'required|date',
        ]);

        if ($this->selectedBukuRusak) {
            $this->selectedBukuRusak->update([
                'rusak_ringan' => $this->rusak_ringan,
                'rusak_sedang' => $this->rusak_sedang,
                'rusak_berat' => $this->rusak_berat,
                'tanggal_pencatatan' => $this->tanggal_pencatatan,
            ]);

            $this->resetInputFields();
            return redirect('/admin/buku-rusak')->with('success', 'Data Buku Rusak berhasil diubah.');
        }
    }

    public function delete()
    {
        ModelsBukuRusak::findOrFail($this->selectedBukuRusak->id)->delete();
        $this->resetInputFields();
        
        return redirect('/admin/buku-rusak')->with('success', 'Data Buku Rusak berhasil dihapus.');
    }

    private function resetInputFields()
    {
        $this->buku_id = '';
        $this->rusak_ringan = '';
        $this->rusak_sedang = '';
        $this->rusak_berat = '';
        $this->tanggal_pencatatan = date('Y-m-d');
        $this->selectedBukuRusak = null;
    }
}
