@extends('Layout.app')

@section('content')
    <div class="p-4 md:p-6">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
            <h1 class="text-xl md:text-2xl font-bold text-gray-800">Data Pengeluaran</h1>
            <a href="{{ route('admin.pengeluaran.create') }}"
                class="bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition text-center font-semibold">
                + Tambah Pengeluaran
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
                <span class="block sm:inline">{{ session('success') }}</span>
                <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3"
                    onclick="this.parentElement.style.display='none'">
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
        @endif

        <!-- Filter Section -->
        <div class="bg-white shadow-md rounded-lg p-4 mb-4">
            <form method="GET" action="{{ route('admin.pengeluaran.index') }}">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                        <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                            class="w-full border p-2 rounded focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                            class="w-full border p-2 rounded focus:ring-2 focus:ring-orange-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategoris_id" class="w-full border p-2 rounded focus:ring-2 focus:ring-orange-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($kategori as $kat)
                                <option value="{{ $kat->id }}"
                                    {{ request('kategoris_id') == $kat->id ? 'selected' : '' }}>
                                    {{ $kat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Karyawan</label>
                        <select name="karyawans_id" class="w-full border p-2 rounded focus:ring-2 focus:ring-orange-500">
                            <option value="">Semua Karyawan</option>
                            @foreach ($karyawan as $kar)
                                <option value="{{ $kar->id }}"
                                    {{ request('karyawans_id') == $kar->id ? 'selected' : '' }}>
                                    {{ $kar->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kandang</label>
                        <select name="kandang_id" class="w-full border p-2 rounded focus:ring-2 focus:ring-orange-500">
                            <option value="">Semua Kandang</option>
                            @foreach ($kandangs as $kd)
                                <option value="{{ $kd->id }}"
                                    {{ request('kandang_id') == $kd->id ? 'selected' : '' }}>
                                    {{ $kd->nama_kandang }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="flex gap-2 mt-4">
                    <button type="submit"
                        class="bg-orange-600 text-white font-semibold px-4 py-2 rounded hover:bg-orange-700 transition flex items-center justify-center ">
                        Filter
                    </button>
                    <a href="{{ route('admin.pengeluaran.index') }}"
                        class="bg-gray-500 text-white font-semibold px-4 py-2 rounded hover:bg-gray-600 transition flex items-center justify-center">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- TABLE CARD -->
        <div class="bg-white shadow-md rounded-lg p-4">

            <!-- WRAPPER UNTUK SCROLL MOBILE -->
            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left min-w-[850px]">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 px-2">No</th>
                            <th class="py-3 px-2">Tanggal</th>
                            <th class="py-3 px-2">Kategori</th>
                            <th class="py-3 px-2">Kandang</th>
                            <th class="py-3 px-2">Karyawan</th>
                            <th class="py-3 px-2">Jumlah</th>
                            <th class="py-3 px-2">Deskripsi</th>
                            <th class="py-3 px-2 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($pengeluaran as $item)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-2">{{ $pengeluaran->firstItem() + $loop->index }}</td>

                                <td class="py-3 px-2">
                                    {{ $item->tanggal->format('d/m/Y') }}
                                </td>

                                <td class="py-3 px-2">
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-orange-100 text-orange-800">
                                        {{ $item->kategori->nama_kategori }}
                                    </span>
                                </td>

                                <td class="py-3 px-2">
                                    @if($item->kandang)
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $item->kandang->nama_kandang }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>

                                <td class="py-3 px-2">{{ $item->karyawan->nama }}</td>

                                <td class="py-3 px-2 font-semibold text-red-600">
                                    Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                                </td>

                                <td class="py-3 px-2">
                                    {{ $item->deskripsi ?: '-' }}
                                </td>

                                <td class="py-3 px-2">
                                    <div class="flex flex-col sm:flex-row sm:justify-center gap-2 w-full">

                                        <a href="{{ route('admin.pengeluaran.edit', $item->id) }}"
                                            class="bg-yellow-500 text-white font-semibold px-3 py-2 rounded text-center w-full sm:w-auto flex items-center justify-center">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            class="w-full sm:w-auto">
                                            @csrf
                                            @method('DELETE')
                                            <button class="bg-red-600 text-white px-3 py-2 rounded w-full sm:w-auto font-semibold">
                                                Hapus
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4 text-gray-500">
                                    Belum ada data pengeluaran.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>

            <!-- PAGINATION -->
            @if ($pengeluaran->hasPages())
                <div class="mt-6 flex flex-col md:flex-row md:justify-between md:items-center gap-4">

                    <!-- INFO (INDONESIA) -->
                    <p class="text-sm text-gray-600">
                        Menampilkan
                        <span class="font-semibold">{{ $pengeluaran->firstItem() }}</span>
                        sampai
                        <span class="font-semibold">{{ $pengeluaran->lastItem() }}</span>
                        dari
                        <span class="font-semibold">{{ $pengeluaran->total() }}</span>
                        data
                    </p>

                    <!-- PAGINATION LINK -->
                    <div class="flex justify-center md:justify-end">
                        {{ $pengeluaran->withQueryString()->onEachSide(1)->links('pagination::tailwind') }}
                    </div>

                </div>
            @endif


        </div>
    </div>
@endsection
