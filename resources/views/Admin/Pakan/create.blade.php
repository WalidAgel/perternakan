@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Tambah Pakan Baru
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Isi formulir di bawah untuk menambahkan jenis pakan baru ke sistem
                    </p>
                </div>

                <a href="{{ route('admin.pakan.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- CARD FORM --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

            <form action="{{ route('admin.pakan.store') }}" method="POST" class="space-y-6">

                @csrf

                {{-- Nama Pakan --}}
                <div>
                    <label for="nama_pakan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Pakan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </span>
                        <input type="text" name="nama_pakan" id="nama_pakan" required
                            value="{{ old('nama_pakan') }}"
                            placeholder="Contoh: BR-1, Konsentrat 511, dll."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('nama_pakan') border-red-500 @enderror">
                    </div>
                    @error('nama_pakan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Harga per Kg --}}
                <div>
                    <label for="harga_pakan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Harga per Kg <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                        <input type="text" name="harga_pakan" id="harga_pakan" required inputmode="numeric"
                            placeholder="0"
                            value="{{ old('harga_pakan') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('harga_pakan') border-red-500 @enderror">
                    </div>
                    @error('harga_pakan')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Masukkan harga per kilogram pakan
                    </p>
                </div>

                {{-- Stok Awal --}}
                <div>
                    <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                        Stok Awal (Kg) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </span>
                        <input type="text" name="stok" id="stok" required inputmode="decimal"
                            placeholder="0"
                            value="{{ old('stok', '0') }}"
                            class="w-full pl-12 pr-20 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('stok') border-red-500 @enderror">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Kg</span>
                    </div>
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Masukkan jumlah stok awal pakan dalam kilogram (bisa desimal)
                    </p>
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
                                <li>Stok pakan dapat menggunakan angka desimal (contoh: 25.5 kg)</li>
                                <li>Harga akan tersimpan per kilogram untuk memudahkan perhitungan</li>
                                <li>Stok akan bertambah saat ada pembelian dan berkurang saat digunakan</li>
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
                        Simpan Pakan
                    </button>

                    <a href="{{ route('admin.pakan.index') }}"
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
            // Format Harga Pakan
            const hargaInput = document.getElementById('harga_pakan');
            const MAX_HARGA = 1000000000; // 1 Miliar

            hargaInput.addEventListener('input', function() {
                let raw = this.value.replace(/[^0-9]/g, '');

                if (!raw) {
                    this.value = '';
                    return;
                }

                let number = parseInt(raw, 10);

                if (number > MAX_HARGA) {
                    number = MAX_HARGA;
                }

                this.value = new Intl.NumberFormat('id-ID').format(number);
            });

            // Format Stok (support decimal)
            const stokInput = document.getElementById('stok');

            stokInput.addEventListener('input', function() {
                // Allow numbers and one decimal point
                let value = this.value.replace(/[^0-9.]/g, '');

                // Prevent multiple decimal points
                const parts = value.split('.');
                if (parts.length > 2) {
                    value = parts[0] + '.' + parts.slice(1).join('');
                }

                // Limit decimal places to 2
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }

                this.value = value;
            });

            // Before submit, convert harga to raw number
            document.querySelector('form').addEventListener('submit', function() {
                hargaInput.value = hargaInput.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
