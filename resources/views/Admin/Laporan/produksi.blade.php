@extends('Layout.app')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">📊 Laporan Produksi Telur</h1>
    <p class="text-gray-600 mt-2">Monitor dan analisis data produksi telur</p>
</div>

{{-- FILTER CARD --}}
<div class="bg-white shadow-lg rounded-xl p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
        </svg>
        Filter Laporan
    </h2>

    <form method="GET" action="{{ route('admin.laporan.produksi') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
            <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                class="w-full border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
            <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                class="w-full border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Karyawan</label>
            <select name="karyawan_id"
                class="w-full border-gray-300 rounded-lg p-2.5 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <option value="">Semua Karyawan</option>
                @foreach($karyawans as $k)
                <option value="{{ $k->id }}" {{ request('karyawan_id') == $k->id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button type="submit"
                class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
            Filter
            </button>
            <a href="{{ route('admin.laporan.produksi') }}"
                class="px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transition duration-300">
                ↻
            </a>
        </div>
    </form>
</div>

{{-- STATISTIK CARDS --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Produksi</p>
                <p class="text-3xl font-bold mt-2">{{ number_format($totalJumlah) }}</p>
                <p class="text-blue-100 text-sm mt-1">Butir</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 3.5a1.5 1.5 0 013 0V4a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-.5a1.5 1.5 0 000 3h.5a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-.5a1.5 1.5 0 00-3 0v.5a1 1 0 01-1 1H6a1 1 0 01-1-1v-3a1 1 0 00-1-1h-.5a1.5 1.5 0 010-3H4a1 1 0 001-1V6a1 1 0 011-1h3a1 1 0 001-1v-.5z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Total Data</p>
                <p class="text-3xl font-bold mt-2">{{ number_format($totalData) }}</p>
                <p class="text-green-100 text-sm mt-1">Transaksi</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"/>
                    <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Rata-rata/Hari</p>
                <p class="text-3xl font-bold mt-2">
                    {{ $totalData > 0 ? number_format($totalJumlah / $totalData, 0) : 0 }}
                </p>
                <p class="text-purple-100 text-sm mt-1">Butir</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
            </div>
        </div>
    </div>
</div>

{{-- EXPORT BUTTONS --}}
<div class="flex gap-3 mb-6">
    <form method="GET" action="{{ route('admin.laporan.produksi.pdf') }}" class="inline">
        <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
        <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
        <input type="hidden" name="karyawan_id" value="{{ request('karyawan_id') }}">
        <button type="submit"
            class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center gap-2">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
            </svg>
            Export PDF
        </button>
    </form>


</div>

{{-- TABLE --}}
<div class="bg-white shadow-lg rounded-xl overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Data Produksi</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-4 text-left font-semibold">No</th>
                    <th class="p-4 text-left font-semibold">Tanggal</th>
                    <th class="p-4 text-left font-semibold">Karyawan</th>
                    <th class="p-4 text-left font-semibold">Jumlah</th>
                    <th class="p-4 text-left font-semibold">Kualitas</th>
                    <th class="p-4 text-left font-semibold">Keterangan</th>
                </tr>
            </thead>
            <tbody class="text-gray-800 divide-y divide-gray-200">
                @forelse($produksi as $index => $p)
                <tr class="hover:bg-gray-50 transition duration-150">
                    <td class="p-4">{{ $index + 1 }}</td>
                    <td class="p-4">
                        <span class="text-sm font-medium">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</span>
                    </td>
                    <td class="p-4">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold mr-3">
                                {{ substr($p->karyawan->nama, 0, 1) }}
                            </div>
                            <span class="font-medium">{{ $p->karyawan->nama }}</span>
                        </div>
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            {{ number_format($p->jumlah) }} butir
                        </span>
                    </td>
                    <td class="p-4">
                        <span class="px-3 py-1
                            @if(strtolower($p->kualitas) == 'baik') bg-green-100 text-green-800
                            @elseif(strtolower($p->kualitas) == 'retak') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif
                            rounded-full text-sm font-semibold">
                            {{ $p->kualitas }}
                        </span>
                    </td>
                    <td class="p-4 text-sm text-gray-600">{{ $p->keterangan ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="font-medium">Tidak ada data produksi</p>
                        <p class="text-sm mt-1">Coba ubah filter pencarian</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
