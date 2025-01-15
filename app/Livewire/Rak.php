<?php

namespace App\Livewire;

use App\Models\Rak as ModelsRak;
use Livewire\Component;
use Illuminate\Support\Str;

class Rak extends Component
{
    public $namarak, $baris, $rakId;

    protected $rules = [
        'namarak' => 'required|string|max:255',
        'baris' => 'required|integer',
    ];

    public function render()
    {
        return view('livewire.adminpage.rak', [
            'rak' => ModelsRak::orderBy('rak', 'ASC')->orderBy('baris', 'ASC')->get()
        ]);
    }

    public function resetInputFields()
    {
        $this->namarak = '';
        $this->baris = '';
        $this->rakId = '';
    }

    public function store()
    {
        $this->validate();

        // Check if the data already exists
        $existingRak = ModelsRak::where('rak', $this->namarak)
                                ->where('baris', $this->baris)
                                ->first();

        if ($existingRak) {
            return redirect('/admin/rak')->with('error', 'Data rak sudah ada, tambahkan data rak baru.');
        }

        ModelsRak::create([
            'rak' => $this->namarak,
            'baris' => $this->baris,
            'slug' => Str::slug($this->namarak . '-' . $this->baris),
        ]);

        $this->resetInputFields();
        return redirect('/admin/rak')->with('success', 'Data Rak Buku berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rak = ModelsRak::findOrFail($id);
        $this->rakId = $id;
        $this->namarak = $rak->rak;
        $this->baris = $rak->baris;
    }

    public function update()
    {
        $this->validate();

        if ($this->rakId) {
            $rak = ModelsRak::find($this->rakId);

            // Check if the updated data already exists
            $existingRak = ModelsRak::where('rak', $this->namarak)
                                    ->where('baris', $this->baris)
                                    ->where('id', '!=', $this->rakId)
                                    ->first();

            if ($existingRak) {
                return redirect('/admin/rak')->with('error', 'Data rak sudah ada, tambahkan data rak baru.');
            }

            $rak->update([
                'rak' => $this->namarak,
                'baris' => $this->baris,
                'slug' => Str::slug($this->namarak . '-' . $this->baris),
            ]);

            $this->resetInputFields();
            return redirect('/admin/rak')->with('success', 'Data Rak Buku berhasil diubah.');
        }
    }

    public function delete()
    {
        ModelsRak::find($this->rakId)->delete();
        return redirect('/admin/rak')->with('success', 'Data Rak Buku berhasil dihapus.');
    }
}