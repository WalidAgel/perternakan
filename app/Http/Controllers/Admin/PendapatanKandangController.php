<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PendapatanKandang;
use App\Models\Kandang;
use Illuminate\Http\Request;

class PendapatanKandangController extends Controller
{
    public function index(Request $request)
    {
        $query = PendapatanKandang::with(['kandang', 'produksiTelur']);

        if ($request->filled('kandang_id')) {
            $query->where('kandang_id', $request->kandang_id);
        }

        if ($request->filled('tanggal_dari')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_dari);
        }

        if ($request->filled('tanggal_sampai')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_sampai);
        }

        $pendapatans = $query->orderBy('tanggal', 'desc')->paginate(10);
        $kandangs = Kandang::all();

        $totalPendapatan = $query->sum('jumlah');

        return view('Admin.PendapatanKandang.index', compact('pendapatans', 'kandangs', 'totalPendapatan'));
    }
}
