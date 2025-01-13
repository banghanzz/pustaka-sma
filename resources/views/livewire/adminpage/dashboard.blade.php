<div>
    <div class="px-5">
        <div class="row">
            <!-- Total Buku Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Buku</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1234</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Sedang Dipinjam Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Sedang Dipinjam</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">56</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book-reader fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Selesai Dipinjam Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Selesai Dipinjam</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-double fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Buku Rusak Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-danger shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                    Buku Rusak</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book-dead fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Peminjaman Perlu Disetujui --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Peminjaman Perlu Disetujui</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="setujuTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="">#</th>
                                <th class="" width="">Kode Peminjam</th>
                                <th class="" width="">Nama Peminjam</th>
                                <th class="" width="">Buku Dipinjam</th>
                                <th class="" width="">Lokasi Buku</th>
                                <th class="" width="">Tanggal Pinjam</th>
                                <th class="" width="">Tanggal Kembali</th>
                                <th class="" width="">Status</th>
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
                                <td class="align-middle">
                                    <div class="alert alert-warning text-center m-0" role="alert">
                                        Menunggu persetujuan
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary btn-sm w-100 mb-2">Setujui</button>
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100">Tidak Setujui</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Buku yang sedang dipinjam --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Buku yang Sedang Dipinjam</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dipinjamTable" width="100%" cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="">#</th>
                                <th class="" width="">Kode Peminjam</th>
                                <th class="" width="">Nama Peminjam</th>
                                <th class="" width="">Buku Dipinjam</th>
                                <th class="" width="">Lokasi Buku</th>
                                <th class="" width="">Tanggal Pinjam</th>
                                <th class="" width="">Tanggal Kembali</th>
                                <th class="" width="">Status</th>
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
                                <td class="align-middle">
                                    <div class="alert alert-info text-center m-0" role="alert">
                                        Sedang Dipinjam
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    <button type="button" class="btn btn-primary btn-sm w-100 mb-2">Sudah Kembali</button>
                                    <button type="button" class="btn btn-outline-primary btn-sm w-100">Hubungi Peminjam</button>
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
    $('#dipinjamTable').DataTable();
} );

    $(document).ready( function () {
    $('#setujuTable').DataTable();
} );
</script>
@endsection