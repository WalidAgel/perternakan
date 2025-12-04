@extends('Layout.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Penjualan</h1>

    <a href="{{ route('admin.penjualan.create') }}"
        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
        + Tambah Penjualan
    </a>
</div>

{{-- FILTER CARD --}}
<div class="bg-white shadow rounded-xl p-5 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>
            <label class="text-sm font-semibold">Tanggal</label>
            <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="text-sm font-semibold">Produksi</label>
            <select name="produksi_id"
                class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring focus:ring-blue-200">
                <option value="">-- Pilih Produksi --</option>
                @foreach ($produksiList as $p)
                    <option value="{{ $p->id }}" {{ request('produksi_id') == $p->id ? 'selected' : '' }}>
                        Produksi #{{ $p->id }} - {{ $p->tanggal }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="flex items-end">
            <button
                class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
                Filter
            </button>
        </div>
    </form>
</div>

{{-- TABLE --}}
<div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full">
        <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
            <tr>
                <th class="p-3 text-left">Tanggal</th>
                <th class="p-3 text-left">Produksi</th>
                <th class="p-3 text-left">Jumlah Terjual</th>
                <th class="p-3 text-left">Harga/kg</th>
                <th class="p-3 text-left">Total</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-800">
            @forelse ($penjualan as $row)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $row->tanggal }}</td>

                <td class="p-3">
                    @if ($row->produksiTelur)
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">
                            Produksi #{{ $row->produksiTelur->id }}
                        </span>
                        <br>
                        <small class="text-gray-500">
                            {{ $row->produksiTelur->tanggal }} |
                            {{ $row->produksiTelur->jumlah }} butir
                        </small>
                    @else
                        <span class="text-red-600 text-sm">Tidak ada data</span>
                    @endif
                </td>

                <td class="p-3">{{ $row->jumlah_terjual }} kg</td>

                <td class="p-3">Rp {{ number_format($row->harga_per_kg) }}</td>

                <td class="p-3 font-semibold text-green-700">
                    Rp {{ number_format($row->total) }}
                </td>

                <td class="p-3 text-center">
                    <a href="{{ route('admin.penjualan.edit', $row->id) }}"
                        class="text-blue-600 hover:underline font-medium">Edit</a>

                    <form action="{{ route('admin.penjualan.destroy', $row->id) }}"
                        method="POST" class="inline ml-2"
                        onsubmit="return confirm('Yakin ingin menghapus penjualan ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline font-medium">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-gray-500 p-5">
                    Belum ada data penjualan
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $penjualan->links() }}
</div>

@endsection
