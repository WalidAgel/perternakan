@csrf

<div class="mb-3">
    <label>Nama Kategori</label>
    <input name="nama_kategori"
           value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
           class="w-full border p-2 rounded">
</div>

<div class="mb-3">
    <label>Deskripsi</label>
    <textarea name="deskripsi"
              class="w-full border p-2 rounded">{{ old('deskripsi', $kategori->deskripsi ?? '') }}</textarea>
</div>

<button class="px-4 py-2 bg-orange-600 text-white rounded">Simpan</button>
