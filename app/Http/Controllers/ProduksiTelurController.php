<?php

namespace App\Http\Controllers;

use App\Models\ProduksiTelur;
use Illuminate\Http\Request;


class ProduksiTelurController extends Controller
{
    public function index()
    {
        return ProduksiTelur::with('karyawan')->paginate(15);
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'karyawan_id' => 'required|exists:karyawan,id',
            'tanggal' => 'required|date',
            'jumlah' => 'required|numeric',
            'kualitas' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);


        $produksi = ProduksiTelur::create($data);
        return response()->json($produksi, 201);
    }


    public function show(ProduksiTelur $produksiTelur)
    {
        return $produksiTelur->load('karyawan');
    }


    public function update(Request $request, ProduksiTelur $produksiTelur)
    {
        $data = $request->validate([
            'karyawan_id' => 'sometimes|exists:karyawan,id',
            'tanggal' => 'sometimes|date',
            'jumlah' => 'sometimes|numeric',
            'kualitas' => 'nullable|string',
            'keterangan' => 'nullable|string',
        ]);


        $produksiTelur->update($data);
        return response()->json($produksiTelur);
    }


    public function destroy(ProduksiTelur $produksiTelur)
    {
        $produksiTelur->delete();
        return response()->noContent();
    }
}


