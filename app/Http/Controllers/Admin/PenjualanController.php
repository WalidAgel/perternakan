<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use App\Models\Kandang;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('produksiTelur');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('kandang_id')) {
            $query->whereHas('produksiTelur', function($q) use ($request) {
                $q->where('kandang_id', $request->kandang_id);
            });
        }

        $penjualan = $query->latest('tanggal')->paginate(10);
        $kandangs = Kandang::where('status', 'aktif')->get();

        return view('admin.penjualan.index', compact('penjualan', 'kandangs'));
    }

    public function create()
    {
        $kandangs = Kandang::where('status', 'aktif')->get();
        return view('admin.penjualan.create', compact('kandangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Hitung total qty
        $totalQty = array_sum($request->qty);

        // Cari atau buat produksi telur untuk kandang dan tanggal tersebut
        $produksi = ProduksiTelur::where('kandang_id', $request->kandang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if (!$produksi) {
            return back()->withErrors(['kandang_id' => 'Tidak ada data produksi untuk kandang ini pada tanggal tersebut.'])->withInput();
        }

        Penjualan::create([
            'produks_id' => $produksi->id,
            'tanggal' => $request->tanggal,
            'harga_per_kg' => $request->harga_per_kg,
            'jumlah_terjual' => $totalQty,
            'total' => $request->total,
        ]);

        return redirect()->route('admin.penjualan.index')
            ->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        $kandangs = Kandang::where('status', 'aktif')->get();

        return view('admin.penjualan.edit', compact('penjualan', 'kandangs'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'jumlah_terjual' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Cari produksi telur berdasarkan kandang dan tanggal
        $produksi = ProduksiTelur::where('kandang_id', $request->kandang_id)
            ->whereDate('tanggal', $request->tanggal)
            ->first();

        if (!$produksi) {
            return back()->withErrors(['kandang_id' => 'Tidak ada data produksi untuk kandang ini pada tanggal tersebut.'])->withInput();
        }

        $penjualan->update([
            'produks_id' => $produksi->id,
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