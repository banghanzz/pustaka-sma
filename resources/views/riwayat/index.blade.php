@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Riwayat Peminjaman Buku</h2>

        {{-- Table --}}
        <div wire:ignore class="py-4 mb-3">
            <table class="table text-center table-bordered table-striped" id="riwayatTable">
                <thead class="table-dark">
                    <tr>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="1%">#</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">No. Peminjaman</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Judul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Penulis</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Jumlah</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Lokasi</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Tanggal Pinjam</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Tanggal Kembali</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Waktu Pengembalian</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Denda</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach ($slots as $slot) --}}
                        <tr>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                            <td class="align-middle fs-6"></td>
                        </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>

    </div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#riwayatTable').DataTable();
} );
</script>
@endsection
