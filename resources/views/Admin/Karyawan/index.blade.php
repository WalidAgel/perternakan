@extends('Layout.app')

@section('content')
<div class="p-4 md:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Karyawan</h1>

        <a href="{{ route('admin.karyawan.create') }}"
           class="bg-orange-600 text-white px-4 font-semibold py-2 rounded hover:bg-orange-700 transition text-center">
            + Tambah Karyawan
        </a>
    </div>

    {{-- CARD --}}
    <div class="bg-white shadow-md rounded-lg p-4">

        {{-- WRAPPER SCROLL MOBILE --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm text-left min-w-[650px]">
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

                            <td class="py-3 px-2">
                                {{-- Aksi yang benar-benar responsif --}}
                                <div class="flex flex-col sm:flex-row sm:justify-center sm:items-center gap-2 w-full">

                                    <a href="{{ route('admin.karyawan.edit', $k->id) }}"
                                       class="bg-yellow-500 text-white font-semibold px-3 py-2 rounded text-center w-full sm:w-auto flex items-center justify-center">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.karyawan.destroy', $k->id) }}" method="POST"
                                          onsubmit="return confirm('Hapus data ini?')" class="w-full sm:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button class="bg-red-600 text-white font-semibold px-3 py-2 rounded w-full sm:w-auto">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
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
</div>
@endsection
