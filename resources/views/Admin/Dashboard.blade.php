<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - DWI FARM</title>

    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-[#B9997F] to-[#A8886E]">

    <div class="flex flex-col md:flex-row min-h-screen">

        @include('Layout.sidebar')

        <div class="flex-1 w-full md:w-auto overflow-x-hidden pt-16 md:pt-0">
            <div class="p-3 md:p-6 lg:p-8">

                <!-- Header -->
                <div class="mb-6 md:mb-8">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold text-white">Dashboard</h1>
                            <p class="text-white/80 text-xs md:text-sm mt-1">Selamat datang kembali! Berikut ringkasan hari ini.</p>
                        </div>

                        <div class="text-white/90 text-xs md:text-sm bg-white/10 backdrop-blur-sm px-4 py-2 rounded-lg">
                            <span id="currentDate"></span>
                        </div>
                    </div>
                </div>

                <!-- Summary Cards - 3 Kolom -->
                <div class="grid grid-cols-3 gap-3 md:gap-6 mb-8 md:mb-10">

                    <!-- Produksi -->
                    <div class="bg-white border shadow-lg rounded-2xl p-4 md:p-6 hover:shadow-xl transition">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-gray-500 text-xs md:text-sm font-medium">Produksi Hari Ini</h2>
                            <div class="bg-blue-100 p-2 rounded-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                                </svg>
                            </div>
                        </div>

                        <p class="text-3xl md:text-4xl font-extrabold text-gray-800">{{ number_format($produksiHariIni ?? 0, 1) }}</p>
                        <p class="text-gray-600 text-xs md:text-sm">Kg</p>

                        @if(isset($perubahanProduksi) && $perubahanProduksi != 0)
                        <div class="mt-3 md:mt-4 flex items-center text-{{ $perubahanProduksi > 0 ? 'green' : 'red' }}-600 text-xs md:text-sm">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                @if($perubahanProduksi > 0)
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                @else
                                <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                            <span>{{ $perubahanProduksi > 0 ? '+' : '' }}{{ number_format($perubahanProduksi, 1) }}% dari kemarin</span>
                        </div>
                        @else
                        <p class="mt-3 md:mt-4 text-gray-500 text-xs md:text-sm">Tidak ada perubahan</p>
                        @endif
                    </div>

                    <!-- Pengeluaran -->
                    <div class="bg-white border shadow-lg rounded-2xl p-4 md:p-6 hover:shadow-xl transition">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-gray-500 text-xs md:text-sm font-medium">Pengeluaran Hari Ini</h2>
                            <div class="bg-red-100 p-2 rounded-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <p class="text-3xl md:text-4xl font-extrabold text-gray-800">Rp {{ number_format(($pengeluaranHariIni ?? 0) / 1000, 0) }}K</p>
                        <p class="text-gray-600 text-xs md:text-sm">Total biaya operasional</p>

                        <p class="mt-3 md:mt-4 text-gray-500 text-xs md:text-sm">{{ $jumlahTransaksiPengeluaran ?? 0 }} transaksi tercatat</p>
                    </div>

                    <!-- Penjualan -->
                    <div class="bg-white border shadow-lg rounded-2xl p-4 md:p-6 hover:shadow-xl transition">
                        <div class="flex items-center justify-between mb-3">
                            <h2 class="text-gray-500 text-xs md:text-sm font-medium">Penjualan Hari Ini</h2>
                            <div class="bg-green-100 p-2 rounded-lg">
                                <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>

                        <p class="text-3xl md:text-4xl font-extrabold text-gray-800">Rp {{ number_format(($penjualanHariIni ?? 0) / 1000000, 1) }}Jt</p>
                        <p class="text-gray-600 text-xs md:text-sm">Pendapatan kotor</p>

                        @if(isset($perubahanPenjualan) && $perubahanPenjualan != 0)
                        <div class="mt-3 md:mt-4 flex items-center text-{{ $perubahanPenjualan > 0 ? 'green' : 'red' }}-600 text-xs md:text-sm">
                            <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                @if($perubahanPenjualan > 0)
                                <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                                @else
                                <path fill-rule="evenodd" d="M12 13a1 1 0 100 2h5a1 1 0 001-1V9a1 1 0 10-2 0v2.586l-4.293-4.293a1 1 0 00-1.414 0L8 9.586 3.707 5.293a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0L11 9.414 14.586 13H12z" clip-rule="evenodd"></path>
                                @endif
                            </svg>
                            <span>{{ $perubahanPenjualan > 0 ? '+' : '' }}{{ number_format($perubahanPenjualan, 1) }}% dari kemarin</span>
                        </div>
                        @else
                        <p class="mt-3 md:mt-4 text-gray-500 text-xs md:text-sm">Tidak ada perubahan</p>
                        @endif
                    </div>

                </div>


                <!-- Tables -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">

                    <!-- Pengeluaran Terbaru -->
                    <div class="bg-white p-4 md:p-6 border rounded-2xl shadow-lg">
                        <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Pengeluaran Terbaru</h3>

                        <div class="overflow-x-auto -mx-4 md:mx-0">
                            <div class="inline-block min-w-full align-middle">
                                <table class="min-w-full text-xs md:text-sm">
                                    <thead>
                                        <tr class="bg-gray-50 border-b">
                                            <th class="p-2 md:p-3 text-left text-gray-600 font-semibold">Tanggal</th>
                                            <th class="p-2 md:p-3 text-left text-gray-600 font-semibold">Kategori</th>
                                            <th class="p-2 md:p-3 text-right text-gray-600 font-semibold">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @forelse($pengeluaranTerbaru as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-2 md:p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m') }}</td>
                                            <td class="p-2 md:p-3">
                                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-semibold">
                                                    {{ $item->kategori->nama_kategori ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td class="p-2 md:p-3 text-right font-medium">{{ number_format($item->jumlah / 1000, 0) }}k</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="p-4 text-center text-gray-500">Belum ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Produksi Terbaru -->
                    <div class="bg-white p-4 md:p-6 border rounded-2xl shadow-lg">
                        <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Produksi Terbaru</h3>

                        <div class="overflow-x-auto -mx-4 md:mx-0">
                            <div class="inline-block min-w-full align-middle">
                                <table class="min-w-full text-xs md:text-sm">
                                    <thead>
                                        <tr class="bg-gray-50 border-b">
                                            <th class="p-2 md:p-3 text-left text-gray-600 font-semibold">Tanggal</th>
                                            <th class="p-2 md:p-3 text-right text-gray-600 font-semibold">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @forelse($produksiTerbaru as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-2 md:p-3">
                                                <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-xs">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                                </span>
                                            </td>
                                            <td class="p-2 md:p-3 text-right font-medium">{{ number_format($item->jumlah, 1) }} kg</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="p-4 text-center text-gray-500">Belum ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Penjualan Terbaru -->
                    <div class="bg-white p-4 md:p-6 border rounded-2xl shadow-lg">
                        <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Penjualan Terbaru</h3>

                        <div class="overflow-x-auto -mx-4 md:mx-0">
                            <div class="inline-block min-w-full align-middle">
                                <table class="min-w-full text-xs md:text-sm">
                                    <thead>
                                        <tr class="bg-gray-50 border-b">
                                            <th class="p-2 md:p-3 text-left text-gray-600 font-semibold">Tanggal</th>
                                            <th class="p-2 md:p-3 text-right text-gray-600 font-semibold">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y">
                                        @forelse($penjualanTerbaru as $item)
                                        <tr class="hover:bg-gray-50">
                                            <td class="p-2 md:p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                            <td class="p-2 md:p-3 text-right font-medium">{{ number_format($item->total / 1000, 0) }}k</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="2" class="p-4 text-center text-gray-500">Belum ada data</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <!-- Script -->
    <script>
        // Tanggal
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const fullDate = new Date().toLocaleDateString('id-ID', options);
        const shortDate = new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });

        document.getElementById('currentDate').textContent = window.innerWidth < 768 ? shortDate : fullDate;

        window.addEventListener('resize', () => {
            document.getElementById('currentDate').textContent = window.innerWidth < 768 ? shortDate : fullDate;
        });

        // Chart Produksi Mingguan (Data dari Controller)
        new Chart(document.getElementById('chartProduksi'), {
            type: 'line',
            data: {
                labels: {!! json_encode($chartProduksiLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartProduksiData) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59,130,246,0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: { font: { size: window.innerWidth < 768 ? 10 : 11 } }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: window.innerWidth < 768 ? 10 : 11 } }
                    }
                }
            }
        });

        // Chart Pengeluaran per Kategori (Data dari Controller)
        new Chart(document.getElementById('chartPengeluaran'), {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($chartPengeluaranLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartPengeluaranData) !!},
                    backgroundColor: {!! json_encode($chartPengeluaranColors) !!},
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: { size: window.innerWidth < 768 ? 10 : 11 },
                            padding: window.innerWidth < 768 ? 10 : 15
                        }
                    }
                }
            }
        });

        // Chart Penjualan Harian (Data dari Controller)
        new Chart(document.getElementById('chartPenjualan'), {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartPenjualanLabels) !!},
                datasets: [{
                    data: {!! json_encode($chartPenjualanData) !!},
                    backgroundColor: '#14b8a6',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: v => 'Rp ' + (v / 1000) + 'k',
                            font: { size: window.innerWidth < 768 ? 10 : 11 }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: window.innerWidth < 768 ? 10 : 11 } }
                    }
                }
            }
        });
    </script>

</body>

</html>
