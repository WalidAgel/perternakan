<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\PenggunaanPakan;
use App\Models\Pakan;
use App\Models\Kandang;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PenggunaanPakanController extends Controller
{
    /**
     * Helper method untuk mengambil data karyawan
     */
    private function getKaryawan()
    {
        $karyawan = Karyawan::where('user_id', Auth::id())->first();

        if (!$karyawan) {
            abort(403, 'Data karyawan tidak ditemukan. Silakan hubungi administrator.');
        }

        return $karyawan;
    }

    /**
     * INDEX - Daftar Penggunaan Pakan
     */
    public function index(Request $request)
    {
        $karyawan = $this->getKaryawan();

        $query = PenggunaanPakan::with(['kandang', 'pakan'])
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('tanggal', 'DESC');

        // Filter by kandang
        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        // Filter by pakan
        if ($request->filled('pakan_id')) {
            $query->where('pakan_id', $request->pakan_id);
        }

        // Filter by tanggal awal
        if ($request->filled('tanggal_awal')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_awal);
        }

        // Filter by tanggal akhir
        if ($request->filled('tanggal_akhir')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_akhir);
        }

        // Clone query untuk hitung total
        $totalPenggunaan = (clone $query)->sum('jumlah');

        // Paginate hasil
        $penggunaanPakan = $query->paginate(15);

        // Data untuk dropdown
        $kandangs = Kandang::where('status', 'aktif')->orderBy('nama_kandang')->get();
        $pakans = Pakan::orderBy('nama_pakan')->get();

        return view('karyawan.penggunaan-pakan.index', compact(
            'penggunaanPakan',
            'kandangs',
            'pakans',
            'totalPenggunaan'
        ));
    }

    /**
     * CREATE - Form Input Penggunaan Pakan
     */
    public function create()
    {
        $this->getKaryawan();

        $kandangs = Kandang::where('status', 'aktif')->orderBy('nama_kandang')->get();
        $pakans = Pakan::where('stok', '>', 0)->orderBy('nama_pakan')->get();

        return view('karyawan.penggunaan-pakan.create', compact('kandangs', 'pakans'));
    }

    /**
     * STORE - Simpan Data Penggunaan Pakan
     */
    public function store(Request $request)
    {
        $karyawan = $this->getKaryawan();

        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'pakan_id' => 'required|exists:pakans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:500'
        ], [
            'kandang_id.required' => 'Kandang harus dipilih',
            'kandang_id.exists' => 'Kandang tidak valid',
            'pakan_id.required' => 'Pakan harus dipilih',
            'pakan_id.exists' => 'Pakan tidak valid',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 0.01'
        ]);

        // Cek stok pakan
        $pakan = Pakan::find($validated['pakan_id']);
        if ($pakan->stok < $validated['jumlah']) {
            return back()
                ->withErrors(['jumlah' => 'Stok pakan tidak mencukupi. Stok tersedia: ' . number_format($pakan->stok, 2) . ' kg'])
                ->withInput();
        }

        // Tambahkan karyawans_id
        $validated['karyawans_id'] = $karyawan->id;

        // Simpan data dengan transaction
        DB::transaction(function () use ($validated, $pakan) {
            PenggunaanPakan::create($validated);

            // Kurangi stok pakan
            $pakan->stok -= $validated['jumlah'];
            $pakan->save();
        });

        return redirect()->route('karyawan.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil dicatat dan stok telah diperbarui.');
    }

    /**
     * EDIT - Form Edit Penggunaan Pakan
     */
    public function edit(PenggunaanPakan $penggunaanPakan)
    {
        $karyawan = $this->getKaryawan();

        // Pastikan hanya pemilik data yang bisa edit
        if ($penggunaanPakan->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengedit data ini.');
        }

        $kandangs = Kandang::where('status', 'aktif')->orderBy('nama_kandang')->get();
        $pakans = Pakan::orderBy('nama_pakan')->get();

        return view('karyawan.penggunaan-pakan.edit', compact('penggunaanPakan', 'kandangs', 'pakans'));
    }

    /**
     * UPDATE - Update Penggunaan Pakan
     */
    public function update(Request $request, PenggunaanPakan $penggunaanPakan)
    {
        $karyawan = $this->getKaryawan();

        // Pastikan hanya pemilik data yang bisa update
        if ($penggunaanPakan->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk mengubah data ini.');
        }

        $validated = $request->validate([
            'kandang_id' => 'required|exists:kandangs,id',
            'pakan_id' => 'required|exists:pakans,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric|min:0.01',
            'keterangan' => 'nullable|string|max:500'
        ], [
            'kandang_id.required' => 'Kandang harus dipilih',
            'kandang_id.exists' => 'Kandang tidak valid',
            'pakan_id.required' => 'Pakan harus dipilih',
            'pakan_id.exists' => 'Pakan tidak valid',
            'tanggal.required' => 'Tanggal harus diisi',
            'tanggal.date' => 'Format tanggal tidak valid',
            'jumlah.required' => 'Jumlah harus diisi',
            'jumlah.numeric' => 'Jumlah harus berupa angka',
            'jumlah.min' => 'Jumlah minimal 0.01'
        ]);

        // Update dengan transaction
        DB::transaction(function () use ($validated, $penggunaanPakan) {
            // Kembalikan stok pakan lama
            $oldPakan = Pakan::find($penggunaanPakan->pakan_id);
            $oldPakan->stok += $penggunaanPakan->jumlah;
            $oldPakan->save();

            // Kurangi stok pakan baru
            $newPakan = Pakan::find($validated['pakan_id']);
            if ($newPakan->stok < $validated['jumlah']) {
                throw new \Exception('Stok pakan tidak mencukupi. Stok tersedia: ' . number_format($newPakan->stok, 2) . ' kg');
            }
            $newPakan->stok -= $validated['jumlah'];
            $newPakan->save();

            // Update data penggunaan
            $penggunaanPakan->update($validated);
        });

        return redirect()->route('karyawan.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil diperbarui.');
    }

    /**
     * DESTROY - Hapus Penggunaan Pakan
     */
    public function destroy(PenggunaanPakan $penggunaanPakan)
    {
        $karyawan = $this->getKaryawan();

        // Pastikan hanya pemilik data yang bisa hapus
        if ($penggunaanPakan->karyawans_id != $karyawan->id) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus data ini.');
        }

        // Hapus dengan transaction
        DB::transaction(function () use ($penggunaanPakan) {
            // Kembalikan stok pakan
            $pakan = Pakan::find($penggunaanPakan->pakan_id);
            $pakan->stok += $penggunaanPakan->jumlah;
            $pakan->save();

            // Hapus data
            $penggunaanPakan->delete();
        });

        return redirect()->route('karyawan.penggunaan-pakan.index')
            ->with('success', 'Penggunaan pakan berhasil dihapus dan stok telah dikembalikan.');
    }

    /**
     * RIWAYAT - Riwayat Penggunaan Pakan
     */
    public function riwayat(Request $request)
    {
        $karyawan = $this->getKaryawan();

        $query = PenggunaanPakan::with(['kandang', 'pakan'])
            ->where('karyawans_id', $karyawan->id)
            ->orderBy('tanggal', 'DESC');

        // Filter by tanggal dari
        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        // Filter by tanggal sampai
        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        // Filter by kandang
        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        // Filter by pakan
        if ($request->filled('pakan_id')) {
            $query->where('pakan_id', $request->pakan_id);
        }

        // Search by keterangan
        if ($request->filled('search')) {
            $query->where('keterangan', 'like', '%' . $request->search . '%');
        }

        // Paginate
        $riwayat = $query->paginate(20);

        // Data untuk filter
        $kandangs = Kandang::where('status', 'aktif')->orderBy('nama_kandang')->get();
        $pakans = Pakan::orderBy('nama_pakan')->get();

        return view('karyawan.penggunaan-pakan.riwayat', compact('riwayat', 'kandangs', 'pakans'));
    }
}
