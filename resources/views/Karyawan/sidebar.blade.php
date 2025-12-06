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
            sidebar.classList.toggle("-translate-x-full");
        }
    </script>
</head>

<body class="min-h-screen bg-[#C9B5A0]">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-white h-screen shadow-md flex flex-col px-6 py-8 fixed md:static z-40 transform -translate-x-full md:translate-x-0 transition duration-300 overflow-y-auto">

        <!-- LOGO -->
        <div class="flex items-center justify-between mb-10">
            <img src="/img/logo.png" class="w-24" alt="Logo">

            <button onclick="toggleSidebar()" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- USER INFO -->
        <div class="bg-gradient-to-r from-blue-50 to-blue-100 rounded-xl p-4 mb-6">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-lg">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="font-semibold text-gray-800 text-sm">{{ auth()->user()->name }}</p>
                    <p class="text-xs text-blue-600 font-medium">Karyawan</p>
                </div>
            </div>
        </div>

        <!-- MENU -->
        <nav class="flex flex-col space-y-2 text-gray-900 font-medium text-sm pt-2">

            <!-- DASHBOARD -->
            <a href="{{ route('karyawan.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.dashboard') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- PRODUKSI -->
            <a href="{{ route('karyawan.produksi.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.produksi.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Input Produksi</span>
            </a>

            <!-- PENGELUARAN -->
            <a href="{{ route('karyawan.pengeluaran.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.pengeluaran.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>Pengeluaran</span>
            </a>

            {{-- <!-- pakan -->
            <a href="{{ route('karyawan.pakan.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.pengeluaran.*') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>pakan & obat</span>
            </a> --}}

            <!-- RIWAYAT -->
            <div x-data="{ open: {{ request()->routeIs('karyawan.riwayat.*') ? 'true' : 'false' }} }">
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition"
                    :class="open ? 'bg-blue-50 text-blue-600' : ''">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Riwayat</span>
                    </div>
                    <svg class="w-4 h-4 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" class="ml-8 mt-2 flex flex-col space-y-1">

                    <a href="{{ route('karyawan.riwayat.produksi') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.riwayat.produksi') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Riwayat Produksi</span>
                    </a>

                    <a href="{{ route('karyawan.riwayat.pengeluaran') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.riwayat.pengeluaran') ? 'bg-blue-100 text-blue-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Riwayat Pengeluaran</span>
                    </a>
                </div>
            </div>

            <!-- PROFIL -->
            <a href="{{ route('karyawan.profil') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50 hover:text-blue-600 transition {{ request()->routeIs('karyawan.profil') ? 'bg-blue-100 text-blue-600' : '' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>Profil Saya</span>
            </a>

        </nav>

        <!-- LOGOUT (STICKY BOTTOM) -->
        <div class="mt-auto w-full pt-6">
            <div class="border-t border-gray-300 my-4"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 hover:text-red-600 transition text-left group">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    <span>Logout</span>
                </button>
            </form>
        </div>

    </aside>

</body>

</html>
