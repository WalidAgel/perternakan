@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Penggunaan Pakan</h1>
    </div>

    @if($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.penggunaan-pakan.update', $penggunaanPakan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kandang</label>
                    <select name="kandang_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('kandang_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Kandang --</option>
                        @foreach ($kandangs as $kandang)
                        <option value="{{ $kandang->id }}" {{ old('kandang_id', $penggunaanPakan->kandang_id) == $kandang->id ? 'selected' : '' }}>
                            {{ $kandang->nama_kandang }}
                        </option>
                        @endforeach
                    </select>
                    @error('kandang_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pakan</label>
                    <select name="pakan_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('pakan_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Pakan --</option>
                        @foreach ($pakans as $pakan)
                        <option value="{{ $pakan->id }}" {{ old('pakan_id', $penggunaanPakan->pakan_id) == $pakan->id ? 'selected' : '' }}>
                            {{ $pakan->nama_pakan }} (Stok: {{ number_format($pakan->stok, 2) }} Kg)
                        </option>
                        @endforeach
                    </select>
                    @error('pakan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Karyawan</label>
                    <select name="karyawans_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('karyawans_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ old('karyawans_id', $penggunaanPakan->karyawans_id) == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('karyawans_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $penggunaanPakan->tanggal->format('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah (Kg)</label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', $penggunaanPakan->jumlah) }}" step="0.01" min="0.01"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('jumlah') border-red-500 @enderror"
                        required>
                    @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300">{{ old('keterangan', $penggunaanPakan->keterangan) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Update
                </button>
                <a href="{{ route('admin.penggunaan-pakan.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
