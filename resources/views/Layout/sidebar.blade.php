<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWI FARM - Sidebar</title>

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

<body>
    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-white h-screen shadow-md flex flex-col px-6 py-8 fixed md:sticky md:top-0 md:left-0 z-40 transform -translate-x-full md:translate-x-0 transition-transform duration-300">

        <!-- LOGO -->
        <div class="flex items-center justify-between mb-10 flex-shrink-0">
            <img src="/img/logo.png" class="w-24" alt="Logo">

            <button onclick="toggleSidebar()" class="md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- MENU -->
        <nav class="flex flex-col space-y-2 text-gray-900 font-medium text-sm pt-6 flex-1 overflow-y-auto">

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.dashboard') ? 'bg-orange-100 text-orange-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- MASTER DATA DROPDOWN -->
            <div x-data="{ open: {{ request()->is('admin/karyawan*') || request()->is('admin/kategori*') ? 'true' : 'false' }} }">

                <!-- Button -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition"
                    :class="open ? 'bg-orange-50 text-orange-600' : ''">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4" />
                        </svg>
                        <span>Data Master</span>
                    </div>
                    <svg class="w-4 h-4 flex-shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Submenu -->
                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" 
                    class="ml-8 mt-2 flex flex-col space-y-1">

                    <a href="{{ route('admin.karyawan.index') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->is('admin/karyawan*') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Karyawan</span>
                    </a>

                    <a href="{{ route('admin.kategori.index') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->is('admin/kategori*') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        <span>Kategori Pengeluaran</span>
                    </a>

                </div>
            </div>

            <!-- PENGELUARAN -->
            <a href="{{ route('admin.pengeluaran.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.pengeluaran.*') ? 'bg-orange-100 text-orange-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <span>Pengeluaran</span>
            </a>

            <!-- PRODUKSI -->
            <a href="{{ route('admin.produksi.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.produksi.*') ? 'bg-orange-100 text-orange-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
                <span>Produksi</span>
            </a>

            <!-- PENJUALAN -->
            <a href="{{ route('admin.penjualan.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.penjualan.*') ? 'bg-orange-100 text-orange-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
                <span>Penjualan</span>
            </a>

            <!-- LAPORAN DROPDOWN -->
            <div x-data="{ open: {{ request()->routeIs('admin.laporan.*') ? 'true' : 'false' }} }">

                <button @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition"
                    :class="open ? 'bg-orange-50 text-orange-600' : ''">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span>Laporan</span>
                    </div>
                    <svg class="w-4 h-4 flex-shrink-0 transition-transform" :class="open ? 'rotate-180' : ''" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform scale-95"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-95" 
                    class="ml-8 mt-2 flex flex-col space-y-1">

                    <a href="{{ route('admin.laporan.produksi') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.laporan.produksi') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        <span>Laporan Produksi</span>
                    </a>

                    <a href="{{ route('admin.laporan.pengeluaran') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.laporan.pengeluaran') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Laporan Pengeluaran</span>
                    </a>

                    <a href="{{ route('admin.laporan.penjualan') }}"
                        class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.laporan.penjualan') ? 'bg-orange-100 text-orange-600 font-semibold' : '' }}">
                        <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                        </svg>
                        <span>Laporan Penjualan</span>
                    </a>

                </div>
            </div>

            <!-- USER MANAGEMENT -->
            <a href="{{ route('admin.user.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-orange-50 hover:text-orange-600 transition {{ request()->routeIs('admin.user.*') ? 'bg-orange-100 text-orange-600' : '' }}">
                <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <span>User Management</span>
            </a>
        </nav>

        <!-- LOGOUT SECTION -->
        <div class="mt-auto w-full flex-shrink-0 pt-4">
            <div class="border-t border-gray-300 my-4"></div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 hover:text-red-600 transition text-left">
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
    <div id="sidebar-overlay" 
         onclick="toggleSidebar()" 
         class="fixed inset-0 bg-black bg-opacity-50 z-30 md:hidden hidden">
    </div>

    <script>
        // Tambahkan overlay toggle
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("sidebar-overlay");
            
            sidebar.classList.toggle("-translate-x-full");
            overlay.classList.toggle("hidden");
        }
    </script>
</body>

</html>