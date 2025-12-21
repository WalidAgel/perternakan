@extends('Layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-amber-50 via-white to-orange-50 py-12 px-4">
    <div class="max-w-3xl mx-auto">

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-6">
            <div class="bg-orange-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-1">Edit Kategori</h1>
                        <p class="text-amber-100 text-sm">Perbarui informasi kategori pengeluaran</p>
                    </div>
                    <a href="{{ route('admin.kategori.index') }}"
                       class="flex items-center gap-2 px-4 py-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white rounded-lg transition duration-200 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <form action="{{ route('admin.kategori.update', ['kategori' => $kategori->id]) }}" method="POST" class="p-8">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    @include('admin.kategori.form')
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 sm:flex-none px-8 py-3 bg-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                        </svg>
                        Update Kategori
                    </button>

                    <a href="{{ route('admin.kategori.index') }}"
                       class="flex-1 sm:flex-none px-8 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Warning Card -->
        <div class="mt-6 bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-amber-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm text-amber-800">
                <p class="font-semibold mb-1">Perhatian:</p>
                <p>Perubahan pada kategori ini akan mempengaruhi semua data pengeluaran yang terkait dengan kategori ini.</p>
            </div>
        </div>

    </div>
</div>
@endsection
