@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pembelian Pakan</h1>
        <a href="{{ route('admin.pembelian-pakan.create') }}"
            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
            + Tambah Pembelian
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-xl p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Pakan</label>
                <select name="pakan_id" class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
                    <option value="">-- Semua Pakan --</option>
                    @foreach ($pakans as $p)
                    <option value="{{ $p->id }}" {{ request('pakan_id') == $p->id ? 'selected' : '' }}>{{ $p->nama_pakan }}</option>
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
                    <th class="p-3 text-left">Pakan</th>
                    <th class="p-3 text-left">Jumlah</th>
                    <th class="p-3 text-left">Harga Satuan</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Karyawan</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($pembelianPakans as $index => $pembelian)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $pembelianPakans->firstItem() + $index }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-sm">
                            {{ $pembelian->tanggal->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="p-3 font-medium">{{ $pembelian->pakan->nama_pakan }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm font-semibold">
                            {{ number_format($pembelian->jumlah, 2, ',', '.') }} Kg
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="text-gray-700 font-medium">
                            Rp {{ number_format($pembelian->harga_satuan, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-lg text-sm font-bold">
                            Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}
                        </span>
                    </td>
                    <td class="p-3">{{ $pembelian->karyawan->nama }}</td>
                    <td class="p-3">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.pembelian-pakan.edit', $pembelian->id) }}"
                                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-md transition shadow text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.pembelian-pakan.destroy', $pembelian->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pembelian ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md transition shadow text-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-500 p-5">Belum ada data pembelian pakan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pembelianPakans->links() }}
    </div>
</div>
@endsection
