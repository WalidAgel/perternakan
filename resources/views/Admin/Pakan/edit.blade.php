@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Edit Pakan
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Perbarui informasi pakan yang sudah ada
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

            <form action="{{ route('admin.pakan.update', $pakan->id) }}" method="POST" class="space-y-6">

                @csrf
                @method('PUT')

                {{-- Nama Pakan --}}
                <div>
                    <label for="nama_pakan" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Pakan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        <input type="text" name="nama_pakan" id="nama_pakan" required
                            value="{{ old('nama_pakan', $pakan->nama_pakan) }}"
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
                            placeholder="0" value="{{ old('harga_pakan', $pakan->harga_pakan) }}"
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

                {{-- Stok --}}
                <div>
                    <label for="stok" class="block text-sm font-semibold text-gray-700 mb-2">
                        Stok (Kg) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </span>
                        <input type="text" name="stok" id="stok" required inputmode="decimal" placeholder="0"
                            value="{{ old('stok', $pakan->stok) }}"
                            class="w-full pl-12 pr-20 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('stok') border-red-500 @enderror">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Kg</span>
                    </div>
                    @error('stok')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Masukkan jumlah stok pakan dalam kilogram (bisa desimal)
                    </p>
                </div>

                {{-- Warning Box --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        <div class="text-sm text-yellow-800">
                            <p class="font-semibold mb-1">Peringatan:</p>
                            <p class="text-yellow-700">
                                Perubahan harga atau stok pakan akan mempengaruhi perhitungan pembelian dan penggunaan pakan
                                selanjutnya.
                            </p>
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Update Pakan
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
            const jumlahInput = document.getElementById('jumlah');
            const hargaSatuanInput = document.getElementById('harga_satuan');
            const totalDisplay = document.getElementById('total_harga_display');

            // Format harga satuan dengan ribuan - FORMAT NILAI AWAL
            function formatInitialHarga() {
                let raw = hargaSatuanInput.value.replace(/[^0-9]/g, '');
                if (raw) {
                    let number = parseInt(raw, 10);
                    hargaSatuanInput.value = new Intl.NumberFormat('id-ID').format(number);
                }
            }

            // Format nilai awal saat halaman dimuat
            formatInitialHarga();

            // Format jumlah awal (jika ada)
            if (jumlahInput.value) {
                let value = jumlahInput.value.replace(/[^0-9.]/g, '');
                const parts = value.split('.');
                if (parts.length === 2 && parts[1].length > 2) {
                    value = parts[0] + '.' + parts[1].substring(0, 2);
                }
                jumlahInput.value = value;
            }

            // Hitung total awal
            calculateTotal();

            // Event handler untuk harga satuan
            hargaSatuanInput.addEventListener('input', function() {
                let raw = this.value.replace(/[^0-9]/g, '');
                if (!raw) {
                    this.value = '';
                    calculateTotal();
                    return;
                }
                let number = parseInt(raw, 10);
                this.value = new Intl.NumberFormat('id-ID').format(number);
                calculateTotal();
            });

            // Event handler untuk jumlah (support decimal)
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
                calculateTotal();
            });

            // Hitung total
            function calculateTotal() {
                const jumlah = parseFloat(jumlahInput.value) || 0;
                const hargaRaw = hargaSatuanInput.value.replace(/[^0-9]/g, '');
                const harga = parseInt(hargaRaw, 10) || 0;
                const total = jumlah * harga;

                if (total > 0) {
                    totalDisplay.value = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
                } else {
                    totalDisplay.value = 'Rp 0';
                }
            }

            // Before submit, convert formatted values to raw numbers
            document.querySelector('form').addEventListener('submit', function() {
                hargaSatuanInput.value = hargaSatuanInput.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
