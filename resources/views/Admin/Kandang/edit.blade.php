@extends('Layout.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

        {{-- HEADER ORANGE --}}
        <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white">
                        Edit Kandang
                    </h1>
                    <p class="text-orange-100 mt-1 text-sm">
                        Perbarui informasi kandang yang sudah ada
                    </p>
                </div>

                <a href="{{ route('admin.kandang.index') }}"
                    class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30
                      text-white px-5 py-2.5 rounded-xl transition">
                    ← Kembali
                </a>
            </div>
        </div>

        {{-- CARD FORM --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8">

            <form action="{{ route('admin.kandang.update', $kandang->id) }}" method="POST" class="space-y-6">

                @csrf
                @method('PUT')

                {{-- Nama Kandang --}}
                <div>
                    <label for="nama_kandang" class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Kandang <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </span>
                        <input type="text" name="nama_kandang" id="nama_kandang" required
                            value="{{ old('nama_kandang', $kandang->nama_kandang) }}"
                            placeholder="Contoh: Kandang A1, Kandang Utara, dll."
                            class="w-full pl-12 pr-4 py-3 border border-gray-300 rounded-xl
                               focus:ring-2 focus:ring-orange-500 focus:border-orange-500
                               @error('nama_kandang') border-red-500 @enderror">
                    </div>
                    @error('nama_kandang')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-1">
                        Gunakan nama yang mudah diingat dan mencerminkan lokasi atau fungsi kandang
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
                                {{ old('status', $kandang->status) == 'aktif' ? 'checked' : '' }}
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
                                            <span class="text-xs text-gray-500">Kandang siap digunakan</span>
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

                        {{-- Nonaktif --}}
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="status" value="nonaktif"
                                {{ old('status', $kandang->status) == 'nonaktif' ? 'checked' : '' }}
                                class="peer sr-only">
                            <div class="p-5 border-2 rounded-xl transition-all duration-200
                                peer-checked:border-gray-500 peer-checked:bg-gray-50
                                hover:border-gray-300 hover:shadow-md
                                border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center gap-3">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 peer-checked:bg-gray-200
                                            flex items-center justify-center transition-colors">
                                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="font-semibold text-gray-800 block">Nonaktif</span>
                                            <span class="text-xs text-gray-500">Kandang tidak digunakan</span>
                                        </div>
                                    </div>
                                    <div class="w-5 h-5 rounded-full border-2 border-gray-300
                                        peer-checked:border-gray-500 peer-checked:bg-gray-500
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

                {{-- Warning Box untuk perubahan status --}}
                <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-yellow-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div class="text-sm text-yellow-800">
                            <p class="font-semibold mb-1">Peringatan:</p>
                            <p class="text-yellow-700">
                                Mengubah status kandang menjadi "Nonaktif" akan mempengaruhi ketersediaan kandang dalam sistem. Pastikan tidak ada aktivitas yang sedang berjalan di kandang ini.
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
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Update Kandang
                    </button>

                    <a href="{{ route('admin.kandang.index') }}"
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
@endsection
