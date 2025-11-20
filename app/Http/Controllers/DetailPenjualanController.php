<?php

namespace App\Http\Controllers;

use App\Models\DetailPenjualan;
use App\Models\Penjualan;
use Illuminate\Http\Request;

class DetailPenjualanController extends Controller
{
    public function index()
    {
        $details = DetailPenjualan::with('penjualan')->get();
        return response()->json($details);
    }

    public function store(Request $request)
    {
        $request->validate([
            'penjualan_id' => 'required|exists:penjualan,id',
            'qty' => 'required|numeric',
            'subtotal' => 'required|numeric',
        ]);

        $detail = DetailPenjualan::create($request->all());

        return response()->json($detail, 201);
    }

    public function show($id)
    {
        $detail = DetailPenjualan::with('penjualan')->findOrFail($id);
        return response()->json($detail);
    }

    public function update(Request $request, $id)
    {
        $detail = DetailPenjualan::findOrFail($id);
        $detail->update($request->all());

        return response()->json($detail);
    }

    public function destroy($id)
    {
        DetailPenjualan::destroy($id);
        return response()->json(['message' => 'Detail deleted']);
    }
}
