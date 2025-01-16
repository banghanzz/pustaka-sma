<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahKoleksiBukuModal">+ Data Koleksi Buku</a>
        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if (session()->has('error'))
        <div class="alert alert-warning alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Koleksi Buku</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="koleksiTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Sampul Buku</th>
                                <th class="" width="">Judul Buku</th>
                                <th class="" width="">Penulis</th>
                                <th class="" width="">Penerbit</th>
                                <th class="" width="">Kategori</th>
                                <th class="" width="">Stok Buku</th>
                                <th class="" width="">Lokasi Buku</th>
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($buku as $itemBuku)    
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle text-center">
                                    <img src="{{ $itemBuku->sampul ? Storage::url($itemBuku->sampul) : asset('assets/images/default_cover_book.jpg') }}" 
                                         onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cover_book.jpg') }}';" 
                                         class="img-fluid rounded shadow" width="60px">
                                </td>
                                <td class="align-middle">{{ $itemBuku->judul }}</td>
                                <td class="align-middle">{{ $itemBuku->penulis }}</td>
                                <td class="align-middle">{{ $itemBuku->penerbit }}</td>
                                <td class="align-middle text-center">{{ $itemBuku->kategori->nama ?? 'Data kategori tidak ditemukan' }}</td>
                                <td class="align-middle text-center">{{ $itemBuku->stok }}</td>
                                <td class="align-middle">Rak {{ $itemBuku->rak->rak ?? 'Data rak tidak ditemukan' }} - Baris {{ $itemBuku->rak->baris ?? '' }}</td>
                                <td class="align-middle text-center">
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-outline-primary btn-sm mr-2" data-toggle="modal" data-target="#ubahKoleksiBukuModal" wire:click="show({{ $itemBuku->id }})">Ubah</button>
                                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapusKoleksiBukuModal" wire:click="show({{ $itemBuku->id }})">Hapus</button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    @include('livewire.adminpage.koleksibukuModal')
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#koleksiTable').DataTable();

        // Reinitialize DataTables when modal is closed
        $('#ubahKoleksiBukuModal, #hapusKoleksiBukuModal').on('hidden.bs.modal', function () {
            $('#koleksiTable').DataTable();
        });
    });

    // Listen for Livewire events to reinitialize DataTables
    Livewire.on('modalClosed', () => {
        $('#koleksiTable').DataTable();
    });
</script>
@endsection
