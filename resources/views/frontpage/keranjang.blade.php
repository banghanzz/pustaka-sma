@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Keranjang Peminjaman Buku</h2>

        {{-- Table --}}
        <div wire:ignore class="py-4 mb-3">
            <table class="table text-center table-bordered table-striped" id="keranjangTable">
                <thead class="table-dark">
                    <tr>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="1%">#</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Judul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Penulis</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Jumlah</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Lokasi</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="6%">Aksi</th>
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
                            <td
                                class="align-middle fs-6">
                                <div class="d-flex justify-content-center align-items-center">
                                    <button type="button" class="btn btn-outline-danger"><i class="bi bi-trash3"></i></button>
                                </div>
                            </td>
                        </tr>
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>

        {{-- Button Ajukan Pinjaman --}}
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="input-group-lg mb-3">
                    <label for="tanggalpinjam" class="form-label">Tanggal Mulai Pinjam</label>
                    <input type="date" class="form-control" id="tanggalpinjam" value="{{ date('Y-m-d') }}" placeholder="">
                </div>
                <button type="button" class="btn btn-primary px-5 py-2 fs-5 fw-semibold w-100">Ajukan Peminjaman</button>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#keranjangTable').DataTable();
} );
</script>
@endsection
