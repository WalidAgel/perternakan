@extends('Layout.app')

@section('content')
<div class="p-4 md:p-6">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-3 mb-6">
        <h1 class="text-xl md:text-2xl font-bold text-gray-800">Pembelian Pakan</h1>
        <a href="{{ route('admin.pembelian-pakan.create') }}"
           class="px-4 py-2 bg-orange-600 hover:bg-orange-700 text-white rounded-lg shadow font-semibold text-center">
            + Tambah Pembelian
        </a>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
    @endif

    {{-- FILTER --}}
    <div class="bg-white shadow rounded-xl p-4 md:p-5 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="text-sm font-semibold">Pakan</label>
                <select name="pakan_id" class="w-full mt-1 border rounded-lg p-2">
                    <option value="">-- Semua Pakan --</option>
                    @foreach ($pakans as $p)
                        <option value="{{ $p->id }}" {{ request('pakan_id') == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_pakan }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="text-sm font-semibold">Tanggal Dari</label>
                <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                       class="w-full mt-1 border rounded-lg p-2">
            </div>

            <div>
                <label class="text-sm font-semibold">Tanggal Sampai</label>
                <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                       class="w-full mt-1 border rounded-lg p-2">
            </div>

            <div class="flex items-end">
                <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 rounded-lg font-semibold">
                    Filter
                </button>
            </div>
        </form>
    </div>

    {{-- ================= MOBILE CARD ================= --}}
    <div class="space-y-4 md:hidden">
        @forelse ($pembelianPakans as $pembelian)
        <div class="bg-white shadow rounded-xl p-4">
            <div class="flex justify-between mb-2">
                <span class="text-sm text-gray-500">
                    {{ $pembelian->tanggal->format('d/m/Y') }}
                </span>
                <span class="text-sm font-bold text-green-600">
                    Rp {{ number_format($pembelian->total_harga, 0, ',', '.') }}
                </span>
            </div>

            <p class="font-semibold text-gray-800">{{ $pembelian->pakan->nama_pakan }}</p>

            <div class="text-sm text-gray-600 mt-2 space-y-1">
                <p>Jumlah : {{ number_format($pembelian->jumlah,2,',','.') }} Kg</p>
                <p>Harga : Rp {{ number_format($pembelian->harga_satuan,0,',','.') }}</p>
                <p>Karyawan : {{ $pembelian->karyawan->nama }}</p>
            </div>

            <div class="flex gap-2 mt-4">
                <a href="{{ route('admin.pembelian-pakan.edit', $pembelian->id) }}"
                   class="flex-1 text-center bg-yellow-400 hover:bg-yellow-500 text-white py-2 rounded-lg text-sm font-semibold">
                    Edit
                </a>
                <form action="{{ route('admin.pembelian-pakan.destroy', $pembelian->id) }}" method="POST"
                      onsubmit="return confirm('Yakin ingin menghapus?')" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 rounded-lg text-sm font-semibold">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
            <p class="text-center text-gray-500">Belum ada data</p>
        @endforelse
    </div>

    {{-- ================= DESKTOP TABLE ================= --}}
    <div class="hidden md:block bg-white shadow rounded-xl overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 text-sm uppercase">
                <tr>
                    <th class="p-3 text-left">No</th>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Pakan</th>
                    <th class="p-3 text-left">Jumlah</th>
                    <th class="p-3 text-left">Harga</th>
                    <th class="p-3 text-left">Total</th>
                    <th class="p-3 text-left">Karyawan</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pembelianPakans as $i => $pembelian)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">{{ $pembelianPakans->firstItem() + $i }}</td>
                    <td class="p-3">{{ $pembelian->tanggal->format('d/m/Y') }}</td>
                    <td class="p-3">{{ $pembelian->pakan->nama_pakan }}</td>
                    <td class="p-3">{{ number_format($pembelian->jumlah,2,',','.') }} Kg</td>
                    <td class="p-3">Rp {{ number_format($pembelian->harga_satuan,0,',','.') }}</td>
                    <td class="p-3 font-bold text-green-600">
                        Rp {{ number_format($pembelian->total_harga,0,',','.') }}
                    </td>
                    <td class="p-3">{{ $pembelian->karyawan->nama }}</td>
                    <td class="p-3 text-center">
                        <div class="flex justify-center gap-2">
                            <a href="{{ route('admin.pembelian-pakan.edit',$pembelian->id) }}"
                               class="px-3 py-1 bg-yellow-400 text-white rounded">Edit</a>
                            <form action="{{ route('admin.pembelian-pakan.destroy',$pembelian->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    <div class="mt-4">
        {{ $pembelianPakans->links() }}
    </div>

</div>
@endsection
