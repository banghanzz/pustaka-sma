{{-- Modal Tambah Data Rak Buku --}}
<div wire:ignore.self class="modal fade" id="tambahRakModal" tabindex="-1" aria-labelledby="tambahRakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Data Rak Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="form-group">
                        <label for="namarak" class="text-dark">Nama Rak Buku</label>
                        <input type="text" class="form-control text-dark" id="namarak" wire:model="namarak" required placeholder="Ketikkan Nama Rak Buku">
                    </div>
                    <div class="form-group">
                        <label for="baris" class="text-dark" placeholder="Ketikkan Baris Rak">Baris Rak</label>
                        <input type="number" class="form-control" id="baris" wire:model="baris" required placeholder="Ketikkan Baris Rak Buku">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Rak Buku --}}
<div wire:ignore.self class="modal fade" id="ubahRakModal" tabindex="-1" aria-labelledby="ubahRakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Data Rak Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group">
                        <label for="namarak" class="text-dark">Nama Rak Buku</label>
                        <input type="text" class="form-control text-dark" id="namarak" wire:model="namarak" required placeholder="Ketikkan Nama Rak Buku">
                    </div>
                    <div class="form-group">
                        <label for="baris" class="text-dark">Baris Rak</label>
                        <input type="number" class="form-control" id="baris" wire:model="baris" required placeholder="Ketikkan Baris Rak Buku">
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Data Rak Buku --}}
<div wire:ignore.self class="modal fade" id="hapusRakModal" tabindex="-1" aria-labelledby="hapusRakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Data Rak Buku</h5>
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
                            <td width="20%" class="text-dark">Rak</td>
                            <td width="80%" class="text-dark">: {{ $namarak }}</td>
                        </tr>
                        <tr>
                            <td width="20%" class="text-dark">Baris</td>
                            <td width="80%" class="text-dark">: {{ $baris }}</td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>