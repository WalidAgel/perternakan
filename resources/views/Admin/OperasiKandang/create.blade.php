@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Operasi Kandang</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.operasi-kandang.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Kandang</label>
                <select name="kandang_id"
                    class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('kandang_id') border-red-500 @enderror"
                    required>
                    <option value="">-- Pilih Kandang --</option>
                    @foreach ($kandangs as $kandang)
                    <option value="{{ $kandang->id }}" {{ old('kandang_id') == $kandang->id ? 'selected' : '' }}>
                        {{ $kandang->nama_kandang }}
                    </option>
                    @endforeach
                </select>
                @error('kandang_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Ayam</label>
                <input type="number" name="jumlah_ayam" value="{{ old('jumlah_ayam') }}" min="1"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('jumlah_ayam') border-red-500 @enderror"
                    required>
                @error('jumlah_ayam')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Mulai Produksi</label>
                <input type="date" name="tanggal_mulai_produksi" value="{{ old('tanggal_mulai_produksi') }}"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('tanggal_mulai_produksi') border-red-500 @enderror"
                    required>
                @error('tanggal_mulai_produksi')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
                <select name="status"
                    class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Simpan
                </button>
                <a href="{{ route('admin.operasi-kandang.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
