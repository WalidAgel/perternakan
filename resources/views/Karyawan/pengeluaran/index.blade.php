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
                <h1 class="text-3xl font-bold text-white mb-2"> Riwayat Pengeluaran</h1>
                <p class="text-white/80">Lihat dan kelola riwayat pengeluaran operasional</p>
            </div>

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
                                            <button onclick="showImage('{{ asset('uploads/bukti/' . $item->bukti) }}')"
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
    </script>

</body>

</html>
