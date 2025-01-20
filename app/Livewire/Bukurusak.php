<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\BukuRusak as ModelsBukuRusak;

class BukuRusak extends Component
{
    public $buku_id, $judul, $penulis, $stok, $rusak_ringan, $rusak_sedang, $rusak_berat;
    public $selectedBukuRusak;

    public function render()
    {
        return view('livewire.adminpage.bukurusak',[
            'bukurusak' => ModelsBukuRusak::with('buku')->orderBy(Buku::select('judul')->whereColumn('buku_id', 'id'), 'asc')->get(),
            'semuaBuku' => Buku::orderBy('judul', 'asc')->get(),
        ]);
    }

    public function store()
    {
        $this->validate([
            'buku_id' => 'required|integer',
            'rusak_ringan' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_berat' => 'required|integer',
        ]);

        ModelsBukuRusak::create([
            'buku_id' => $this->buku_id,
            'rusak_ringan' => $this->rusak_ringan,
            'rusak_sedang' => $this->rusak_sedang,
            'rusak_berat' => $this->rusak_berat,
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
    }

    public function update()
    {
        $this->validate([
            'rusak_ringan' => 'required|integer',
            'rusak_sedang' => 'required|integer',
            'rusak_berat' => 'required|integer',
        ]);

        if ($this->selectedBukuRusak) {
            $this->selectedBukuRusak->update([
                'rusak_ringan' => $this->rusak_ringan,
                'rusak_sedang' => $this->rusak_sedang,
                'rusak_berat' => $this->rusak_berat,
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
        $this->selectedBukuRusak = null;
    }
}
