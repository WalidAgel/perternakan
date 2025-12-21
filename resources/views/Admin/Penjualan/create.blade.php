@extends('Layout.app')

@section('content')
    {{-- HEADER HIJAU --}}
    <div class="mb-8">
        <div class="bg-orange-600 rounded-2xl px-8 py-6 flex items-center justify-between shadow-lg">
            <div>
                <h1 class="text-3xl font-bold text-white">Input Penjualan</h1>
                <p class="text-orange-100 mt-1">
                    Catat transaksi penjualan telur secara akurat
                </p>
            </div>

            <a href="{{ route('admin.penjualan.index') }}"
                class="inline-flex items-center gap-2 px-5 py-2.5
                  bg-orange-500 hover:bg-orange-700
                  text-white font-semibold rounded-xl transition">
                ← Kembali
            </a>
        </div>
    </div>

    {{-- CARD FORM --}}
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        {{-- CARD HEADER --}}
        <div class="px-8 py-6 border-b">
            <h2 class="text-2xl font-bold text-gray-800">Form Input Penjualan</h2>
            <p class="text-gray-500 mt-1">
                Lengkapi data penjualan dan detail transaksi
            </p>
        </div>

        {{-- FORM --}}
        <form method="POST" action="{{ route('admin.penjualan.store') }}" class="px-8 py-6 space-y-6">
            @csrf

            {{-- PILIH PRODUKSI --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Pilih Produksi <span class="text-red-500">*</span>
                </label>
                <select name="produks_id"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300
                       focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                    @foreach ($produksi as $p)
                        <option value="{{ $p->id }}">
                            Produksi #{{ $p->id }} — {{ $p->tanggal->format('d-m-Y') }}
                            ({{ $p->jumlah }} kg)
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- TANGGAL --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        Tanggal Penjualan <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="tanggal"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>

                {{-- HARGA --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">
                        Harga per Kg <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="harga_per_kg" name="harga_per_kg"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300
                           focus:ring-2 focus:ring-orange-500 focus:border-orange-500">
                </div>
            </div>

            {{-- DETAIL PENJUALAN --}}
            <div>
                <h3 class="text-xl font-semibold text-gray-800 mb-3">
                    Detail Penjualan
                </h3>

                <div class="overflow-x-auto rounded-xl border">
                    <table class="w-full" id="itemsTable">
                        <thead class="bg-gray-50 text-gray-700">
                            <tr>
                                <th class="p-4 text-left">Qty (Kg)</th>
                                <th class="p-4 text-left">Subtotal</th>
                                <th class="p-4 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="p-4">
                                    <input type="number" name="qty[]"
                                        class="qty w-full px-3 py-2 rounded-lg border
                                           focus:ring-2 focus:ring-orange-500">
                                </td>
                                <td class="p-4">
                                    <input type="number" name="subtotal[]"
                                        class="subtotal w-full px-3 py-2 rounded-lg
                                           bg-gray-100 border"
                                        readonly>
                                </td>
                                <td class="p-4 text-center">
                                    <button type="button"
                                        class="removeRow px-4 py-2 bg-red-500 hover:bg-red-600
                                           text-white rounded-lg font-semibold">
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <button type="button" id="addRow"
                    class="mt-4 px-6 py-2.5 bg-orange-600 hover:bg-orange-700
                       text-white rounded-xl font-semibold shadow">
                    + Tambah Baris
                </button>
            </div>

            {{-- TOTAL --}}
            <div>
                <label class="block font-semibold text-gray-700 mb-2">
                    Total Semua
                </label>
                <input type="number" id="total" name="total" class="w-full px-4 py-3 rounded-xl bg-gray-100 border"
                    readonly>
            </div>

            {{-- ACTION --}}
            <div class="pt-6 border-t flex justify-end">
                <button
                    class="px-8 py-3 bg-orange-600 hover:bg-orange-700
                       text-white rounded-xl font-semibold shadow-lg
                       active:scale-95 transition">
                    Simpan Penjualan
                </button>
            </div>

        </form>
    </div>

    {{-- SCRIPT (LOGIKA ASLI, TIDAK DIUBAH) --}}
    <script>
        document.getElementById('addRow').addEventListener('click', () => {
            const tbody = document.querySelector('#itemsTable tbody');
            tbody.insertAdjacentHTML('beforeend', `
        <tr class="hover:bg-gray-50 transition">
            <td class="p-4">
                <input type="number" name="qty[]" class="qty w-full px-3 py-2 rounded-lg border focus:ring-2 focus:ring-orange  -500">
            </td>
            <td class="p-4">
                <input type="number" name="subtotal[]" class="subtotal w-full px-3 py-2 rounded-lg bg-gray-100 border" readonly>
            </td>
            <td class="p-4 text-center">
                <button type="button" class="removeRow px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-lg font-semibold">
                    Hapus
                </button>
            </td>
        </tr>
    `);
        });

        document.addEventListener('input', function(e) {
            if (e.target.classList.contains('qty')) {
                const row = e.target.closest('tr');
                const qty = e.target.value || 0;
                const harga = document.getElementById('harga_per_kg').value || 0;
                row.querySelector('.subtotal').value = qty * harga;
                updateTotal();
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('removeRow')) {
                e.target.closest('tr').remove();
                updateTotal();
            }
        });

        function updateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal').forEach(sub => {
                total += parseFloat(sub.value || 0);
            });
            document.getElementById('total').value = total;
        }
    </script>
@endsection
