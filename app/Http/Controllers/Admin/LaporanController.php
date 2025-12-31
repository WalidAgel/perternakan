<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\KategoriPengeluaran;
use App\Models\Kategori;
use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use App\Models\Karyawan;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    // ===============================
    // LAPORAN PENGELUARAN
    // ===============================

    public function pengeluaran(Request $request)
    {
        $query = KategoriPengeluaran::with(['kategori', 'karyawan', 'kandang']);

        // Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategoris_id', $request->kategori_id);
        }

        $pengeluaran = $query->orderBy('tanggal', 'desc')->get();
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        // Data untuk chart - group by kategori dengan pengecekan null
        $chartData = collect();

        if ($pengeluaran->isNotEmpty()) {
            $grouped = $pengeluaran->groupBy('kategoris_id');

            foreach ($grouped as $kategoriId => $items) {
                $firstItem = $items->first();
                if ($firstItem && $firstItem->kategori) {
                    $chartData->push([
                        'kategori' => $firstItem->kategori->nama_kategori,
                        'total' => $items->sum('jumlah')
                    ]);
                }
            }
        }

        $kategoris = Kategori::all();

        return view('admin.laporan.pengeluaran', compact(
            'pengeluaran',
            'totalPengeluaran',
            'chartData',
            'kategoris'
        ));
    }

    public function pengeluaranPDF(Request $request)
    {
        $query = KategoriPengeluaran::with(['kategori', 'karyawan', 'kandang']);

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }
        if ($request->filled('kategori_id')) {
            $query->where('kategoris_id', $request->kategori_id);
        }

        $pengeluaran = $query->orderBy('tanggal', 'desc')->get();
        $totalPengeluaran = $pengeluaran->sum('jumlah');

        // Generate PDF dengan DomPDF
        $pdf = Pdf::loadView('admin.laporan.pengeluaran-pdf', compact('pengeluaran', 'totalPengeluaran'));

        // Set paper size dan orientasi
        $pdf->setPaper('A4', 'landscape');

        // Download langsung
        return $pdf->download('laporan-pengeluaran-' . date('Y-m-d-His') . '.pdf');
    }

    // ===============================
    // LAPORAN PENJUALAN
    // ===============================

    public function penjualan(Request $request)
    {
        $query = Penjualan::with(['kandang']);

        // Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $penjualan = $query->orderBy('tanggal', 'desc')->get();

        // Hitung statistik
        $totalPenjualan = $penjualan->sum('total');
        $totalTerjual = $penjualan->sum('jumlah_terjual');
        $totalTransaksi = $penjualan->count();

        // Data untuk chart - group by tanggal
        $chartData = $penjualan->groupBy('tanggal')->map(function ($items, $tanggal) {
            return [
                'tanggal' => $tanggal,
                'total' => $items->sum('total')
            ];
        })->values();

        return view('admin.laporan.penjualan', compact(
            'penjualan',
            'totalPenjualan',
            'totalTerjual',
            'totalTransaksi',
            'chartData'
        ));
    }

    public function penjualanPdf(Request $request)
    {
        $query = Penjualan::with(['kandang']);

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $penjualan = $query->orderBy('tanggal', 'desc')->get();
        $totalPenjualan = $penjualan->sum('total');
        $totalTerjual = $penjualan->sum('jumlah_terjual');

        // Generate PDF dengan DomPDF
        $pdf = Pdf::loadView('admin.laporan.penjualan-pdf', compact(
            'penjualan',
            'totalPenjualan',
            'totalTerjual'
        ));

        // Set paper size dan orientasi
        $pdf->setPaper('A4', 'landscape');

        // Download langsung
        return $pdf->download('laporan-penjualan-' . date('Y-m-d-His') . '.pdf');
    }

    // ===============================
    // LAPORAN PRODUKSI
    // ===============================

    public function produksi(Request $request)
    {
        $query = ProduksiTelur::with(['karyawan', 'kandang']);

        // Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter karyawan
        if ($request->filled('karyawan_id')) {
            $query->where('karyawans_id', $request->karyawan_id);
        }

        // Filter kandang
        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $produksi = $query->orderBy('tanggal', 'desc')->get();

        // Hitung statistik
        $totalJumlah = $produksi->sum('jumlah');
        $totalBagus = $produksi->sum('jumlah_bagus');
        $totalRusak = $produksi->sum('jumlah_rusak');
        $totalData = $produksi->count();

        // Ambil data untuk dropdown
        $karyawans = Karyawan::all();
        $kandangs = Kandang::all();

        return view('admin.laporan.produksi', compact(
            'produksi',
            'totalJumlah',
            'totalBagus',
            'totalRusak',
            'totalData',
            'karyawans',
            'kandangs'
        ));
    }

    public function produksiPdf(Request $request)
    {
        $query = ProduksiTelur::with(['karyawan', 'kandang']);

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }
        if ($request->filled('karyawan_id')) {
            $query->where('karyawans_id', $request->karyawan_id);
        }
        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        $produksi = $query->orderBy('tanggal', 'desc')->get();
        $totalJumlah = $produksi->sum('jumlah');
        $totalBagus = $produksi->sum('jumlah_bagus');
        $totalRusak = $produksi->sum('jumlah_rusak');

        // Generate PDF dengan DomPDF
        $pdf = Pdf::loadView('admin.laporan.produksi-pdf', compact(
            'produksi', 
            'totalJumlah',
            'totalBagus',
            'totalRusak'
        ));

        // Set paper size dan orientasi
        $pdf->setPaper('A4', 'landscape');

        // Download langsung
        return $pdf->download('laporan-produksi-' . date('Y-m-d-His') . '.pdf');
    }
}