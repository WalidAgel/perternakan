@extends('Layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-purple-50 py-12 px-4">
    <div class="max-w-3xl mx-auto">

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden mb-6">
            <div class="bg-orange-600 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-white mb-1">Tambah Kategori Baru</h1>
                        <p class="text-orange-100 text-sm">Isi formulir di bawah untuk menambahkan kategori pengeluaran</p>
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
            <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-8">
                @csrf

                <div class="space-y-6">
                    @include('admin.kategori.form')
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-6 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 sm:flex-none px-8 py-3 bg-orange-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition duration-200 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan Kategori
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

        <!-- Info Card -->
        <div class="mt-6 bg-orange-50 border border-orange-200 rounded-xl p-4 flex items-start gap-3">
            <svg class="w-5 h-5 text-orange-600 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
            </svg>
            <div class="text-sm text-orange-800">
                <p class="font-semibold mb-1">Tips:</p>
                <p>Gunakan nama kategori yang jelas dan deskripsi yang informatif untuk memudahkan pengelolaan pengeluaran.</p>
            </div>
        </div>

    </div>
</div>
@endsection
