{{-- Modal Tambah Tata Tertib --}}
<div wire:ignore.self class="modal fade" id="tambahTertibModal" tabindex="-1" aria-labelledby="tambahTertibLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Tata Tertib</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="form-group">
                        <label for="judul_tata_tertib" class="text-dark">Judul Tata Tertib</label>
                        <input type="text" class="form-control text-dark" id="judul_tata_tertib" wire:model="judul_tata_tertib" required placeholder="Ketikkan Nama Rak Buku">
                    </div>
                    <div class="form-group">
                        <label for="isi_tata_tertib" class="text-dark">Isi Tata Tertib</label>
                        <textarea rows="5" class="form-control" id="isi_tata_tertib" wire:model="isi_tata_tertib" required placeholder="Ketikkan Isi Tata Tertib"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Tata Tertib --}}
<div wire:ignore.self class="modal fade" id="ubahTertibModal" tabindex="-1" aria-labelledby="ubahTertibLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Tata Tertib</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group">
                        <label for="judul_tata_tertib" class="text-dark">Judul Tata Tertib</label>
                        <input type="text" class="form-control text-dark" id="judul_tata_tertib" wire:model="judul_tata_tertib" required placeholder="Ketikkan Nama Rak Buku">
                    </div>
                    <div class="form-group">
                        <label for="isi_tata_tertib" class="text-dark">Isi Tata Tertib</label>
                        <textarea rows="5" class="form-control" id="isi_tata_tertib" wire:model="isi_tata_tertib" required placeholder="Ketikkan Isi Tata Tertib"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Tata Tertib --}}
<div wire:ignore.self class="modal fade" id="hapusTertibModal" tabindex="-1" aria-labelledby="hapusTertibLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Tata Tertib</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="delete">
                    @csrf
                    <div class="text-center mb-3 text-dark font-weight-bold">
                        Tata Tertib berikut akan dihapus, anda yakin ?
                    </div>
                    <table class="w-100">
                        <tr>
                            <td width="20%" class="text-dark">Judul</td>
                            <td width="80%" class="text-dark">: {{ $judul_tata_tertib }}</td>
                        </tr>
                        <tr>
                            <td width="20%" class="text-dark">Isi</td>
                            <td width="80%" class="text-dark">: {!! nl2br(e( $isi_tata_tertib)) !!}</td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>