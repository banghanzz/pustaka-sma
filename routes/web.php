<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuPerpustakaanController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\KoleksiBukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\RiwayatController;
use App\Http\Controllers\TataTertibController;
use App\Http\Controllers\VIsiMisiController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost']);
});

Route::get('/signup', function () {
    return view('signup.index');
});

Route::get('/', [KoleksiBukuController::class, 'index']);
Route::get('/tata-tertib', [TataTertibController::class, 'index']);
Route::get('/visi-misi', [VIsiMisiController::class, 'index']);
Route::get('/kartu-perpustakaan', [KartuPerpustakaanController::class, 'index']);
Route::get('/keranjang', [KeranjangController::class, 'index']);
Route::get('/riwayat', [RiwayatController::class, 'index']);
Route::get('/rekapitulasi', [RekapitulasiController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index']);


