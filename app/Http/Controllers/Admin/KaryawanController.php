<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('admin.karyawan.index', compact('karyawans'));
    }

    // ✅ METHOD INI HARUS ADA
    public function create()
    {
        $users = User::all(); // Bisa dihapus jika tidak pakai dropdown user
        return view('admin.karyawan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'no_hp' => 'nullable|string|max:15'
        ], [
            'nama.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat User terlebih dahulu
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'karyawan'
            ]);

            // 2. Buat Karyawan dengan user_id yang baru dibuat
            Karyawan::create([
                'user_id' => $user->id,
                'nama' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp
            ]);

            DB::commit();

            return redirect()->route('admin.karyawan.index')
                ->with('success', 'Karyawan berhasil ditambahkan. Login: ' . $request->email);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal menambahkan karyawan: ' . $e->getMessage());
        }
    }

    public function edit(Karyawan $karyawan)
    {
        $users = User::all();
        return view('admin.karyawan.edit', compact('karyawan', 'users'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $user = $karyawan->user;

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'nullable|string|max:15',
            'password' => 'nullable|min:6',
        ]);

        DB::beginTransaction();
        try {
            // UPDATE USER
            $user->update([
                'name' => $request->nama,
                'email' => $request->email,
            ]);

            if ($request->filled('password')) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            // UPDATE KARYAWAN
            $karyawan->update([
                'nama' => $request->nama,
                'no_hp' => $request->no_hp,
            ]);

            DB::commit();

            return redirect()
                ->route('admin.karyawan.index')
                ->with('success', 'Data karyawan berhasil diperbarui');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }


    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('admin.karyawan.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
