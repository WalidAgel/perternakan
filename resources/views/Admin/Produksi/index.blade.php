@extends('Layout.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Produksi Telur</h1>

    <a href="{{ route('admin.produksi.create') }}"
        class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
        + Tambah Produksi
    </a>
</div>

{{-- FILTER CARD --}}
<div class="bg-white shadow rounded-xl p-5 mb-6">
    <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">

        <div>
            <label class="text-sm font-semibold">Tanggal</label>
            <input type="date" name="tanggal"
                class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="text-sm font-semibold">Karyawan</label>
            <select name="karyawan_id"
                class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring focus:ring-blue-200">
                <option value="">-- Pilih Karyawan --</option>
                @foreach ($karyawans as $k)
                    <option value="{{ $k->id }}">{{ $k->nama }}</option>
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
                <th class="p-3 text-left">Karyawan</th>
                <th class="p-3 text-left">Jumlah</th>
                <th class="p-3 text-left">Kualitas</th>
                <th class="p-3 text-left">Keterangan</th>
                <th class="p-3 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="text-gray-800">
            @foreach ($produksi as $p)
            <tr class="border-b hover:bg-gray-50">
                <td class="p-3">{{ $p->tanggal }}</td>
                <td class="p-3">{{ $p->karyawan->nama }}</td>
                <td class="p-3">{{ $p->jumlah }}</td>
                <td class="p-3">{{ $p->kualitas }}</td>
                <td class="p-3">{{ $p->keterangan }}</td>

                <td class="p-3 text-center">
                    <a href="{{ route('admin.produksi.edit', $p->id) }}"
                        class="text-blue-600 hover:underline font-medium">Edit</a>

                    <form action="{{ route('admin.produksi.destroy', $p->id) }}"
                        method="POST" class="inline ml-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600 hover:underline font-medium">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>

@endsection
