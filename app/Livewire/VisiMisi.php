<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\VisiMisi as ModelsVisiMisi;

class VisiMisi extends Component
{
    public $visiMisiId, $visi, $misi;

    public function render()
    {
        return view('livewire.adminpage.visi-misi', [
            'title' => 'Visi & Misi',
            'visi_misi' => ModelsVisiMisi::orderBy('visi', 'asc')->get(),
        ]);
    }

    public function resetInputFields()
    {
        $this->visiMisiId = null;
        $this->visi = '';
        $this->misi = '';
    }

    public function show($id)
    {
        $visiMisi = ModelsVisiMisi::findOrFail($id);
        $this->visiMisiId = $id;
        $this->visi = $visiMisi->visi;
        $this->misi = $visiMisi->misi;
    }

    public function update()
    {
        $this->validate([
            'visi' => 'required|string|max:255',
            'misi' => 'required|string',
        ]);

        if ($this->visiMisiId) {
            $visiMisi = ModelsVisiMisi::findOrFail($this->visiMisiId);
            $visiMisi->update([
                'visi' => $this->visi,
                'misi' => $this->misi,
            ]);

            $this->resetInputFields();
            return redirect('/admin/visi-misi')->with('success', 'Visi & Misi berhasil diperbarui.');}
    }
}
