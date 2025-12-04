<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        // Query utama penjualan
        $query = Penjualan::with(['produksiTelur']);

        // Filter tanggal
        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        // Filter produksi
        if ($request->filled('produksi_id')) {
            $query->where('produksi_id', $request->produksi_id);
        }

        $penjualan = $query->latest()->paginate(10);

        // WAJIB: kirim list produksi
        $produksiList = ProduksiTelur::orderBy('id', 'DESC')->get();

        return view('Admin.Penjualan.index', compact('penjualan', 'produksiList'));
    }


    public function create()
    {
        $produksiList = ProduksiTelur::orderBy('id', 'DESC')->get();
        return view('Admin.Penjualan.create', compact('produksiList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produksi_id' => 'required',
            'tanggal'     => 'required|date',
            'jumlah_terjual' => 'required|numeric',
            'harga_per_kg'   => 'required|numeric',
        ]);

        $total = $request->jumlah_terjual * $request->harga_per_kg;

        Penjualan::create([
            'produksi_id' => $request->produksi_id,
            'tanggal'     => $request->tanggal,
            'jumlah_terjual' => $request->jumlah_terjual,
            'harga_per_kg'   => $request->harga_per_kg,
            'total'       => $total,
        ]);

        return redirect()->route('admin.penjualan.index')->with('success', 'Penjualan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = Penjualan::findOrFail($id);
        $produksiList = ProduksiTelur::all();

        return view('Admin.Penjualan.edit', compact('data', 'produksiList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'produksi_id' => 'required',
            'tanggal'     => 'required',
            'jumlah_terjual' => 'required|numeric',
            'harga_per_kg'   => 'required|numeric',
        ]);

        $penjualan = Penjualan::findOrFail($id);

        $penjualan->update([
            'produksi_id' => $request->produksi_id,
            'tanggal' => $request->tanggal,
            'jumlah_terjual' => $request->jumlah_terjual,
            'harga_per_kg' => $request->harga_per_kg,
            'total' => $request->jumlah_terjual * $request->harga_per_kg,
        ]);

        return redirect()->route('admin.penjualan.index')->with('success', 'Penjualan berhasil diperbarui!');
    }

    public function destroy($id)
    {
        Penjualan::findOrFail($id)->delete();
        return redirect()->route('admin.penjualan.index')->with('success', 'Penjualan berhasil dihapus!');
    }
}
