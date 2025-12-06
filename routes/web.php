<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
// use App\Http\Controllers\Karyawan\KaryawanController AS KaryawanProduksiTelurController;
use App\Http\Controllers\Karyawan\ProduksiTelurController AS KaryawanProduksiTelurController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriPengeluaranController;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\ProduksiTelurController;
use App\Http\Controllers\Admin\LaporanController;

// ===============================
// AUTH ROUTES (PUBLIC)
// ===============================

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ===============================
// KARYAWAN ROUTES (AUTH REQUIRED)
// ===============================

Route::prefix('karyawan')->name('karyawan.')->middleware('auth')->group(function () {

    // Dashboard Karyawan
    Route::get('/dashboard', function () {
        // Cek role
        if (Auth::check() && Auth::user()->role !== 'karyawan') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        return view('karyawan.dashboard');
    })->name('dashboard');

    // Input Produksi
    Route::get('/produksi', [KaryawanProduksiTelurController::class, 'index'])->name('produksi.index');
    Route::post('/produksi', [KaryawanProduksiTelurController::class, 'store'])->name('produksi.store');
    Route::get('/produksi/{id}/edit', [KaryawanProduksiTelurController::class, 'edit'])->name('produksi.edit');
    Route::put('/produksi/{id}', [KaryawanProduksiTelurController::class, 'update'])->name('produksi.update');
    Route::delete('/produksi/{id}', [KaryawanProduksiTelurController::class, 'destroy'])->name('produksi.destroy');

    // Input Pengeluaran
    Route::get('/pengeluaran', [KategoriPengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::post('/pengeluaran', [KategoriPengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{pengeluaran}/edit', [KategoriPengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{pengeluaran}', [KategoriPengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{pengeluaran}', [KategoriPengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    // Riwayat
    Route::get('/riwayat/produksi', [ProduksiTelurController::class, 'riwayat'])->name('riwayat.produksi');
    Route::get('/riwayat/pengeluaran', [KategoriPengeluaranController::class, 'riwayat'])->name('riwayat.pengeluaran');

    // Profil
    Route::get('/profil', function () {
        if (Auth::check() && Auth::user()->role !== 'karyawan') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        return view('karyawan.profil');
    })->name('profil');
});

// ===============================
// ADMIN ROUTES (AUTH REQUIRED)
// ===============================

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        // Cek role
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        return view('admin.dashboard');
    })->name('dashboard');

    // Data Master
    Route::get('/data-master', function () {
        if (Auth::check() && Auth::user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
        return view('admin.DataMaster');
    })->name('dataMaster');

    // ===============================
    // RESOURCE ROUTES
    // ===============================

    // User Management
    Route::resource('user', UserController::class)->except(['show']);

    // Karyawan
    Route::resource('karyawan', KaryawanController::class)->except(['show']);

    // Kategori
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // Kategori Pengeluaran
    Route::resource('pengeluaran', KategoriPengeluaranController::class)->except(['show']);

    // Produksi Telur
    Route::resource('produksi', ProduksiTelurController::class)->except(['show']);

    // Penjualan
    Route::resource('penjualan', PenjualanController::class)->except(['show']);

    // ===============================
    // LAPORAN ROUTES
    // ===============================
    Route::prefix('laporan')->name('laporan.')->group(function () {
        // Laporan Produksi
        Route::get('/produksi', [LaporanController::class, 'produksi'])->name('produksi');
        Route::get('/produksi/pdf', [LaporanController::class, 'produksiPdf'])->name('produksi.pdf');

        // Laporan Pengeluaran
        Route::get('/pengeluaran', [LaporanController::class, 'pengeluaran'])->name('pengeluaran');
        Route::get('/pengeluaran/pdf', [LaporanController::class, 'pengeluaranPdf'])->name('pengeluaran.pdf');

        // Laporan Penjualan
        Route::get('/penjualan', [LaporanController::class, 'penjualan'])->name('penjualan');
        Route::get('/penjualan/pdf', [LaporanController::class, 'penjualanPdf'])->name('penjualan.pdf');
    });
});
