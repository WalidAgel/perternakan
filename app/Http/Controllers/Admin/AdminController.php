<?php

namespace App\Http\Controllers\Admin;

use App\Models\Karyawan;
use App\Models\ProduksiTelur;
use App\Models\KategoriPengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik Produksi
        $produksiHariIni = ProduksiTelur::whereDate('tanggal', Carbon::today())->sum('jumlah') ?? 0;
        $produksiKemarin = ProduksiTelur::whereDate('tanggal', Carbon::yesterday())->sum('jumlah') ?? 0;

        $perubahanProduksi = 0;
        if ($produksiKemarin > 0) {
            $perubahanProduksi = (($produksiHariIni - $produksiKemarin) / $produksiKemarin) * 100;
        } elseif ($produksiHariIni > 0) {
            $perubahanProduksi = 100;
        }

        // Statistik Pengeluaran
        $pengeluaranHariIni = KategoriPengeluaran::whereDate('tanggal', Carbon::today())->sum('jumlah') ?? 0;
        $jumlahTransaksiPengeluaran = KategoriPengeluaran::whereDate('tanggal', Carbon::today())->count() ?? 0;

        // Statistik Penjualan
        $penjualanHariIni = Penjualan::whereDate('tanggal', Carbon::today())->sum('total') ?? 0;
        $penjualanKemarin = Penjualan::whereDate('tanggal', Carbon::yesterday())->sum('total') ?? 0;

        $perubahanPenjualan = 0;
        if ($penjualanKemarin > 0) {
            $perubahanPenjualan = (($penjualanHariIni - $penjualanKemarin) / $penjualanKemarin) * 100;
        } elseif ($penjualanHariIni > 0) {
            $perubahanPenjualan = 100;
        }

        // Chart Produksi Mingguan
        $produksiMingguan = ProduksiTelur::whereBetween('tanggal', [
                Carbon::now()->subDays(6)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('SUM(jumlah) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $chartProduksiLabels = [];
        $chartProduksiData = [];
        $hariIndo = ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartProduksiLabels[] = $hariIndo[$date->dayOfWeek];
            $produksi = $produksiMingguan->firstWhere('tanggal', $date->format('Y-m-d'));
            $chartProduksiData[] = $produksi ? round($produksi->total, 1) : 0;
        }

        // Chart Pengeluaran per Kategori
        $pengeluaranPerKategori = KategoriPengeluaran::with('kategori')
            ->select('kategoris_id', DB::raw('SUM(jumlah) as total'))
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->groupBy('kategoris_id')
            ->orderByDesc('total')
            ->limit(4)
            ->get();

        $chartPengeluaranLabels = [];
        $chartPengeluaranData = [];
        $chartPengeluaranColors = ['#3b82f6', '#ef4444', '#f59e0b', '#10b981'];

        if ($pengeluaranPerKategori->isNotEmpty()) {
            foreach ($pengeluaranPerKategori as $item) {
                $chartPengeluaranLabels[] = $item->kategori ? $item->kategori->nama_kategori : 'Lainnya';
                $chartPengeluaranData[] = round($item->total / 1000000, 2);
            }
        } else {
            $chartPengeluaranLabels = ['Belum Ada Data'];
            $chartPengeluaranData = [0];
        }

        // Chart Penjualan Harian
        $penjualanMingguan = Penjualan::whereBetween('tanggal', [
                Carbon::now()->subDays(6)->startOfDay(),
                Carbon::now()->endOfDay()
            ])
            ->select(DB::raw('DATE(tanggal) as tanggal'), DB::raw('SUM(total) as total'))
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        $chartPenjualanLabels = [];
        $chartPenjualanData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartPenjualanLabels[] = $hariIndo[$date->dayOfWeek];
            $penjualan = $penjualanMingguan->firstWhere('tanggal', $date->format('Y-m-d'));
            $chartPenjualanData[] = $penjualan ? round($penjualan->total, 0) : 0;
        }

        // Data Tabel Terbaru
        $pengeluaranTerbaru = KategoriPengeluaran::with('kategori')->orderBy('created_at', 'desc')->limit(5)->get();
        $produksiTerbaru = ProduksiTelur::with('karyawan')->orderBy('tanggal', 'desc')->limit(5)->get();
        $penjualanTerbaru = Penjualan::with('kandang')->orderBy('tanggal', 'desc')->limit(5)->get();

        return view('admin.Dashboard', compact(
            'produksiHariIni', 'perubahanProduksi',
            'pengeluaranHariIni', 'jumlahTransaksiPengeluaran',
            'penjualanHariIni', 'perubahanPenjualan',
            'chartProduksiLabels', 'chartProduksiData',
            'chartPengeluaranLabels', 'chartPengeluaranData', 'chartPengeluaranColors',
            'chartPenjualanLabels', 'chartPenjualanData',
            'pengeluaranTerbaru', 'produksiTerbaru', 'penjualanTerbaru'
        ));
    }

    public function dataMaster()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.DataMaster', compact('karyawans'));
    }
}
