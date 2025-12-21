@extends('Layout.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">

    {{-- HEADER --}}
    <div class="bg-orange-500 rounded-2xl px-6 py-8 mb-8 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-white">
                    Edit Pengeluaran
                </h1>
                <p class="text-orange-100 mt-1 text-sm">
                    Perbarui data pengeluaran dengan informasi terbaru
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

        <form action="{{ route('admin.pengeluaran.update', $pengeluaran->id) }}"
              method="POST"
              class="space-y-6">
            @csrf
            @method('PUT')

            {{-- FORM INPUT --}}
            @include('Admin.Pengeluaran.form')

            {{-- ACTION --}}
            <div class="border-t pt-6 flex flex-col sm:flex-row gap-3">

                <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           bg-orange-500 hover:bg-orange-600
                           text-white font-semibold px-6 py-3 rounded-xl
                           shadow active:scale-95 transition">
                    ✓ Update Pengeluaran
                </button>

                <a href="{{ route('admin.pengeluaran.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          bg-gray-100 hover:bg-gray-200
                          text-gray-700 font-medium px-6 py-3 rounded-xl transition">
                    ✕ Batal
                </a>

            </div>
        </form>

    </div>

</div>
@endsection
