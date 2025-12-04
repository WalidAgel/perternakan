<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DWI FARM</title>

    @vite('resources/css/app.css')
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- AlpineJS untuk dropdown -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }
    </script>
</head>

<body class="min-h-screen flex bg-[#C9B5A0]">

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="w-64 bg-white h-screen shadow-md flex flex-col px-6 py-8 fixed md:static z-40 transform -translate-x-full md:translate-x-0 transition duration-300">

        <!-- LOGO -->
        <div class="flex items-center justify-between mb-10">
            <img src="/img/logo.png" class="w-24" alt="Logo">

            <button onclick="toggleSidebar()" class="md:hidden">
                <i data-feather="menu" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- MENU -->
        <nav class="flex flex-col space-y-4 text-gray-900 font-medium text-sm">

            <!-- DASHBOARD -->
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="home" class="w-5 h-5"></i>
                <span>Dashboard</span>
            </a>

            <!-- MASTER DATA DROPDOWN -->
            <div x-data="{ open: {{ request()->is('admin/master/*') ? 'true' : 'false' }} }">

                <!-- Button -->
                <button @click="open = !open"
                    class="w-full flex items-center justify-between hover:text-orange-600 transition">
                    <div class="flex items-center gap-3">
                        <i data-feather="database" class="w-5 h-5"></i>
                        <span>Data Master</span>
                    </div>
                    <i data-feather="chevron-down" class="w-4"></i>
                </button>

                <!-- Submenu -->
                <div x-show="open" x-cloak class="ml-8 mt-2 flex flex-col space-y-2">

                    <a href="{{ route('karyawan.index') }}"
                        class="flex items-center gap-2 hover:text-orange-600 transition
                        {{ request()->is('admin/master/karyawan*') ? 'text-orange-600 font-semibold' : '' }}">
                        <span>Karyawan</span>
                    </a>

                    <a href="{{ route('kategori.index') }}"
                        class="flex items-center gap-2 hover:text-orange-600 transition
                        {{ request()->is('admin/master/kategori-pengeluaran*') ? 'text-orange-600 font-semibold' : '' }}">
                        <span>Kategori Pengeluaran</span>
                    </a>

                </div>
            </div>

            <!-- MENU LAIN -->
            <a href="{{ route('admin.pengeluaran.index') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="credit-card" class="w-5 h-5"></i>
                <span>Pengeluaran</span>
            </a>

            <a href="{{ route('admin.produksi.index') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="package" class="w-5 h-5"></i>
                <span>Produksi</span>
            </a>

            <a href="{{ route('admin.penjualan.index') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="shopping-bag" class="w-5 h-5"></i>
                <span>Penjualan</span>
            </a>

            <a href="{{ route('admin.laporan') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="file-text" class="w-5 h-5"></i>
                <span>Laporan</span>
            </a>

            <a href="{{ route('admin.user') }}"
                class="flex items-center gap-3 hover:text-orange-600 transition">
                <i data-feather="users" class="w-5 h-5"></i>
                <span>User Management</span>
            </a>

        </nav>
    </aside>

    <!-- FEATHER ICONS -->
    <script>
        feather.replace();
    </script>

</body>

</html>
