<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Icon pada Head Title -->
    <link rel="icon" type="image/x-icon" href="{{ public_path('/assets/images/tut-wuri-handayani.png') }}">

    <title>Laporan Data Keadaan Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .header {
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
            height: auto;
            margin-right: 0px;
            float: left;
        }
        .header .title {
            text-align: left;
            display: inline-block;
            vertical-align: top;
        }
        .content {
            margin: 20px;
        }
        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .content table th, .content table td {
            border: 1px solid black;
            text-align: center;
            padding: 8px;
        }
        .signature {
            margin-top: 30px;
            width: 100%;
        }
        .signature table {
            width: 100%;
            border-collapse: collapse;
        }
        .signature td {
            text-align: center;
            vertical-align: top;
            padding: 20px;
        }
        .borderless-table {
            width: 100%;
            border-collapse: collapse;
        }
        .borderless-table th, .borderless-table td {
            border: none;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('/assets/images/tut-wuri-handayani.png') }}" alt="Logo SMA Negeri 3 Tualang">
        <div class="title">
            <h2>Perpustakaan Pijar Cakrawala SMA Negeri 3 Tualang</h2>
            <p>Jl. AMD Pinang Sebatang Timur</p>
        </div>
    </div>
    <div class="content">
        <h3>Laporan Data Keadaan Buku Perpustakaan SMA Negeri 3 Tualang</h3>
        <table class="borderless-table">
            <tr>
                <td>Bulan</td>
                <td>: {{ $currentMonth }}</td>
            </tr>
            <tr>
                <td>Tahun</td>
                <td>: {{ $currentYear }}</td>
            </tr>
        </table>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Jumlah Buku</th>
                    <th>Rusak Ringan</th>
                    <th>Rusak Sedang</th>
                    <th>Rusak Berat</th>
                    <th>Total Rusak</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data buku diisi di sini -->
                @foreach ($rekapitulasi as $itemRekapitulasi)   
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $itemRekapitulasi->buku->judul }}</td>
                        <td>{{ $itemRekapitulasi->buku->penulis }}</td>
                        <td>{{ $itemRekapitulasi->buku->kategori->nama }}</td>
                        <td>{{ $itemRekapitulasi->buku->stok }}</td>
                        <td>{{ $itemRekapitulasi->rusak_ringan }}</td>
                        <td>{{ $itemRekapitulasi->rusak_sedang }}</td>
                        <td>{{ $itemRekapitulasi->rusak_berat }}</td>
                        <td>{{ $itemRekapitulasi->rusak_ringan + $itemRekapitulasi->rusak_sedang + $itemRekapitulasi->rusak_berat }}</td>
                    </tr>
                    
                @endforeach
                <!-- Tambahkan baris lain jika diperlukan -->
                <tr>
                    <td colspan="4"><strong>Total</strong></td>
                    <td>{{ $totalJumlah }}</td>
                    <td>{{ $totalRusakRingan }}</td>
                    <td>{{ $totalRusakSedang }}</td>
                    <td>{{ $totalRusakBerat }}</td>
                    <td>{{ $totalRusak }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="signature">
        <table>
            <tr>
                <td>
                    Mengetahui,<br>
                    Kepala Sekolah SMA Negeri 3 Tualang<br><br><br>
                    <strong>Nama</strong><br>
                    NIP. 0000000000000000
                </td>
                <td>
                    Perawang, 01 Januari 2025<br>
                    Kepala Perpustakaan<br><br><br>
                    <strong>Nama</strong><br>
                    NIP. 0000000000000000
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
