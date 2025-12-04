<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\KategoriPengeluaranController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProduksiTelurController;   // <-- TAMBAHKAN INI

// ===============================
// AUTH ROUTES
// ===============================

Route::get('/', [AuthController::class, 'index']);

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// RESOURCE DI LUAR ADMIN
// ===============================

Route::resource('karyawan', KaryawanController::class);
Route::resource('kategori', KategoriController::class);


// ===============================
// ADMIN ROUTES (AUTH WAJIB)
// ===============================

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Data Master
    Route::get('/data-master', function () {
        return view('admin.DataMaster');
    })->name('dataMaster');

    // Kategori Pengeluaran (Resource)
    Route::resource('pengeluaran', KategoriPengeluaranController::class);

    // PRODUKSI - gunakan controller, bukan langsung view
    Route::resource('produksi', ProduksiTelurController::class);

    // Penjualan (🔥 DIPINDAHKAN KE SINI)
    Route::resource('penjualan', PenjualanController::class);


    // Laporan
    Route::get('/laporan', function () {
        return view('admin.Laporan');
    })->name('laporan');

    // User Management
    Route::get('/user', function () {
        return view('admin.UserManagement');
    })->name('user');
});
