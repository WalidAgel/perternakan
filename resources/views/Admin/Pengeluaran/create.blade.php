@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Tambah Pengeluaran Baru
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Isi formulir di bawah untuk mencatat pengeluaran operasional
                    </p>
                </div>

                <a href="{{ route('admin.pengeluaran.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- CARD FORM --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

            <form id="form-pengeluaran" action="{{ route('admin.pengeluaran.store') }}" method="POST" class="space-y-6">

                @csrf

                {{-- Kategori --}}
                <div>
                    <label for="kategoris_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kategori Pengeluaran <span class="text-red-500">*</span>
                    </label>
                    <select name="kategoris_id" id="kategoris_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('kategoris_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategori as $item)
                            <option value="{{ $item->id }}" {{ old('kategoris_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategoris_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Karyawan --}}
                <div>
                    <label for="karyawans_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Karyawan <span class="text-red-500">*</span>
                    </label>
                    <select name="karyawans_id" id="karyawans_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('karyawans_id') border-red-500 @enderror">
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawan as $item)
                            <option value="{{ $item->id }}" {{ old('karyawans_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('karyawans_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Kandang --}}
                <div>
                    <label for="kandang_id" class="block text-sm font-semibold text-gray-700 mb-2">
                        Kandang (Opsional)
                    </label>
                    <select name="kandang_id" id="kandang_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('kandang_id') border-red-500 @enderror">
                        <option value="">-- Pilih Kandang (opsional) --</option>
                        @foreach ($kandangs as $item)
                            <option value="{{ $item->id }}" {{ old('kandang_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->nama_kandang }}
                            </option>
                        @endforeach
                    </select>
                    @error('kandang_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tanggal --}}
                <div>
                    <label for="tanggal" class="block text-sm font-semibold text-gray-700 mb-2">
                        Tanggal <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal" id="tanggal" required
                        value="{{ old('tanggal', date('Y-m-d')) }}" max="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
               @error('tanggal') border-red-500 @enderror">

                    @error('tanggal')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Jumlah --}}
                {{-- Jumlah --}}
                <div>
                    <label for="jumlah" class="block text-sm font-semibold text-gray-700 mb-2">
                        Jumlah (Rp) <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-medium">Rp</span>
                        <input type="text" name="jumlah" id="jumlah" required inputmode="numeric" placeholder="0"
                            value="{{ old('jumlah') }}"
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                   focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                   @error('jumlah') border-red-500 @enderror">
                    </div>

                    @error('jumlah')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                    <p class="text-gray-500 text-xs mt-1">
                        Maksimal Rp 1.000.000.000
                    </p>
                </div>


                {{-- Deskripsi --}}
                <div>
                    <label for="deskripsi" class="block text-sm font-semibold text-gray-700 mb-2">
                        Deskripsi / Keterangan
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="4" placeholder="Tulis keterangan detail pengeluaran (opsional)..."
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                           @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
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
                        Simpan Pengeluaran
                    </button>

                    <a href="{{ route('admin.pengeluaran.index') }}"
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
            const MAX = 1000000000; // 1 Miliar

            jumlahInput.addEventListener('input', function() {
                let raw = this.value.replace(/[^0-9]/g, '');

                if (!raw) {
                    this.value = '';
                    return;
                }

                let number = parseInt(raw, 10);

                if (number > MAX) {
                    number = MAX;
                }

                this.value = new Intl.NumberFormat('id-ID').format(number);
            });

            document.querySelector('form').addEventListener('submit', function() {
                jumlahInput.value = jumlahInput.value.replace(/[^0-9]/g, '');
            });
        });
    </script>
@endsection
