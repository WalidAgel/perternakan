<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pakan;
use Illuminate\Http\Request;

class PakanController extends Controller
{
    public function index()
    {
        $pakans = Pakan::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.Pakan.index', compact('pakans'));
    }

    public function create()
    {
        return view('Admin.Pakan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_pakan' => 'required|string|max:255',
            'harga_pakan' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0'
        ]);

        Pakan::create($validated);

        return redirect()->route('admin.pakan.index')
            ->with('success', 'Pakan berhasil ditambahkan');
    }

    public function edit(Pakan $pakan)
    {
        return view('Admin.Pakan.edit', compact('pakan'));
    }

    public function update(Request $request, Pakan $pakan)
    {
        $validated = $request->validate([
            'nama_pakan' => 'required|string|max:255',
            'harga_pakan' => 'required|numeric|min:0',
            'stok' => 'required|numeric|min:0'
        ]);

        $pakan->update($validated);

        return redirect()->route('admin.pakan.index')
            ->with('success', 'Pakan berhasil diperbarui');
    }

    public function destroy(Pakan $pakan)
    {
        $pakan->delete();

        return redirect()->route('admin.pakan.index')
            ->with('success', 'Pakan berhasil dihapus');
    }
}
