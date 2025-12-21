@extends('Layout.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="bg-gradient-to-r from-orange-600 to-orange-700 rounded-2xl px-8 py-8 mb-10 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 text-white">
            <div>
                <h1 class="text-3xl font-bold mb-1">Tambah Produksi Telur</h1>
                <p class="text-orange-100 text-sm">
                    Input data produksi telur harian secara akurat
                </p>
            </div>
            <a href="{{ route('admin.produksi.index') }}"
               class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      px-5 py-2.5 rounded-xl transition">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- FORM CARD --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">

        {{-- FORM HEADER --}}
        <div class="px-8 py-6 border-b bg-gray-50">
            <h3 class="text-xl font-semibold text-gray-800">Form Input Produksi</h3>
            <p class="text-sm text-gray-500 mt-1">
                Lengkapi semua field yang bertanda wajib
            </p>
        </div>

        {{-- FORM BODY --}}
        <form action="{{ route('admin.produksi.store') }}" method="POST" class="p-8">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- KARYAWAN --}}
                <div class="lg:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Karyawan <span class="text-red-500">*</span>
                    </label>
                    <select name="karyawans_id" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                        <option value="" disabled selected>-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $k)
                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- TANGGAL --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Produksi <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                </div>

                {{-- JUMLAH --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah Telur (kg) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="jumlah" min="0" required
                        placeholder="Contoh: 120"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                </div>

                {{-- KUALITAS --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Kualitas <span class="text-red-500">*</span>
                    </label>
                    <select name="kualitas" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent transition">
                        <option value="" disabled selected>-- Pilih Kualitas --</option>
                        <option value="Baik">Baik</option>
                        <option value="Retak">Retak</option>
                        <option value="Rusak">Rusak</option>
                    </select>
                </div>

                {{-- KETERANGAN --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Keterangan (Opsional)
                    </label>
                    <textarea name="keterangan" rows="4"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-transparent transition resize-none"
                        placeholder="Tambahkan catatan tambahan..."></textarea>
                </div>
            </div>

            {{-- ACTION --}}
            <div class="mt-10 pt-6 border-t flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-sm text-gray-500">
                    <span class="text-red-500">*</span> wajib diisi
                </p>

                <div class="flex gap-3">
                    <button type="reset"
                        class="px-6 py-3 bg-gray-100 hover:bg-gray-200
                               text-gray-700 rounded-xl transition">
                        Reset
                    </button>
                    <button type="submit"
                        class="inline-flex items-center gap-2 px-8 py-3
                               bg-gradient-to-r from-orange-600 to-orange-700
                               hover:from-orange-700 hover:to-orange-800
                               text-white font-semibold rounded-xl shadow
                               focus:ring-4 focus:ring-orange-300 transition active:scale-95">
                        ✓ Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- INFO --}}
    <div class="mt-6 bg-orange-50 border border-orange-200 rounded-xl p-5">
        <h4 class="font-semibold text-orange-900 mb-2">Tips Pengisian</h4>
        <ul class="text-sm text-orange-800 space-y-1">
            <li>• Pilih karyawan sesuai petugas produksi</li>
            <li>• Input jumlah telur berdasarkan hasil aktual</li>
            <li>• Gunakan kualitas untuk memudahkan inventori</li>
        </ul>
    </div>

</div>
@endsection
