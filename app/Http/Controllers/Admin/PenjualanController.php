<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penjualan;
use App\Models\ProduksiTelur;
use App\Models\Kandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $query = Penjualan::with('kandang');

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
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
        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'qty' => 'required|array|min:1',
            'qty.*' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Hitung total qty
        $totalQty = array_sum($validated['qty']);

        // Validasi: cek apakah ada produksi di kandang tersebut pada tanggal tersebut
        $produksiExists = ProduksiTelur::where('kandang_id', $validated['kandang_id'])
            ->whereDate('tanggal', $validated['tanggal'])
            ->exists();

        if (!$produksiExists) {
            return back()->withErrors([
                'kandang_id' => 'Tidak ada data produksi untuk kandang ini pada tanggal tersebut.'
            ])->withInput();
        }

        try {
            DB::beginTransaction();

            Penjualan::create([
                'kandang_id' => $validated['kandang_id'],
                'tanggal' => $validated['tanggal'],
                'harga_per_kg' => $validated['harga_per_kg'],
                'jumlah_terjual' => $totalQty,
                'total' => $validated['total']
            ]);

            DB::commit();

            return redirect()->route('admin.penjualan.index')
                ->with('success', 'Penjualan berhasil ditambahkan!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating penjualan: ' . $e->getMessage());
            
            return back()->withErrors([
                'error' => 'Gagal menyimpan data penjualan: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function edit($id)
    {
        $penjualan = Penjualan::with('kandang')->findOrFail($id);
        $kandangs = Kandang::where('status', 'aktif')->get();

        return view('admin.penjualan.edit', compact('penjualan', 'kandangs'));
    }

    public function update(Request $request, $id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'harga_per_kg' => 'required|numeric|min:0',
            'jumlah_terjual' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0'
        ]);

        // Validasi: cek apakah ada produksi di kandang tersebut pada tanggal tersebut
        $produksiExists = ProduksiTelur::where('kandang_id', $validated['kandang_id'])
            ->whereDate('tanggal', $validated['tanggal'])
            ->exists();

        if (!$produksiExists) {
            return back()->withErrors([
                'kandang_id' => 'Tidak ada data produksi untuk kandang ini pada tanggal tersebut.'
            ])->withInput();
        }

        try {
            DB::beginTransaction();

            $penjualan->update([
                'kandang_id' => $validated['kandang_id'],
                'tanggal' => $validated['tanggal'],
                'harga_per_kg' => $validated['harga_per_kg'],
                'jumlah_terjual' => $validated['jumlah_terjual'],
                'total' => $validated['total']
            ]);

            DB::commit();

            return redirect()->route('admin.penjualan.index')
                ->with('success', 'Penjualan berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating penjualan: ' . $e->getMessage());
            
            return back()->withErrors([
                'error' => 'Gagal update data penjualan: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $penjualan = Penjualan::findOrFail($id);
            $penjualan->delete();

            return redirect()->route('admin.penjualan.index')
                ->with('success', 'Penjualan berhasil dihapus!');

        } catch (\Exception $e) {
            Log::error('Error deleting penjualan: ' . $e->getMessage());
            
            return redirect()->route('admin.penjualan.index')
                ->with('error', 'Gagal menghapus data penjualan!');
        }
    }
}