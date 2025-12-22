@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Tambah Penggunaan Pakan
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Catat penggunaan pakan harian per kandang untuk monitoring konsumsi
                    </p>
                </div>

                <a href="{{ route('admin.penggunaan-pakan.index') }}"
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

            <form action="{{ route('admin.penggunaan-pakan.store') }}" method="POST" class="space-y-6">

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

                    {{-- Pakan --}}
                    <div>
                        <label for="pakan_id" class="block text-sm font-semibold text-gray-700 mb-2">
                            Pakan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </span>
                            <select name="pakan_id" id="pakan_id" required
                                class="w-full pl-12 pr-10 py-3 border border-gray-300 rounded-xl appearance-none bg-white
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('pakan_id') border-red-500 @enderror">
                                <option value="">-- Pilih Pakan --</option>
                                @foreach ($pakans as $pakan)
                                    <option value="{{ $pakan->id }}" {{ old('pakan_id') == $pakan->id ? 'selected' : '' }}>
                                        {{ $pakan->nama_pakan }} (Stok: {{ number_format($pakan->stok, 2) }} Kg)
                                    </option>
                                @endforeach
                            </select>
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </span>
                        </div>
                        @error('pakan_id')
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
                                @foreach ($karyawans as $karyawan)
                                    <option value="{{ $karyawan->id }}" {{ old('karyawans_id') == $karyawan->id ? 'selected' : '' }}>
                                        {{ $karyawan->nama }}
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

                    {{-- Tanggal --}}
                    <div>
                        <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                            Tanggal <span class="text-red-500">*</span>
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

                    {{-- Jumlah --}}
                    <div>
                        <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                            Jumlah (Kg) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"/>
                                </svg>
                            </span>
                            <input type="text" name="jumlah" id="jumlah" required inputmode="decimal"
                                placeholder="0"
                                value="{{ old('jumlah') }}"
                                class="w-full pl-12 pr-16 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                                   @error('jumlah') border-red-500 @enderror">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Kg</span>
                        </div>
                        @error('jumlah')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Bisa menggunakan angka desimal (contoh: 25.5)</p>
                    </div>

                </div>

                {{-- Keterangan --}}
                <div>
                    <label for="keterangan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Keterangan / Catatan
                    </label>
                    <textarea name="keterangan" id="keterangan" rows="4"
                        placeholder="Tulis keterangan tambahan seperti waktu pemberian, kondisi ayam, atau catatan lainnya (opsional)..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                    @error('keterangan')
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
                                <li>Penggunaan pakan akan otomatis mengurangi stok pakan yang dipilih</li>
                                <li>Pastikan stok pakan mencukupi sebelum mencatat penggunaan</li>
                                <li>Data ini digunakan untuk monitoring konsumsi pakan per kandang</li>
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
                        Simpan Penggunaan
                    </button>

                    <a href="{{ route('admin.penggunaan-pakan.index') }}"
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
            const jumlahInput = document.getElementById('jumlah');

            // Format jumlah (support decimal)
            jumlahInput.addEventListener('input', function() {
                let value = this.value.replace(/[^0-9.]/g, '');
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                this.value = value;
            });
        });
    </script>
@endsection
