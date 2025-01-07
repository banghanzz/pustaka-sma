<?php

use App\Http\Controllers\KoleksiBukuController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::group(['middleware' => 'guest'], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'loginPost']);
});


Route::get('/', [KoleksiBukuController::class, 'index']);

Route::get('/signup', function () {
    return view('signup.index');
});


