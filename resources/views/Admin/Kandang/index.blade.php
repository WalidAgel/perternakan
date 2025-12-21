@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Kandang</h1>
        <a href="{{ route('admin.kandang.create') }}"
            class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
            + Tambah Kandang
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
                    <th class="p-3 text-left">Nama Kandang</th>
                    <th class="p-3 text-left">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-800">
                @forelse ($kandangs as $index => $kandang)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3">{{ $kandangs->firstItem() + $index }}</td>
                    <td class="p-3 font-medium">{{ $kandang->nama_kandang }}</td>
                    <td class="p-3">
                        <span class="px-2 py-1 rounded text-sm {{ $kandang->status == 'aktif' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ ucfirst($kandang->status) }}
                        </span>
                    </td>
                    <td class="p-3">
                        <div class="flex items-center justify-center gap-3">
                            <a href="{{ route('admin.kandang.edit', $kandang->id) }}"
                                class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-md transition shadow text-sm">
                                Edit
                            </a>
                            <form action="{{ route('admin.kandang.destroy', $kandang->id) }}" method="POST"
                                onsubmit="return confirm('Yakin ingin menghapus kandang ini?')">
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
                    <td colspan="4" class="text-center text-gray-500 p-5">Belum ada data kandang</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $kandangs->links() }}
    </div>
</div>
@endsection
