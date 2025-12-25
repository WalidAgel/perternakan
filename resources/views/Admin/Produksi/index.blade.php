@extends('Layout.app')

@section('content')
<div class="p-4 md:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800">Produksi Telur</h1>

        <a href="{{ route('admin.produksi.create') }}"
           class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold text-center">
            + Tambah Produksi
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- FILTER --}}
    <div class="bg-white shadow rounded-xl p-4 md:p-5 mb-4">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-semibold text-gray-700">Tanggal</label>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Kandang</label>
                <select name="kandang_id"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white">
                    <option value="">-- Semua Kandang --</option>
                    @foreach ($kandangs as $k)
                        <option value="{{ $k->id }}" {{ request('kandang_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama_kandang }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold text-gray-700">Karyawan</label>
                <select name="karyawan_id"
                    class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white">
                    <option value="">-- Semua Karyawan --</option>
                    @foreach ($karyawans as $k)
                        <option value="{{ $k->id }}" {{ request('karyawan_id') == $k->id ? 'selected' : '' }}>
                            {{ $k->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-end">
                <button
                    class="w-full px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- TABLE (SCROLLABLE) --}}
    <div class="bg-white shadow rounded-xl overflow-x-auto">
        <table class="w-full min-w-max">
            <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                <tr>
                    <th class="p-3 text-left whitespace-nowrap">Tanggal</th>
                    <th class="p-3 text-left whitespace-nowrap">Kandang</th>
                    <th class="p-3 text-left whitespace-nowrap">Karyawan</th>
                    <th class="p-3 text-left whitespace-nowrap">Telur Bagus</th>
                    <th class="p-3 text-left whitespace-nowrap">Telur Rusak</th>
                    <th class="p-3 text-left whitespace-nowrap">Total</th>
                    <th class="p-3 text-left whitespace-nowrap">Catatan</th>
                    <th class="p-3 text-center whitespace-nowrap">Aksi</th>
                </tr>
            </thead>

            <tbody class="text-gray-800">
                @forelse ($produksi as $p)
                <tr class="border-b hover:bg-gray-50 transition">
                    <td class="p-3 whitespace-nowrap">
                        {{ $p->tanggal->format('d/m/Y') }}
                    </td>

                    <td class="p-3 whitespace-nowrap font-medium">
                        {{ $p->kandang->nama_kandang ?? '-' }}
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        {{ $p->karyawan->nama }}
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                            {{ $p->jumlah_bagus }} butir
                        </span>
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                            {{ $p->jumlah_rusak }} butir
                        </span>
                    </td>

                    <td class="p-3 whitespace-nowrap font-semibold text-blue-600">
                        {{ $p->jumlah }} butir
                    </td>

                    <td class="p-3 max-w-xs truncate">
                        {{ $p->catatan ?? '-' }}
                    </td>

                    <td class="p-3 whitespace-nowrap">
                        <div class="flex gap-2 justify-center">
                            <a href="{{ route('admin.produksi.edit', $p->id) }}"
                               class="px-3 py-2 bg-yellow-400 hover:bg-yellow-500 text-white rounded text-sm font-semibold">
                                Edit
                            </a>

                            <form action="{{ route('admin.produksi.destroy', $p->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="px-3 py-2 bg-red-600 hover:bg-red-700 text-white rounded text-sm font-semibold">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-gray-500 p-5">
                        Belum ada data produksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
