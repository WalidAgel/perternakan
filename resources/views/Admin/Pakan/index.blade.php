@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Pakan</h1>
        <a href="{{ route('admin.pakan.create') }}"
            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
            + Tambah Pakan
        </a>
    </div>

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Nama Pakan</th>
                    <th class="p-3 text-left">Harga/Kg</th>
                    <th class="p-3 text-left">Stok (Kg)</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($pakans as $index => $pakan)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $pakans->firstItem() + $index }}</td>
                    <td class="p-3 font-medium">{{ $pakan->nama_pakan }}</td>
                    <td class="p-3">Rp {{ number_format($pakan->harga_pakan, 0, ',', '.') }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm {{ $pakan->stok > 100 ? 'bg-green-100 text-green-700' : ($pakan->stok > 0 ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ number_format($pakan->stok, 2, ',', '.') }} Kg
                        </span>
                    </td>
                    <td class="p-3">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.pakan.edit', $pakan->id) }}"
                                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-md transition shadow text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.pakan.destroy', $pakan->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus pakan ini?')">
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
                    <td colspan="5" class="text-center text-gray-500 p-5">Belum ada data pakan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $pakans->links() }}
    </div>
</div>
@endsection
