<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('admin.kategori.index', compact('kategoris')); // ✅ FIXED
    }

    public function create()
    {
        return view('admin.kategori.create'); // ✅ FIXED
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        Kategori::create($request->all());

        return redirect()->route('admin.kategori.index') // ✅ FIXED
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', ['kategori' => $kategori]); // ✅ FIXED
    }

    public function update(Request $request, Kategori $kategori_pengeluaran)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $kategori_pengeluaran->update($request->all());

        return redirect()->route('admin.kategori.index') // ✅ FIXED
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori_pengeluaran)
    {
        $kategori_pengeluaran->delete();

        return redirect()->route('admin.kategori.index') // ✅ FIXED
            ->with('success', 'Kategori berhasil dihapus');
    }
}
