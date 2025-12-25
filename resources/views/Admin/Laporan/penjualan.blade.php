@extends('Layout.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">💵 Laporan Penjualan</h1>
        <p class="text-gray-600 mt-2">Analisis dan monitoring pendapatan penjualan telur</p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('admin.laporan.penjualan') }}"
          class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-6 rounded-xl shadow">

        <div>
            <label class="text-sm font-semibold text-gray-700">Tanggal Dari</label>
            <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                   class="w-full mt-1 rounded-lg border-gray-300">
        </div>

        <div>
            <label class="text-sm font-semibold text-gray-700">Tanggal Sampai</label>
            <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                   class="w-full mt-1 rounded-lg border-gray-300">
        </div>

        <div class="flex items-end gap-2">
            <button class="flex-1 bg-orange-600 text-white py-2 rounded-lg font-semibold">
                Filter
            </button>
            <a href="{{ route('admin.laporan.penjualan') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                ↻
            </a>
        </div>
    </form>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-green-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Total Pendapatan</p>
            <p class="text-3xl font-bold">
                Rp {{ number_format($totalPenjualan,0,',','.') }}
            </p>
        </div>

        <div class="bg-blue-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Total Terjual</p>
            <p class="text-3xl font-bold">
                {{ number_format($totalTerjual,0,',','.') }} Kg
            </p>
        </div>

        <div class="bg-purple-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Rata-rata / Transaksi</p>
            <p class="text-3xl font-bold">
                Rp {{ $totalTransaksi ? number_format($totalPenjualan / $totalTransaksi,0,',','.') : 0 }}
            </p>
        </div>
    </div>

    {{-- EXPORT --}}
    <form method="GET" action="{{ route('admin.laporan.penjualan.pdf') }}">
        <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
        <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
        <button class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold shadow">
            Export PDF
        </button>
    </form>

    {{-- TABLE --}}
    <div class="bg-white rounded-xl shadow overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 text-sm">
                <tr>
                    <th class="p-4 text-left">No</th>
                    <th class="p-4 text-left">Tanggal</th>
                    <th class="p-4 text-left">Produksi</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Harga/Kg</th>
                    <th class="p-4 text-left">Total</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penjualan as $i => $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-4">{{ $i + 1 }}</td>
                    <td class="p-4">
                        {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                    </td>
                    <td class="p-4">
                        Produksi #{{ optional($item->produksiTelur)->id ?? '-' }}
                    </td>
                    <td class="p-4 text-orange-600 font-semibold">
                        {{ number_format($item->jumlah_terjual, 2) }} Kg
                    </td>
                    <td class="p-4">
                        Rp {{ number_format($item->harga_per_kg,0,',','.') }}
                    </td>
                    <td class="p-4 text-green-600 font-bold">
                        Rp {{ number_format($item->total,0,',','.') }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        Tidak ada data penjualan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
