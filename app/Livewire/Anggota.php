<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use App\Models\User as ModelsAnggota;
use Illuminate\Support\Facades\Storage;

class Anggota extends Component
{
    use WithFileUploads;

    public $nama, $nomor_induk, $alamat, $nomor_telegram, $chat_id, $role, $roles_id, $kelas, $foto_profil, $email, $password, $anggotaId;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'nomor_induk' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'nomor_telegram' => 'required|string|max:255',
        'chat_id' => 'required|string|max:255',
        'roles_id' => 'required|integer',
        'kelas' => 'nullable|string|max:255',
        'foto_profil' => 'nullable|image|max:1024', // 1MB Max
        'email' => 'required|email|max:255',
        'password' => 'required|string|min:8',
    ];

    public function render()
    {
        return view('livewire.adminpage.anggota', [
            'anggota' => ModelsAnggota::where('roles_id', '!=', 999)
                ->orderBy('roles_id', 'asc')
                ->orderBy('nama', 'asc')
                ->get()
        ]);
    }

    public function resetInputFields()
    {
        $this->nama = '';
        $this->nomor_induk = '';
        $this->alamat = '';
        $this->nomor_telegram = '';
        $this->chat_id = '';
        $this->roles_id = '';
        $this->kelas = '';
        $this->foto_profil = '';
        $this->email = '';
        $this->password = '';
        $this->anggotaId = '';
    }

    public function store()
    {
        $this->validate();

        // Pengecekan akun yang sama berdasarkan nama, nomor_induk, dan email
        $existingUser = ModelsAnggota::where('nama', $this->nama)
            ->where('nomor_induk', $this->nomor_induk)
            ->where('email', $this->email)
            ->first();

        if ($existingUser) {
            return redirect('/admin/anggota-perpustakaan')->with('error', 'Akun dengan nama, nomor induk, dan email yang sama sudah terdaftar.');
        }

        $slug = Str::slug($this->nama . '-' . $this->nomor_induk);
        $fotoPath = null;

        if ($this->foto_profil) {
            try {
                $extension = $this->foto_profil->getClientOriginalExtension();
                $fotoPath = $this->foto_profil->storeAs('fotoprofil', $slug . '.' . $extension, 'public');
            } catch (\Exception $e) {
                return redirect('/admin/anggota-perpustakaan')->with('error', 'Gagal mengunggah foto profil.');
            }
        }

        ModelsAnggota::create([
            'nama' => $this->nama,
            'nomor_induk' => $this->nomor_induk,
            'alamat' => $this->alamat,
            'nomor_telegram' => $this->nomor_telegram,
            'chat_id' => $this->chat_id,
            'roles_id' => $this->roles_id,
            'kelas' => $this->kelas,
            'foto_profil' => $fotoPath,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $this->resetInputFields();
        return redirect('/admin/anggota-perpustakaan')->with('success', 'Data Anggota berhasil ditambahkan.');
    }

    public function show($id)
    {
        $anggota = ModelsAnggota::findOrFail($id);
        $this->anggotaId = $id;
        $this->nama = $anggota->nama;
        $this->nomor_induk = $anggota->nomor_induk;
        $this->alamat = $anggota->alamat;
        $this->nomor_telegram = $anggota->nomor_telegram;
        $this->chat_id = $anggota->chat_id;
        $this->role = $anggota->role->role;
        $this->roles_id = $anggota->roles_id;
        $this->kelas = $anggota->kelas;
        $this->email = $anggota->email;
    }

    public function update()
    {
        try {
            // Cast chat_id to string before validation
            $this->chat_id = strval($this->chat_id);
    
            // Validate with specific messages
            $this->validate([
                'nama' => 'required|string|max:255',
                'nomor_induk' => 'required|string|max:255',
                'alamat' => 'required|string|max:255',
                'nomor_telegram' => 'required|string|max:255',
                'chat_id' => 'required|string|max:255',
                'roles_id' => 'required|integer',
                'kelas' => 'nullable|string|max:255',
                'foto_profil' => 'nullable|image|max:1024',
                'email' => 'required|email|max:255',
            ]);
    
            if ($this->anggotaId) {
                $anggota = ModelsAnggota::findOrFail($this->anggotaId);
                
                $fotoPath = $anggota->foto_profil;
    
                if ($this->foto_profil) {
                    if ($anggota->foto_profil && Storage::disk('public')->exists($anggota->foto_profil)) {
                        Storage::disk('public')->delete($anggota->foto_profil);
                    }
    
                    $slug = Str::slug($this->nama . '-' . $this->nomor_induk);
                    $extension = $this->foto_profil->getClientOriginalExtension();
                    $fotoPath = $this->foto_profil->storeAs('fotoprofil', $slug . '.' . $extension, 'public');
                }
    
                $updated = $anggota->update([
                    'nama' => $this->nama,
                    'nomor_induk' => $this->nomor_induk,
                    'alamat' => $this->alamat,
                    'nomor_telegram' => $this->nomor_telegram,
                    'chat_id' => $this->chat_id,
                    'roles_id' => $this->roles_id,
                    'kelas' => $this->kelas,
                    'foto_profil' => $fotoPath,
                    'email' => $this->email,
                ]);
    
                if (!$updated) {
                    throw new \Exception('Gagal memperbarui data');
                }
    
                $this->resetInputFields();
                $this->dispatch('dataUpdated');
                return redirect('/admin/anggota-perpustakaan')->with('success', 'Data Anggota berhasil diubah.');
            }
        } catch (\Exception $e) {
            logger()->error('Update failed: ' . $e->getMessage());
            return redirect('/admin/anggota-perpustakaan')->with('error', 'Gagal mengubah data anggota: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $anggota = ModelsAnggota::find($this->anggotaId);

        if ($anggota->foto_profil) {
            Storage::disk('public')->delete($anggota->foto_profil);
        }

        $anggota->delete();

        $this->resetInputFields();
        return redirect('/admin/anggota-perpustakaan')->with('success', 'Data Anggota berhasil dihapus.');
    }
}