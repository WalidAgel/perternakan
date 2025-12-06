<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Karyawan;
use Illuminate\Http\Request;


class KaryawanController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::with('user')->get();
        return view('Admin.Karyawan.index', compact('karyawans'));
    }

    public function create()
    {
        $users = User::all();
        return view('Admin.Karyawan.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'nullable'
        ]);

        Karyawan::create($request->all());

        return redirect()->route('Admin.Karyawan.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Karyawan $karyawan)
    {
        $users = User::all();
        return view('Admin.Karyawan.edit', compact('karyawan', 'users'));
    }

    public function update(Request $request, Karyawan $karyawan)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'email' => 'nullable|email',
            'no_hp' => 'nullable'
        ]);

        $karyawan->update($request->all());

        return redirect()->route('Admin.Karyawan.index')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return redirect()->route('Admin.Karyawan.index')->with('success', 'Data berhasil dihapus');
    }
}
