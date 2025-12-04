@extends('Layout.app')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">Tambah Produksi Telur</h1>

<div class="bg-white shadow rounded-xl p-6">

<form action="{{ route('admin.produksi.store') }}" method="POST" class="space-y-5">
    @csrf

    <div>
        <label class="text-sm font-semibold">Karyawan</label>
        <select name="karyawans_id"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring focus:ring-blue-200">
            @foreach ($karyawans as $k)
                <option value="{{ $k->id }}">{{ $k->nama }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="text-sm font-semibold">Tanggal</label>
        <input type="date" name="tanggal"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="text-sm font-semibold">Jumlah Telur</label>
        <input type="number" name="jumlah"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="text-sm font-semibold">Kualitas</label>
        <input type="text" name="kualitas"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"
            placeholder="Contoh: Baik / Retak / Rusak">
    </div>

    <div>
        <label class="text-sm font-semibold">Keterangan</label>
        <textarea name="keterangan"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200"></textarea>
    </div>

    <button class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg shadow">
        Simpan
    </button>
</form>

</div>

@endsection
