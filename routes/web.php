<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CheckAdmin;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard',  [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/transaksi/{id}/struk', [TransaksiController::class, 'viewStruk'])->name('transaksi.struk');
    Route::resource('transaksi', TransaksiController::class);
    Route::resource('genre', GenreController::class)->except(['show']);

    Route::resource('user', UserController::class)->except(['show']);
    Route::resource('buku', BukuController::class)->except(['show']);
    Route::resource('/users', UserController::class);
    Route::put('/users/{id}/change-password', [UserController::class, 'changePassword'])->name('users.changePassword');
    Route::middleware(CheckAdmin::class)->group(function () {
    Route::get('/transaksi/{id}/pdf', [TransaksiController::class, 'cetakPdf'])->name('transaksi.pdf');

    });
});

Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->name('logout');