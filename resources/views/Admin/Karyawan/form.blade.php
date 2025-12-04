@csrf
<div class="mb-3">
    <label>User</label>
    <select name="user_id" class="w-full border rounded p-2">
        @foreach ($users as $u)
            <option value="{{ $u->id }}" {{ (old('user_id', $karyawan->user_id ?? '') == $u->id) ? 'selected' : '' }}>
                {{ $u->name }} ({{ $u->email }})
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label>Nama</label>
    <input name="nama" value="{{ old('nama', $karyawan->nama ?? '') }}" class="w-full border p-2 rounded">
</div>

<div class="mb-3">
    <label>Email</label>
    <input name="email" value="{{ old('email', $karyawan->email ?? '') }}" class="w-full border p-2 rounded">
</div>

<div class="mb-3">
    <label>No HP</label>
    <input name="no_hp" value="{{ old('no_hp', $karyawan->no_hp ?? '') }}" class="w-full border p-2 rounded">
</div>

<button class="px-4 py-2 bg-blue-600 text-white">Simpan</button>
