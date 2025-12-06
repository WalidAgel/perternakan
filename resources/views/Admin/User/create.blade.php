@extends('Layout.app')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="mb-6">
        <div class="flex items-center gap-3 mb-2">
            <a href="{{ route('admin.user.index') }}"
                class="text-gray-600 hover:text-gray-800 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Tambah User Baru</h1>
                <p class="text-gray-600 mt-1">Buat akun pengguna baru untuk sistem</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="max-w-2xl">
        <div class="bg-white shadow-lg rounded-xl p-8">
            <form action="{{ route('admin.user.store') }}" method="POST" class="space-y-6">
                @csrf

                <!-- Nama -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Nama Lengkap <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </div>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            placeholder="Masukkan nama lengkap"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                    </div>
                    @error('name')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Email <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <input type="email" name="email" value="{{ old('email') }}" required
                            placeholder="nama@email.com"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Password <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </div>
                        <input type="password" name="password" required
                            placeholder="Minimal 6 karakter"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                    </div>
                    @error('password')
                    <p class="text-red-500 text-sm mt-1 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Konfirmasi Password <span class="text-red-600">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" required
                            placeholder="Ketik ulang password"
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Role -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-3">
                        Role <span class="text-red-600">*</span>
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-purple-500 transition @error('role') border-red-500 @enderror">
                            <input type="radio" name="role" value="admin" {{ old('role') === 'admin' ? 'checked' : '' }}
                                class="w-5 h-5 text-purple-600 focus:ring-purple-500">
                            <div class="ml-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-2xl">🔐</span>
                                    <span class="font-semibold text-gray-800">Admin</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Akses penuh sistem</p>
                            </div>
                        </label>

                        <label class="relative flex items-center p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-blue-500 transition @error('role') border-red-500 @enderror">
                            <input type="radio" name="role" value="karyawan" {{ old('role') === 'karyawan' ? 'checked' : '' }}
                                class="w-5 h-5 text-blue-600 focus:ring-blue-500">
                            <div class="ml-3">
                                <div class="flex items-center gap-2">
                                    <span class="text-2xl">👤</span>
                                    <span class="font-semibold text-gray-800">Karyawan</span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Akses terbatas</p>
                            </div>
                        </label>
                    </div>
                    @error('role')
                    <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-4 border-t border-gray-200">
                    <button type="submit"
                        class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Simpan User
                    </button>
                    <a href="{{ route('admin.user.index') }}"
                        class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
