<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OperasiKandang;
use App\Models\Kandang;
use Illuminate\Http\Request;

class OperasiKandangController extends Controller
{
    public function index(Request $request)
    {
        $query = OperasiKandang::with('kandang');

        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $operasiKandangs = $query->orderBy('created_at', 'desc')->paginate(10);
        $kandangs = Kandang::where('status', 'aktif')->get();

        return view('Admin.OperasiKandang.index', compact('operasiKandangs', 'kandangs'));
    }

    public function create()
    {
        $kandangs = Kandang::where('status', 'aktif')->get();
        return view('Admin.OperasiKandang.create', compact('kandangs'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'jumlah_ayam' => 'required|integer|min:1',
            'tanggal_mulai_produksi' => 'required|date',
            'status' => 'required|in:aktif,selesai'
        ]);

        OperasiKandang::create($validated);

        return redirect()->route('admin.operasi-kandang.index')
            ->with('success', 'Operasi kandang berhasil ditambahkan');
    }

    public function edit(OperasiKandang $operasiKandang)
    {
        $kandangs = Kandang::where('status', 'aktif')->get();
        return view('Admin.OperasiKandang.edit', compact('operasiKandang', 'kandangs'));
    }

    public function update(Request $request, OperasiKandang $operasiKandang)
    {
        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'jumlah_ayam' => 'required|integer|min:1',
            'tanggal_mulai_produksi' => 'required|date',
            'status' => 'required|in:aktif,selesai'
        ]);

        $operasiKandang->update($validated);

        return redirect()->route('admin.operasi-kandang.index')
            ->with('success', 'Operasi kandang berhasil diperbarui');
    }

    public function destroy(OperasiKandang $operasiKandang)
    {
        $operasiKandang->delete();

        return redirect()->route('admin.operasi-kandang.index')
            ->with('success', 'Operasi kandang berhasil dihapus');
    }
}
