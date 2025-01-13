<div>
    <div class="px-5">
        {{-- Add Data Button --}}
        <div class="py-4">
            <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#">+ Anggota Perpustakaan</a>
        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show m-0" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Anggota Perpustakaan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="koleksiTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="1%">#</th>
                                <th class="" width="">Foto Anggota</th>
                                <th class="" width="">Nama Anggota</th>
                                <th class="" width="">NISN/NIP</th>
                                <th class="" width="">Alamat</th>
                                <th class="" width="">Email</th>
                                <th class="" width="">No Telegram</th>
                                <th class="" width="">Level Anggota</th>                                
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle"></td>
                                <td class="align-middle d-flex">
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100 mr-2">Ubah</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100">Hapus</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    $(document).ready( function () {
    $('#koleksiTable').DataTable();
} );
</script>
@endsection
