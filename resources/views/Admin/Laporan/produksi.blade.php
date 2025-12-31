@extends('Layout.app')

@section('content')
<div class="p-4 md:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
        <div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Laporan Produksi Telur</h1>
            <p class="text-gray-600 mt-1">Monitor dan analisis data produksi telur</p>
        </div>
    </div>

    {{-- FILTER --}}
    <div class="bg-white shadow rounded-xl p-4 md:p-5 mb-4">
        <form method="GET" action="{{ route('admin.laporan.produksi') }}" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Kandang</label>
                <select name="kandang_id" class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white">
                    <option value="">-- Semua Kandang --</option>
                    @foreach ($kandangs as $k)
                        <option value="{{ $k->id }}" {{ request('kandang_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kandang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Karyawan</label>
                <select name="karyawan_id" class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white">
                    <option value="">-- Semua Karyawan --</option>
                    @foreach ($karyawans as $k)
                        <option value="{{ $k->id }}" {{ request('karyawan_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-600 text-white p-6 rounded-xl shadow text-center">
            <p class="text-sm">Total Produksi</p>
            <p class="text-2xl md:text-3xl font-bold">{{ number_format($totalJumlah) }} Butir</p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-xl shadow text-center">
            <p class="text-sm">Telur Bagus</p>
            <p class="text-2xl md:text-3xl font-bold">{{ number_format($totalBagus ?? 0) }} Butir</p>
        </div>

        <div class="bg-red-600 text-white p-6 rounded-xl shadow text-center">
            <p class="text-sm">Telur Rusak</p>
            <p class="text-2xl md:text-3xl font-bold">{{ number_format($totalRusak ?? 0) }} Butir</p>
        </div>

        <div class="bg-purple-600 text-white p-6 rounded-xl shadow text-center">
            <p class="text-sm">Rata-rata / Hari</p>
            <p class="text-2xl md:text-3xl font-bold">
                {{ $totalData ? number_format($totalJumlah / $totalData) : 0 }} Butir
            </p>
        </div>
    </div>

    {{-- EXPORT --}}
    <div class="mb-4">
        <form method="GET" action="{{ route('admin.laporan.produksi.pdf') }}" class="inline">
            <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
            <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
            <input type="hidden" name="kandang_id" value="{{ request('kandang_id') }}">
            <input type="hidden" name="karyawan_id" value="{{ request('karyawan_id') }}">
            <button class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg shadow font-semibold">
                Export PDF
            </button>
        </form>
    </div>

    {{-- TABLE (SCROLLABLE) --}}
    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-3 text-left whitespace-nowrap">Tanggal</th>
                    <th class="p-3 text-left whitespace-nowrap">Kandang</th>
                    <th class="p-3 text-left whitespace-nowrap">Karyawan</th>
                    <th class="p-3 text-left whitespace-nowrap">Telur Bagus</th>
                    <th class="p-3 text-left whitespace-nowrap">Telur Rusak</th>
                    <th class="p-3 text-left whitespace-nowrap">Total</th>
                    <th class="p-3 text-left whitespace-nowrap">Catatan</th>
                </tr>
            </thead>

            <tbody class="text-gray-800">
                @forelse ($produksi as $p)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 whitespace-nowrap">
                        {{ $p->tanggal->format('d/m/Y') }}
                    </td>

                    <td class="p-3 whitespace-nowrap font-medium">
                        @if($p->kandang)
                            <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded text-sm font-semibold">
                                {{ $p->kandang->nama_kandang }}
                            </span>
                        @else
                            <span class="text-gray-400">-</span>
                        @endif
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        {{ $p->karyawan->nama }}
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                            {{ $p->jumlah_bagus }} butir
                        </span>
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                            {{ $p->jumlah_rusak }} butir
                        </span>
                    </td>

                    <td class="p-3 whitespace-nowrap font-semibold text-blue-600">
                        {{ $p->jumlah }} butir
                    </td>

                    <td class="p-3 max-w-xs truncate">
                        {{ $p->catatan ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center text-gray-500 p-5">
                        Belum ada data produksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection