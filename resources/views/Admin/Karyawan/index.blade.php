@extends('Layout.app')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Daftar Karyawan</h1>

        <a href="{{ route('admin.karyawan.create') }}"
            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Karyawan
        </a>
    </div>

    <div class="bg-white shadow-md rounded-lg p-4">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-2">Nama</th>
                    <th class="py-3 px-2">Email</th>
                    <th class="py-3 px-2">No HP</th>
                    <th class="py-3 px-2">Role</th>
                    <th class="py-3 px-2 text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($karyawans as $k)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="py-3 px-2">{{ $k->nama }}</td>
                        <td class="py-3 px-2">{{ $k->email }}</td>
                        <td class="py-3 px-2">{{ $k->no_hp }}</td>
                        <td class="py-3 px-2">{{ $k->user->role }}</td>

                        <td class="py-3 px-2 flex gap-2 justify-center">
                            <a href="{{ route('admin.karyawan.edit', $k->id) }}"
                                class="bg-yellow-500 text-white px-3 py-1 rounded">
                                Edit
                            </a>

                            <form action="{{ route('admin.karyawan.destroy', $k->id) }}" method="POST"
                                onsubmit="return confirm('Hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-600 text-white px-3 py-1 rounded">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
