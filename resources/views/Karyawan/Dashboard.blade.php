<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - DWI FARM</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen bg-[#C9B5A0] flex">

@include('karyawan.sidebar')

<main class="flex-1 p-6 md:p-8">

    <h1 class="text-3xl font-bold text-white mb-6">Dashboard Karyawan</h1>

    <!-- WIDGET -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Total Produksi Telur -->
        <div class="bg-purple-600 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Total Produksi Telur</p>
            <p class="text-3xl font-bold mt-2">
                {{ number_format($totalProduksiTelur ?? 0, 0) }} Butir
            </p>
        </div>

        <!-- Produksi Hari Ini -->
        <div class="bg-orange-500 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Produksi Hari Ini</p>
            <p class="text-3xl font-bold mt-2">
                {{ number_format($produksiHariIni ?? 0, 0) }} Butir
            </p>
        </div>

        <!-- Produksi Bulan Ini -->
        <div class="bg-pink-500 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Produksi Bulan Ini</p>
            <p class="text-3xl font-bold mt-2">
                {{ number_format($produksiBulanIni ?? 0, 0) }} Butir
            </p>
        </div>

    </div>

    <!-- WIDGET PENGGUNAAN PAKAN -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Total Pakan -->
        <div class="bg-green-600 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Total Penggunaan Pakan</p>
            <p class="text-3xl font-bold mt-2">
                {{ number_format($totalPenggunaanPakan, 2) }} Kg
            </p>
        </div>

        <!-- Transaksi -->
        <div class="bg-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Total Transaksi</p>
            <p class="text-3xl font-bold mt-2">
                {{ $totalTransaksi }}
            </p>
        </div>

        <!-- Hari Ini -->
        <div class="bg-yellow-500 rounded-2xl p-6 text-white shadow-lg">
            <p class="text-sm opacity-80">Penggunaan Hari Ini</p>
            <p class="text-3xl font-bold mt-2">
                {{ number_format($penggunaanHariIni, 2) }} Kg
            </p>
        </div>

    </div>

    <!-- TABEL DATA TERBARU -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-bold text-gray-800">Penggunaan Pakan Terbaru</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 text-gray-700 text-sm">
                    <tr>
                        <th class="p-4 text-left">Tanggal</th>
                        <th class="p-4 text-left">Kandang</th>
                        <th class="p-4 text-left">Pakan</th>
                        <th class="p-4 text-left">Jumlah</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($penggunaanTerbaru as $item)
                        <tr class="hover:bg-gray-50">
                            <td class="p-4">
                                {{ $item->tanggal->format('d/m/Y') }}
                            </td>
                            <td class="p-4">{{ $item->kandang->nama_kandang }}</td>
                            <td class="p-4">{{ $item->pakan->nama_pakan }}</td>
                            <td class="p-4 font-semibold">
                                {{ number_format($item->jumlah, 2) }} Kg
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-10 text-gray-500">
                                Belum ada data penggunaan pakan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t text-right">
            <a href="{{ route('karyawan.penggunaan-pakan.index') }}"
               class="text-blue-600 hover:underline text-sm font-medium">
                Lihat Semua →
            </a>
        </div>
    </div>

</main>
</body>
</html>