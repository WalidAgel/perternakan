<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Karyawan;
use App\Models\ProduksiTelur;
use App\Models\KategoriPengeluaran;
use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    /**
     * Menampilkan dashboard karyawan dengan statistik dan data terkini.
     */
    public function dashboard()
    {
        // Pastikan user adalah karyawan
        if (Auth::user()->role !== 'karyawan') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Ambil data karyawan yang login
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan) {
            return redirect()->route('login')
                ->with('error', 'Data karyawan tidak ditemukan!');
        }

        // === STATISTIK PRODUKSI ===

        // Produksi hari ini
        $produksiHariIni = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->sum('jumlah');

        // Produksi kemarin untuk perbandingan
        $produksiKemarin = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::yesterday())
            ->sum('jumlah');

        // Hitung persentase perubahan
        $perubahanProduksi = 0;
        if ($produksiKemarin > 0) {
            $perubahanProduksi = (($produksiHariIni - $produksiKemarin) / $produksiKemarin) * 100;
        }

        // Produksi bulan ini
        $produksiBulanIni = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        // Rata-rata produksi harian bulan ini
        $jumlahHariBulanIni = Carbon::now()->day;
        $rataRataHarian = $jumlahHariBulanIni > 0 ? $produksiBulanIni / $jumlahHariBulanIni : 0;

        // === STATISTIK PENGELUARAN ===

        // Pengeluaran hari ini
        $pengeluaranHariIni = KategoriPengeluaran::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->sum('jumlah');

        // Jumlah transaksi pengeluaran hari ini
        $jumlahTransaksiHariIni = KategoriPengeluaran::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->count();

        // Pengeluaran bulan ini
        $pengeluaranBulanIni = KategoriPengeluaran::where('karyawans_id', $karyawan->id)
            ->whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        // Rata-rata pengeluaran harian
        $rataRataPengeluaran = $jumlahHariBulanIni > 0 ? $pengeluaranBulanIni / $jumlahHariBulanIni : 0;

        // === DATA GRAFIK PRODUKSI MINGGUAN (7 hari terakhir) ===

        $produksiMingguan = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereBetween('tanggal', [Carbon::now()->subDays(6), Carbon::now()])
            ->select(
                DB::raw('DATE(tanggal) as tanggal'),
                DB::raw('SUM(jumlah) as total')
            )
            ->groupBy('tanggal')
            ->orderBy('tanggal', 'asc')
            ->get();

        // Format data untuk chart
        $chartLabels = [];
        $chartData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('D'); // Senin, Selasa, dst

            $produksi = $produksiMingguan->firstWhere('tanggal', $date->format('Y-m-d'));
            $chartData[] = $produksi ? round($produksi->total, 1) : 0;
        }

        // === RIWAYAT PRODUKSI TERBARU (5 terakhir) ===

        $produksiTerbaru = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // === RIWAYAT PENGELUARAN TERBARU (5 terakhir) ===

        $pengeluaranTerbaru = KategoriPengeluaran::with('kategori')
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // === STATISTIK PENJUALAN (TOTAL/GLOBAL - untuk informasi) ===

        $penjualanHariIni = Penjualan::whereDate('tanggal', Carbon::today())
            ->sum('total');

        $penjualanBulanIni = Penjualan::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('total');

        // === DATA SISA STOK (Contoh - bisa disesuaikan) ===

        // Total produksi bulan ini
        $totalProduksiBulanIni = ProduksiTelur::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah');

        // Total terjual bulan ini
        $totalTerjualBulanIni = Penjualan::whereMonth('tanggal', Carbon::now()->month)
            ->whereYear('tanggal', Carbon::now()->year)
            ->sum('jumlah_terjual');

        // Estimasi sisa stok
        $estimasiSisaStok = $totalProduksiBulanIni - $totalTerjualBulanIni;
        $persentaseSisa = $totalProduksiBulanIni > 0
            ? ($estimasiSisaStok / $totalProduksiBulanIni) * 100
            : 0;

        return view('karyawan.dashboard', compact(
            'karyawan',
            'produksiHariIni',
            'produksiKemarin',
            'perubahanProduksi',
            'produksiBulanIni',
            'rataRataHarian',
            'pengeluaranHariIni',
            'jumlahTransaksiHariIni',
            'pengeluaranBulanIni',
            'rataRataPengeluaran',
            'penjualanHariIni',
            'penjualanBulanIni',
            'estimasiSisaStok',
            'persentaseSisa',
            'chartLabels',
            'chartData',
            'produksiTerbaru',
            'pengeluaranTerbaru'
        ));
    }

    /**
     * Menampilkan profil karyawan.
     */
    public function profil()
    {
        $user = Auth::user();
        $karyawan = Karyawan::where('user_id', $user->id)->first();

        if (!$karyawan) {
            return redirect()->route('karyawan.dashboard')
                ->with('error', 'Data karyawan tidak ditemukan!');
        }

        // Statistik tambahan untuk profil
        $totalProduksi = ProduksiTelur::where('karyawans_id', $karyawan->id)->sum('jumlah');
        $totalPengeluaran = KategoriPengeluaran::where('karyawans_id', $karyawan->id)->sum('jumlah');
        $totalInputProduksi = ProduksiTelur::where('karyawans_id', $karyawan->id)->count();
        $totalInputPengeluaran = KategoriPengeluaran::where('karyawans_id', $karyawan->id)->count();

        return view('karyawan.profil.index', compact(
            'user',
            'karyawan',
            'totalProduksi',
            'totalPengeluaran',
            'totalInputProduksi',
            'totalInputPengeluaran'
        ));
    }

    /**
     * Menampilkan statistik karyawan (untuk modal/ajax).
     */
    public function statistik()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan) {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }

        // Statistik lengkap
        $stats = [
            'produksi' => [
                'total' => ProduksiTelur::where('karyawans_id', $karyawan->id)->sum('jumlah'),
                'bulan_ini' => ProduksiTelur::where('karyawans_id', $karyawan->id)
                    ->whereMonth('tanggal', Carbon::now()->month)
                    ->sum('jumlah'),
                'hari_ini' => ProduksiTelur::where('karyawans_id', $karyawan->id)
                    ->whereDate('tanggal', Carbon::today())
                    ->sum('jumlah'),
                'total_input' => ProduksiTelur::where('karyawans_id', $karyawan->id)->count(),
            ],
            'pengeluaran' => [
                'total' => KategoriPengeluaran::where('karyawans_id', $karyawan->id)->sum('jumlah'),
                'bulan_ini' => KategoriPengeluaran::where('karyawans_id', $karyawan->id)
                    ->whereMonth('tanggal', Carbon::now()->month)
                    ->sum('jumlah'),
                'hari_ini' => KategoriPengeluaran::where('karyawans_id', $karyawan->id)
                    ->whereDate('tanggal', Carbon::today())
                    ->sum('jumlah'),
                'total_input' => KategoriPengeluaran::where('karyawans_id', $karyawan->id)->count(),
            ],
        ];

        return response()->json($stats);
    }

    /**
     * Notifikasi untuk karyawan.
     */
    public function notifikasi()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        // Cek apakah sudah input produksi hari ini
        $sudahInputHariIni = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::today())
            ->exists();

        // Cek produksi kemarin untuk perbandingan
        $produksiKemarin = ProduksiTelur::where('karyawans_id', $karyawan->id)
            ->whereDate('tanggal', Carbon::yesterday())
            ->first();

        $notifikasi = [];

        if (!$sudahInputHariIni) {
            $notifikasi[] = [
                'type' => 'warning',
                'message' => 'Anda belum melakukan input produksi hari ini.',
                'action' => route('karyawan.produksi.index'),
                'action_text' => 'Input Sekarang'
            ];
        }

        if ($produksiKemarin && $produksiKemarin->jumlah < 100) {
            $notifikasi[] = [
                'type' => 'info',
                'message' => 'Produksi kemarin di bawah target ('. number_format($produksiKemarin->jumlah, 1) .' kg). Perhatikan kondisi ayam.',
                'action' => route('karyawan.riwayat.produksi'),
                'action_text' => 'Lihat Riwayat'
            ];
        }

        return view('karyawan.notifikasi', compact('notifikasi'));
    }
}
