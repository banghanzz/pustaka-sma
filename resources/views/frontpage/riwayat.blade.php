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
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="1%">#</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">No. Peminjaman</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Judul Buku</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Penulis</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Jumlah</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Lokasi</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Tanggal Pinjam</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Tanggal Kembali</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Waktu Pengembalian</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Denda</th>
                        <th class="fw-semibold text-center align-middle" style="font-size: 14px" scope="col" width="">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($riwayatPeminjaman as $itemPeminjaman)
                        <tr>
                            <td class="align-middle text-center" style="font-size: 12px">{{ $loop->iteration }}</td>
                            <td class="align-middle text-nowrap" style="font-size: 12px">{{ $itemPeminjaman->nomor_pinjaman }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ $itemPeminjaman->buku->judul ?? 'Data Buku tidak ditemukan' }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ $itemPeminjaman->buku->penulis ?? 'Data Buku tidak ditemukan' }}</td>
                            <td class="align-middle text-center" style="font-size: 12px">{{ $itemPeminjaman->jumlah }}</td>
                            <td class="align-middle text-nowrap" style="font-size: 12px">Rak {{ $itemPeminjaman->buku->rak->rak ?? 'Data rak tidak ditemukan' }} - Baris {{ $itemPeminjaman->buku->rak->baris ?? '' }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_pinjam)) }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_kembali)) }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ $itemPeminjaman->waktu_pengembalian ? date('d-m-Y', strtotime($itemPeminjaman->waktu_pengembalian)) : '-' }}</td>
                            <td class="align-middle" style="font-size: 12px">{{ $itemPeminjaman->denda ?? '-' }}</td>
                            <td class="align-middle">
                                @switch($itemPeminjaman->status_peminjaman)
                                        @case('menunggu')
                                            <div class="alert alert-warning text-center m-0" style="font-size: 12px" role="alert">
                                                Menunggu persetujuan Pustakawan
                                            </div>
                                            @break
                                        @case('dibatalkan')
                                            <div class="alert alert-warning text-center m-0" style="font-size: 12px" role="alert">
                                                Peminjaman kamu tidak disetujui Pustakawan
                                            </div>
                                            @break
                                        @case('dipinjam')
                                            <div class="alert alert-info text-center m-0" style="font-size: 12px" role="alert">
                                                Kamu sedang meminjam
                                            </div>
                                            @break
                                        @case('terlambat')
                                            <div class="alert alert-danger text-center m-0" style="font-size: 12px" role="alert">
                                                Segera kembalikan buku, denda akan bertambah setiap harinya
                                            </div>
                                            @break
                                        @case('selesai')
                                            <div class="alert alert-success text-center m-0" style="font-size: 12px" role="alert">
                                                Selesai
                                            </div>
                                            @break
                                        @default
                                            {{ ucfirst($itemPeminjaman->status_peminjaman) }}
                                    @endswitch
                            </td>
                        </tr>
                    @endforeach
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
