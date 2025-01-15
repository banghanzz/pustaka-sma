<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahKategoriModal">+ Data Kategori Buku</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Kategori Buku</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="kategoriTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Kategori</th>
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $itemKategori)    
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $itemKategori->nama }}</td>
                                <td class="align-middle d-flex">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 mr-2" data-toggle="modal" data-target="#ubahKategoriModal" wire:click="show({{ $itemKategori->id }})">Ubah</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100" data-toggle="modal" data-target="#hapusKategoriModal" wire:click="show({{ $itemKategori->id }})">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.adminpage.kategoriModal')
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#kategoriTable').DataTable();

        // Reinitialize DataTables when modal is closed
        $('#ubahKategoriModal, #hapusKategoriModal').on('hidden.bs.modal', function () {
            $('#kategoriTable').DataTable();
        });
    });

    // Listen for Livewire events to reinitialize DataTables
    Livewire.on('modalClosed', () => {
        $('#kategoriTable').DataTable();
    });
</script>
@endsection
