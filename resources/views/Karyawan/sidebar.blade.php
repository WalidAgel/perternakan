<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Karyawan - DWI FARM</title>

    @vite('resources/css/app.css')

    <!-- AlpineJS untuk dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebar-overlay");

            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
</head>

<body>


    <!-- Overlay untuk mobile -->
    <div id="sidebar-overlay" onclick="toggleSidebar()" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden">
    </div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-white h-screen shadow-md flex flex-col px-4 py-6
               fixed top-0 left-0 z-50
               transform -translate-x-full md:translate-x-0
               transition-transform duration-300 ease-in-out
               md:sticky md:top-0
               overflow-y-auto">

        <!-- LOGO (Desktop) -->
        <div class="hidden md:flex items-center justify-between mb-10 flex-shrink-0">
            <img src="/img/logo.png" class="w-24" alt="Logo">
        </div>

        <!-- Header Mobile (dalam sidebar) -->
        <div class="md:hidden flex items-center justify-between mb-6 flex-shrink-0">
            <img src="/img/logo.png" class="w-20" alt="Logo">
            <button onclick="toggleSidebar()" class="p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- USER INFO -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-4 mb-6 flex-shrink-0">
            <div class="flex items-center space-x-3">
                <div
                    class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div class="overflow-hidden">
                    <p class="font-semibold text-gray-800 text-sm truncate">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-600 font-medium">Karyawan</p>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <nav class="flex flex-col space-y-2 text-gray-900 font-medium text-sm flex-1 overflow-y-auto">

            <!-- DASHBOARD -->
            <a href="{{ route('karyawan.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- PRODUKSI -->
            <a href="{{ route('karyawan.produksi.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.produksi.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Input Produksi</span>
            </a>

            <!-- PENGELUARAN -->
            <a href="{{ route('karyawan.pengeluaran.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.pengeluaran.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>Pengeluaran</span>
            </a>

            <!-- PROFIL -->
            <a href="{{ route('karyawan.profil.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.profil') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil Saya</span>
            </a>

        </nav>

        <!-- LOGOUT (STICKY BOTTOM) -->
        <div class="mt-auto w-full flex-shrink-0 pt-4">
            <div class="border-t border-gray-300 my-4"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 hover:text-red-600 transition text-left group">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

    <!-- Overlay untuk mobile (ketika sidebar terbuka) -->
    <div id="sidebar-overlay" onclick="toggleSidebar()"
        class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden">
    </div>

</body>

</html>
