<?php

namespace App\Livewire;

use App\Models\Kategori as ModelsKategori;
use Livewire\Component;
use Illuminate\Support\Str;

class Kategori extends Component
{
    public $namaKategori, $kategoriId;

    protected $rules = [
        'namaKategori' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.adminpage.kategori', [
            'kategori' => ModelsKategori::orderBy('nama', 'asc')->get()
        ]);
    }

    public function resetInputFields()
    {
        $this->namaKategori = '';
        $this->kategoriId = '';
    }

    public function store()
    {
        $this->validate();

        // Check if the data already exists
        $existingKategori = ModelsKategori::where('nama', $this->namaKategori)->first();

        if ($existingKategori) {
            return redirect('/admin/kategori')->with('error', 'Data kategori sudah ada, tambahkan data kategori baru.');
        }

        ModelsKategori::create([
            'nama' => $this->namaKategori,
            'slug' => Str::slug($this->namaKategori),
        ]);

        $this->resetInputFields();
        return redirect('/admin/kategori')->with('success', 'Data Kategori Buku berhasil ditambahkan.');
    }

    public function show($id)
    {
        $kategori = ModelsKategori::findOrFail($id);
        $this->kategoriId = $id;
        $this->namaKategori = $kategori->nama;
    }

    public function update()
    {
        $this->validate();

        if ($this->kategoriId) {
            $kategori = ModelsKategori::find($this->kategoriId);

            // Check if the updated data already exists
            $existingKategori = ModelsKategori::where('nama', $this->namaKategori)
                                              ->where('id', '!=', $this->kategoriId)
                                              ->first();

            if ($existingKategori) {
                return redirect('/admin/kategori')->with('error', 'Data kategori sudah ada, tambahkan data kategori baru.');
            }

            $kategori->update([
                'nama' => $this->namaKategori,
                'slug' => Str::slug($this->namaKategori),
            ]);

            $this->resetInputFields();
            return redirect('/admin/kategori')->with('success', 'Data Kategori Buku berhasil diubah.');
        }
    }

    public function delete()
    {
        ModelsKategori::find($this->kategoriId)->delete();
        $this->resetInputFields();
        return redirect('/admin/kategori')->with('success', 'Data Kategori Buku berhasil dihapus.');
    }
}