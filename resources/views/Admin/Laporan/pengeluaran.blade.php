@extends('Layout.app')

@section('content')
<div class="p-4 md:p-6">

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Laporan Pengeluaran</h1>
        <p class="text-gray-600 mt-1">
            Pantau total pengeluaran berdasarkan kategori & rentang tanggal.
        </p>
    </div>

    {{-- FILTER --}}
    <div class="bg-white shadow-md rounded-xl p-4 md:p-6 mb-6">
        <form method="GET" action="{{ route('admin.laporan.pengeluaran') }}"
              class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                       class="w-full border px-3 py-2 rounded-lg">
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                <select name="kategori_id" class="w-full border px-3 py-2 rounded-lg">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Filter
                </button>
                <a href="{{ route('admin.laporan.pengeluaran') }}"
                   class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                    Reset
                </a>
            </div>
        </form>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-6">
        <div class="bg-white shadow-md rounded-xl p-6 text-center">
            <h3 class="text-sm md:text-lg font-semibold text-gray-700 mb-1">Total Pengeluaran</h3>
            <p class="text-xl md:text-2xl font-bold text-red-600">
                Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}
            </p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 text-center">
            <h3 class="text-sm md:text-lg font-semibold text-gray-700 mb-1">Jumlah Transaksi</h3>
            <p class="text-xl md:text-2xl font-bold">
                {{ $pengeluaran->count() }}
            </p>
        </div>

        <div class="bg-white shadow-md rounded-xl p-6 text-center">
            <h3 class="text-sm md:text-lg font-semibold text-gray-700 mb-1">Kategori Terpakai</h3>
            <p class="text-xl md:text-2xl font-bold">
                {{ $chartData->count() }}
            </p>
        </div>
    </div>

    {{-- EXPORT --}}
    <div class="mb-4">
        <a href="{{ route('admin.laporan.pengeluaran.pdf', request()->all()) }}"
           class="inline-block px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold shadow">
            Export PDF
        </a>
    </div>

    {{-- HINT MOBILE --}}
    <div class="text-sm text-gray-500 mb-2 md:hidden">
        ⇠ Geser tabel ke samping untuk melihat kolom lainnya ⇢
    </div>

    {{-- TABLE --}}
    <div class="bg-white shadow-md rounded-xl overflow-x-auto">
        <table class="w-full min-w-max text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 font-semibold text-gray-700 whitespace-nowrap">Tanggal</th>
                    <th class="px-6 py-3 font-semibold text-gray-700 whitespace-nowrap">Kategori</th>
                    <th class="px-6 py-3 font-semibold text-gray-700 whitespace-nowrap">Karyawan</th>
                    <th class="px-6 py-3 font-semibold text-gray-700 whitespace-nowrap">Jumlah</th>
                    <th class="px-6 py-3 font-semibold text-gray-700 whitespace-nowrap">Deskripsi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pengeluaran as $item)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $item->tanggal->format('d/m/Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $item->kategori->nama_kategori }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $item->karyawan->nama }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-red-600">
                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 max-w-xs truncate">
                        {{ $item->deskripsi ?? '-' }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-600">
                        Tidak ada data ditemukan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
