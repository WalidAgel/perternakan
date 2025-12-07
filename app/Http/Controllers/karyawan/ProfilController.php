<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil data karyawan jika ada
        $karyawan = null;
        if ($user->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', $user->id)->first();
        }

        return view('karyawan.profil', compact('user', 'karyawan'));
    }

    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
        ], [
            'name.required' => 'Nama harus diisi',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah digunakan',
        ]);

        // Update user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Update data karyawan jika user adalah karyawan
        if ($user->role === 'karyawan') {
            $karyawan = Karyawan::where('user_id', $user->id)->first();
            if ($karyawan) {
                $karyawan->nama = $request->name;
                $karyawan->email = $request->email;
                $karyawan->no_hp = $request->no_hp;
                $karyawan->save();
            }
        }

        return redirect()->route('karyawan.profil')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6|confirmed',
        ], [
            'password_lama.required' => 'Password lama harus diisi',
            'password_baru.required' => 'Password baru harus diisi',
            'password_baru.min' => 'Password baru minimal 6 karakter',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok'
        ]);

        $user = Auth::user();

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        // Update password
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('karyawan.profil')
            ->with('success', 'Password berhasil diubah!');
    }
}
