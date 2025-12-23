<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PembelianPakan;
use App\Models\Pakan;
use App\Models\Karyawan;
use App\Models\Kategori;
use App\Models\KategoriPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianPakanController extends Controller
{
    public function index(Request $request)
    {
        $query = PembelianPakan::with(['pakan', 'karyawan']);

        if ($request->filled('pakan_id')) {
            $query->where('pakan_id', $request->pakan_id);
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $pembelianPakans = $query->orderBy('tanggal', 'desc')->paginate(10);
        $pakans = Pakan::all();

        return view('Admin.PembelianPakan.index', compact('pembelianPakans', 'pakans'));
    }

    public function create()
    {
        $pakans = Pakan::all();
        $karyawans = Karyawan::all();
        return view('Admin.PembelianPakan.create', compact('pakans', 'karyawans'));
    }

    public function store(Request $request)
    {
        // Bersihkan format dari input harga_satuan (hapus pemisah ribuan)
        $hargaSatuan = preg_replace('/[^0-9]/', '', $request->harga_satuan);

        // Bersihkan format dari input jumlah (ganti koma dengan titik untuk desimal)
        $jumlah = str_replace(',', '.', $request->jumlah);

        // Validasi
        $request->validate([
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        // Validasi manual untuk jumlah dan harga
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            return back()->withErrors(['jumlah' => 'Jumlah harus berupa angka positif'])->withInput();
        }

        if (!is_numeric($hargaSatuan) || $hargaSatuan < 0) {
            return back()->withErrors(['harga_satuan' => 'Harga satuan harus berupa angka positif'])->withInput();
        }

        // Hitung total harga
        $totalHarga = $jumlah * $hargaSatuan;

        DB::transaction(function () use ($request, $jumlah, $hargaSatuan, $totalHarga) {
            // Simpan pembelian
            $pembelian = PembelianPakan::create([
                'pakan_id' => $request->pakan_id,
                'karyawans_id' => $request->karyawans_id,
                'tanggal' => $request->tanggal,
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
                'total_harga' => $totalHarga,
                'keterangan' => $request->keterangan
            ]);

            // Update stok pakan
            $pakan = Pakan::find($request->pakan_id);
            $pakan->stok += $jumlah;
            $pakan->save();

            // Catat sebagai pengeluaran
            $kategoriPakan = Kategori::firstOrCreate(
                ['nama_kategori' => 'Pembelian Pakan'],
                ['deskripsi' => 'Kategori untuk pembelian pakan']
            );

            KategoriPengeluaran::create([
                'kategoris_id' => $kategoriPakan->id,
                'karyawans_id' => $request->karyawans_id,
                'tanggal' => $request->tanggal,
                'jumlah' => $totalHarga,
                'deskripsi' => 'Pembelian pakan: ' . $pakan->nama_pakan . ' (' . $jumlah . ' kg)'
            ]);
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil ditambahkan dan stok diperbarui');
    }

    public function edit(PembelianPakan $pembelianPakan)
    {
        $pakans = Pakan::all();
        $karyawans = Karyawan::all();

        // Format data untuk tampilan (jika diperlukan)
        // harga_satuan dan jumlah sudah dalam format yang benar dari database

        return view('Admin.PembelianPakan.edit', compact('pembelianPakan', 'pakans', 'karyawans'));
    }

    public function update(Request $request, PembelianPakan $pembelianPakan)
    {
        // Bersihkan format dari input harga_satuan
        $hargaSatuan = preg_replace('/[^0-9]/', '', $request->harga_satuan);

        // Bersihkan format dari input jumlah
        $jumlah = str_replace(',', '.', $request->jumlah);

        // Validasi
        $request->validate([
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'keterangan' => 'nullable|string'
        ]);

        // Validasi manual untuk jumlah dan harga
        if (!is_numeric($jumlah) || $jumlah <= 0) {
            return back()->withErrors(['jumlah' => 'Jumlah harus berupa angka positif'])->withInput();
        }

        if (!is_numeric($hargaSatuan) || $hargaSatuan < 0) {
            return back()->withErrors(['harga_satuan' => 'Harga satuan harus berupa angka positif'])->withInput();
        }

        // Hitung total harga
        $totalHarga = $jumlah * $hargaSatuan;

        DB::transaction(function () use ($request, $pembelianPakan, $jumlah, $hargaSatuan, $totalHarga) {
            // Kembalikan stok pakan lama
            $oldPakan = Pakan::find($pembelianPakan->pakan_id);
            $oldPakan->stok -= $pembelianPakan->jumlah;
            $oldPakan->save();

            // Tambah stok pakan baru
            $newPakan = Pakan::find($request->pakan_id);
            $newPakan->stok += $jumlah;
            $newPakan->save();

            // Update data pembelian
            $pembelianPakan->update([
                'pakan_id' => $request->pakan_id,
                'karyawans_id' => $request->karyawans_id,
                'tanggal' => $request->tanggal,
                'jumlah' => $jumlah,
                'harga_satuan' => $hargaSatuan,
                'total_harga' => $totalHarga,
                'keterangan' => $request->keterangan
            ]);
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil diperbarui');
    }

    public function destroy(PembelianPakan $pembelianPakan)
    {
        DB::transaction(function () use ($pembelianPakan) {
            // Kurangi stok pakan
            $pakan = Pakan::find($pembelianPakan->pakan_id);
            $pakan->stok -= $pembelianPakan->jumlah;
            $pakan->save();

            // Hapus pembelian
            $pembelianPakan->delete();
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil dihapus');
    }
}
