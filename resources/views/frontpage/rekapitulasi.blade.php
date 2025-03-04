@extends('layout.main')

@section('content')
    {{-- Navbar --}}
    @include('components.topNavbar')

    <div class="container mt-5">
        {{-- Judul Halaman --}}
        <h2 class="mb-5 text-center">Rekapitulasi Kondisi Buku</h2>

        {{-- Filter Controls --}}
        <form action="{{ route('rekapitulasi') }}" method="GET" class="mb-4">
            <div class="row mb-4">
                <div class="col-md-3">
                    <select name="tahun" class="form-select">
                        <option value="">Semua Tahun</option>
                        @for ($i = date('Y'); $i >= 2020; $i--)
                            <option value="{{ $i }}" {{ $selectedTahun == $i ? 'selected' : '' }}>
                                {{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="bulan" class="form-select">
                        <option value="">Semua Bulan</option>
                        <option value="01" {{ $selectedBulan == '01' ? 'selected' : '' }}>Januari</option>
                        <option value="02" {{ $selectedBulan == '02' ? 'selected' : '' }}>Februari</option>
                        <option value="03" {{ $selectedBulan == '03' ? 'selected' : '' }}>Maret</option>
                        <option value="04" {{ $selectedBulan == '04' ? 'selected' : '' }}>April</option>
                        <option value="05" {{ $selectedBulan == '05' ? 'selected' : '' }}>Mei</option>
                        <option value="06" {{ $selectedBulan == '06' ? 'selected' : '' }}>Juni</option>
                        <option value="07" {{ $selectedBulan == '07' ? 'selected' : '' }}>Juli</option>
                        <option value="08" {{ $selectedBulan == '08' ? 'selected' : '' }}>Agustus</option>
                        <option value="09" {{ $selectedBulan == '09' ? 'selected' : '' }}>September</option>
                        <option value="10" {{ $selectedBulan == '10' ? 'selected' : '' }}>Oktober</option>
                        <option value="11" {{ $selectedBulan == '11' ? 'selected' : '' }}>November</option>
                        <option value="12" {{ $selectedBulan == '12' ? 'selected' : '' }}>Desember</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('rekapitulasi') }}" class="btn btn-outline-primary ml-2">Bulan ini</a>
                </div>
            </div>
        </form>

        <a href="{{ route('rekapitulasi.downloadPDF', ['bulan' => $selectedBulan, 'tahun' => $selectedTahun]) }}" class="btn btn-primary" target="_blank">
            Download PDF
        </a> 

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
                            <td class="align-middle text-center">
                                {{ $itemRekapitulasi->rusak_ringan + $itemRekapitulasi->rusak_sedang + $itemRekapitulasi->rusak_berat }}
                            </td>
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
