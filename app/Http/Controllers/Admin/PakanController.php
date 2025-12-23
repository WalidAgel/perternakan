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
        // Bersihkan format dari input harga dan stok
        $hargaPakan = preg_replace('/[^0-9]/', '', $request->harga_pakan);
        $stok = str_replace(',', '.', $request->stok); // Ganti koma dengan titik untuk desimal

        $validated = $request->validate([
            'nama_pakan' => 'required|string|max:255',
        ]);

        // Validasi manual untuk harga dan stok
        if (!is_numeric($hargaPakan) || $hargaPakan < 0) {
            return back()->withErrors(['harga_pakan' => 'Harga pakan harus berupa angka positif'])->withInput();
        }

        if (!is_numeric($stok) || $stok < 0) {
            return back()->withErrors(['stok' => 'Stok harus berupa angka positif'])->withInput();
        }

        // Simpan dengan nilai yang sudah dibersihkan
        Pakan::create([
            'nama_pakan' => $validated['nama_pakan'],
            'harga_pakan' => $hargaPakan,
            'stok' => $stok
        ]);

        return redirect()->route('admin.pakan.index')
            ->with('success', 'Pakan berhasil ditambahkan');
    }

    public function edit(Pakan $pakan)
    {
        return view('Admin.Pakan.edit', compact('pakan'));
    }

    public function update(Request $request, Pakan $pakan)
    {
        // Bersihkan format dari input harga dan stok
        $hargaPakan = preg_replace('/[^0-9]/', '', $request->harga_pakan);
        $stok = str_replace(',', '.', $request->stok);

        $validated = $request->validate([
            'nama_pakan' => 'required|string|max:255',
        ]);

        // Validasi manual untuk harga dan stok
        if (!is_numeric($hargaPakan) || $hargaPakan < 0) {
            return back()->withErrors(['harga_pakan' => 'Harga pakan harus berupa angka positif'])->withInput();
        }

        if (!is_numeric($stok) || $stok < 0) {
            return back()->withErrors(['stok' => 'Stok harus berupa angka positif'])->withInput();
        }

        // Update dengan nilai yang sudah dibersihkan
        $pakan->update([
            'nama_pakan' => $validated['nama_pakan'],
            'harga_pakan' => $hargaPakan,
            'stok' => $stok
        ]);

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
