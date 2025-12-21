@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Tambah Produksi Telur</h1>
        <p class="text-gray-600 text-sm mt-1">Input data produksi telur harian per kandang</p>
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
        <form action="{{ route('admin.produksi.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kandang <span class="text-red-500">*</span></label>
                    <select name="kandang_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300"
                        required>
                        <option value="">-- Pilih Kandang --</option>
                        @foreach ($kandangs as $k)
                            <option value="{{ $k->id }}" {{ old('kandang_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama_kandang }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Karyawan <span class="text-red-500">*</span></label>
                    <select name="karyawans_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300"
                        required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $k)
                            <option value="{{ $k->id }}" {{ old('karyawans_id') == $k->id ? 'selected' : '' }}>
                                {{ $k->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Produksi <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Telur Bagus (butir) <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_bagus" value="{{ old('jumlah_bagus', 0) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300"
                        min="0" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah Telur Rusak (butir) <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah_rusak" value="{{ old('jumlah_rusak', 0) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300"
                        min="0" required>
                </div>
            </div>

            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan</label>
                <textarea name="catatan" rows="3"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300"
                    placeholder="Opsional...">{{ old('catatan') }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Simpan
                </button>
                <a href="{{ route('admin.produksi.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
