@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Rekapitulasi Kondisi Buku</h2>

        {{-- Table --}}
        <div wire:ignore class="py-4 mb-3">
            <table class="table text-center table-bordered table-striped" id="rekapTable">
                <thead class="table-dark">
                    <tr>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="1%">#</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Judul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Penulis</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Kategori</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Rusak Ringan</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Rusak Sedang</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Rusak Berat</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Jumlah</th>
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
                        </tr>
                    {{-- @endforeach --}}
                    <tr>
                        <td class="align-middle fs-6" colspan="4">Jumlah Total</td>
                        <td class="align-middle fs-6"></td>
                        <td class="align-middle fs-6"></td>
                        <td class="align-middle fs-6"></td>
                        <td class="align-middle fs-6"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
<script>
    $(document).ready( function () {
    $('#rekapTable').DataTable();
} );
</script>
@endsection
