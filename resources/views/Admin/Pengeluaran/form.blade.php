@csrf

<!-- Kategori -->
<div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Kategori <span class="text-red-600">*</span>
    </label>
    <select name="kategoris_id" required
            class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('kategoris_id') border-red-500 @enderror">
        <option value="">Pilih Kategori</option>
        @foreach($kategori as $kat)
        <option value="{{ $kat->id }}" {{ old('kategoris_id', $pengeluaran->kategoris_id ?? '') == $kat->id ? 'selected' : '' }}>
            {{ $kat->nama_kategori }}
        </option>
        @endforeach
    </select>
    @error('kategoris_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Karyawan -->
<div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Karyawan <span class="text-red-600">*</span>
    </label>
    <select name="karyawans_id" required
            class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('karyawans_id') border-red-500 @enderror">
        <option value="">Pilih Karyawan</option>
        @foreach($karyawan as $kar)
        <option value="{{ $kar->id }}" {{ old('karyawans_id', $pengeluaran->karyawans_id ?? '') == $kar->id ? 'selected' : '' }}>
            {{ $kar->nama }}
        </option>
        @endforeach
    </select>
    @error('karyawans_id')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Tanggal -->
<div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Tanggal <span class="text-red-600">*</span>
    </label>
    <input type="date" name="tanggal" required
           value="{{ old('tanggal', isset($pengeluaran) ? $pengeluaran->tanggal->format('Y-m-d') : date('Y-m-d')) }}"
           class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('tanggal') border-red-500 @enderror">
    @error('tanggal')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Jumlah -->
<div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Jumlah (Rupiah) <span class="text-red-600">*</span>
    </label>
    <input type="number" name="jumlah" required step="0.01" min="0"
           value="{{ old('jumlah', $pengeluaran->jumlah ?? '') }}"
           placeholder="0"
           class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('jumlah') border-red-500 @enderror">
    @error('jumlah')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<!-- Deskripsi -->
<div class="mb-3">
    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
    <textarea name="deskripsi" rows="4"
              placeholder="Tambahkan deskripsi pengeluaran..."
              class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $pengeluaran->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
    @enderror
</div>

<div class="flex gap-2">
    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Simpan
    </button>
    <a href="{{ route('admin.pengeluaran.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600 transition">
        Batal
    </a>
</div>
