<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ItemPeminjamanController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::get('/', [BukuController::class, 'index']); 


Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::resource('staff', StaffController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::patch('peminjaman/{peminjaman}/kembali', [PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');
Route::resource('item_peminjaman', ItemPeminjamanController::class);
Route::resource('anggota', AnggotaController::class);

// Route::get('/dashboard', [BukuController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [BukuController::class, 'index'])
    ->name('dashboard')
    ->middleware('auth');
Route::resource('buku', BukuController::class);
Route::get('/katalog', [BukuController::class, 'katalog'])->name('buku.katalog');

Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
Route::post('/user', [UserController::class, 'store'])->name('user.store');


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('buku.katalog');
})->name('logout');
