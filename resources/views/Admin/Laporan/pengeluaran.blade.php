@extends('Layout.app')

@section('content')
    <div class="p-6">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Laporan Pengeluaran</h1>
            <p class="text-gray-600 mt-1">Pantau total pengeluaran berdasarkan kategori & rentang tanggal.</p>
        </div>

        <!-- ========== FILTER SECTION ========== -->
        <div class="bg-white shadow-md rounded-xl p-6 mb-6">
            <form method="GET" action="{{ route('admin.laporan.pengeluaran') }}"
                class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <!-- Tanggal Dari -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                        class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Tanggal Sampai -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                        class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500">
                </div>

                <!-- Kategori -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                    <select name="kategori_id" class="w-full border px-3 py-2 rounded-lg focus:ring-2 focus:ring-red-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris as $kat)
                            <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>
                                {{ $kat->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Tombol -->
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg">
                        Filter
                    </button>
                    <a href="{{ route('admin.laporan.pengeluaran') }}"
                        class="px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- ========== STATISTIK ========== -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white shadow-md rounded-xl p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Total Pengeluaran</h3>
                <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Jumlah Transaksi</h3>
                <p class="text-2xl font-bold">{{ $pengeluaran->count() }}</p>
            </div>

            <div class="bg-white shadow-md rounded-xl p-6 text-center">
                <h3 class="text-lg font-semibold text-gray-700 mb-1">Kategori Terpakai</h3>
                <p class="text-2xl font-bold">{{ $chartData->count() }}</p>
            </div>
        </div>


        <!-- ========== BUTTON EXPORT ========== -->
        <div class="flex gap-3 mb-6">
            <a href="{{ route('admin.laporan.pengeluaran.pdf', request()->all()) }}"
                class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-lg font-semibold shadow">
                📄 Export PDF
            </a>
        </div>

        <!-- ========== TABLE DATA ========== -->
        <div class="bg-white shadow-md rounded-xl overflow-hidden">
            <div class="p-6 border-b">
                <h2 class="text-xl font-semibold text-gray-800">Data Pengeluaran</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-gray-700">Tanggal</th>
                            <th class="px-6 py-3 font-semibold text-gray-700">Kategori</th>
                            <th class="px-6 py-3 font-semibold text-gray-700">Karyawan</th>
                            <th class="px-6 py-3 font-semibold text-gray-700">Jumlah</th>
                            <th class="px-6 py-3 font-semibold text-gray-700">Deskripsi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengeluaran as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $item->tanggal->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ $item->kategori->nama_kategori }}</td>
                                <td class="px-6 py-4">{{ $item->karyawan->nama }}</td>
                                <td class="px-6 py-4 font-semibold text-red-600">Rp
                                    {{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">{{ $item->deskripsi ?? '-' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center text-gray-600">
                                    Tidak ada data ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Debug: Cek apakah data tersedia
        console.log('Chart Data:', @json($chartData));

        @if ($chartData->count() > 0)
            const ctx = document.getElementById('pengeluaranChart');

            if (!ctx) {
                console.error('Canvas element tidak ditemukan!');
            } else {
                const dataKategori = @json($chartData->pluck('kategori'));
                const dataTotal = @json($chartData->pluck('total'));

                console.log('Kategori:', dataKategori);
                console.log('Total:', dataTotal);

                // Warna yang lebih menarik
                const colors = [
                    'rgba(239, 68, 68, 0.8)', // red
                    'rgba(59, 130, 246, 0.8)', // blue
                    'rgba(34, 197, 94, 0.8)', // green
                    'rgba(251, 191, 36, 0.8)', // yellow
                    'rgba(168, 85, 247, 0.8)', // purple
                    'rgba(236, 72, 153, 0.8)', // pink
                    'rgba(14, 165, 233, 0.8)', // sky
                    'rgba(249, 115, 22, 0.8)', // orange
                ];

                try {
                    new Chart(ctx, {
                        type: 'pie',
                        data: {
                            labels: dataKategori,
                            datasets: [{
                                label: 'Pengeluaran (Rp)',
                                data: dataTotal,
                                backgroundColor: colors,
                                borderColor: colors.map(c => c.replace('0.8', '1')),
                                borderWidth: 2
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 12
                                        }
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) {
                                                label += ': ';
                                            }
                                            label += 'Rp ' + context.parsed.toLocaleString('id-ID');
                                            return label;
                                        }
                                    }
                                }
                            }
                        }
                    });
                    console.log('Chart berhasil dibuat!');
                } catch (error) {
                    console.error('Error membuat chart:', error);
                }
            }
        @else
            console.log('Tidak ada data untuk chart');
        @endif
    </script>
@endpush
