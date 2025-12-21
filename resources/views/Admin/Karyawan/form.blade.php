@csrf

<!-- User Selection Card -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
    <label class="block text-sm font-semibold text-gray-700 mb-3">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Pilih User
        </span>
    </label>
    <select
        name="user_id"
        class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 outline-none hover:border-gray-400"
        required
    >
        <option value="" disabled selected>-- Pilih User --</option>
        @foreach ($users as $u)
            <option
                value="{{ $u->id }}"
                {{ (old('user_id') ?? '') == $u->id ? 'selected' : '' }}
            >
                {{ $u->name }} ({{ $u->email }})
            </option>
        @endforeach
    </select>
</div>

<!-- Input Fields Grid -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
    <!-- Nama -->
    <div class="space-y-2">
        <label for="nama" class="block text-sm font-semibold text-gray-700">
            Nama Lengkap
        </label>
        <input
            type="text"
            name="nama"
            id="nama"
            value="{{ old('nama') }}"
            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 outline-none hover:border-gray-400"
            placeholder="Masukkan nama"
            required
        >
    </div>

    <!-- Email -->
    <div class="space-y-2">
        <label for="email" class="block text-sm font-semibold text-gray-700">
            Email Address
        </label>
        <input
            type="email"
            name="email"
            id="email"
            value="{{ old('email') }}"
            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 outline-none hover:border-gray-400"
            placeholder="nama@example.com"
            required
        >
    </div>

    <!-- No HP -->
    <div class="space-y-2">
        <label for="no_hp" class="block text-sm font-semibold text-gray-700">
            No. HP
        </label>
        <input
            type="tel"
            name="no_hp"
            id="no_hp"
            value="{{ old('no_hp') }}"
            class="w-full px-4 py-3 bg-gray-50 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 outline-none hover:border-gray-400"
            placeholder="08xxxxxxxxxx"
            required
        >
    </div>
</div>

<!-- Submit Button -->
<div class="flex justify-end">
    <button
        type="submit"
        class="inline-flex items-center gap-2 px-6 py-3 bg-linear-to-r from-orange-600 to-orange-700 text-white font-semibold rounded-lg hover:from-orange-700 hover:to-orange-800 focus:ring-4 focus:ring-orange-300 transition-all duration-200 shadow-md hover:shadow-lg active:scale-95"
    >
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Simpan Data
    </button>
</div>
