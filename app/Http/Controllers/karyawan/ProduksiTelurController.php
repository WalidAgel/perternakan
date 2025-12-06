<?php

namespace App\Http\Controllers\karyawan;

use Carbon\Carbon;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\ProduksiTelur;
use App\Http\Controllers\Controller;

class ProduksiTelurController extends Controller
{
    public function index(Request $request)
    {
        // Untuk karyawan: tampilkan form input + riwayat hari ini
        if (auth()->user()->role === 'karyawan') {
            // Ambil karyawan yang sedang login
            $karyawan = Karyawan::where('user_id', auth()->id())->first();

            // Ambil produksi hari ini untuk user yang login
            $produksiHariIni = ProduksiTelur::with('karyawan')
                ->where('karyawans_id', $karyawan->id ?? 0)
                ->whereDate('tanggal', Carbon::today())
                ->orderBy('created_at', 'desc')
                ->get();

            return view('karyawan.produksi.input', compact('produksiHariIni'));
        }

        // Untuk admin: tampilkan semua data dengan filter
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $query = ProduksiTelur::with('karyawan');

        // Filter Tanggal
        if ($request->filled('tanggal')) {
            $query->where('tanggal', $request->tanggal);
        }

        // Filter karyawan
        if ($request->filled('karyawan_id')) {
            $query->where('karyawans_id', $request->karyawan_id);
        }

        $produksi = $query->latest('tanggal')->get();
        $karyawans = Karyawan::all();

        return view('admin.produksi.index', compact('produksi', 'karyawans'));
    }

    public function create()
    {
        // Hanya admin yang bisa akses
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $karyawans = Karyawan::all();
        return view('admin.produksi.create', compact('karyawans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'kualitas' => 'required|in:A,B,C',
            'keterangan' => 'nullable|string'
        ], [
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jumlah.required' => 'Jumlah telur harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 0',
            'kualitas.required' => 'Kualitas harus dipilih',
            'kualitas.in' => 'Kualitas harus A, B, atau C'
        ]);

        // Untuk karyawan
        if (auth()->user()->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', auth()->id())->first();

            if (!$karyawan) {
                return back()->with('error', 'Data karyawan tidak ditemukan!')->withInput();
            }

            ProduksiTelur::create([
                'karyawans_id' => $karyawan->id,
                'tanggal' => $request->tanggal,
                'jumlah' => $request->jumlah,
                'kualitas' => $request->kualitas,
                'keterangan' => $request->keterangan
            ]);

            return redirect()->route('karyawan.produksi.index')
                ->with('success', 'Data produksi berhasil disimpan!');
        }

        // Untuk admin
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menambah data.');
        }

        ProduksiTelur::create($request->all());

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Produksi telur berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $data = ProduksiTelur::findOrFail($id);

        // Cek apakah karyawan hanya bisa edit data sendiri
        if (auth()->user()->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', auth()->id())->first();
            if ($data->karyawans_id !== $karyawan->id) {
                abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
            }
            return view('karyawan.produksi.edit', compact('data'));
        }

        // Admin bisa edit semua
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $karyawans = Karyawan::all();
        return view('admin.produksi.edit', compact('data', 'karyawans'));
    }

    public function update(Request $request, $id)
    {
        $data = ProduksiTelur::findOrFail($id);

        $request->validate([
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0',
            'kualitas' => 'required|in:A,B,C',
            'keterangan' => 'nullable|string'
        ]);

        // Cek akses karyawan
        if (auth()->user()->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', auth()->id())->first();
            if ($data->karyawans_id !== $karyawan->id) {
                abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
            }
        } elseif (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data.');
        }

        $data->update([
            'tanggal' => $request->tanggal,
            'jumlah' => $request->jumlah,
            'kualitas' => $request->kualitas,
            'keterangan' => $request->keterangan
        ]);

        if (auth()->user()->role === 'karyawan') {
            return redirect()->route('karyawan.produksi.index')
                ->with('success', 'Data produksi berhasil diperbarui!');
        }

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $data = ProduksiTelur::findOrFail($id);

        // Cek apakah karyawan hanya bisa hapus data sendiri
        if (auth()->user()->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', auth()->id())->first();
            if ($data->karyawans_id !== $karyawan->id) {
                abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
            }
        } elseif (auth()->user()->role !== 'admin') {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data.');
        }

        $data->delete();

        if (auth()->user()->role === 'karyawan') {
            return redirect()->route('karyawan.produksi.index')
                ->with('success', 'Data produksi berhasil dihapus!');
        }

        return redirect()->route('admin.produksi.index')
            ->with('success', 'Data produksi berhasil dihapus!');
    }

    // Method khusus untuk riwayat produksi karyawan
    public function riwayat(Request $request)
    {
        // Hanya karyawan yang bisa akses
        if (auth()->user()->role !== 'karyawan') {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        $karyawan = Karyawan::where('user_id', auth()->id())->first();

        $query = ProduksiTelur::where('karyawans_id', $karyawan->id ?? 0);

        // Filter tanggal dari
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        // Filter tanggal sampai
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter kualitas
        if ($request->filled('kualitas')) {
            $query->where('kualitas', $request->kualitas);
        }

        // Search
        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        $produksi = $query->orderBy('tanggal', 'desc')->paginate(15);

        return view('karyawan.riwayat.produksi', compact('produksi'));
    }
}
