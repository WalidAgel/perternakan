<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use App\Models\Kategori;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    /**
     * Menampilkan halaman laporan pengeluaran karyawan.
     */
    public function index(Request $request)
    {
        // Ambil kategori untuk dropdown filter
        $kategori = Kategori::orderBy('nama_kategori')->get();

        // Query dasar
        $query = KategoriPengeluaran::with(['kategori', 'karyawan'])
            ->orderBy('tanggal', 'DESC');

        // Filter kategori
        if ($request->kategoris_id) {
            $query->where('kategoris_id', $request->kategoris_id);
        }

        // Filter tanggal awal
        if ($request->tanggal_awal) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // Filter tanggal akhir
        if ($request->tanggal_akhir) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // Clone query untuk perhitungan total
        $totalQuery = clone $query;

        // Eksekusi pagination
        $pengeluaran = $query->paginate(15);

        // Hitung total akurat
        $total_pengeluaran = $totalQuery->sum('jumlah');

        return view('karyawan.pengeluaran.index', compact(
            'pengeluaran',
            'kategori',
            'total_pengeluaran'
        ));
    }
}
