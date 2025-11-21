<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center py-8">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">Register</h2>

        {{-- FORM REGISTER --}}
        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            {{-- NAME --}}
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap
                </label>
                <input 
                    type="text" 
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                    placeholder="Masukkan nama lengkap"
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email"
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                    placeholder="nama@email.com"
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                    placeholder="Masukkan password"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                    Konfirmasi Password
                </label>
                <input 
                    type="password" 
                    name="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none"
                    placeholder="Masukkan ulang password"
                >
            </div>

            {{-- SUBMIT --}}
            <button 
                type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200 font-medium mt-6"
            >
                Daftar
            </button>

            <p class="text-center text-sm text-gray-600 mt-4">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                    Login
                </a>
            </p>
        </form>
    </div>
</body>
</html>
