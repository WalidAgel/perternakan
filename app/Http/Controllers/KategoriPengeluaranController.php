<?php

namespace App\Http\Controllers;

use App\Models\KategoriPengeluaran;
use App\Models\Kategori;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class KategoriPengeluaranController extends Controller
{
  public function index(Request $request)
    {
        $query = KategoriPengeluaran::with(['kategori', 'karyawan']);

        // Filter tanggal
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter kategori
        if ($request->filled('kategoris_id')) {
            $query->where('kategoris_id', $request->kategoris_id);
        }

        // Filter karyawan
        if ($request->filled('karyawans_id')) {
            $query->where('karyawans_id', $request->karyawans_id);
        }

        $pengeluaran = $query->orderBy('tanggal', 'desc')->paginate(10);

        $kategori = Kategori::all();
        $karyawan = Karyawan::all();

        return view('Admin.Pengeluaran.index', compact('pengeluaran', 'kategori', 'karyawan'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $karyawan = Karyawan::all();
        return view('Admin.Pengeluaran.create', compact('kategori', 'karyawan'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kategoris_id' => 'required|exists:kategoris,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ], [
            'kategoris_id.required' => 'Kategori harus dipilih',
            'kategoris_id.exists' => 'Kategori tidak valid',
            'karyawans_id.required' => 'Karyawan harus dipilih',
            'karyawans_id.exists' => 'Karyawan tidak valid',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 0'
        ]);

        KategoriPengeluaran::create($validated);

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan');
    }

    public function edit(KategoriPengeluaran $pengeluaran)
    {
        $kategori = Kategori::all();
        $karyawan = Karyawan::all();
        return view('Admin.Pengeluaran.edit', compact('pengeluaran', 'kategori', 'karyawan'));
    }

    public function update(Request $request, KategoriPengeluaran $pengeluaran)
    {
        $validated = $request->validate([
            'kategoris_id' => 'required|exists:kategoris,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string'
        ], [
            'kategoris_id.required' => 'Kategori harus dipilih',
            'kategoris_id.exists' => 'Kategori tidak valid',
            'karyawans_id.required' => 'Karyawan harus dipilih',
            'karyawans_id.exists' => 'Karyawan tidak valid',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 0'
        ]);

        $pengeluaran->update($validated);

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil diperbarui');
    }

    public function destroy(KategoriPengeluaran $pengeluaran)
    {
        $pengeluaran->delete();

        return redirect()->route('admin.pengeluaran.index')
            ->with('success', 'Pengeluaran berhasil dihapus');
    }
}
