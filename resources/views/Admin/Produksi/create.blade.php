@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Tambah Produksi Telur
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Input data produksi telur harian per kandang untuk monitoring produktivitas
                    </p>
                </div>

                <a href="{{ route('admin.produksi.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- ERROR ALERT --}}
        @if($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 rounded-xl p-4 mb-6">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div class="flex-1">
                    <p class="font-semibold text-red-800 mb-2">Terdapat kesalahan:</p>
                    <ul class="list-disc list-inside space-y-1 text-red-700 text-sm">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- CARD FORM --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

            <form action="{{ route('admin.produksi.store') }}" method="POST" class="space-y-6">

                @csrf

                {{-- Grid 2 Kolom --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

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
                                class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl appearance-none bg-white
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('kandang_id') border-red-500 @enderror">
                                <option value="">-- Pilih Kandang --</option>
                                @foreach ($kandangs as $k)
                                    <option value="{{ $k->id }}" {{ old('kandang_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kandang }}
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

                    {{-- Karyawan --}}
                    <div>
                        <label for="karyawans_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Karyawan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </span>
                            <select name="karyawans_id" id="karyawans_id" required
                                class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl appearance-none bg-white
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('karyawans_id') border-red-500 @enderror">
                                <option value="">-- Pilih Karyawan --</option>
                                @foreach ($karyawans as $k)
                                    <option value="{{ $k->id }}" {{ old('karyawans_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </div>
                        @error('karyawans_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Tanggal Produksi --}}
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal Produksi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </span>
                            <input type="date" name="tanggal" id="tanggal" required
                                value="{{ old('tanggal', date('Y-m-d')) }}"
                                max="{{ date('Y-m-d') }}"
                                class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('tanggal') border-red-500 @enderror">
                        </div>
                        @error('tanggal')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Total Produksi (Display) --}}
                    <div>
                        <label for="total_produksi" class="block text-sm font-semibold text-gray-700 mb-2">
                            Total Produksi
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </span>
                            <input type="text" id="total_produksi" readonly
                                placeholder="0 butir"
                                class="w-full pl-12 pr-16 py-3 border-2 border-blue-300 rounded-xl bg-blue-50
                                   text-blue-800 font-bold text-lg cursor-not-allowed">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-blue-600 font-medium">Butir</span>
                        </div>
                        <p class="text-gray-500 text-xs mt-1">Otomatis dihitung: Telur Bagus + Telur Rusak</p>
                    </div>

                    {{-- Jumlah Telur Bagus --}}
                    <div>
                        <label for="jumlah_bagus" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Telur Bagus (butir) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-green-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input type="number" name="jumlah_bagus" id="jumlah_bagus" required min="0" step="1"
                                placeholder="0"
                                value="{{ old('jumlah_bagus', 0) }}"
                                class="w-full pl-12 pr-16 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('jumlah_bagus') border-red-500 @enderror">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Butir</span>
                        </div>
                        @error('jumlah_bagus')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Jumlah Telur Rusak --}}
                    <div>
                        <label for="jumlah_rusak" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah Telur Rusak (butir) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-red-500">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </span>
                            <input type="number" name="jumlah_rusak" id="jumlah_rusak" required min="0" step="1"
                                placeholder="0"
                                value="{{ old('jumlah_rusak', 0) }}"
                                class="w-full pl-12 pr-16 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('jumlah_rusak') border-red-500 @enderror">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Butir</span>
                        </div>
                        @error('jumlah_rusak')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Catatan --}}
                <div>
                    <label for="catatan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Catatan
                    </label>
                    <textarea name="catatan" id="catatan" rows="4"
                        placeholder="Tulis catatan tambahan seperti kondisi telur, kendala produksi, atau informasi lainnya (opsional)..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('catatan') border-red-500 @enderror">{{ old('catatan') }}</textarea>
                    @error('catatan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                                <li>Total produksi dihitung otomatis dari jumlah telur bagus dan rusak</li>
                                <li>Data produksi digunakan untuk monitoring performa kandang</li>
                                <li>Pastikan data yang diinput sesuai dengan kondisi aktual di lapangan</li>
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
                        Simpan Produksi
                    </button>

                    <a href="{{ route('admin.produksi.index') }}"
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
            const jumlahBagusInput = document.getElementById('jumlah_bagus');
            const jumlahRusakInput = document.getElementById('jumlah_rusak');
            const totalProduksi = document.getElementById('total_produksi');

            function calculateTotal() {
                const bagus = parseInt(jumlahBagusInput.value) || 0;
                const rusak = parseInt(jumlahRusakInput.value) || 0;
                const total = bagus + rusak;

                totalProduksi.value = total + ' butir';
            }

            jumlahBagusInput.addEventListener('input', calculateTotal);
            jumlahRusakInput.addEventListener('input', calculateTotal);

            // Calculate on page load
            calculateTotal();
        });
    </script>
@endsection
