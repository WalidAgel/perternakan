<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kandang;
use Illuminate\Http\Request;

class KandangController extends Controller
{
    public function index()
    {
        $kandangs = Kandang::orderBy('created_at', 'desc')->paginate(10);
        return view('Admin.Kandang.index', compact('kandangs'));
    }

    public function create()
    {
        return view('Admin.Kandang.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kandang' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        Kandang::create($validated);

        return redirect()->route('admin.kandang.index')
            ->with('success', 'Kandang berhasil ditambahkan');
    }

    public function edit(Kandang $kandang)
    {
        return view('Admin.Kandang.edit', compact('kandang'));
    }

    public function update(Request $request, Kandang $kandang)
    {
        $validated = $request->validate([
            'nama_kandang' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $kandang->update($validated);

        return redirect()->route('admin.kandang.index')
            ->with('success', 'Kandang berhasil diperbarui');
    }

    public function destroy(Kandang $kandang)
    {
        $kandang->delete();

        return redirect()->route('admin.kandang.index')
            ->with('success', 'Kandang berhasil dihapus');
    }
}
