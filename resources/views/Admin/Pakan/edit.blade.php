@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pakan</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.pakan.update', $pakan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pakan</label>
                <input type="text" name="nama_pakan" value="{{ old('nama_pakan', $pakan->nama_pakan) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('nama_pakan') border-red-500 @enderror"
                    required>
                @error('nama_pakan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga per Kg</label>
                <input type="number" name="harga_pakan" value="{{ old('harga_pakan', $pakan->harga_pakan) }}" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('harga_pakan') border-red-500 @enderror"
                    required>
                @error('harga_pakan')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Stok (Kg)</label>
                <input type="number" name="stok" value="{{ old('stok', $pakan->stok) }}" step="0.01" min="0"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('stok') border-red-500 @enderror"
                    required>
                @error('stok')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Update
                </button>
                <a href="{{ route('admin.pakan.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
