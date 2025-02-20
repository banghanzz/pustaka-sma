{{-- Modal Tambah Data Koleksi Buku --}}
<div wire:ignore.self class="modal fade" id="tambahKoleksiBukuModal" tabindex="-1" aria-labelledby="tambahKoleksiBukuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Data Koleksi Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="judul" class="text-dark">Judul Buku</label>
                        <input type="text" class="form-control text-dark" id="judul" wire:model="judul" required placeholder="Ketikkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <label for="penulis" class="text-dark">Penulis</label>
                        <input type="text" class="form-control text-dark" id="penulis" wire:model="penulis" required placeholder="Ketikkan Nama Penulis">
                    </div>
                    <div class="form-group">
                        <label for="penerbit" class="text-dark">Penerbit</label>
                        <input type="text" class="form-control text-dark" id="penerbit" wire:model="penerbit" required placeholder="Ketikkan Nama Penerbit">
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran" class="text-dark">Tahun Ajaran/Terbit</label>
                        <input type="text" class="form-control text-dark" id="tahun_ajaran" wire:model="tahun_ajaran" required placeholder="Ketikkan Tahun Ajaran/Terbit Buku">
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="text-dark">Kategori</label>
                        <select class="form-control text-dark" id="kategori" wire:model="kategori" required>
                            <option value="" selected>Pilih Kategori Buku</option>
                            @foreach ($kategoris as $itemKategori)
                                <option value="{{ $itemKategori->id }}">{{ $itemKategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="text-dark">Stok Buku</label>
                        <input type="number" class="form-control text-dark" id="stok" wire:model="stok" required placeholder="Ketikkan Jumlah Stok Buku">
                    </div>
                    <div class="form-group">
                        <label for="rak" class="text-dark">Lokasi Buku</label>
                        <select class="form-control text-dark" id="rak" wire:model="rak" required>
                            <option value="" selected>Pilih Lokasi Buku</option>
                            @foreach ($raks as $itemRak)
                                <option value="{{ $itemRak->id }}">Rak {{ $itemRak->rak }} - Baris {{ $itemRak->baris }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sampul" class="text-dark">Sampul Buku</label>
                        <input type="file" class="form-control-file" id="sampul" wire:model="sampul">
                        <small id="sampulHelp" class="form-text text-muted">Upload gambar maksimal 1024 KB (1 MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Koleksi Buku --}}
<div wire:ignore.self class="modal fade" id="ubahKoleksiBukuModal" tabindex="-1" aria-labelledby="ubahKoleksiBukuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Data Koleksi Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group">
                        <label for="judul" class="text-dark">Judul Buku</label>
                        <input type="text" class="form-control text-dark" id="judul" wire:model="judul" required placeholder="Ketikkan Judul Buku">
                    </div>
                    <div class="form-group">
                        <label for="penulis" class="text-dark">Penulis</label>
                        <input type="text" class="form-control text-dark" id="penulis" wire:model="penulis" required placeholder="Ketikkan Nama Penulis">
                    </div>
                    <div class="form-group">
                        <label for="penerbit" class="text-dark">Penerbit</label>
                        <input type="text" class="form-control text-dark" id="penerbit" wire:model="penerbit" required placeholder="Ketikkan Nama Penerbit">
                    </div>
                    <div class="form-group">
                        <label for="tahun_ajaran" class="text-dark">Tahun Ajaran/Terbit</label>
                        <input type="text" class="form-control text-dark" id="tahun_ajaran" wire:model="tahun_ajaran" required placeholder="Ketikkan Tahun Ajaran/Terbit Buku">
                    </div>
                    <div class="form-group">
                        <label for="kategori" class="text-dark">Kategori</label>
                        <select class="form-control text-dark" id="kategori" wire:model="kategori" required>
                            <option value="" selected disabled>Pilih Kategori Buku</option>
                            @foreach ($kategoris as $itemKategori)
                                <option value="{{ $itemKategori->id }}">{{ $itemKategori->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="stok" class="text-dark">Stok Buku</label>
                        <input type="number" class="form-control text-dark" id="stok" wire:model="stok" required placeholder="Ketikkan Jumlah Stok Buku">
                    </div>
                    <div class="form-group">
                        <label for="rak" class="text-dark">Lokasi Buku</label>
                        <select class="form-control text-dark" id="rak" wire:model="rak" required>
                            <option value="" selected disabled>Pilih Lokasi Buku</option>
                            @foreach ($raks as $itemRak)
                                <option value="{{ $itemRak->id }}">Rak {{ $itemRak->rak }} - Baris {{ $itemRak->baris }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sampul" class="text-dark">Sampul Buku</label>
                        <input type="file" class="form-control-file" id="sampul" wire:model="sampul">
                        <small id="sampulHelp" class="form-text text-muted">Upload gambar maksimal 1024 KB (1 MB)</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Data Koleksi Buku --}}
<div wire:ignore.self class="modal fade" id="hapusKoleksiBukuModal" tabindex="-1" aria-labelledby="hapusKoleksiBukuLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Data Koleksi Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="delete">
                    @csrf
                    <div class="text-center mb-3 text-dark font-weight-bold">
                        Data berikut akan dihapus, anda yakin ?
                    </div>
                    <table class="w-100">
                        <tr>
                            <td width="40%" class="text-dark">Judul</td>
                            <td width="60%" class="text-dark">: {{ $judul }}</td>
                        </tr>
                        <tr>
                            <td width="40%" class="text-dark">Penulis</td>
                            <td width="60%" class="text-dark">: {{ $penulis }}</td>
                        </tr>
                        <tr>
                            <td width="40%" class="text-dark">Penerbit</td>
                            <td width="60%" class="text-dark">: {{ $penerbit }}</td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>