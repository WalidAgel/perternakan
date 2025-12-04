@extends('Layout.app')

@section('content')
<h1 class="text-2xl font-semibold mb-6">Input Penjualan</h1>

<form method="POST" action="{{ route('penjualan.store') }}" class="space-y-4">
    @csrf

    <div>
        <label>Pilih Produksi</label>
        <select name="produks_id" class="border w-full p-2 rounded">
            @foreach($produksi as $p)
                <option value="{{ $p->id }}">
                    Produksi #{{ $p->id }} - {{ $p->tanggal }}
                </option>
            @endforeach
        </select>
    </div>

    <div>
        <label>Tanggal</label>
        <input type="date" name="tanggal" class="border w-full p-2 rounded">
    </div>

    <div>
        <label>Harga per Kg</label>
        <input type="number" id="harga_per_kg" name="harga_per_kg" class="border w-full p-2 rounded">
    </div>

    <div>
        <h2 class="font-semibold mb-2">Detail Penjualan</h2>

        <table class="w-full" id="itemsTable">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2">Qty</th>
                    <th class="border p-2">Subtotal</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="border p-2">
                        <input type="number" name="qty[]" class="qty border rounded p-1 w-full">
                    </td>
                    <td class="border p-2">
                        <input type="number" name="subtotal[]" class="subtotal border rounded p-1 w-full" readonly>
                    </td>
                    <td class="border p-2 text-center">
                        <button type="button" class="text-red-600 removeRow">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <button type="button" id="addRow" class="mt-2 px-4 py-2 bg-green-600 text-white rounded">Tambah Baris</button>
    </div>

    <div>
        <label>Total Semua</label>
        <input type="number" id="total" name="total" class="border w-full p-2 rounded" readonly>
    </div>

    <button class="px-6 py-2 bg-blue-600 text-white rounded">Simpan</button>
</form>

<script>
document.getElementById('addRow').addEventListener('click', () => {
    const tbody = document.querySelector('#itemsTable tbody');

    tbody.insertAdjacentHTML('beforeend', `
        <tr>
            <td class="border p-2">
                <input type="number" name="qty[]" class="qty border rounded p-1 w-full">
            </td>
            <td class="border p-2">
                <input type="number" name="subtotal[]" class="subtotal border rounded p-1 w-full" readonly>
            </td>
            <td class="border p-2 text-center">
                <button type="button" class="text-red-600 removeRow">Hapus</button>
            </td>
        </tr>
    `);
});

document.addEventListener('input', function(e) {
    if (e.target.classList.contains('qty')) {
        const row = e.target.closest('tr');
        const qty = e.target.value;
        const harga = document.getElementById('harga_per_kg').value;
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
