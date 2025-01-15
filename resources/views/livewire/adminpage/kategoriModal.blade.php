{{-- Modal Tambah Data Kategori Buku --}}
<div wire:ignore.self class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="tambahKategoriLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Data Kategori Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="form-group">
                        <label for="namaKategori" class="text-dark">Nama Kategori Buku</label>
                        <input type="text" class="form-control text-dark" id="namaKategori" wire:model="namaKategori" required placeholder="Ketikkan Nama Kategori Buku">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Kategori Buku --}}
<div wire:ignore.self class="modal fade" id="ubahKategoriModal" tabindex="-1" aria-labelledby="ubahKategoriLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Data Kategori Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group">
                        <label for="namaKategori" class="text-dark">Nama Kategori Buku</label>
                        <input type="text" class="form-control text-dark" id="namaKategori" wire:model="namaKategori" required placeholder="Ketikkan Nama Kategori Buku">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Data Kategori Buku --}}
<div wire:ignore.self class="modal fade" id="hapusKategoriModal" tabindex="-1" aria-labelledby="hapusKategoriLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Data Kategori Buku</h5>
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
                            <td width="20%" class="text-dark">Kategori</td>
                            <td width="80%" class="text-dark">: {{ $namaKategori }}</td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>