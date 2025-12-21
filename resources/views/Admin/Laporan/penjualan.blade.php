@extends('Layout.app')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">💵 Laporan Penjualan</h1>
            <p class="text-gray-600 mt-2">Analisis dan monitoring pendapatan penjualan telur</p>
        </div>

        {{-- FILTER CARD --}}
        <div class="bg-white shadow-lg rounded-xl p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                </svg>
                Filter Laporan
            </h2>

            <form method="GET" action="{{ route('admin.laporan.penjualan') }}"
                class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                        class="w-full border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                        class="w-full border-gray-300 rounded-lg p-2.5 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 px-4 py-2.5 bg-orange-600 hover:bg-orange-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                        Filter
                    </button>
                    <a href="{{ route('admin.laporan.penjualan') }}"
                        class="px-4 py-2.5 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transition duration-300">
                        ↻
                    </a>
                </div>
            </form>
        </div>

        {{-- STATISTIK CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-linear-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium">Total Pendapatan</p>
                        <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                        <p class="text-green-100 text-sm mt-1">Dari {{ $totalTransaksi }} Transaksi</p>
                    </div>
                </div>
            </div>

            <div class="bg-linear-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium">Total Terjual</p>
                        <p class="text-3xl font-bold mt-2">{{ number_format($totalTerjual, 0, ',', '.') }}</p>
                        <p class="text-blue-100 text-sm mt-1">Kilogram</p>
                    </div>
                </div>
            </div>

            <div class="bg-linear-to-br from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium">Rata-rata/Transaksi</p>
                        <p class="text-3xl font-bold mt-2">
                            Rp {{ $totalTransaksi > 0 ? number_format($totalPenjualan / $totalTransaksi, 0, ',', '.') : 0 }}
                        </p>
                        <p class="text-purple-100 text-sm mt-1">Per Penjualan</p>
                    </div>
                </div>
            </div>
        </div>



        {{-- EXPORT BUTTONS --}}
        <div class="flex gap-3 mb-6">
            <form method="GET" action="{{ route('admin.laporan.penjualan.pdf') }}" class="inline">
                <input type="hidden" name="tanggal_dari" value="{{ request('tanggal_dari') }}">
                <input type="hidden" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}">
                <button type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z"
                            clip-rule="evenodd" />
                    </svg>
                    Export PDF
                </button>
            </form>

        </div>

        {{-- TABLE --}}
        <div class="bg-white shadow-lg rounded-xl overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Data Penjualan</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                        <tr>
                            <th class="p-4 text-left font-semibold">No</th>
                            <th class="p-4 text-left font-semibold">Tanggal</th>
                            <th class="p-4 text-left font-semibold">Produksi</th>
                            <th class="p-4 text-left font-semibold">Jumlah Terjual</th>
                            <th class="p-4 text-left font-semibold">Harga/Kg</th>
                            <th class="p-4 text-left font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-800 divide-y divide-gray-200">
                        @forelse($penjualan as $index => $item)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="p-4">{{ $index + 1 }}</td>
                                <td class="p-4">
                                    <span
                                        class="text-sm font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</span>
                                </td>
                                <td class="p-4">
                                    @if ($item->produksiTelur)
                                        <span
                                            class="px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-semibold">
                                            Produksi #{{ $item->produksiTelur->id }}
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-sm">-</span>
                                    @endif
                                </td>
                                <td class="p-4">
                                    <span class="font-semibold text-orange-600">{{ number_format($item->jumlah_terjual, 2) }}
                                        kg</span>
                                </td>
                                <td class="p-4">
                                    <span class="text-gray-700">Rp
                                        {{ number_format($item->harga_per_kg, 0, ',', '.') }}</span>
                                </td>
                                <td class="p-4">
                                    <span class="text-green-600 font-bold text-lg">Rp
                                        {{ number_format($item->total, 0, ',', '.') }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-8 text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    <p class="font-medium">Tidak ada data penjualan</p>
                                    <p class="text-sm mt-1">Coba ubah filter pencarian</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot class="bg-gray-50 font-bold">
                        <tr>
                            <td colspan="5" class="p-4 text-right text-gray-700">TOTAL PENDAPATAN:</td>
                            <td class="p-4 text-green-600 text-xl">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    {{-- CHART.JS SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const chartData = @json($chartData);

        const ctx = document.getElementById('lineChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: chartData.map(item => {
                    const date = new Date(item.tanggal);
                    return date.toLocaleDateString('id-ID', {
                        day: 'numeric',
                        month: 'short'
                    });
                }),
                datasets: [{
                    label: 'Pendapatan (Rp)',
                    data: chartData.map(item => item.total),
                    borderColor: '#10B981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#10B981',
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
                        position: 'top',
                        labels: {
                            padding: 20,
                            font: {
                                size: 13,
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
                                return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return 'Rp ' + value.toLocaleString('id-ID');
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
@endsection
