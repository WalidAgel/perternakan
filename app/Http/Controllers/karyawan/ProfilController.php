<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    /**
     * Tampilkan halaman profil
     */
    public function index()
    {
        $user = Auth::user();

        // Ambil data karyawan jika ada
        $karyawan = null;
        if ($user->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', $user->id)->first();
        }

        return view('karyawan.profil.index', compact('user', 'karyawan'));
    }

    /**
     * Update profil user
     */
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
        ]);

        // Gunakan transaction untuk keamanan
        DB::beginTransaction();

        try {
            // ✅ Update user dengan fill
            $user->fill([
                'name' => $validated['name'],
                'email' => $validated['email']
            ]);
            $user->save();

            // ✅ Update data karyawan jika user adalah karyawan
            if ($user->role === 'karyawan') {
                $karyawan = Karyawan::where('user_id', $user->id)->first();

                if ($karyawan) {
                    $karyawan->fill([
                        'nama' => $validated['name'],
                        'email' => $validated['email'],
                        'no_hp' => $validated['no_hp']
                    ]);
                    $karyawan->save();
                } else {
                    // ✅ Jika belum ada data karyawan, buat baru
                    Karyawan::create([
                        'user_id' => $user->id,
                        'nama' => $validated['name'],
                        'email' => $validated['email'],
                        'no_hp' => $validated['no_hp']
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('karyawan.profil.index')
                ->with('success', 'Profil berhasil diperbarui!');

        } catch (\Exception $e) {
            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', 'Gagal memperbarui profil: ' . $e->getMessage());
        }
    }

    /**
     * Update password user
     */
    public function updatePassword(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ], [
            'password_lama.required' => 'Password lama harus diisi',
            'password_baru.required' => 'Password baru harus diisi',
            'password_baru.min' => 'Password baru minimal 6 karakter',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        $user = Auth::user();

        // ✅ Cek password lama
        if (!Hash::check($validated['password_lama'], $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        // ✅ Cek password baru tidak sama dengan password lama
        if (Hash::check($validated['password_baru'], $user->password)) {
            return back()->with('error', 'Password baru tidak boleh sama dengan password lama!');
        }

        try {
            // ✅ Update password
            $user->password = Hash::make($validated['password_baru']);
            $user->save();

            return redirect()->route('karyawan.profil.index')
                ->with('success', 'Password berhasil diubah!');

        } catch (\Exception $e) {
            return back()->with('error', 'Gagal mengubah password: ' . $e->getMessage());
        }
    }
}
