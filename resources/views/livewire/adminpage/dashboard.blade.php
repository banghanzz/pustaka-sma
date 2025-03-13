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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBuku }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $sedangDipinjam }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $selesaiDipinjam }}</div>
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
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $bukuRusak }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-book-dead fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert --}}
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

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
                                <th class="" width="">Nomor Peminjaman</th>
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
                            @foreach ($latestPeminjaman as $itemPeminjaman)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->nomor_pinjaman }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->keranjang->user->nama }}</td>
                                    <td class="align-middle">
                                        {{ $itemPeminjaman->buku->judul ?? 'Data Buku tidak ditemukan' }}</td>
                                    <td class="align-middle">Rak
                                        {{ $itemPeminjaman->buku->rak->rak ?? 'Data rak tidak ditemukan' }} - Baris
                                        {{ $itemPeminjaman->buku->rak->baris ?? '' }}</td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_pinjam)) }}</td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_kembali)) }}</td>
                                    <td class="align-middle">
                                        <div class="alert alert-warning text-center m-0" role="alert">
                                            Menunggu persetujuan
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <button wire:click="approvePeminjaman({{ $itemPeminjaman->id }})"
                                            class="btn btn-primary btn-sm w-100 mb-2">Setujui</button>
                                        <button wire:click="cancelPeminjaman({{ $itemPeminjaman->id }})"
                                            class="btn btn-outline-danger btn-sm w-100">Tidak Setujui</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Buku yang sedang dipinjam --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Peminjaman buku mendekati tenggat</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="dipinjamTable" width="100%"
                        cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="">#</th>
                                <th class="" width="">Nomor Peminjaman</th>
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
                            @foreach ($sedangDipinjamList as $itemPeminjaman)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->nomor_pinjaman }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->keranjang->user->nama }}</td>
                                    <td class="align-middle">
                                        {{ $itemPeminjaman->buku->judul ?? 'Data Buku tidak ditemukan' }}</td>
                                    <td class="align-middle">Rak
                                        {{ $itemPeminjaman->buku->rak->rak ?? 'Data rak tidak ditemukan' }} - Baris
                                        {{ $itemPeminjaman->buku->rak->baris ?? '' }}</td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_pinjam)) }}</td>
                                    <td class="align-middle">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_kembali)) }}</td>
                                    <td class="align-middle">
                                            @switch($itemPeminjaman->status_peminjaman)
                                                @case('dipinjam')
                                                    <div class="alert alert-info text-center m-0" role="alert">
                                                        Sedang dipinjam
                                                    </div>
                                                @break

                                                @case('terlambat')
                                                    @php
                                                        $tanggalKembali = \Carbon\Carbon::parse(
                                                            $itemPeminjaman->tanggal_kembali,
                                                        );
                                                        $hariTerlambat = floor($tanggalKembali->diffInDays(now()));
                                                    @endphp
                                                    <div class="alert alert-danger text-center m-0" role="alert">
                                                        Terlambat {{ $hariTerlambat }} hari
                                                    </div>
                                                @break

                                                @default
                                                    {{ ucfirst($itemPeminjaman->status_peminjaman) }}
                                            @endswitch
                                    </td>
                                    <td class="align-middle text-center">
                                        <button wire:click="completePeminjaman({{ $itemPeminjaman->id }})"
                                            class="btn btn-primary btn-sm w-100 mb-2">Sudah Kembali</button>
                                        <a href="https://t.me/+62{{ $itemPeminjaman->keranjang->user->nomor_telegram }}"
                                            target="_blank" class="btn btn-outline-primary btn-sm w-100">Hubungi
                                            Peminjam</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        $(document).ready(function() {
            $('#dipinjamTable').DataTable();
        });

        $(document).ready(function() {
            $('#setujuTable').DataTable();
        });
    </script>
@endsection
