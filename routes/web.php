<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Karyawan\ProduksiTelurController as KaryawanProduksiTelurController;
use App\Http\Controllers\Admin\KaryawanController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriPengeluaranController;
use App\Http\Controllers\Admin\PenjualanController;
use App\Http\Controllers\Admin\ProduksiTelurController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Karyawan\PengeluaranController;
use App\Http\Controllers\Karyawan\ProfilController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Karyawan\KaryawanController as KaryawanDashboardController;
use App\Http\Controllers\Admin\KandangController;
use App\Http\Controllers\Admin\PakanController;
use App\Http\Controllers\Admin\OperasiKandangController;
use App\Http\Controllers\Admin\PembelianPakanController;
use App\Http\Controllers\Admin\PenggunaanPakanController;
use App\Http\Controllers\Admin\PendapatanKandangController;

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

    // Dashboard Karyawan - ⭐ GANTI DENGAN CONTROLLER
    Route::get('/dashboard', [KaryawanDashboardController::class, 'dashboard'])->name('dashboard');

    // Input Produksi
    Route::get('/produksi', [KaryawanProduksiTelurController::class, 'index'])->name('produksi.index');
    Route::post('/produksi', [KaryawanProduksiTelurController::class, 'store'])->name('produksi.store');
    Route::get('/produksi/{id}/edit', [KaryawanProduksiTelurController::class, 'edit'])->name('produksi.edit');
    Route::put('/produksi/{id}', [KaryawanProduksiTelurController::class, 'update'])->name('produksi.update');
    Route::delete('/produksi/{id}', [KaryawanProduksiTelurController::class, 'destroy'])->name('produksi.destroy');

    // Input Pengeluaran
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{pengeluaran}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');

    // Riwayat
    Route::get('/riwayat/produksi', [KaryawanProduksiTelurController::class, 'riwayat'])->name('riwayat.produksi');
    Route::get('/riwayat/pengeluaran', [PengeluaranController::class, 'riwayat'])->name('riwayat.pengeluaran');

    // Laporan Pengeluaran Karyawan
    Route::get('/laporan/pengeluaran', [PengeluaranController::class, 'index'])->name('laporan.pengeluaran');

    // Profil
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');
    Route::put('/profil', [ProfilController::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil/password', [ProfilController::class, 'updatePassword'])->name('profil.update-password');
});

// ===============================
// ADMIN ROUTES (AUTH REQUIRED)
// ===============================

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {

    // Dashboard - ⭐ GANTI DENGAN CONTROLLER (INI YANG PENTING!)
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Data Master - ⭐ GANTI DENGAN CONTROLLER
    Route::get('/data-master', [AdminController::class, 'dataMaster'])->name('dataMaster');

    // ===============================
    // RESOURCE ROUTES
    // ===============================

    // User Management
    Route::resource('user', UserController::class)->except(['show']);

    // Karyawan
    Route::resource('karyawan', KaryawanController::class)->except(['show']);

    // Kategori
    Route::resource('kategori', KategoriController::class)->except(['show']);

    // Kandang
    Route::resource('kandang', KandangController::class)->except(['show']);

    // Pakan
    Route::resource('pakan', PakanController::class)->except(['show']);

    // Operasi Kandang
    Route::resource('operasi-kandang', OperasiKandangController::class)->except(['show']);

    // Pembelian Pakan
    Route::resource('pembelian-pakan', PembelianPakanController::class)->except(['show']);

    // Penggunaan Pakan
    Route::resource('penggunaan-pakan', PenggunaanPakanController::class)->except(['show']);

    // Pendapatan Kandang
    Route::get('pendapatan-kandang', [PendapatanKandangController::class, 'index'])->name('pendapatan-kandang.index');

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
