<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\PenggunaanPakan;
use App\Models\Karyawan;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    /**
     * Ambil data karyawan login
     */
    private function getKaryawan()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan) {
            abort(403, 'Data karyawan tidak ditemukan.');
        }

        return $karyawan;
    }

    /**
     * DASHBOARD KARYAWAN
     * (INI YANG DIPANGGIL ROUTE)
     */
    public function dashboard()
    {
        $karyawan = $this->getKaryawan();

        // ===============================
        // STATISTIK PENGGUNAAN PAKAN
        // ===============================

        // Total penggunaan pakan (semua waktu)
        $totalPenggunaanPakan = PenggunaanPakan::where('karyawans_id', $karyawan->id)
            ->sum('jumlah');

        // Total transaksi penggunaan pakan
        $totalTransaksi = PenggunaanPakan::where('karyawans_id', $karyawan->id)
            ->count();

        // Penggunaan pakan hari ini
        $penggunaanHariIni = PenggunaanPakan::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->sum('jumlah');

        // Penggunaan pakan bulan ini
        $penggunaanBulanIni = PenggunaanPakan::where('karyawans_id', $karyawan->id)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        // ===============================
        // DATA TERBARU (WIDGET / TABLE)
        // ===============================
        $penggunaanTerbaru = PenggunaanPakan::with(['kandang', 'pakan'])
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('karyawan.dashboard', compact(
            'karyawan',
            'totalPenggunaanPakan',
            'totalTransaksi',
            'penggunaanHariIni',
            'penggunaanBulanIni',
            'penggunaanTerbaru'
        ));
    }
}
