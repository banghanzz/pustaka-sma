<div>
    <div class="px-5">
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

        {{-- Filter --}}
        <ul class="nav nav-pills mb-3">
            <li class="nav-item">
                <a class="nav-link {{ $activeFilter === 'semua' ? 'active' : '' }}" href="#"
                    wire:click.prevent="setFilter('semua')">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeFilter === 'menunggu' ? 'active' : '' }}" href="#"
                    wire:click.prevent="setFilter('menunggu')">Perlu Disetujui</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeFilter === 'dipinjam' ? 'active' : '' }}" href="#"
                    wire:click.prevent="setFilter('dipinjam')">Sedang Dipinjam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeFilter === 'selesai' ? 'active' : '' }}" href="#"
                    wire:click.prevent="setFilter('selesai')">Selesai</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ $activeFilter === 'peganganguru' ? 'active' : '' }}" href="#"
                    wire:click.prevent="setFilter('peganganguru')">Pegangan Guru</a>
            </li>
        </ul>
        {{-- Card Table --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Transaksi Peminjaman</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="transaksiTable" width="100%"
                        cellspacing="0">
                        <thead class="">
                            <tr>
                                <th class="" width="">#</th>
                                <th class="" width="">Nomor Pinjaman</th>
                                <th class="" width="">Nama Peminjam</th>
                                <th class="" width="">Buku Dipinjam</th>
                                <th class="" width="">Lokasi Buku</th>
                                <th class="" width="">Tanggal Pinjam</th>
                                <th class="" width="">Tanggal Kembali</th>
                                <th class="" width="">Status</th>
                                <th class="" width="">Waktu Pengembalian</th>
                                <th class="" width="">Denda</th>
                                <th class="" width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($detailPeminjaman as $itemPeminjaman)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->nomor_pinjaman }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->keranjang->user->nama }}</td>
                                    <td class="align-middle">{{ $itemPeminjaman->buku->judul }}</td>
                                    <td class="align-middle">Rak {{ $itemPeminjaman->buku->rak->rak }} - Baris
                                        {{ $itemPeminjaman->buku->rak->baris }}</td>
                                    <td class="align-middle text-center">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_pinjam)) }}</td>
                                    <td class="align-middle text-center">
                                        {{ date('d-m-Y', strtotime($itemPeminjaman->tanggal_kembali)) }}</td>
                                    <td class="align-middle">
                                        @switch($itemPeminjaman->status_peminjaman)
                                            @case('menunggu')
                                                <div class="alert alert-warning text-center m-0" role="alert">
                                                    Menunggu persetujuan
                                                </div>
                                            @break

                                            @case('dibatalkan')
                                                <div class="alert alert-warning text-center m-0" role="alert">
                                                    Peminjaman tidak disetujui
                                                </div>
                                            @break

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

                                            @case('selesai')
                                                <div class="alert alert-success text-center m-0" role="alert">
                                                    Selesai
                                                </div>
                                            @break

                                            @default
                                                {{ ucfirst($itemPeminjaman->status_peminjaman) }}
                                        @endswitch
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($itemPeminjaman->tanggal_pengembalian)
                                        {{ \Carbon\Carbon::parse($itemPeminjaman->tanggal_pengembalian)->setTimezone('Asia/Jakarta')->format('H:i') }} WIB<br>
                                        {{ \Carbon\Carbon::parse($itemPeminjaman->tanggal_pengembalian)->setTimezone('Asia/Jakarta')->format('d-m-Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle">
                                        @if ($itemPeminjaman->denda > 0)
                                            <span class="text-danger">
                                                Rp {{ number_format($itemPeminjaman->denda, 0, ',', '.') }}
                                            </span>
                                        @elseif($itemPeminjaman->status_peminjaman == 'terlambat')
                                            @php
                                                $tanggalKembali = \Carbon\Carbon::parse(
                                                    $itemPeminjaman->tanggal_kembali,
                                                );
                                                $hariTerlambat = floor($tanggalKembali->diffInDays(now()));
                                                $potentialDenda = $hariTerlambat * 500;
                                            @endphp
                                            <span class="text-danger font-weight-bold">
                                                Rp {{ number_format($potentialDenda, 0, ',', '.') }}
                                            </span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="align-middle text-center">
                                        @if ($itemPeminjaman->status_peminjaman == 'menunggu')
                                            <button type="button"
                                                wire:click="approvePeminjaman({{ $itemPeminjaman->id }})"
                                                class="btn btn-primary btn-sm w-100 mb-2">Setujui</button>
                                            <button type="button"
                                                wire:click="cancelPeminjaman({{ $itemPeminjaman->id }})"
                                                class="btn btn-outline-danger btn-sm w-100">Batalkan</button>
                                        @elseif (in_array($itemPeminjaman->status_peminjaman, ['dipinjam', 'terlambat']))
                                            <button type="button"
                                                wire:click="completePeminjaman({{ $itemPeminjaman->id }})"
                                                class="btn btn-outline-primary btn-sm w-100 mb-2">Selesaikan</button>
                                            <a href="https://t.me/+62{{ $itemPeminjaman->keranjang->user->nomor_telegram }}"
                                                target="_blank" class="btn btn-outline-primary btn-sm w-100">Hubungi
                                                Peminjam</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">Tidak ada peminjaman yang menunggu
                                            persetujuan</td>
                                    </tr>
                                @endforelse
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
                $('#transaksiTable').DataTable();
            });
        </script>
    @endsection
