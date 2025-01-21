<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\TataTertib as ModelsTataTertib;

class TataTertib extends Component
{
    public $tataTertibId, $judul_tata_tertib, $isi_tata_tertib;

    public function render()
    {
        return view('livewire.adminpage.tata-tertib', [
            'title' => 'Tata Tertib',
            'tata_tertib' => ModelsTataTertib::orderBy('judul_tata_tertib', 'asc')->get(),
        ]);
    }

    public function resetInputFields()
    {
        $this->tataTertibId = null;
        $this->judul_tata_tertib = '';
        $this->isi_tata_tertib = '';
    }

    public function store()
    {
        $this->validate([
            'judul_tata_tertib' => 'required|string|max:255',
            'isi_tata_tertib' => 'required|string',
        ]);

        ModelsTataTertib::create([
            'judul_tata_tertib' => $this->judul_tata_tertib,
            'isi_tata_tertib' => $this->isi_tata_tertib,
        ]);

        $this->resetInputFields();
        return redirect('/admin/tata-tertib')->with('success', 'Tata Tertib berhasil ditambahkan.');
    }

    public function show($id)
    {
        $tataTertib = ModelsTataTertib::findOrFail($id);
        $this->tataTertibId = $id;
        $this->judul_tata_tertib = $tataTertib->judul_tata_tertib;
        $this->isi_tata_tertib = $tataTertib->isi_tata_tertib;
    }

    public function update()
    {
        $this->validate([
            'judul_tata_tertib' => 'required|string|max:255',
            'isi_tata_tertib' => 'required|string',
        ]);

        if ($this->tataTertibId) {
            $tataTertib = ModelsTataTertib::findOrFail($this->tataTertibId);
            $tataTertib->update([
                'judul_tata_tertib' => $this->judul_tata_tertib,
                'isi_tata_tertib' => $this->isi_tata_tertib,
            ]);

            $this->resetInputFields();
            return redirect('/admin/tata-tertib')->with('success', 'Tata Tertib berhasil diperbarui.');
        }
    }

    public function delete()
    {
        $tataTertib = ModelsTataTertib::findOrFail($this->tataTertibId);
        $tataTertib->delete();

        $this->resetInputFields();
        return redirect('/admin/tata-tertib')->with('success', 'Tata Tertib berhasil dihapus.');
    }
}
