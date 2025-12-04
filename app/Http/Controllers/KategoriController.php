<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::all();
        return view('Admin.Kategori.index', compact('kategoris'));
    }

    public function create()
    {
        return view('Admin.Kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        Kategori::create($request->all());

        return redirect()->route('Admin.Kategori.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit(Kategori $kategori_pengeluaran)
    {
        return view('Admin.Kategori.edit', ['kategori' => $kategori_pengeluaran]);
    }

    public function update(Request $request, Kategori $kategori_pengeluaran)
    {
        $request->validate([
            'nama_kategori' => 'required',
            'deskripsi' => 'nullable'
        ]);

        $kategori_pengeluaran->update($request->all());

        return redirect()->route('Admin.Kategori.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori_pengeluaran)
    {
        $kategori_pengeluaran->delete();

        return redirect()->route('Admin.Kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
