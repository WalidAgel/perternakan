<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-[#A8BBA3] min-h-screen flex items-center justify-center">

    <!-- CARD LOGIN -->
    <div class="bg-white p-8 rounded-xl shadow-lg w-full max-w-md">

        <!-- LOGO -->
        <div class="flex justify-center mb-4">
            <img src="/img/logo.png" alt="Logo" class="w-32">
        </div>

        <!-- Error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Success -->
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-3 rounded mb-4 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <!-- FORM -->
        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf

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
                        onclick="togglePassword()"
                        class="absolute inset-y-0 right-4 flex items-center text-gray-500 hover:text-gray-700"
                    >
                        <!-- Mata tertutup (default) -->
                        <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 3l18 18M10.477 10.477A3 3 0 0113.5 13.5m2.384 2.386A8.959 8.959 0 0012 21c-4.418 0-8-3.582-10-8 1.032-2.575 2.672-4.754 4.75-6.25" />
                        </svg>

                        <!-- Mata terbuka -->
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 hidden" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- INGAT SAYA -->
            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="rounded text-green-600">
                <label for="remember" class="text-sm text-gray-700">Ingat saya</label>
            </div>

            <!-- BUTTON -->
            <button
                type="submit"
                class="w-full bg-green-700 text-white py-2 rounded-full hover:bg-green-800 transition font-medium"
            >
                Login
            </button>
        </form>

        <!-- FOOTER -->
        <p class="text-center text-sm text-gray-600 mt-5">
            Belum punya akun?
            <a href="{{ route('register.post') }}" class="text-blue-600 hover:underline">Daftar di sini</a>
        </p>

    </div>

    <!-- SCRIPT TOGGLE PASSWORD -->
    <script>
        function togglePassword() {
            const pwd = document.getElementById("password");
            const eyeOpen = document.getElementById("eyeOpen");
            const eyeClosed = document.getElementById("eyeClosed");

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
