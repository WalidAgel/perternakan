<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - DWI FARM</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="min-h-screen bg-[#C9B5A0] flex">

    <!-- SIDEBAR -->
    @include('karyawan.sidebar')

    <!-- MAIN CONTENT -->
    <main class="flex-1 overflow-y-auto">

        <!-- Mobile Menu Button -->
        <div class="md:hidden bg-white shadow-md p-4 flex items-center sticky top-0 z-30">
            <button onclick="toggleSidebar()" class="text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div class="flex items-center space-x-2 ml-4">
                <img src="/img/logo.png" class="h-8" alt="Logo">
                <span class="font-bold text-gray-800 text-lg">DWI FARM</span>
            </div>
        </div>

        <div class="p-4 md:p-8">

            <!-- Welcome Section -->
            <div class="mb-8">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h2>
                <p class="text-white/80 text-sm" id="currentDateTime"></p>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-8">

                <!-- Produksi Hari Ini -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-blue-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">Hari Ini</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($produksiHariIni ?? 0, 1) }}</h3>
                    <p class="text-sm text-gray-600">Kg Telur</p>
                    <div class="mt-4 flex items-center {{ ($perubahanProduksi ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }} text-xs font-medium">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            @if(($perubahanProduksi ?? 0) >= 0)
                            <path fill-rule="evenodd"
                                d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z"
                                clip-rule="evenodd" />
                            @else
                            <path fill-rule="evenodd"
                                d="M12 13a1 1 0 100 2h5a1 1 0 001-1v-5a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586l-4.293-4.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z"
                                clip-rule="evenodd" />
                            @endif
                        </svg>
                        <span>{{ number_format(abs($perubahanProduksi ?? 0), 1) }}% dari kemarin</span>
                    </div>
                </div>

                <!-- Total Pengeluaran -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-red-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">Hari Ini</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">Rp {{ number_format($pengeluaranHariIni ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-600">Total Pengeluaran</p>
                    <div class="mt-4 text-xs text-gray-500">
                        {{ $jumlahTransaksiHariIni ?? 0 }} transaksi tercatat
                    </div>
                </div>

                <!-- Sisa Stok -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-yellow-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">Stok</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ number_format($estimasiSisaStok ?? 0, 1) }} Kg</h3>
                    <p class="text-sm text-gray-600">Estimasi Sisa Telur</p>
                    <div class="mt-4">
                        <div class="bg-gray-200 rounded-full h-2">
                            <div class="bg-yellow-500 h-2 rounded-full" style="width: {{ min($persentaseSisa ?? 0, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ number_format($persentaseSisa ?? 0, 1) }}% tersisa</p>
                    </div>
                </div>

                <!-- Penjualan Hari Ini -->
                <div class="bg-white rounded-2xl shadow-lg p-6 hover:shadow-xl transition transform hover:-translate-y-1">
                    <div class="flex items-center justify-between mb-4">
                        <div class="bg-green-100 p-3 rounded-xl">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="text-xs font-semibold text-gray-500 uppercase">Hari Ini</span>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">Rp {{ number_format($penjualanHariIni ?? 0, 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-600">Total Penjualan</p>
                    <div class="mt-4 flex items-center text-green-600 text-xs font-medium">
                        <span>Bulan ini: Rp {{ number_format($penjualanBulanIni ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

            </div>

            <!-- Grafik Produksi Mingguan -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">📊 Produksi Mingguan</h3>
                        <p class="text-sm text-gray-500 mt-1">Grafik produksi telur 7 hari terakhir</p>
                    </div>
                    <div class="flex items-center space-x-2 text-sm">
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-medium">
                            Total: {{ number_format(array_sum($chartData ?? [0]), 1) }} Kg
                        </span>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartProduksi"></canvas>
                </div>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Input Produksi Terbaru -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">🥚 Produksi Terbaru</h3>
                        <a href="{{ route('karyawan.riwayat.produksi') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($produksiTerbaru ?? [] as $item)
                        <div class="flex items-center justify-between p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition">
                            <div class="flex items-center space-x-4">
                                <div class="bg-blue-500 p-3 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ number_format($item->jumlah, 1) }} Kg</p>
                                    <p class="text-sm text-gray-600">Kualitas:
                                        <span class="font-medium {{ $item->kualitas == 'A' ? 'text-green-600' : ($item->kualitas == 'B' ? 'text-yellow-600' : 'text-red-600') }}">
                                            Grade {{ $item->kualitas }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-gray-700">{{ $item->tanggal->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $item->created_at->format('H:i') }} WIB</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="font-medium">Belum ada data produksi</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Pengeluaran Terbaru -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold text-gray-800">💰 Pengeluaran Terbaru</h3>
                        <a href="{{ route('karyawan.riwayat.pengeluaran') }}"
                            class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                            Lihat Semua
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>

                    <div class="space-y-4">
                        @forelse($pengeluaranTerbaru ?? [] as $item)
                        <div class="flex items-center justify-between p-4 bg-red-50 rounded-xl hover:bg-red-100 transition">
                            <div class="flex items-center space-x-4">
                                <div class="bg-red-500 p-3 rounded-lg">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $item->kategori->nama_kategori ?? 'Lainnya' }}</p>
                                    <p class="text-sm text-gray-600">{{ \Illuminate\Support\Str::limit($item->deskripsi, 30) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-lg font-bold text-red-600">Rp {{ number_format($item->jumlah, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500">{{ $item->tanggal->diffForHumans() }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="font-medium">Belum ada pengeluaran</p>
                        </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>

    </main>

    <!-- Scripts -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }

        // Update Date Time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            };
            document.getElementById('currentDateTime').textContent =
                now.toLocaleDateString('id-ID', options) + ' WIB';
        }
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Chart Produksi Mingguan
        const chartLabels = {!! json_encode($chartLabels ?? ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min']) !!};
        const chartData = {!! json_encode($chartData ?? [0, 0, 0, 0, 0, 0, 0]) !!};

        new Chart(document.getElementById('chartProduksi'), {
            type: 'line',
            data: {
                labels: chartLabels,
                datasets: [{
                    label: 'Produksi (Kg)',
                    data: chartData,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            padding: 15,
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
                }
            }
        });
    </script>

</body>

</html>
