<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahRakModal">+ Data Rak Buku</a>
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
                <h6 class="m-0 font-weight-bold text-primary">Rak Buku</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="rakTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Rak</th>
                                <th class="" width="">Baris</th>
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rak as $itemRak)                                
                            <tr>
                                <td class="align-middle">{{ $loop->iteration }}</td>
                                <td class="align-middle">{{ $itemRak->rak }}</td>
                                <td class="align-middle">{{ $itemRak->baris }}</td>
                                <td class="align-middle d-flex">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 mr-2" data-toggle="modal" data-target="#ubahRakModal" wire:click="show({{ $itemRak->id }})">Ubah</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100" data-toggle="modal" data-target="#hapusRakModal" wire:click="show({{ $itemRak->id }})">Hapus</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @include('livewire.adminpage.rakModal')
</div>

@section('script')
<script>
    $(document).ready(function() {
        $('#rakTable').DataTable();

        // Reinitialize DataTables when modal is closed
        $('#ubahRakModal, #hapusRakModal').on('hidden.bs.modal', function () {
            $('#rakTable').DataTable();
        });
    });

    // Listen for Livewire events to reinitialize DataTables
    Livewire.on('modalClosed', () => {
        $('#rakTable').DataTable();
    });
</script>
@endsection