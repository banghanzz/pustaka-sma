<div>
    <div class="px-5">
        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link active" href="#">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Perlu Disetujui</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Sedang Dipinjam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Selesai</a>
            </li>
        </ul>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="transaksiTable" width="100%" cellspacing="0">
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
                                    <button type="button" class="btn btn-outline-danger btn-sm w-100">Tidak
                                        Setujui</button>
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
    $('#transaksiTable').DataTable();
} );
</script>
@endsection
