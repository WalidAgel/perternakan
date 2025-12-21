@extends('Layout.app')

@section('content')

{{-- HEADER HIJAU --}}
<div class="mb-8">
    <div class="bg-green-600 rounded-2xl px-8 py-6 flex items-center justify-between shadow-lg">
        <div>
            <h1 class="text-3xl font-bold text-white">Edit Penjualan</h1>
            <p class="text-green-100 mt-1">
                Perbarui data penjualan telur secara akurat
            </p>
        </div>

        <a href="{{ route('admin.penjualan.index') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5
                  bg-green-500 hover:bg-green-700
                  text-white font-semibold rounded-xl transition">
            ← Kembali
        </a>
    </div>
</div>

{{-- CARD FORM --}}
<div class="bg-white rounded-2xl shadow-lg overflow-hidden">

    {{-- CARD TITLE --}}
    <div class="px-8 py-6 border-b">
        <h2 class="text-2xl font-bold text-gray-800">Form Edit Penjualan</h2>
        <p class="text-gray-500 mt-1">
            Lengkapi semua field yang bertanda wajib
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST"
          action="{{ route('admin.penjualan.update', $penjualan->id) }}"
          class="px-8 py-6 space-y-6">
        @csrf
        @method('PUT')

        {{-- PRODUKSI --}}
        <div>
            <label class="block font-semibold text-gray-700 mb-2">
                Pilih Produksi <span class="text-red-500">*</span>
            </label>
            <select name="produks_id" required
                class="w-full px-4 py-3 rounded-xl border border-gray-300
                       focus:ring-2 focus:ring-green-500 focus:border-green-500">
                <option value="">-- Pilih Produksi --</option>
                @foreach($produksi as $p)
                    <option value="{{ $p->id }}"
                        {{ $p->id == $penjualan->produks_id ? 'selected' : '' }}>
                        Produksi #{{ $p->id }} - {{ $p->tanggal }} ({{ $p->jumlah }} butir)
                    </option>
                @endforeach
            </select>
            @error('produks_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- TANGGAL --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Tanggal Penjualan <span class="text-red-500">*</span>
                </label>
                <input type="date" name="tanggal"
                    value="{{ old('tanggal', $penjualan->tanggal->format('Y-m-d')) }}"
                    required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            {{-- JUMLAH TERJUAL --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Jumlah Terjual (Kg) <span class="text-red-500">*</span>
                </label>
                <input type="number" id="jumlah_terjual" name="jumlah_terjual"
                    value="{{ old('jumlah_terjual', $penjualan->jumlah_terjual) }}"
                    step="0.01" min="0" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            {{-- HARGA --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Harga per Kg <span class="text-red-500">*</span>
                </label>
                <input type="number" id="harga_per_kg" name="harga_per_kg"
                    value="{{ old('harga_per_kg', $penjualan->harga_per_kg) }}"
                    step="0.01" min="0" required
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-green-500 focus:border-green-500">
            </div>

            {{-- TOTAL --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Total Harga
                </label>
                <input type="number" id="total" name="total"
                    value="{{ old('total', $penjualan->total) }}"
                    step="0.01" readonly
                    class="w-full px-4 py-3 rounded-xl bg-gray-100 border border-gray-300">
            </div>
        </div>

        {{-- INFO --}}
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
            <p class="text-sm text-green-800">
                Total harga akan dihitung otomatis berdasarkan harga dan jumlah terjual.
            </p>
        </div>

        {{-- ACTION --}}
        <div class="flex justify-end gap-3 pt-6 border-t">
            <a href="{{ route('admin.penjualan.index') }}"
               class="px-6 py-3 rounded-xl bg-gray-100 hover:bg-gray-200
                      text-gray-700 font-semibold transition">
                Batal
            </a>

            <button type="submit"
                class="px-8 py-3 rounded-xl
                       bg-green-600 hover:bg-green-700
                       text-white font-semibold shadow-lg
                       active:scale-95 transition">
                Update Penjualan
            </button>
        </div>

    </form>
</div>

{{-- SCRIPT (TIDAK DIUBAH) --}}
<script>
function calculateTotal() {
    const harga = parseFloat(document.getElementById('harga_per_kg').value) || 0;
    const qty = parseFloat(document.getElementById('jumlah_terjual').value) || 0;
    document.getElementById('total').value = (harga * qty).toFixed(2);
}

document.getElementById('harga_per_kg').addEventListener('input', calculateTotal);
document.getElementById('jumlah_terjual').addEventListener('input', calculateTotal);
calculateTotal();
</script>

@endsection
