@extends('Layout.app')

@section('content')

<h1 class="text-3xl font-bold mb-6 text-gray-800">Edit Produksi Telur</h1>

<div class="bg-white shadow rounded-xl p-6">

<form action="{{ route('admin.produksi.update', $data->id) }}" method="POST" class="space-y-5">
    @csrf
    @method('PUT')

    <div>
        <label class="text-sm font-semibold">Karyawan</label>
        <select name="karyawans_id"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring focus:ring-blue-200">
            @foreach ($karyawans as $k)
                <option value="{{ $k->id }}" {{ $k->id == $data->karyawans_id ? 'selected' : '' }}>
                    {{ $k->nama }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="text-sm font-semibold">Tanggal</label>
        <input type="date" name="tanggal" value="{{ $data->tanggal }}"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="text-sm font-semibold">Jumlah Telur</label>
        <input type="number" name="jumlah" value="{{ $data->jumlah }}"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="text-sm font-semibold">Kualitas</label>
        <input type="text" name="kualitas" value="{{ $data->kualitas }}"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">
    </div>

    <div>
        <label class="text-sm font-semibold">Keterangan</label>
        <textarea name="keterangan"
            class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring focus:ring-blue-200">{{ $data->keterangan }}</textarea>
    </div>

    <button class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg shadow">
        Update
    </button>
</form>

</div>

@endsection
