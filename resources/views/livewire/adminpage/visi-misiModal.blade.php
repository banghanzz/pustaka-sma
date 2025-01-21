{{-- Modal Ubah Visi Misi --}}
<div wire:ignore.self class="modal fade" id="ubahVisiMisiModal" tabindex="-1" aria-labelledby="ubahVisiMisiLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Visi & Misi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group">
                        <label for="visi" class="text-dark">Visi</label>
                        <input type="text" class="form-control text-dark" id="visi" wire:model="visi" required placeholder="Ketikkan Nama Rak Buku">
                    </div>
                    <div class="form-group">
                        <label for="misi" class="text-dark">Misi</label>
                        <textarea rows="16" class="form-control" id="misi" wire:model="misi" required placeholder="Ketikkan Isi Tata Tertib"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>