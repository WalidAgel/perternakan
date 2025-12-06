@extends('layout.app')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Kategori Pengeluaran</h1>
        <a href="{{ route('admin.kategori.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-2">Nama Kategori</th>
                    <th class="py-3 px-2">Deskripsi</th>
                    <th class="py-3 px-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($kategoris as $k)
                <tr class="border-b hover:bg-gray-50">
                    <td class="py-3 px-2">{{ $k->nama_kategori }}</td>
                    <td class="py-3 px-2">{{ $k->deskripsi }}</td>
                    <td class="py-3 px-2 flex gap-2 justify-center">
                        <a href="{{ route('admin.kategori.edit', $k->id) }}"
                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>

                        <form action="{{ route('admin.kategori.destroy', $k->id) }}" method="POST"
                            onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-gray-500">
                        Belum ada data kategori.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
