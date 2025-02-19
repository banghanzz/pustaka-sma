@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Keranjang Peminjaman Buku</h2>

        {{-- Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Table --}}
        <div wire:ignore class="py-4 mb-3">
            <table class="table text-center table-bordered table-striped" id="keranjangTable">
                <thead class="table-dark">
                    <tr>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="1%">#</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Sampul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Judul Buku</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Penulis</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Jumlah</th>
                        <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Lokasi</th>
                        @if (
                            $detailPeminjaman->filter(function ($item) {
                                    return in_array($item->status_peminjaman, ['menunggu', 'dipinjam', 'dibatalkan', 'terlambat']);
                                })->isNotEmpty())
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Nomor
                                Pinjaman</th>
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Tanggal
                                Pinjam</th>
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Tanggal
                                Kembali</th>
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Denda</th>
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="">Status</th>
                        @endif
                        @if ($detailPeminjaman->contains('status_peminjaman', 'keranjang'))
                            <th class="fs-6 fw-semibold text-center align-middle" scope="col" width="6%">Aksi</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse ($detailPeminjaman as $itemPeminjaman)
                        <tr>
                            <td class="align-middle fs-6">{{ $loop->iteration }}</td>
                            <td class="align-middle text-center">
                                <img src="{{ $itemPeminjaman->buku->sampul ? Storage::url($itemPeminjaman->buku->sampul) : asset('assets/images/default_cover_book.jpg') }}"
                                    onerror="this.onerror=null;this.src='{{ asset('assets/images/default_cover_book.jpg') }}';"
                                    class="img-fluid rounded shadow" width="60px">
                            </td>
                            <td class="align-middle fs-6">{{ $itemPeminjaman->buku->judul ?? 'Data Buku tidak ditemukan' }}
                            </td>
                            <td class="align-middle fs-6">
                                {{ $itemPeminjaman->buku->penulis ?? 'Data Buku tidak ditemukan' }}</td>
                            <td class="align-middle text-center fs-6">{{ $itemPeminjaman->jumlah }}</td>
                            <td class="align-middle fs-6">Rak
                                {{ $itemPeminjaman->buku->rak->rak ?? 'Data rak tidak ditemukan' }} - Baris
                                {{ $itemPeminjaman->buku->rak->baris ?? '' }}</td>
                            @if (in_array($itemPeminjaman->status_peminjaman, ['menunggu', 'dipinjam', 'dibatalkan', 'terlambat']))
                                <td class="align-middle fs-6">{{ $itemPeminjaman->nomor_pinjaman }}</td>
                                <td class="align-middle text-center fs-6">
                                    {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_pinjam)) }}</td>
                                <td class="align-middle text-center fs-6">
                                    {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_kembali)) }}</td>
                                <td class="align-middle fs-6">{{ $itemPeminjaman->denda ?? '-' }}</td>
                                <td class="align-middle fs-6">

                                    @switch($itemPeminjaman->status_peminjaman)
                                        @case('menunggu')
                                            <div class="alert alert-warning text-center m-0" role="alert">
                                                Menunggu persetujuan Pustakawan
                                            </div>
                                        @break

                                        @case('dibatalkan')
                                            <div class="alert alert-warning text-center m-0" role="alert">
                                                Peminjaman kamu tidak disetujui Pustakawan
                                            </div>
                                        @break

                                        @case('dipinjam')
                                            <div class="alert alert-info text-center m-0" role="alert">
                                                Kamu sedang meminjam
                                            </div>
                                        @break

                                        @case('terlambat')
                                            <div class="alert alert-danger text-center m-0" role="alert">
                                                Segera kembalikan buku, denda akan bertambah setiap harinya
                                            </div>
                                        @break

                                        @default
                                            {{ ucfirst($itemPeminjaman->status_peminjaman) }}
                                    @endswitch
        </div>
        </td>
        @endif
        @if ($itemPeminjaman->status_peminjaman == 'keranjang')
            <td class="align-middle fs-6">
                <form action="{{ route('keranjang.remove', $itemPeminjaman->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger btn-sm"><i class="bi bi-trash3"></i></button>
                </form>
            </td>
        @endif
        </tr>
        @empty
            @endforelse
            </tbody>
            </table>
        </div>

        @if (
            $detailPeminjaman->filter(function ($item) {
                    return in_array($item->status_peminjaman, ['keranjang']);
                })->isNotEmpty())
            {{-- Button Ajukan Pinjaman --}}
            <div class="row justify-content-center mb-5">
                <div class="col-md-4">
                    <form action="{{ route('keranjang.ajukan') }}" method="POST">
                        @csrf
                        <div class="input-group-lg mb-3">
                            <label for="tanggalpinjam" class="form-label">Tanggal Mulai Pinjam</label>
                            <input type="date" class="form-control" id="tanggalpinjam" name="tanggal_pinjam"
                                value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="input-group-lg mb-3">
                            <label for="tanggalkembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" id="tanggalkembali" name="tanggal_kembali"
                                value="{{ date('Y-m-d', strtotime('+3 days')) }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary px-5 py-2 fs-5 fw-semibold w-100">Ajukan
                            Peminjaman</button>
                    </form>
                </div>
            </div>
        @endif
        </div>
    @endsection

    @section('script')
        <script>
            $(document).ready(function() {
                $('#keranjangTable').DataTable();

                // Fungsi untuk mengatur tanggal kembali minimal
                function updateTanggalKembali() {
                    const tanggalPinjam = $('#tanggalpinjam').val();
                    $('#tanggalkembali').attr('min', tanggalPinjam);
                }

                // Panggil fungsi saat halaman dimuat
                updateTanggalKembali();

                // Update minimal tanggal kembali saat tanggal pinjam berubah
                $('#tanggalpinjam').on('change', updateTanggalKembali);
            });
        </script>
    @endsection
