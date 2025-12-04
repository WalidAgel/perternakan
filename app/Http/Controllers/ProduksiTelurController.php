<?php

namespace App\Http\Controllers;

use App\Models\ProduksiTelur;
use App\Models\Karyawan;
use Illuminate\Http\Request;

class ProduksiTelurController extends Controller
{
    public function index(Request $request)
    {
        $query = ProduksiTelur::with('karyawan');

        // Filter Tanggal
        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        // Filter karyawan
        if ($request->filled('karyawan_id')) {
            $query->where('karyawans_id', $request->karyawan_id);
        }

        return view('admin.produksi.index', [
            'produksi' => $query->get(),
            'karyawans' => Karyawan::all()
        ]);
    }

    public function create()
    {
        return view('admin.produksi.create', [
            'karyawans' => Karyawan::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'karyawans_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'kualitas' => 'required',
            'keterangan' => 'nullable'
        ]);

        ProduksiTelur::create($request->all());

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Produksi telur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.produksi.edit', [
            'data' => ProduksiTelur::findOrFail($id),
            'karyawans' => Karyawan::all()
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = ProduksiTelur::findOrFail($id);

        $request->validate([
            'karyawans_id' => 'required',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'kualitas' => 'required',
            'keterangan' => 'nullable'
        ]);

        $data->update($request->all());

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        ProduksiTelur::destroy($id);

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil dihapus!');
    }
}
