@extends('Layout.app')

@section('content')
<div class="p-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Data Pengeluaran</h1>
        <a href="{{ route('admin.pengeluaran.create') }}"
           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
            + Tambah Pengeluaran
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 relative">
        <span class="block sm:inline">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.style.display='none'">
            <span class="text-2xl">&times;</span>
        </button>
    </div>
    @endif

    <!-- Filter Section -->
    <div class="bg-white shadow-md rounded-lg p-4 mb-4">
        <form method="GET" action="{{ route('admin.pengeluaran.index') }}">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Filter Tanggal Dari -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Dari</label>
                    <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                           class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filter Tanggal Sampai -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Sampai</label>
                    <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                           class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filter Kategori -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select name="kategoris_id"
                            class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Kategori</option>
                        @foreach($kategori as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategoris_id') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama_kategori }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Karyawan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Karyawan</label>
                    <select name="karyawans_id"
                            class="w-full border p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Semua Karyawan</option>
                        @foreach($karyawan as $kar)
                        <option value="{{ $kar->id }}" {{ request('karyawans_id') == $kar->id ? 'selected' : '' }}>
                            {{ $kar->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Button Filter -->
            <div class="flex gap-2 mt-4">
                <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Filter
                </button>
                <a href="{{ route('admin.pengeluaran.index') }}"
                   class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg p-4">
        <table class="w-full text-sm text-left">
            <thead>
                <tr class="border-b">
                    <th class="py-3 px-2">No</th>
                    <th class="py-3 px-2">Tanggal</th>
                    <th class="py-3 px-2">Kategori</th>
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
                    <td class="py-3 px-2">{{ $item->tanggal->format('d/m/Y') }}</td>
                    <td class="py-3 px-2">
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                            {{ $item->kategori->nama_kategori }}
                        </span>
                    </td>
                    <td class="py-3 px-2">{{ $item->karyawan->nama }}</td>
                    <td class="py-3 px-2 font-semibold text-red-600">
                        Rp {{ number_format($item->jumlah, 0, ',', '.') }}
                    </td>
                    <td class="py-3 px-2">{{ $item->deskripsi ?: '-' }}</td>
                    <td class="py-3 px-2 flex gap-2 justify-center">
                        <a href="{{ route('admin.pengeluaran.edit', $item->id) }}"
                           class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                            Edit
                        </a>
                        <form action="{{ route('admin.pengeluaran.destroy', $item->id) }}"
                              method="POST"
                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">
                        Belum ada data pengeluaran.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pengeluaran->links() }}
        </div>
    </div>
</div>
@endsection
