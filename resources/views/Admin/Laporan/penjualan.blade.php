@extends('Layout.app')

@section('content')

<div class="mb-6">
    <h1 class="text-3xl font-bold text-gray-800">💵 Laporan Penjualan</h1>
    <p class="text-gray-600 mt-2">Analisis dan monitoring pendapatan penjualan telur</p>
</div>

{{-- FILTER CARD --}}
<div class="bg-white shadow-lg rounded-xl p-6 mb-6">
    <h2 class="text-lg font-semibold mb-4 flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
        </svg>
        Filter Laporan
    </h2>

    <form method="GET" action="{{ route('admin.laporan.penjualan') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300">
                🔍 Filter
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
    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-green-100 text-sm font-medium">Total Pendapatan</p>
                <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</p>
                <p class="text-green-100 text-sm mt-1">Dari {{ $totalTransaksi }} Transaksi</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"/>
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-blue-100 text-sm font-medium">Total Terjual</p>
                <p class="text-3xl font-bold mt-2">{{ number_format($totalTerjual, 0, ',', '.') }}</p>
                <p class="text-blue-100 text-sm mt-1">Kilogram</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"/>
                </svg>
            </div>
        </div>
    </div>

    <div class="bg-gradient-to-br from-purple-500 to-purple-600 text-white rounded-xl p-6 shadow-lg">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-purple-100 text-sm font-medium">Rata-rata/Transaksi</p>
                <p class="text-3xl font-bold mt-2">
                    Rp {{ $totalTransaksi > 0 ? number_format($totalPenjualan / $totalTransaksi, 0, ',', '.') : 0 }}
                </p>
                <p class="text-purple-100 text-sm mt-1">Per Penjualan</p>
            </div>
            <div class="bg-white bg-opacity-20 rounded-full p-4">
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z"/>
                </svg>
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
                <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
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
                        <span class="text-sm font-medium">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</span>
                    </td>
                    <td class="p-4">
                        @if($item->produksiTelur)
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-semibold">
                            Produksi #{{ $item->produksiTelur->id }}
                        </span>
                        @else
                        <span class="text-gray-400 text-sm">-</span>
                        @endif
                    </td>
                    <td class="p-4">
                        <span class="font-semibold text-blue-600">{{ number_format($item->jumlah_terjual, 2) }} kg</span>
                    </td>
                    <td class="p-4">
                        <span class="text-gray-700">Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}</span>
                    </td>
                    <td class="p-4">
                        <span class="text-green-600 font-bold text-lg">Rp {{ number_format($item->total, 0, ',', '.') }}</span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-8 text-gray-500">
                        <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
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
                    <td class="p-4 text-green-600 text-xl">Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>
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
            return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
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
