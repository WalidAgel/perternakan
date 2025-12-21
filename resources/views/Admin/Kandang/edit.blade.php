@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Kandang</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.kandang.update', $kandang->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kandang</label>
                <input type="text" name="nama_kandang" value="{{ old('nama_kandang', $kandang->nama_kandang) }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('nama_kandang') border-red-500 @enderror"
                    required>
                @error('nama_kandang')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status"
                    class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
                    <option value="aktif" {{ old('status', $kandang->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status', $kandang->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Update
                </button>
                <a href="{{ route('admin.kandang.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
