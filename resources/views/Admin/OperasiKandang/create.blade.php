@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Tambah Operasi Kandang
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Mulai siklus produksi baru dengan mengisi informasi kandang dan jumlah ayam
                    </p>
                </div>

                <a href="{{ route('admin.operasi-kandang.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- CARD FORM --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

            <form action="{{ route('admin.operasi-kandang.store') }}" method="POST" class="space-y-6">

                @csrf

                {{-- Kandang --}}
                <div>
                    <label for="kandang_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kandang <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </span>
                        <select name="kandang_id" id="kandang_id" required
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl appearance-none bg-white
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('kandang_id') border-red-500 @enderror">
                            <option value="">-- Pilih Kandang --</option>
                            @foreach ($kandangs as $kandang)
                                <option value="{{ $kandang->id }}" {{ old('kandang_id') == $kandang->id ? 'selected' : '' }}>
                                    {{ $kandang->nama_kandang }}
                                </option>
                            @endforeach
                        </select>
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </span>
                    </div>
                    @error('kandang_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah Ayam --}}
                <div>
                    <label for="jumlah_ayam" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah Ayam <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </span>
                        <input type="number" name="jumlah_ayam" id="jumlah_ayam" required min="1" step="1"
                            placeholder="0"
                            value="{{ old('jumlah_ayam') }}"
                            class="w-full pl-12 pr-20 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('jumlah_ayam') border-red-500 @enderror">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Ekor</span>
                    </div>
                    @error('jumlah_ayam')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Masukkan jumlah ayam yang akan dipelihara di kandang ini
                    </p>
                </div>

                {{-- Tanggal Mulai Produksi --}}
                <div>
                    <label for="tanggal_mulai_produksi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal Mulai Produksi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="date" name="tanggal_mulai_produksi" id="tanggal_mulai_produksi" required
                            value="{{ old('tanggal_mulai_produksi', date('Y-m-d')) }}"
                            max="{{ date('Y-m-d') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('tanggal_mulai_produksi') border-red-500 @enderror">
                    </div>
                    @error('tanggal_mulai_produksi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Tanggal saat ayam mulai dipelihara di kandang
                    </p>
                </div>

                {{-- Status --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Status <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- Aktif --}}
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="status" value="aktif"
                                {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}
                                class="peer sr-only">
                            <div class="p-5 border-2 rounded-xl transition-all duration-200
                                peer-checked:border-green-500 peer-checked:bg-green-50
                                hover:border-gray-300 hover:shadow-md
                                border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-green-100 peer-checked:bg-green-200
                                            flex items-center justify-center transition-colors">
                                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-800 block">Aktif</span>
                                            <span class="text-xs text-gray-500">Operasi sedang berjalan</span>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300
                                        peer-checked:border-green-500 peer-checked:bg-green-500
                                        flex items-center justify-center transition-all">
                                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Selesai --}}
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="status" value="selesai"
                                {{ old('status') == 'selesai' ? 'checked' : '' }}
                                class="peer sr-only">
                            <div class="p-5 border-2 rounded-xl transition-all duration-200
                                peer-checked:border-blue-500 peer-checked:bg-blue-50
                                hover:border-gray-300 hover:shadow-md
                                border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-blue-100 peer-checked:bg-blue-200
                                            flex items-center justify-center transition-colors">
                                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-800 block">Selesai</span>
                                            <span class="text-xs text-gray-500">Operasi telah berakhir</span>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300
                                        peer-checked:border-blue-500 peer-checked:bg-blue-500
                                        flex items-center justify-center transition-all">
                                        <svg class="w-3 h-3 text-white opacity-0 peer-checked:opacity-100" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </label>

                    </div>
                </div>

                {{-- Info Box --}}
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm text-blue-800">
                            <p class="font-semibold mb-1">Informasi:</p>
                            <ul class="list-disc list-inside space-y-1 text-blue-700">
                                <li>Pilih status "Aktif" untuk operasi yang sedang berjalan</li>
                                <li>Status "Selesai" digunakan untuk operasi yang sudah berakhir</li>
                                <li>Pastikan kandang yang dipilih dalam kondisi aktif dan siap digunakan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- DIVIDER --}}
                <div class="border-t pt-6 flex flex-col sm:flex-row gap-3">

                    <button type="submit"
                        class="inline-flex items-center justify-center gap-2
                           bg-orange-500 hover:bg-orange-600
                           text-white font-semibold px-6 py-3 rounded-xl
                           shadow-lg hover:shadow-xl active:scale-95 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Operasi
                    </button>

                    <a href="{{ route('admin.operasi-kandang.index') }}"
                        class="inline-flex items-center justify-center gap-2
                          bg-gray-100 hover:bg-gray-200
                          text-gray-700 font-medium px-6 py-3 rounded-xl transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                            </path>
                        </svg>
                        Batal
                    </a>

                </div>
            </form>

        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const jumlahAyamInput = document.getElementById('jumlah_ayam');

            // Ensure only integer input - remove decimal points
            jumlahAyamInput.addEventListener('input', function() {
                // Remove any non-digit characters
                this.value = this.value.replace(/[^0-9]/g, '');
            });

            // Final validation before submit
            form.addEventListener('submit', function(e) {
                const value = jumlahAyamInput.value;

                // Check if value is empty or not a valid integer
                if (!value || isNaN(parseInt(value)) || parseInt(value) < 1) {
                    e.preventDefault();
                    alert('Jumlah ayam harus berupa angka bulat positif');
                    jumlahAyamInput.focus();
                    return false;
                }

                // Ensure the value is a clean integer
                jumlahAyamInput.value = parseInt(value);
            });
        });
    </script>
@endsection
