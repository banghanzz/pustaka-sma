{{-- Modal Tambah Data Buku Rusak --}}
<div wire:ignore.self class="modal fade" id="tambahBukuRusakModal" tabindex="-1" aria-labelledby="tambahBukuRusakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Tambah Data Buku Rusak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="store">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="buku_id" class="text-dark">Pilih Buku</label>
                        <select type="text" class="form-control text-dark" id="buku_id" wire:model="buku_id" required >
                            <option value="" selected disabled>Pilih Buku</option>
                            @foreach ($semuaBuku as $itemBuku)
                                <option value="{{ $itemBuku->id }}">{{ $itemBuku->judul }} [{{ $itemBuku->penulis }}] - Stok: {{ $itemBuku->stok }}</option>         
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_ringan" class="text-dark">Rusak Ringan</label>
                        <input type="number" class="form-control text-dark" id="rusak_ringan" wire:model="rusak_ringan" required placeholder="Ketikkan Banyaknya Buku Rusak Ringan"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_sedang" class="text-dark">Rusak Sedang</label>
                        <input type="number" class="form-control text-dark" id="rusak_sedang" wire:model="rusak_sedang" required placeholder="Ketikkan Banyaknya Buku Rusak Sedang"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_berat" class="text-dark">Rusak Berat</label>
                        <input type="number" class="form-control text-dark" id="rusak_berat" wire:model="rusak_berat" required placeholder="Ketikkan Banyaknya Buku Rusak Berat"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Ubah Data Buku Rusak --}}
<div wire:ignore.self class="modal fade" id="ubahBukuRusakModal" tabindex="-1" aria-labelledby="ubahBukuRusakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Ubah Data Buku Rusak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="update">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="buku_id" class="text-dark">Pilih Buku</label>
                        <select type="text" class="form-control text-dark" id="buku_id" wire:model="buku_id" required >
                            <option value="{{ $selectedBukuRusak }}" selected>{{ $judul }} [{{ $penulis }}] - Stok: {{ $stok }}</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_ringan" class="text-dark">Rusak Ringan</label>
                        <input type="number" class="form-control text-dark" id="rusak_ringan" wire:model="rusak_ringan" required placeholder="Ketikkan Banyaknya Buku Rusak Ringan"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_sedang" class="text-dark">Rusak Sedang</label>
                        <input type="number" class="form-control text-dark" id="rusak_sedang" wire:model="rusak_sedang" required placeholder="Ketikkan Banyaknya Buku Rusak Sedang"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <div class="form-group mb-3">
                        <label for="rusak_berat" class="text-dark">Rusak Berat</label>
                        <input type="number" class="form-control text-dark" id="rusak_berat" wire:model="rusak_berat" required placeholder="Ketikkan Banyaknya Buku Rusak Berat"/>
                        <small id="help" class="form-text text-muted">Isi dengan "0" jika kosong</small>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Modal Hapus Data Buku Rusak --}}
<div wire:ignore.self class="modal fade" id="hapusBukuRusakModal" tabindex="-1" aria-labelledby="hapusBukuRusakLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark font-weight-bold">Hapus Data Buku Rusak</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form wire:submit.prevent="delete">
                    @csrf
                    <div class="text-center mb-3 text-dark font-weight-bold">
                        Data Buku Rusak berikut akan terhapus, anda yakin ?
                    </div>
                    <table class="w-100">
                        <tr>
                            <td width="30%" class="text-dark">Buku</td>
                            <td width="70%" class="text-dark">: {{ $judul }} [{{ $penulis }}] - Stok: {{ $stok }} </td>
                        </tr>
                        <tr>
                            <td width="30%" class="text-dark">Rusak Ringan</td>
                            <td width="70%" class="text-dark">: {{ $rusak_ringan }} </td>
                        </tr>
                        <tr>
                            <td width="30%" class="text-dark">Rusak Sedang</td>
                            <td width="70%" class="text-dark">: {{ $rusak_sedang }} </td>
                        </tr>
                        <tr>
                            <td width="30%" class="text-dark">Rusak Berat</td>
                            <td width="70%" class="text-dark">: {{ $rusak_berat }} </td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-danger w-100 mt-3">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>