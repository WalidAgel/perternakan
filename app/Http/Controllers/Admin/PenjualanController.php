<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Load relasi produksiTelur (sesuai nama method di model)
        $query = Penjualan::with('produksiTelur');

        // Filter berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Filter berdasarkan produksi
        if ($request->filled('produksi_id')) {
            $query->where('produks_id', $request->produksi_id);
        }

        $penjualan = $query->latest('tanggal')->paginate(10);

        // Kirim data produksi telur untuk dropdown filter
        $produksiList = ProduksiTelur::orderBy('tanggal', 'desc')->get();

        return view('admin.penjualan.index', compact('penjualan', 'produksiList'));
    }

    public function create()
    {
        $produksi = ProduksiTelur::with('karyawan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.penjualan.create', compact('produksi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produks_id' => 'required|exists:produksi_telurs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Hitung total qty
        $totalQty = array_sum($request->qty);

        Penjualan::create([
            'produks_id' => $request->produks_id,
            'tanggal' => $request->tanggal,
            'harga_per_kg' => $request->harga_per_kg,
            'jumlah_terjual' => $totalQty, // Sesuai kolom database
            'total' => $request->total,
        ]);

        return redirect()->route('admin.penjualan.index')
            ->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $produksi = ProduksiTelur::with('karyawan')
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('admin.penjualan.edit', compact('penjualan', 'produksi'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $request->validate([
            'produks_id' => 'required|exists:produksi_telurs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'jumlah_terjual' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        $penjualan->update([
            'produks_id' => $request->produks_id,
            'tanggal' => $request->tanggal,
            'harga_per_kg' => $request->harga_per_kg,
            'jumlah_terjual' => $request->jumlah_terjual,
            'total' => $request->total,
        ]);

        return redirect()->route('admin.penjualan.index')
            ->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Penjualan::destroy($id);

        return redirect()->route('admin.penjualan.index')
            ->with('success', 'Penjualan berhasil dihapus!');
    }
}
