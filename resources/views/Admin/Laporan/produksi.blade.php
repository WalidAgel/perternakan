@extends('Layout.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- HEADER --}}
    <div>
        <h1 class="text-3xl font-bold text-gray-800">📊 Laporan Produksi Telur</h1>
        <p class="text-gray-600 mt-2">Monitor dan analisis data produksi telur</p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('admin.laporan.produksi') }}"
          class="grid grid-cols-1 md:grid-cols-4 gap-4 bg-white p-6 rounded-xl shadow">

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

        <div>
            <label class="text-sm font-semibold text-gray-700">Karyawan</label>
            <select name="karyawan_id" class="w-full mt-1 rounded-lg border-gray-300">
                <option value="">Semua Karyawan</option>
                @foreach ($karyawans as $k)
                    <option value="{{ $k->id }}" {{ request('karyawan_id') == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end gap-2">
            <button class="flex-1 bg-orange-600 text-white py-2 rounded-lg font-semibold">
                Filter
            </button>
            <a href="{{ route('admin.laporan.produksi') }}"
               class="bg-gray-500 text-white px-4 py-2 rounded-lg">
                ↻
            </a>
        </div>
    </form>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-blue-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Total Produksi</p>
            <p class="text-3xl font-bold">{{ number_format($totalJumlah) }} Butir</p>
        </div>

        <div class="bg-green-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Total Data</p>
            <p class="text-3xl font-bold">{{ number_format($totalData) }}</p>
        </div>

        <div class="bg-purple-600 text-white p-6 rounded-xl shadow">
            <p class="text-sm">Rata-rata / Hari</p>
            <p class="text-3xl font-bold">
                {{ $totalData ? number_format($totalJumlah / $totalData) : 0 }} Butir
            </p>
        </div>
    </div>

    {{-- EXPORT --}}
    <form method="GET" action="{{ route('admin.laporan.produksi.pdf') }}">
        <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
        <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
        <input type="hidden" name="karyawan_id" value="{{ request('karyawan_id') }}">
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
                    <th class="p-4 text-left">Karyawan</th>
                    <th class="p-4 text-left">Jumlah</th>
                    <th class="p-4 text-left">Kualitas</th>
                    <th class="p-4 text-left">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @forelse($produksi as $i => $p)
                <tr class="border-b">
                    <td class="p-4">{{ $i+1 }}</td>
                    <td class="p-4">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                    <td class="p-4">{{ $p->karyawan->nama }}</td>
                    <td class="p-4 font-semibold text-orange-600">
                        {{ number_format($p->jumlah) }} Butir
                    </td>
                    <td class="p-4">{{ $p->kualitas }}</td>
                    <td class="p-4 text-sm text-gray-600">{{ $p->keterangan ?: '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-10 text-gray-500">
                        Tidak ada data produksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection
