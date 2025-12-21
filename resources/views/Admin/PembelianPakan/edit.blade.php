@extends('Layout.app')

@section('content')
<div class="p-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit Pembelian Pakan</h1>
    </div>

    <div class="bg-white shadow rounded-xl p-6">
        <form action="{{ route('admin.pembelian-pakan.update', $pembelianPakan->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Pakan</label>
                    <select name="pakan_id" id="pakan_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('pakan_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Pakan --</option>
                        @foreach ($pakans as $pakan)
                        <option value="{{ $pakan->id }}" data-harga="{{ $pakan->harga_pakan }}" {{ old('pakan_id', $pembelianPakan->pakan_id) == $pakan->id ? 'selected' : '' }}>
                            {{ $pakan->nama_pakan }}
                        </option>
                        @endforeach
                    </select>
                    @error('pakan_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Karyawan</label>
                    <select name="karyawans_id"
                        class="w-full border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300 @error('karyawans_id') border-red-500 @enderror"
                        required>
                        <option value="">-- Pilih Karyawan --</option>
                        @foreach ($karyawans as $karyawan)
                        <option value="{{ $karyawan->id }}" {{ old('karyawans_id', $pembelianPakan->karyawans_id) == $karyawan->id ? 'selected' : '' }}>
                            {{ $karyawan->nama }}
                        </option>
                        @endforeach
                    </select>
                    @error('karyawans_id')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $pembelianPakan->tanggal->format('Y-m-d')) }}"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('tanggal') border-red-500 @enderror"
                        required>
                    @error('tanggal')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Jumlah (Kg)</label>
                    <input type="number" name="jumlah" id="jumlah" value="{{ old('jumlah', $pembelianPakan->jumlah) }}" step="0.01" min="0.01"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('jumlah') border-red-500 @enderror"
                        required>
                    @error('jumlah')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Satuan (per Kg)</label>
                    <input type="number" name="harga_satuan" id="harga_satuan" value="{{ old('harga_satuan', $pembelianPakan->harga_satuan) }}" step="0.01" min="0"
                        class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300 @error('harga_satuan') border-red-500 @enderror"
                        required>
                    @error('harga_satuan')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Total Harga</label>
                    <input type="text" id="total_harga_display" readonly
                        class="w-full border-gray-300 rounded-lg p-2 bg-gray-100 text-gray-700 font-semibold">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Keterangan</label>
                <textarea name="keterangan" rows="3"
                    class="w-full border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300">{{ old('keterangan', $pembelianPakan->keterangan) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                    class="px-6 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Update
                </button>
                <a href="{{ route('admin.pembelian-pakan.index') }}"
                    class="px-6 py-2 bg-gray-300 hover:bg-gray-400 text-gray-700 rounded-lg shadow font-semibold">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('jumlah').addEventListener('input', calculateTotal);
    document.getElementById('harga_satuan').addEventListener('input', calculateTotal);

    function calculateTotal() {
        const jumlah = parseFloat(document.getElementById('jumlah').value) || 0;
        const harga = parseFloat(document.getElementById('harga_satuan').value) || 0;
        const total = jumlah * harga;
        document.getElementById('total_harga_display').value = 'Rp ' + total.toLocaleString('id-ID');
    }

    calculateTotal();
</script>
@endpush
@endsection
