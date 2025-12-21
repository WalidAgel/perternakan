<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\KategoriPengeluaran;
use App\Models\Kategori;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengeluaranController extends Controller
{
    /**
     * Helper method untuk mengambil data karyawan
     */
    private function getKaryawan()
    {
        // ✅ Ambil karyawan berdasarkan user yang login
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        // ✅ Jika tidak ditemukan, redirect dengan error
        if (!$karyawan) {
            abort(403, 'Data karyawan tidak ditemukan. Silakan hubungi administrator.');
        }

        return $karyawan;
    }

    /**
     * INDEX – Laporan Pengeluaran + Filter
     */
    public function index(Request $request)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Ambil semua kategori untuk dropdown
        $kategori = Kategori::orderBy('nama_kategori')->get();

        // ✅ Query pengeluaran milik karyawan ini
        $query = KategoriPengeluaran::with(['kategori', 'karyawan'])
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('tanggal', 'DESC');

        // ✅ Filter by kategori
        if ($request->filled('kategoris_id')) {
            $query->where('kategoris_id', $request->kategoris_id);
        }

        // ✅ Filter by tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // ✅ Filter by tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // ✅ Clone query untuk hitung total
        $totalPengeluaran = (clone $query)->sum('jumlah');

        // ✅ Paginate hasil
        $pengeluaran = $query->paginate(15);

        return view('karyawan.pengeluaran.index', compact(
            'pengeluaran',
            'kategori',
            'totalPengeluaran'
        ));
    }

    /**
     * CREATE – Form Input Pengeluaran
     */
    public function create()
    {
        // ✅ Pastikan user sudah punya data karyawan
        $this->getKaryawan();

        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('karyawan.pengeluaran.create', compact('kategori'));
    }

    /**
     * STORE – Simpan Data Pengeluaran
     */
    public function store(Request $request)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Validasi input
        $validated = $request->validate([
            'kategoris_id' => 'required|exists:kategoris,id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'deskripsi'    => 'nullable|string|max:500'
        ], [
            'kategoris_id.required' => 'Kategori harus dipilih',
            'kategoris_id.exists'   => 'Kategori tidak valid',
            'tanggal.required'      => 'Tanggal harus diisi',
            'tanggal.date'          => 'Format tanggal tidak valid',
            'jumlah.required'       => 'Jumlah harus diisi',
            'jumlah.numeric'        => 'Jumlah harus berupa angka',
            'jumlah.min'            => 'Jumlah minimal 0'
        ]);

        // ✅ Tambahkan karyawans_id
        $validated['karyawans_id'] = $karyawan->id;

        // ✅ Simpan data
        KategoriPengeluaran::create($validated);

        return redirect()->route('karyawan.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    /**
     * EDIT – Form Edit Pengeluaran
     */
    public function edit(KategoriPengeluaran $pengeluaran)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Pastikan hanya pemilik data yang bisa edit
        if ($pengeluaran->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('karyawan.pengeluaran.edit', compact('pengeluaran', 'kategori'));
    }

    /**
     * UPDATE – Update Pengeluaran
     */
    public function update(Request $request, KategoriPengeluaran $pengeluaran)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Pastikan hanya pemilik data yang bisa update
        if ($pengeluaran->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        // ✅ Validasi input
        $validated = $request->validate([
            'kategoris_id' => 'required|exists:kategoris,id',
            'tanggal'      => 'required|date',
            'jumlah'       => 'required|numeric|min:0',
            'deskripsi'    => 'nullable|string|max:500'
        ], [
            'kategoris_id.required' => 'Kategori harus dipilih',
            'kategoris_id.exists'   => 'Kategori tidak valid',
            'tanggal.required'      => 'Tanggal harus diisi',
            'tanggal.date'          => 'Format tanggal tidak valid',
            'jumlah.required'       => 'Jumlah harus diisi',
            'jumlah.numeric'        => 'Jumlah harus berupa angka',
            'jumlah.min'            => 'Jumlah minimal 0'
        ]);

        // ✅ Update data
        $pengeluaran->update($validated);

        return redirect()->route('karyawan.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    /**
     * DESTROY – Hapus Pengeluaran
     */
    public function destroy(KategoriPengeluaran $pengeluaran)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Pastikan hanya pemilik data yang bisa hapus
        if ($pengeluaran->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        // ✅ Hapus data
        $pengeluaran->delete();

        return redirect()->route('karyawan.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }

    /**
     * RIWAYAT Khusus Karyawan
     */
    public function riwayat(Request $request)
    {
        // ✅ Ambil karyawan yang login
        $karyawan = $this->getKaryawan();

        // ✅ Query riwayat
        $query = KategoriPengeluaran::with(['kategori'])
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('tanggal', 'DESC');

        // ✅ Filter by tanggal dari
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        // ✅ Filter by tanggal sampai
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // ✅ Filter by kategori
        if ($request->filled('kategoris_id')) {
            $query->where('kategoris_id', $request->kategoris_id);
        }

        // ✅ Search by deskripsi
        if ($request->filled('search')) {
            $query->where('deskripsi', 'like', '%' . $request->search . '%');
        }

        // ✅ Paginate
        $riwayat = $query->paginate(20);

        // ✅ Ambil kategori untuk filter
        $kategori = Kategori::orderBy('nama_kategori')->get();

        return view('karyawan.pengeluaran.riwayat', compact('riwayat', 'kategori'));
    }
}
