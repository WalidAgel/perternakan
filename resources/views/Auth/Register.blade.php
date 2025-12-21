<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#A8BBA3] min-h-screen flex items-center justify-center">

    <!-- CARD REGISTER -->
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        <!-- LOGO -->
        <div class="flex justify-center mb-4">
            <img src="/img/logo.png" alt="Logo" class="w-32">
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
            @csrf

            <!-- NAMA LENGKAP -->
            <div>
                <label for="name" class="block text-sm text-gray-700 mb-1">Nama Lengkap</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-600 outline-none"
                    placeholder="Masukkan nama lengkap"
                >
            </div>

            <!-- EMAIL -->
            <div>
                <label for="email" class="block text-sm text-gray-700 mb-1">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-600 outline-none"
                    placeholder="Masukkan email"
                >
            </div>

            <!-- PASSWORD + ICON -->
            <div>
                <label for="password" class="block text-sm text-gray-700 mb-1">Password</label>

                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-600 outline-none"
                        placeholder="Masukkan password"
                    >

                    <!-- ICON SHOW/HIDE -->
                    <button
                        type="button"
                        onclick="togglePassword('password')"
                        class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <!-- Heroicon: Eye Slash (default - password hidden) -->
                        <svg id="eyeClosed-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>

                        <!-- Heroicon: Eye (password visible) -->
                        <svg id="eyeOpen-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- KONFIRMASI PASSWORD + ICON -->
            <div>
                <label for="password_confirmation" class="block text-sm text-gray-700 mb-1">Konfirmasi Password</label>

                <div class="relative">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-600 outline-none"
                        placeholder="Masukkan ulang password"
                    >

                    <!-- ICON SHOW/HIDE -->
                    <button
                        type="button"
                        onclick="togglePassword('password_confirmation')"
                        class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none"
                    >
                        <!-- Heroicon: Eye Slash (default - password hidden) -->
                        <svg id="eyeClosed-password_confirmation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>

                        <!-- Heroicon: Eye (password visible) -->
                        <svg id="eyeOpen-password_confirmation" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-green-700 text-white py-2 rounded-full hover:bg-green-800 transition font-medium"
            >
                Daftar
            </button>
        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm text-gray-600 mt-5">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login di sini</a>
        </p>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        function togglePassword(fieldId) {
            const pwd = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(`eyeOpen-${fieldId}`);
            const eyeClosed = document.getElementById(`eyeClosed-${fieldId}`);

            if (pwd.type === "password") {
                pwd.type = "text";
                eyeOpen.classList.remove("hidden");
                eyeClosed.classList.add("hidden");
            } else {
                pwd.type = "password";
                eyeOpen.classList.add("hidden");
                eyeClosed.classList.remove("hidden");
            }
        }
    </script>

</body>
</html>
