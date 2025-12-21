@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Operasi Kandang</h1>
        <a href="{{ route('admin.operasi-kandang.create') }}"
            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
            + Tambah Operasi
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-xl p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                <label class="text-sm font-semibold text-gray-700">Status</label>
                <select name="status" class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
                    <option value="">-- Semua Status --</option>
                    <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
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
                    <th class="p-3 text-left">Kandang</th>
                    <th class="p-3 text-left">Jumlah Ayam</th>
                    <th class="p-3 text-left">Tanggal Mulai</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($operasiKandangs as $index => $operasi)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $operasiKandangs->firstItem() + $index }}</td>
                    <td class="p-3 font-medium">{{ $operasi->kandang->nama_kandang }}</td>
                    <td class="p-3">{{ number_format($operasi->jumlah_ayam) }} ekor</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-sm">
                            {{ $operasi->tanggal_mulai_produksi->format('d/m/Y') }}
                        </span>
                    </td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm {{ $operasi->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($operasi->status) }}
                        </span>
                    </td>
                    <td class="p-3">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.operasi-kandang.edit', $operasi->id) }}"
                                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-md transition shadow text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.operasi-kandang.destroy', $operasi->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus operasi ini?')">
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
                    <td colspan="6" class="text-center text-gray-500 p-5">Belum ada data operasi kandang</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $operasiKandangs->links() }}
    </div>
</div>
@endsection
