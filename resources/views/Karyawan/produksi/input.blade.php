<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Produksi - DWI FARM</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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
                <h1 class="text-3xl font-bold text-white mb-2">🥚 Input Produksi Telur</h1>
                <p class="text-white/80">Catat hasil produksi telur harian Anda</p>
            </div>

            <!-- Alert Success/Error -->
            @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg mb-6 flex items-center justify-between animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-green-700 hover:text-green-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6 flex items-center justify-between animate-fade-in">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-red-700 hover:text-red-900">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            @endif

            <!-- Form Input -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 mb-8">
                <div class="flex items-center mb-6">
                    <div class="bg-blue-100 p-3 rounded-xl mr-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">Form Input Produksi</h2>
                        <p class="text-sm text-gray-600">Isi data produksi telur hari ini</p>
                    </div>
                </div>

                <form action="{{ route('karyawan.produksi.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Tanggal -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Tanggal Produksi <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                                <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('tanggal') border-red-500 @enderror">
                            </div>
                            @error('tanggal')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jumlah Telur -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Jumlah Telur (Kg) <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/>
                                    </svg>
                                </div>
                                <input type="number" name="jumlah" value="{{ old('jumlah') }}" step="0.01" min="0" required
                                    placeholder="Contoh: 120.5"
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('jumlah') border-red-500 @enderror">
                            </div>
                            @error('jumlah')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Kualitas Telur -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            Kualitas Telur <span class="text-red-600">*</span>
                        </label>
                        <div class="grid grid-cols-3 gap-4">

                            <!-- Grade A -->
                            <label class="relative flex flex-col items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-green-500 transition group @error('kualitas') border-red-500 @enderror">
                                <input type="radio" name="kualitas" value="A" {{ old('kualitas') === 'A' ? 'checked' : '' }} required
                                    class="absolute top-3 right-3 w-5 h-5 text-green-600">
                                <div class="text-4xl mb-2 group-hover:scale-110 transition">🥚</div>
                                <span class="font-bold text-lg text-gray-800">Grade A</span>
                                <span class="text-xs text-gray-500 mt-1">Kualitas Terbaik</span>
                            </label>

                            <!-- Grade B -->
                            <label class="relative flex flex-col items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-yellow-500 transition group @error('kualitas') border-red-500 @enderror">
                                <input type="radio" name="kualitas" value="B" {{ old('kualitas') === 'B' ? 'checked' : '' }} required
                                    class="absolute top-3 right-3 w-5 h-5 text-yellow-600">
                                <div class="text-4xl mb-2 group-hover:scale-110 transition">🥚</div>
                                <span class="font-bold text-lg text-gray-800">Grade B</span>
                                <span class="text-xs text-gray-500 mt-1">Kualitas Sedang</span>
                            </label>

                            <!-- Grade C -->
                            <label class="relative flex flex-col items-center p-4 border-2 border-gray-300 rounded-xl cursor-pointer hover:border-red-500 transition group @error('kualitas') border-red-500 @enderror">
                                <input type="radio" name="kualitas" value="C" {{ old('kualitas') === 'C' ? 'checked' : '' }} required
                                    class="absolute top-3 right-3 w-5 h-5 text-red-600">
                                <div class="text-4xl mb-2 group-hover:scale-110 transition">🥚</div>
                                <span class="font-bold text-lg text-gray-800">Grade C</span>
                                <span class="text-xs text-gray-500 mt-1">Kualitas Rendah</span>
                            </label>

                        </div>
                        @error('kualitas')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Catatan -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Catatan <span class="text-gray-400">(Opsional)</span>
                        </label>
                        <textarea name="keterangan" rows="4"
                            placeholder="Tambahkan catatan atau informasi tambahan tentang produksi hari ini..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('keterangan') border-red-500 @enderror">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Contoh: Cuaca cerah, ayam dalam kondisi sehat</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4 border-t border-gray-200">
                        <button type="submit"
                            class="flex-1 md:flex-none px-8 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Produksi
                        </button>
                        <button type="reset"
                            class="px-6 py-3 bg-gray-500 hover:bg-gray-600 text-white font-semibold rounded-lg shadow-md transition duration-300 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset
                        </button>
                    </div>

                </form>
            </div>

            <!-- Riwayat Input Hari Ini -->
            <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="bg-green-100 p-3 rounded-xl mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">Input Hari Ini</h2>
                            <p class="text-sm text-gray-600">{{ date('d F Y') }}</p>
                        </div>
                    </div>
                    <a href="{{ route('karyawan.riwayat.produksi') }}"
                        class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center gap-1">
                        Lihat Semua
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                            <tr>
                                <th class="p-4 text-left font-semibold">Waktu</th>
                                <th class="p-4 text-left font-semibold">Jumlah (Kg)</th>
                                <th class="p-4 text-left font-semibold">Kualitas</th>
                                <th class="p-4 text-left font-semibold">Keterangan</th>
                                <th class="p-4 text-center font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-800 divide-y divide-gray-200">
                            @forelse($produksiHariIni ?? [] as $item)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">{{ $item->created_at->format('H:i') }} WIB</td>
                                <td class="p-4 font-semibold text-blue-600">{{ number_format($item->jumlah, 2) }} Kg</td>
                                <td class="p-4">
                                    @if($item->kualitas == 'A')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold">Grade A</span>
                                    @elseif($item->kualitas == 'B')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-semibold">Grade B</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-semibold">Grade C</span>
                                    @endif
                                </td>
                                <td class="p-4 text-sm text-gray-600">{{ $item->keterangan ?: '-' }}</td>
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
                                <td colspan="5" class="text-center py-8 text-gray-500">
                                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                                    </svg>
                                    <p class="font-medium">Belum ada input produksi hari ini</p>
                                    <p class="text-sm mt-1">Isi form di atas untuk menambah data</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

    </main>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            sidebar.classList.toggle("-translate-x-full");
        }
    </script>

</body>

</html>
