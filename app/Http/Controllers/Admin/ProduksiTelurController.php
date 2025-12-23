<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\ProduksiTelur;
use App\Models\Karyawan;
use App\Models\Kandang;
use App\Models\PendapatanKandang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduksiTelurController extends Controller
{
    public function index(Request $request)
    {
        $query = ProduksiTelur::with(['karyawan', 'kandang']);

        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        if ($request->filled('karyawan_id')) {
            $query->where('karyawans_id', $request->karyawan_id);
        }

        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        return view('admin.produksi.index', [
            'produksi' => $query->orderBy('tanggal', 'desc')->get(),
            'karyawans' => Karyawan::all(),
            'kandangs' => Kandang::where('status', 'aktif')->get()
        ]);
    }

    public function create()
    {
        return view('admin.produksi.create', [
            'karyawans' => Karyawan::all(),
            'kandangs' => Kandang::where('status', 'aktif')->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawans_id' => 'required|exists:karyawans,id',
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'jumlah_bagus' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
            'catatan' => 'nullable|string'
        ]);

        // Total jumlah dalam BUTIR
        $validated['jumlah'] = $validated['jumlah_bagus'] + $validated['jumlah_rusak'];

        DB::transaction(function () use ($validated) {
            $produksi = ProduksiTelur::create($validated);

            // Simpan pendapatan kandang dalam BUTIR (bukan kg)
            if ($validated['jumlah_bagus'] > 0) {
                PendapatanKandang::create([
                    'kandang_id' => $validated['kandang_id'],
                    'produksi_telur_id' => $produksi->id,
                    'tanggal' => $validated['tanggal'],
                    'jumlah' => $validated['jumlah_bagus'], // Simpan dalam BUTIR
                    'keterangan' => 'Produksi telur bagus dari kandang'
                ]);
            }
        });

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Produksi telur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.produksi.edit', [
            'data' => ProduksiTelur::findOrFail($id),
            'karyawans' => Karyawan::all(),
            'kandangs' => Kandang::where('status', 'aktif')->get()
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = ProduksiTelur::findOrFail($id);

        $validated = $request->validate([
            'karyawans_id' => 'required|exists:karyawans,id',
            'kandang_id' => 'required|exists:kandangs,id',
            'tanggal' => 'required|date',
            'jumlah_bagus' => 'required|integer|min:0',
            'jumlah_rusak' => 'required|integer|min:0',
            'catatan' => 'nullable|string'
        ]);

        // Total jumlah dalam BUTIR
        $validated['jumlah'] = $validated['jumlah_bagus'] + $validated['jumlah_rusak'];

        DB::transaction(function () use ($validated, $data) {
            $data->update($validated);

            // Hapus pendapatan lama
            PendapatanKandang::where('produksi_telur_id', $data->id)->delete();

            // Buat pendapatan baru dengan jumlah dalam BUTIR
            if ($validated['jumlah_bagus'] > 0) {
                PendapatanKandang::create([
                    'kandang_id' => $validated['kandang_id'],
                    'produksi_telur_id' => $data->id,
                    'tanggal' => $validated['tanggal'],
                    'jumlah' => $validated['jumlah_bagus'], // Simpan dalam BUTIR
                    'keterangan' => 'Produksi telur bagus dari kandang'
                ]);
            }
        });

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            PendapatanKandang::where('produksi_telur_id', $id)->delete();
            ProduksiTelur::destroy($id);
        });

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil dihapus!');
    }
}
