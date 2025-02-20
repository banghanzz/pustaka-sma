{{-- Modal Tambah Data Anggota Perpustakaan --}}
<div wire:ignore.self class="modal fade" id="tambahAnggotaModal" tabindex="-1" aria-labelledby="tambahAnggotaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Anggota Perpustakaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <!-- Nama Input -->
                    <div class="mb-3 form-group">
                        <label for="nama" class="text-dark">Nama</label>
                        <input type="text" id="nama" class="form-control" placeholder="Masukkan nama lengkap" wire:model="nama" required>
                    </div>

                    <!-- NISN/NIK Input -->
                    <div class="mb-3 form-group">
                        <label for="nomor_induk" class="text-dark">NISN/NIP</label>
                        <input type="text" id="nomor_induk" class="form-control"  placeholder="Masukkan NISN atau NIP" wire:model="nomor_induk" required>
                    </div>

                    <!-- Alamat Input -->
                    <div class="mb-3 form-group">
                        <label for="alamat" class="text-dark">Alamat</label>
                        <input type="text" id="alamat" class="form-control" placeholder="Masukkan alamat lengkap" wire:model="alamat" required>
                    </div>

                    <!-- Nomor Telegram Input -->
                    <div class="mb-3 form-group">
                        <label for="nomor_telegram" class="text-dark">Nomor Telegram</label>
                        <input type="text" id="nomor_telegram" class="form-control" placeholder="Masukkan nomor Telegram" wire:model="nomor_telegram" required>
                    </div>

                    <!-- Chat ID Telegram Input -->
                    <div class="mb-3 form-group">
                        <label for="chat_id" class="text-dark">Chat ID Telegram</label>
                        <input type="text" id="chat_id" class="form-control" placeholder="Masukkan Chat ID Telegram" wire:model="chat_id" required>
                        <a href="{{ url('/tutorial-chat-id') }}" class="fw-semibold m-0 text-center text-decoration-none" target="_blank">
                            Lihat Tutorial Mendapatkan Chat ID Telegram
                        </a>
                    </div>

                    <!-- Level Pengguna Input -->
                    <div class="mb-3 form-group">
                        <label for="roles_id" class="text-dark">Level Pengguna</label>
                        <select id="roles_id" class="custom-select" wire:model="roles_id">
                            <option value="" selected>Pilih Level Pengguna</option>
                            <option value="1">Pustakawan</option>
                            <option value="2">Kepala Sekolah</option>
                            <option value="3">Guru</option>
                            <option value="4">Siswa</option>
                        </select>
                        @error('roles_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Kelas Input (Hanya untuk siswa) -->
                    <div class="mb-3 form-group" id="kelasInput" style="display: none;">
                        <label for="kelas" class="text-dark">Kelas</label>
                        <input type="text" id="kelas" class="form-control" wire:model="kelas" placeholder="Contoh : 12-1">
                    </div>

                    <!-- Pas Foto Input -->
                    <div class="mb-3 form-group">
                        <label for="foto_profil" class="text-dark">Pas Foto</label>
                        <input type="file" id="foto_profil" class="form-control-file" wire:model="foto_profil">
                        <small id="photoHelp" class="form-text text-muted">Upload gambar maksimal 1024 KB (1 MB)</small>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3 form-group">
                        <label for="email" class="text-dark">Email</label>
                        <input type="email" id="email" class="form-control" placeholder="Masukkan email" wire:model="email" required>
                    </div>

                    <!-- Password Input -->
                    <div class="mb-3 form-group">
                        <label for="password" class="text-dark">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" class="form-control border-right-0"
                                placeholder="Masukkan password" wire:model="password" required>
                            <div class="input-group-addon">
                                <button class="btn h-100 border border-left-0"
                                    style="border-radius: 0 10px 10px 0; border-color:#9e9e9e" type="button" id="togglePassword">
                                    <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>
                        <small id="passwordHelp" class="form-text @error('password') text-danger @else text-muted @enderror">
                            @error('password')
                                {{ $message }}
                            @else
                                Minimal 8 karakter
                            @enderror
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Anggota Perpustakaan --}}
<div wire:ignore.self class="modal fade" id="ubahAnggotaModal" tabindex="-1" aria-labelledby="ubahAnggotaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Anggota Perpustakaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <!-- Nama Input -->
                    <div class="mb-3 form-group">
                        <label for="nama" class="text-dark">Nama</label>
                        <input type="text" id="nama" class="form-control" placeholder="Masukkan nama lengkap" wire:model="nama" required>
                    </div>

                    <!-- NISN/NIK Input -->
                    <div class="mb-3 form-group">
                        <label for="nomor_induk" class="text-dark">NISN/NIP</label>
                        <input type="text" id="nomor_induk" class="form-control" placeholder="Masukkan NISN atau NIP" wire:model="nomor_induk" required>
                    </div>

                    <!-- Alamat Input -->
                    <div class="mb-3 form-group">
                        <label for="alamat" class="text-dark">Alamat</label>
                        <input type="text" id="alamat" class="form-control" placeholder="Masukkan alamat lengkap" wire:model="alamat" required>
                    </div>

                    <!-- Nomor Telegram Input -->
                    <div class="mb-3 form-group">
                        <label for="nomor_telegram" class="text-dark">Nomor Telegram</label>
                        <input type="text" id="nomor_telegram" class="form-control" placeholder="Masukkan nomor Telegram" wire:model="nomor_telegram" required>
                    </div>

                    <!-- Chat ID Telegram Input -->
                    <div class="mb-3 form-group">
                        <label for="chat_id" class="text-dark">Chat ID Telegram</label>
                        <input type="text" id="chat_id" class="form-control" placeholder="Masukkan Chat ID Telegram" wire:model="chat_id" required>
                        <a href="{{ url('/tutorial-chat-id') }}" class="fw-semibold m-0 text-center text-decoration-none" target="_blank">
                            Lihat Tutorial Mendapatkan Chat ID Telegram
                        </a>
                    </div>

                    <!-- Level Pengguna Input -->
                    <div class="mb-3 form-group">
                        <label for="roles_id" class="text-dark">Level Pengguna</label>
                        <select id="roles_id" class="custom-select" wire:model="roles_id">
                            <option value="{{ $roles_id }}" selected>{{ $role }}</option>
                            <option value="1">Pustakawan</option>
                            <option value="2">Kepala Sekolah</option>
                            <option value="3">Guru</option>
                            <option value="4">Siswa</option>
                        </select>
                    </div>

                    <!-- Kelas Input (Hanya untuk siswa) -->
                    <div class="mb-3 form-group" id="kelasInput" style="display: none;">
                        <label for="kelas" class="text-dark">Kelas</label>
                        <input type="text" id="kelas" class="form-control" wire:model="kelas" placeholder="Masukkan kelas">
                    </div>

                    <!-- Pas Foto Input -->
                    <div class="mb-3 form-group">
                        <label for="foto_profil" class="text-dark">Pas Foto</label>
                        <input type="file" id="foto_profil" class="form-control-file" wire:model="foto_profil">
                        <small id="photoHelp" class="form-text text-muted">Upload gambar maksimal 1024 KB (1 MB)</small>
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3 form-group">
                        <label for="email" class="text-dark">Email</label>
                        <input type="email" id="email" class="form-control" wire:model="email" placeholder="Masukkan email" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Data Anggota Perpustakaan --}}
<div wire:ignore.self class="modal fade" id="hapusAnggotaModal" tabindex="-1" aria-labelledby="hapusAnggotaLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Anggota Perpustakaan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="delete">
                    @csrf
                    <div class="text-center mb-3 text-dark font-weight-bold">
                        Anggota berikut akan dihapus, anda yakin ?
                    </div>
                    <table class="w-100">
                        <tr>
                            <td width="20%" class="text-dark">Nama</td>
                            <td width="80%" class="text-dark">: {{ $nama }}</td>
                        </tr>
                        <tr>
                            <td width="20%" class="text-dark">NISN/NIP</td>
                            <td width="80%" class="text-dark">: {{ $nomor_induk }}</td>
                        </tr>
                        <tr>
                            <td width="20%" class="text-dark">Email</td>
                            <td width="80%" class="text-dark">: {{ $email }}</td>
                        </tr>
                        <tr>
                            <td width="20%" class="text-dark">Level</td>
                            <td width="80%" class="text-dark">: {{ $role }}</td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>