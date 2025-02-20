<?php

namespace App\Livewire;

use App\Models\Buku;
use Livewire\Component;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class KoleksiBukuAdmin extends Component
{
    use WithFileUploads;

    public $judul, $penulis, $penerbit, $tahun_ajaran, $kategori, $stok, $rak, $sampul, $bukuId;

    protected $rules = [
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_ajaran' => 'required|string|max:255',
        'kategori' => 'required|integer',
        'stok' => 'required|integer',
        'rak' => 'required|integer',
        'sampul' => 'nullable|image|max:1024', // 1MB Max
    ];

    public function render()
    {
        return view('livewire.adminpage.koleksibukuadmin', [
            'buku' => Buku::orderBy('judul', 'ASC')->get(),
            'kategoris' => Kategori::orderBy('nama', 'ASC')->get(),
            'raks' => Rak::orderBy('rak', 'ASC')->orderBy('baris', 'ASC')->get(),
        ]);
    }

    public function resetInputFields()
    {
        $this->judul = '';
        $this->penulis = '';
        $this->penerbit = '';
        $this->tahun_ajaran = '';
        $this->kategori = '';
        $this->stok = '';
        $this->rak = '';
        $this->sampul = '';
        $this->bukuId = '';
    }

    public function store()
    {
        $this->validate();

        $existingBuku = Buku::where('judul', $this->judul)
            ->where('penulis', $this->penulis)
            ->where('penerbit', $this->penerbit)
            ->first();

        if ($existingBuku) {
            return redirect('/admin/koleksi-buku')->with('error', 'Data buku sudah ada, tambahkan data buku baru.');
        }

        $slug = Str::slug($this->judul . '-by-' . $this->penulis);
        $sampulPath = null;

        if ($this->sampul) {
            try {
                $extension = $this->sampul->getClientOriginalExtension();
                $sampulPath = $this->sampul->storeAs('sampulbuku', $slug . '.' . $extension, 'public');
            } catch (\Exception $e) {
                return redirect('/admin/koleksi-buku')->with('error', 'Gagal mengunggah sampul buku.');
            }
        }

        Buku::create([
            'judul' => $this->judul,
            'penulis' => $this->penulis,
            'penerbit' => $this->penerbit,
            'tahun_ajaran' => $this->tahun_ajaran,
            'kategori_id' => $this->kategori,
            'stok' => $this->stok,
            'rak_id' => $this->rak,
            'sampul' => $sampulPath,
            'slug' => $slug,
        ]);

        $this->resetInputFields();
        return redirect('/admin/koleksi-buku')->with('success', 'Data Koleksi Buku berhasil ditambahkan.');
    }

    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        $this->bukuId = $id;
        $this->judul = $buku->judul;
        $this->penulis = $buku->penulis;
        $this->penerbit = $buku->penerbit;
        $this->tahun_ajaran = $buku->tahun_ajaran;
        $this->kategori = $buku->kategori_id;
        $this->stok = $buku->stok;
        $this->rak = $buku->rak_id;
    }

    public function update()
    {
        $this->validate();

        if ($this->bukuId) {
            $buku = Buku::find($this->bukuId);

            $existingBuku = Buku::where('judul', $this->judul)
                ->where('penulis', $this->penulis)
                ->where('penerbit', $this->penerbit)
                ->where('id', '!=', $this->bukuId)
                ->first();

            if ($existingBuku) {
                return redirect('/admin/koleksi-buku')->with('error', 'Data buku sudah ada, tambahkan data buku baru.');
            }

            $slug = Str::slug($this->judul . '-by-' . $this->penulis);
            $sampulPath = $buku->sampul;

            if ($this->sampul) {
                if ($buku->sampul) {
                    Storage::disk('public')->delete($buku->sampul);
                }

                $extension = $this->sampul->getClientOriginalExtension();
                $sampulPath = $this->sampul->storeAs('sampulbuku', $slug . '.' . $extension, 'public');
            }

            $updateData = [
                'judul' => $this->judul,
                'penulis' => $this->penulis,
                'penerbit' => $this->penerbit,
                'tahun_ajaran' => $this->tahun_ajaran,
                'kategori_id' => $this->kategori,
                'stok' => $this->stok,
                'rak_id' => $this->rak,
                'slug' => $slug,
            ];

            if ($this->sampul) {
                $updateData['sampul'] = $sampulPath;
            }

            $buku->update($updateData);

            $this->resetInputFields();
            return redirect('/admin/koleksi-buku')->with('success', 'Data Koleksi Buku berhasil diubah.');
        }
    }

    public function delete()
    {
        $buku = Buku::find($this->bukuId);

        if ($buku->sampul) {
            // Delete the cover image
            Storage::disk('public')->delete($buku->sampul);
        }

        // Delete the book record
        $buku->delete();

        $this->resetInputFields();
        return redirect('/admin/koleksi-buku')->with('success', 'Data Koleksi Buku berhasil dihapus.');
    }
}
