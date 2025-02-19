<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\DetailPeminjaman;

class Notifikasi extends Command
{
    protected $signature = 'kirim:pesan';
    protected $description = 'Mengirim pengingat H-3 sebelum tanggal pengumpulan';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $this->info('Command kirim:pesan dijalankan di Notifikasi');
        $pinjaman = DetailPeminjaman::where('status_peminjaman', '!=', 'selesai')->get();
        foreach ($pinjaman as $pinjam) {
            $tanggalPengumpulan = Carbon::parse($pinjam->tanggal_kembali);
            $tanggalPengingat = $tanggalPengumpulan->copy()->subDays(3);
            $tanggalHMin1 = $tanggalPengumpulan->copy()->subDay(1);
            $tanggalTerlambat = $tanggalPengumpulan->copy()->addDay();

            if (Carbon::now()->isSameDay($tanggalPengingat)) {
                $nama = $pinjam->keranjang->user->nama;
                $chatId = $pinjam->keranjang->user->chat_id;
                $buku = $pinjam->buku->judul;

                $text = 'Peringatan : Batas pengembalian dengan judul buku ' . $buku .' atas nama ' . $nama . ' adalah 3 hari lagi';
                file_get_contents("https://api.telegram.org/bot7876373650:AAG_Ld2C6BXXy7TJWIUd4V5lP-jX02pdM34/sendMessage?chat_id=". $chatId . "&text=".$text);
            }

            if (Carbon::now()->isSameDay($tanggalHMin1)) {
                $nama = $pinjam->keranjang->user->nama;
                $chatId = $pinjam->keranjang->user->chat_id;
                $buku = $pinjam->buku->judul;

                $text = 'Pengingat: Besok adalah batas pengembalian pinjaman dari ' . $nama . ' dengan judul buku ' . $buku;
                file_get_contents("https://api.telegram.org/bot7876373650:AAG_Ld2C6BXXy7TJWIUd4V5lP-jX02pdM34/sendMessage?chat_id=". $chatId . "&text=".$text);
            }

            if (Carbon::now()->isSameDay($tanggalPengumpulan)) {
                $nama = $pinjam->keranjang->user->nama;
                $chatId = $pinjam->keranjang->user->chat_id;
                $buku = $pinjam->buku->judul;

                $text = 'Peringatan: Hari ini adalah batas pengembalian pinjaman dari ' . $nama . ' dengan judul buku ' . $buku;
                file_get_contents("https://api.telegram.org/bot7876373650:AAG_Ld2C6BXXy7TJWIUd4V5lP-jX02pdM34/sendMessage?chat_id=". $chatId . "&text=".$text);
            }

            if (Carbon::now()->isSameDay($tanggalTerlambat)) {
                $nama = $pinjam->keranjang->user->nama;
                $chatId = $pinjam->keranjang->user->chat_id;
                $buku = $pinjam->buku->judul;

                $text = 'Peringatan: Pinjaman dari ' . $nama . ' dengan judul buku '. $buku . ' sudah melewati batas pengembalian! Segera hubungi pihak Perpustakaan SMA Negeri 3 Tualang';
                file_get_contents("https://api.telegram.org/bot7876373650:AAG_Ld2C6BXXy7TJWIUd4V5lP-jX02pdM34/sendMessage?chat_id=". $chatId . "&text=".$text);
            }
        }
    }
}