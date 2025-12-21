@extends('Layout.app')

@section('content')
    <div class="p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Produksi Telur</h1>

            <a href="{{ route('admin.produksi.create') }}"
                class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold">
                + Tambah Produksi
            </a>
        </div>

        @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white shadow rounded-xl p-5 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="text-sm font-semibold text-gray-700">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                        class="w-full mt-1 border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-orange-300">
                </div>

                <div>
                    <label class="text-sm font-semibold text-gray-700">Kandang</label>
                    <select name="kandang_id"
                        class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
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
                        class="w-full mt-1 border-gray-300 rounded-lg p-2 bg-white focus:ring-2 focus:ring-orange-300">
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

        <div class="bg-white shadow rounded-xl overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 text-gray-700 text-sm uppercase">
                    <tr>
                        <th class="p-3 text-left">Tanggal</th>
                        <th class="p-3 text-left">Kandang</th>
                        <th class="p-3 text-left">Karyawan</th>
                        <th class="p-3 text-left">Telur Bagus</th>
                        <th class="p-3 text-left">Telur Rusak</th>
                        <th class="p-3 text-left">Total</th>
                        <th class="p-3 text-left">Catatan</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-800">
                    @forelse ($produksi as $p)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-3">
                                <span class="px-2 py-1 rounded-lg bg-gray-100 text-gray-700 text-sm">
                                    {{ $p->tanggal->format('d/m/Y') }}
                                </span>
                            </td>

                            <td class="p-3 font-medium text-gray-700">
                                {{ $p->kandang->nama_kandang ?? '-' }}
                            </td>

                            <td class="p-3 text-gray-700">
                                {{ $p->karyawan->nama }}
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">
                                    {{ $p->jumlah_bagus }} butir
                                </span>
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">
                                    {{ $p->jumlah_rusak }} butir
                                </span>
                            </td>

                            <td class="p-3">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm font-semibold">
                                    {{ $p->jumlah }} butir
                                </span>
                            </td>

                            <td class="p-3 text-gray-600">
                                {{ $p->catatan ?? '-' }}
                            </td>

                            <td class="p-3">
                                <div class="flex items-center justify-center gap-3">
                                    <a href="{{ route('admin.produksi.edit', $p->id) }}"
                                        class="px-4 py-2 bg-yellow-400 hover:bg-yellow-500 text-white font-semibold rounded-md transition shadow text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.produksi.destroy', $p->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-md transition shadow text-sm">
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
