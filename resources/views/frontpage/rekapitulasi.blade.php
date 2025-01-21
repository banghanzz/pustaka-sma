@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Rekapitulasi Kondisi Buku</h2>

        {{-- Table --}}
        <div wire:ignore class="py-4 mb-3">
            <table class="table text-center table-bordered table-striped" id="">
                <thead class="table-dark">
                    <tr>
                        <th class="fs-6 fw-semibold text-center align-middle" width="1%">#</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Judul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Penulis</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Kategori</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Jumlah Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Rusak Ringan</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Rusak Sedang</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Rusak Berat</th>
                        <th class="fs-6 fw-semibold text-center align-middle" width="">Total Rusak</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekapitulasi as $itemRekapitulasi)   
                        <tr>
                            <td class="align-middle">{{ $loop->iteration }}</td>
                            <td class="align-middle">{{ $itemRekapitulasi->buku->judul }}</td>
                            <td class="align-middle">{{ $itemRekapitulasi->buku->penulis }}</td>
                            <td class="align-middle">{{ $itemRekapitulasi->buku->kategori->nama }}</td>
                            <td class="align-middle text-center">{{ $itemRekapitulasi->buku->stok }}</td>
                            <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_ringan }}</td>
                            <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_sedang }}</td>
                            <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_berat }}</td>
                            <td class="align-middle text-center">{{ $itemRekapitulasi->rusak_ringan + $itemRekapitulasi->rusak_sedang + $itemRekapitulasi->rusak_berat }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4"><strong>Total</strong></td>
                        <td class="fw-semibold">{{ $totalJumlah }}</td>
                        <td class="fw-semibold">{{ $totalRusakRingan }}</td>
                        <td class="fw-semibold">{{ $totalRusakSedang }}</td>
                        <td class="fw-semibold">{{ $totalRusakBerat }}</td>
                        <td class="fw-semibold">{{ $totalRusak }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection