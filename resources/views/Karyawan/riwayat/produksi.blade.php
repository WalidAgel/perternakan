<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Produksi - DWI FARM</title>
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
                <h1 class="text-3xl font-bold text-white mb-2">📊 Riwayat Produksi Telur</h1>
                <p class="text-white/80">Lihat dan analisis riwayat produksi Anda</p>
            </div>

            <!-- Statistik Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 md:gap-6 mb-8">

                <!-- Total Produksi Bulan Ini -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">BULAN INI</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">3,450 Kg</h3>
                    <p class="text-sm text-gray-600 mt-1">Total Produksi</p>
                </div>

                <!-- Rata-rata Harian -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">RATA-RATA</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">115 Kg</h3>
                    <p class="text-sm text-gray-600 mt-1">Per Hari</p>
                </div>

                <!-- Grade A -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 p-3 rounded-lg">
                            <span class="text-2xl">🥚</span>
                        </div>
                        <span class="text-xs font-semibold text-green-600">GRADE A</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">2,070 Kg</h3>
                    <p class="text-sm text-gray-600 mt-1">60% Total</p>
                </div>

                <!-- Total Entry -->
                <div class="bg-white rounded-xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-purple-100 p-3 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500">TOTAL</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800">30</h3>
                    <p class="text-sm text-gray-600 mt-1">Pencatatan</p>
                </div>

            </div>

            <!-- Grafik Tren Produksi -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">📈 Tren Produksi Bulanan</h2>
                        <p class="text-sm text-gray-500 mt-1">Grafik produksi 30 hari terakhir</p>
                    </div>
                    <select class="px-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-blue-500">
                        <option>30 Hari Terakhir</option>
                        <option>7 Hari Terakhir</option>
                        <option>3 Bulan Terakhir</option>
                    </select>
                </div>
                <div class="h-80">
                    <canvas id="chartProduksiBulanan"></canvas>
                </div>
            </div>

            <!-- Filter & Search -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-6">
                <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <!-- Tanggal Dari -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Tanggal Sampai -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Kualitas -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kualitas</label>
                        <select name="kualitas"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Semua Kualitas</option>
                            <option value="A" {{ request('kualitas') == 'A' ? 'selected' : '' }}>Grade A</option>
                            <option value="B" {{ request('kualitas') == 'B' ? 'selected' : '' }}>Grade B</option>
                            <option value="C" {{ request('kualitas') == 'C' ? 'selected' : '' }}>Grade C</option>
                        </select>
                    </div>

                    <!-- Tombol -->
                    <div class="flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                            Filter
                        </button>
                        <a href="{{ route('karyawan.riwayat.produksi') }}"
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
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari berdasarkan keterangan..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>
                    <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                        Cari
                    </button>
                </form>
            </div>

            <!-- Tabel Riwayat -->
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-800">Daftar Riwayat Produksi</h2>
                        <a href="{{ route('karyawan.produksi.index') }}"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
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
                                <th class="p-4 text-left font-semibold">Jumlah (Kg)</th>
                                <th class="p-4 text-left font-semibold">Kualitas</th>
                                <th class="p-4 text-left font-semibold">Keterangan</th>
                                <th class="p-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 divide-y divide-gray-200">
                            @forelse($produksi ?? [] as $index => $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">{{ $index + 1 }}</td>
                                <td class="p-4">
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</span>
                                    <br>
                                    <span class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($item->tanggal)->diffForHumans() }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="font-bold text-blue-600 text-lg">{{ number_format($item->jumlah, 2) }}</span>
                                    <span class="text-sm text-gray-600">Kg</span>
                                </td>
                                <td class="p-4">
                                    @if($item->kualitas == 'A')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold inline-flex items-center gap-1">
                                            <span>🥚</span> Grade A
                                        </span>
                                    @elseif($item->kualitas == 'B')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold inline-flex items-center gap-1">
                                            <span>🥚</span> Grade B
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold inline-flex items-center gap-1">
                                            <span>🥚</span> Grade C
                                        </span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600 max-w-xs truncate">
                                    {{ $item->keterangan ?: '-' }}
                                </td>
                                <td class="p-4">
                                    <div class="flex gap-2 justify-center">
                                        <a href="{{ route('karyawan.produksi.edit', $item->id) }}"
                                            class="px-3 py-1 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg text-sm font-medium transition">
                                            Edit
                                        </a>
                                        <form action="{{ route('karyawan.produksi.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded-lg text-sm font-medium transition">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-12 text-gray-500">
                                    <svg class="w-20 h-20 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="font-medium text-lg">Tidak ada data riwayat produksi</p>
                                    <p class="text-sm mt-1">Coba ubah filter atau tambah data baru</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if(isset($produksi) && $produksi->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $produksi->links() }}
                </div>
                @endif
            </div>

        </div>

    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }

        // Chart Tren Produksi Bulanan
        const ctx = document.getElementById('chartProduksiBulanan');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12', '13', '14', '15',
                         '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30'],
                datasets: [
                    {
                        label: 'Grade A',
                        data: [70, 68, 72, 75, 73, 71, 74, 76, 78, 77, 75, 73, 71, 74, 76,
                               78, 80, 79, 77, 75, 73, 76, 78, 80, 82, 81, 79, 77, 75, 73],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Grade B',
                        data: [30, 32, 28, 25, 27, 29, 26, 24, 22, 23, 25, 27, 29, 26, 24,
                               22, 20, 21, 23, 25, 27, 24, 22, 20, 18, 19, 21, 23, 25, 27],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    },
                    {
                        label: 'Grade C',
                        data: [15, 17, 13, 12, 14, 13, 12, 11, 10, 11, 12, 13, 14, 12, 11,
                               10, 9, 8, 9, 10, 11, 10, 9, 8, 7, 6, 7, 8, 9, 10],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.1)',
                        borderWidth: 3,
                        tension: 0.4,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            font: {
                                size: 12,
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y + ' Kg';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value + ' Kg';
                            },
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: 11
                            }
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });
    </script>

</body>

</html>
