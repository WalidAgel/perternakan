<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PenggunaanPakan;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenggunaanPakanController extends Controller
{
    public function index(Request $request)
    {
        $query = PenggunaanPakan::with(['kandang', 'pakan', 'karyawan']);

        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        if ($request->filled('pakan_id')) {
            $query->where('pakan_id', $request->pakan_id);
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $penggunaanPakans = $query->orderBy('tanggal', 'desc')->paginate(10);
        $kandangs = Kandang::where('status', 'aktif')->get();
        $pakans = Pakan::all();

        return view('Admin.PenggunaanPakan.index', compact('penggunaanPakans', 'kandangs', 'pakans'));
    }

    public function create()
    {
        $kandangs = Kandang::where('status', 'aktif')->get();
        $pakans = Pakan::where('stok', '>', 0)->get();
        $karyawans = Karyawan::all();
        return view('Admin.PenggunaanPakan.create', compact('kandangs', 'pakans', 'karyawans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string'
        ]);

        $pakan = Pakan::find($validated['pakan_id']);
        if ($pakan->stok < $validated['jumlah']) {
            return back()->withErrors(['jumlah' => 'Stok pakan tidak mencukupi. Stok tersedia: ' . $pakan->stok . ' kg'])->withInput();
        }

        DB::transaction(function () use ($validated, $pakan) {
            PenggunaanPakan::create($validated);
            $pakan->stok -= $validated['jumlah'];
            $pakan->save();
        });

        return redirect()->route('admin.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil dicatat');
    }

    public function edit(PenggunaanPakan $penggunaanPakan)
    {
        $kandangs = Kandang::where('status', 'aktif')->get();
        $pakans = Pakan::all();
        $karyawans = Karyawan::all();
        return view('Admin.PenggunaanPakan.edit', compact('penggunaanPakan', 'kandangs', 'pakans', 'karyawans'));
    }

    public function update(Request $request, PenggunaanPakan $penggunaanPakan)
    {
        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string'
        ]);

        DB::transaction(function () use ($validated, $penggunaanPakan) {
            $oldPakan = Pakan::find($penggunaanPakan->pakan_id);
            $oldPakan->stok += $penggunaanPakan->jumlah;
            $oldPakan->save();

            $newPakan = Pakan::find($validated['pakan_id']);
            if ($newPakan->stok < $validated['jumlah']) {
                throw new \Exception('Stok pakan tidak mencukupi');
            }
            $newPakan->stok -= $validated['jumlah'];
            $newPakan->save();

            $penggunaanPakan->update($validated);
        });

        return redirect()->route('admin.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil diperbarui');
    }

    public function destroy(PenggunaanPakan $penggunaanPakan)
    {
        DB::transaction(function () use ($penggunaanPakan) {
            $pakan = Pakan::find($penggunaanPakan->pakan_id);
            $pakan->stok += $penggunaanPakan->jumlah;
            $pakan->save();

            $penggunaanPakan->delete();
        });

        return redirect()->route('admin.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil dihapus');
    }
}
