<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dataMaster()
    {
        // Ambil semua data karyawan dengan relasi user
        $karyawans = Karyawan::with('user')->get();

        // Atau jika mau pakai pagination
        // $karyawans = Karyawan::with('user')->paginate(10);

        return view('admin.DataMaster', compact('karyawans'));
    }
}
