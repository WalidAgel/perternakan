@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pendapatan Kandang</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded-xl p-5">
            <div class="text-sm text-gray-500">Total Telur Bagus</div>
            <div class="text-2xl font-bold text-green-600">{{ number_format($totalPendapatan, 0) }} butir</div>
            <p class="text-xs text-gray-500 mt-1">Total produksi telur berkualitas baik</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-xl p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Kandang</label>
                <select name="kandang_id" class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
                    <option value="">-- Semua Kandang --</option>
                    @foreach ($kandangs as $k)
                    <option value="{{ $k->id }}" {{ request('kandang_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kandang }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300">
            </div>
            <div>
                <label class="text-sm font-semibold text-gray-700">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300">
            </div>
            <div class="flex items-end">
                <button class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Kandang</th>
                    <th class="p-3 text-left">Jumlah Telur</th>
                    <th class="p-3 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($pendapatans as $index => $pendapatan)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $pendapatans->firstItem() + $index }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-sm">
                            {{ $pendapatan->tanggal->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="p-3 font-medium">
                        <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-lg text-sm font-semibold">
                            {{ $pendapatan->kandang->nama_kandang }}
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-sm font-semibold">
                            {{ number_format($pendapatan->jumlah, 0) }} butir
                        </span>
                    </td>
                    <td class="p-3 text-gray-600">{{ $pendapatan->keterangan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-gray-500 p-5">Belum ada data pendapatan kandang</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pendapatans->links() }}
    </div>
</div>
@endsection
