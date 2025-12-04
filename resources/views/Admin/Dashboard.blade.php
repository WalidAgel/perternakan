<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - DWI FARM</title>

    @vite('resources/css/app.css')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="min-h-screen bg-gradient-to-br from-[#B9997F] to-[#A8886E] flex">


    @include('Layout.sidebar')

    <div class="flex-1 p-4 md:p-5 overflow-y-auto pt-20 md:pt-5">
        <div class="w-full max-w-7xl mx-auto">

            <!-- Header -->
            <div class="mb-6 md:mb-8 flex items-center justify-between flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-1 md:mb-2">Dashboard</h1>
                    <p class="text-white/80 text-xs md:text-sm">Selamat datang kembali! Berikut ringkasan bisnis Anda hari ini</p>
                </div>
                <div class="text-white/90 text-xs md:text-sm">
                    <span id="currentDate"></span>
                </div>
            </div>


            <!-- Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 mb-8 md:mb-10">
                <div class="bg-white border border-gray-200 shadow-lg rounded-xl md:rounded-2xl p-5 md:p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-2 md:mb-3">
                        <h2 class="text-gray-500 text-xs md:text-sm font-medium">Produksi Hari Ini</h2>
                        <div class="bg-blue-100 p-1.5 md:p-2 rounded-lg">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl md:text-4xl font-extrabold text-gray-800">320</p>
                    <p class="text-gray-600 text-xs md:text-sm mt-1 md:mt-2">Butir</p>
                    <div class="mt-3 md:mt-4 flex items-center text-green-600 text-xs md:text-sm">
                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                        <span>+5% dari kemarin</span>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-lg rounded-xl md:rounded-2xl p-5 md:p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-2 md:mb-3">
                        <h2 class="text-gray-500 text-xs md:text-sm font-medium">Pengeluaran Hari Ini</h2>
                        <div class="bg-red-100 p-1.5 md:p-2 rounded-lg">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl md:text-4xl font-extrabold text-gray-800">Rp 450.000</p>
                    <p class="text-gray-600 text-xs md:text-sm mt-1 md:mt-2">Total biaya operasional</p>
                    <div class="mt-3 md:mt-4 flex items-center text-gray-500 text-xs md:text-sm">
                        <span>2 transaksi tercatat</span>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 shadow-lg rounded-xl md:rounded-2xl p-5 md:p-8 hover:shadow-xl transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-2 md:mb-3">
                        <h2 class="text-gray-500 text-xs md:text-sm font-medium">Penjualan Hari Ini</h2>
                        <div class="bg-green-100 p-1.5 md:p-2 rounded-lg">
                            <svg class="w-4 h-4 md:w-5 md:h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="text-3xl md:text-4xl font-extrabold text-gray-800">Rp 1.200.000</p>
                    <p class="text-gray-600 text-xs md:text-sm mt-1 md:mt-2">Pendapatan kotor</p>
                    <div class="mt-3 md:mt-4 flex items-center text-green-600 text-xs md:text-sm">
                        <svg class="w-3 h-3 md:w-4 md:h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"></path>
                        </svg>
                        <span>+12% dari kemarin</span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-8 mb-8 md:mb-12">

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Produksi per Minggu</h3>
                    <canvas id="chartProduksi"></canvas>
                </div>

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Pengeluaran per Kategori</h3>
                    <canvas id="chartPengeluaran"></canvas>
                </div>

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Penjualan Harian</h3>
                    <canvas id="chartPenjualan"></canvas>
                </div>

            </div>

            <!-- Tables -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 md:gap-6">

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Pengeluaran Terbaru</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs md:text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-2 md:p-3 text-left font-semibold text-gray-600">Tanggal</th>
                                    <th class="p-2 md:p-3 text-left font-semibold text-gray-600">Kategori</th>
                                    <th class="p-2 md:p-3 text-right font-semibold text-gray-600">Jumlah</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-2 md:p-3 text-gray-700">01/12</td>
                                    <td class="p-2 md:p-3">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-medium">Pakan</span>
                                    </td>
                                    <td class="p-2 md:p-3 text-right font-medium text-gray-800">200k</td>
                                </tr>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-2 md:p-3 text-gray-700">01/12</td>
                                    <td class="p-2 md:p-3">
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">Vitamin</span>
                                    </td>
                                    <td class="p-2 md:p-3 text-right font-medium text-gray-800">150k</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Produksi Terbaru</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs md:text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-2 md:p-3 text-left font-semibold text-gray-600">Tanggal</th>
                                    <th class="p-2 md:p-3 text-right font-semibold text-gray-600">Jumlah (Butir)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-2 md:p-3 text-gray-700">01/12/2025</td>
                                    <td class="p-2 md:p-3 text-right font-medium text-gray-800">320</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white p-4 md:p-6 border border-gray-200 rounded-xl md:rounded-2xl shadow-lg">
                    <h3 class="font-semibold mb-3 md:mb-4 text-gray-800 text-base md:text-lg">Penjualan Terbaru</h3>

                    <div class="overflow-x-auto">
                        <table class="w-full text-xs md:text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-2 md:p-3 text-left font-semibold text-gray-600">Tanggal</th>
                                    <th class="p-2 md:p-3 text-right font-semibold text-gray-600">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="p-2 md:p-3 text-gray-700">01/12/2025</td>
                                    <td class="p-2 md:p-3 text-right font-medium text-gray-800">350k</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        // Display current date
        const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
        const currentDate = new Date().toLocaleDateString('id-ID', options);
        document.getElementById('currentDate').textContent = window.innerWidth < 768 ?
            new Date().toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) :
            currentDate;

        // Produksi Mingguan
        new Chart(document.getElementById('chartProduksi'), {
            type: 'line',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Butir',
                    data: [300, 320, 310, 330, 340, 350, 360],
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#3b82f6',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        grid: {
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Pengeluaran Kategori
        new Chart(document.getElementById('chartPengeluaran'), {
            type: 'doughnut',
            data: {
                labels: ['Pakan', 'Obat', 'Vitamin', 'Listrik'],
                datasets: [{
                    data: [50, 15, 20, 15],
                    backgroundColor: ['#3b82f6', '#ef4444', '#f59e0b', '#10b981'],
                    borderWidth: 0,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 10,
                            usePointStyle: true,
                            font: {
                                size: window.innerWidth < 768 ? 10 : 12
                            }
                        }
                    }
                }
            }
        });

        // Penjualan Harian
        new Chart(document.getElementById('chartPenjualan'), {
            type: 'bar',
            data: {
                labels: ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'],
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: [800000, 750000, 900000, 1000000, 1100000, 950000, 1200000],
                    backgroundColor: '#14b8a6',
                    borderRadius: 8,
                    barThickness: window.innerWidth < 768 ? 16 : 24
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false
                        },
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + (value/1000) + 'k';
                            },
                            font: {
                                size: window.innerWidth < 768 ? 9 : 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                size: window.innerWidth < 768 ? 9 : 11
                            }
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>
