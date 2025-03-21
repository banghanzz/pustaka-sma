<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\VisiMisiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\KoleksiBukuController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\KartuPerpustakaanController;
use App\Http\Controllers\ProfilPerpustakaanController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/koleksi-buku');
    }
    return redirect('/profil-perpustakaan');
});

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost']);
    Route::get('/signup', [SignupController::class, 'index']);
    Route::post('/signup', [SignupController::class, 'store']);
});

Route::get('/koleksi-buku', [KoleksiBukuController::class, 'index']);
Route::get('/tata-tertib', [TataTertibController::class, 'index']);
Route::get('/visi-misi', [VisiMisiController::class, 'index']);
Route::get('/tutorial-chat-id', [SignupController::class, 'tutorial']);
Route::get('/profil-perpustakaan', [ProfilPerpustakaanController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/kartu-perpustakaan', [KartuPerpustakaanController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::post('/keranjang/add/{id}', [KeranjangController::class, 'addToKeranjang'])->name('keranjang.add');
    Route::delete('/keranjang/{id}', [KeranjangController::class, 'removeFromKeranjang'])->name('keranjang.remove');
    Route::post('/keranjang/ajukan', [KeranjangController::class, 'ajukanPinjaman'])->name('keranjang.ajukan');
    Route::get('/ubah-password', [SignupController::class, 'ubahPasswordView'])->name('ubahpassword');
    Route::post('/ubah-password', [SignupController::class, 'updatePassword'])->name('ubahpassword.update');

    Route::group(['middleware' => 'role:1,999'], function () {
        Route::get('/admin/dashboard', [DashboardController::class, 'index']);
        Route::get('/admin/transaksi-peminjaman', [DashboardController::class, 'transaksi']);
        Route::get('/admin/rak', [DashboardController::class, 'rak']);
        Route::get('/admin/kategori', [DashboardController::class, 'kategori']);
        Route::get('/admin/koleksi-buku', [DashboardController::class, 'koleksibuku']);
        Route::get('/admin/buku-rusak', [DashboardController::class, 'bukurusak']);
        Route::get('/admin/anggota-perpustakaan', [DashboardController::class, 'anggota']);
        Route::get('/admin/rekapitulasi', [DashboardController::class, 'rekapitulasi']);
        Route::get('/admin/tata-tertib', [TataTertibController::class, 'adminVIew']);
        Route::get('/admin/visi-misi', [VIsiMisiController::class, 'adminView']);
    });

    Route::group(['middleware' => 'role:2,3,4,999'], function () {
        Route::get('/keranjang', [KeranjangController::class, 'index']);
        Route::get('/riwayat', [RiwayatController::class, 'index']);

        Route::group(['middleware' => 'role:2,999'], function () {
            Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi');
            Route::get('/rekapitulasi/download-pdf', [RekapitulasiController::class, 'downloadPDF'])->name('rekapitulasi.downloadPDF');
        });
    });
});
