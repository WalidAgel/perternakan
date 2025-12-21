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
        $validated = $request->validate([
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        DB::transaction(function () use ($validated) {
            $pembelian = PembelianPakan::create($validated);

            $pakan = Pakan::find($validated['pakan_id']);
            $pakan->stok += $validated['jumlah'];
            $pakan->save();

            $kategoriPakan = Kategori::firstOrCreate(
                ['nama_kategori' => 'Pembelian Pakan'],
                ['deskripsi' => 'Kategori untuk pembelian pakan']
            );

            KategoriPengeluaran::create([
                'kategoris_id' => $kategoriPakan->id,
                'karyawans_id' => $validated['karyawans_id'],
                'tanggal' => $validated['tanggal'],
                'jumlah' => $validated['total_harga'],
                'deskripsi' => 'Pembelian pakan: ' . $pakan->nama_pakan . ' (' . $validated['jumlah'] . ' kg)'
            ]);
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil ditambahkan dan stok diperbarui');
    }

    public function edit(PembelianPakan $pembelianPakan)
    {
        $pakans = Pakan::all();
        $karyawans = Karyawan::all();
        return view('Admin.PembelianPakan.edit', compact('pembelianPakan', 'pakans', 'karyawans'));
    }

    public function update(Request $request, PembelianPakan $pembelianPakan)
    {
        $validated = $request->validate([
            'pakan_id' => 'required|exists:pakans,id',
            'karyawans_id' => 'required|exists:karyawans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'harga_satuan' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string'
        ]);

        $validated['total_harga'] = $validated['jumlah'] * $validated['harga_satuan'];

        DB::transaction(function () use ($validated, $pembelianPakan) {
            $oldPakan = Pakan::find($pembelianPakan->pakan_id);
            $oldPakan->stok -= $pembelianPakan->jumlah;
            $oldPakan->save();

            $newPakan = Pakan::find($validated['pakan_id']);
            $newPakan->stok += $validated['jumlah'];
            $newPakan->save();

            $pembelianPakan->update($validated);
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil diperbarui');
    }

    public function destroy(PembelianPakan $pembelianPakan)
    {
        DB::transaction(function () use ($pembelianPakan) {
            $pakan = Pakan::find($pembelianPakan->pakan_id);
            $pakan->stok -= $pembelianPakan->jumlah;
            $pakan->save();

            $pembelianPakan->delete();
        });

        return redirect()->route('admin.pembelian-pakan.index')
            ->with('success', 'Pembelian pakan berhasil dihapus');
    }
}
