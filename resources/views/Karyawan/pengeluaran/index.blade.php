<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Pengeluaran - DWI FARM</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-[#C9B5A0] flex">

    @include('karyawan.sidebar')

    <main class="flex-1 overflow-y-auto">

        <!-- Mobile Menu Button -->
        <div class="md:hidden bg-white shadow-md p-4 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center space-x-3">
                <img src="/img/logo.png" class="h-10" alt="Logo">
                <span class="font-bold text-gray-800">DWI FARM</span>
            </div>
            <button onclick="toggleSidebar()" class="text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <div class="p-4 md:p-8">

            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">💰 Riwayat Pengeluaran</h1>
                <p class="text-white/80">Lihat dan kelola riwayat pengeluaran operasional</p>
            </div>

            <!-- Alert Success/Error -->
            @if (session('success'))
                <div
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center justify-between animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Total Pengeluaran Card -->
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl shadow-lg p-8 mb-8 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100 text-sm font-medium mb-2">Total Pengeluaran</p>
                        <h2 class="text-4xl font-bold mb-1">Rp {{ number_format($totalPengeluaran ?? 0, 0, ',', '.') }}
                        </h2>
                        <p class="text-red-100 text-sm">Semua waktu</p>
                    </div>
                    <div class="bg-white/20 p-4 rounded-xl">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8">

                <!-- Pengeluaran Bulan Ini -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">BULAN INI</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 2,5 Jt</h3>
                    <p class="text-sm text-gray-600 mt-1">Total Pengeluaran</p>
                </div>

                <!-- Pengeluaran Hari Ini -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">HARI INI</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 450K</h3>
                    <p class="text-sm text-gray-600 mt-1">2 Transaksi</p>
                </div>

                <!-- Rata-rata Harian -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">RATA-RATA</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">Rp 83K</h3>
                    <p class="text-sm text-gray-600 mt-1">Per Hari</p>
                </div>

            </div>

            <!-- Grafik Pengeluaran Bulanan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">📊 Grafik Pengeluaran per Kategori</h2>
                        <p class="text-sm text-gray-500 mt-1">Distribusi pengeluaran bulan ini</p>
                    </div>
                </div>
                <div class="h-80">
                    <canvas id="chartPengeluaran"></canvas>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Tanggal Dari -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>

                    <!-- Tanggal Sampai -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="kategoris_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori ?? [] as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ request('kategoris_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                            Filter
                        </button>
                        <a href="{{ route('karyawan.pengeluaran.index') }}"
                            class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg transition">
                            Reset
                        </a>
                    </div>

                </form>
            </div>

            <!-- Search Bar -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <form method="GET" class="flex gap-3">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan keterangan..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg transition">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Tabel Riwayat -->
            <!-- Tabel Riwayat -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">Daftar Pengeluaran</h2>
                        <a href="{{ route('karyawan.pengeluaran.create') }}"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                            </svg>
                            Input Baru
                        </a>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                            <tr>
                                <th class="p-4 text-left font-semibold">No</th>
                                <th class="p-4 text-left font-semibold">Tanggal</th>
                                <th class="p-4 text-left font-semibold">Kategori</th>
                                <th class="p-4 text-left font-semibold">Nominal</th>
                                <th class="p-4 text-left font-semibold">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 divide-y divide-gray-200">
                            @forelse($pengeluaran ?? [] as $index => $item)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-4">{{ $pengeluaran->firstItem() + $index }}</td>
                                    <td class="p-4">
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                        </span>
                                        <br>
                                        <span class="text-xs text-gray-500">
                                            {{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                            {{ $item->kategori->nama_kategori ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="p-4">
                                        <span class="font-bold text-red-600 text-lg">
                                            Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-gray-600 max-w-xs">
                                        <div class="line-clamp-2">{{ $item->deskripsi ?: '-' }}</div>
                                    </td>
                                    <td class="p-4 text-center">
                                        @if ($item->bukti)
                                            <button
                                                onclick="showImage('{{ asset('uploads/bukti/' . $item->bukti) }}')"
                                                class="text-blue-600 hover:text-blue-800 font-medium text-sm">
                                                Lihat Bukti
                                            </button>
                                        @else
                                            <span class="text-gray-400 text-sm">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-12 text-gray-500">
                                        <svg class="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="font-medium text-lg">Tidak ada data pengeluaran</p>
                                        <p class="text-sm mt-1">Coba ubah filter atau tambah data baru</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if (isset($pengeluaran) && $pengeluaran->hasPages())
                    <div class="p-4 border-t border-gray-200">
                        {{ $pengeluaran->links() }}
                    </div>
                @endif
            </div>


        </div>

    </main>

    <!-- Modal untuk lihat bukti -->
    <div id="imageModal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4"
        onclick="closeModal()">
        <div class="relative max-w-4xl max-h-full" onclick="event.stopPropagation()">
            <button onclick="closeModal()" class="absolute -top-10 right-0 text-white hover:text-gray-300">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
            <img id="modalImage" class="max-w-full max-h-[80vh] rounded-lg shadow-2xl" alt="Bukti">
        </div>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }

        function showImage(src) {
            document.getElementById('modalImage').src = src;
            document.getElementById('imageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('imageModal').classList.add('hidden');
        }

        // Chart Pengeluaran per Kategori
        const ctx = document.getElementById('chartPengeluaran');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Pakan Ayam', 'Obat & Vitamin', 'Perawatan Kandang', 'Utilitas', 'Peralatan', 'Lain-lain'],
                datasets: [{
                    label: 'Pengeluaran',
                    data: [45, 15, 12, 18, 7, 3],
                    backgroundColor: [
                        '#3b82f6',
                        '#10b981',
                        '#f59e0b',
                        '#ef4444',
                        '#8b5cf6',
                        '#6b7280'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 'bold'
                            },
                            usePointStyle: true
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + '%';
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>
