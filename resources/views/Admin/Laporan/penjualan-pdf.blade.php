<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            line-height: 1.4;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 3px solid #333;
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 18px;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 3px 0;
            font-size: 10px;
            color: #666;
        }

        .info-box {
            background: #f5f5f5;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 3px;
        }

        .info-box p {
            margin: 3px 0;
            font-size: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px 6px;
            text-align: left;
        }

        th {
            background-color: #10B981;
            color: white;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f0f0f0;
        }

        .text-center { text-align: center; }
        .text-right { text-align: right; }

        .total {
            font-weight: bold;
            background-color: #e8f8e8;
            font-size: 12px;
        }

        .amount {
            font-weight: 600;
            color: #10B981;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #333;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENJUALAN TELUR</h2>
        <p>Sistem Peternakan Ayam Petelur</p>
        <p>Tanggal Cetak: {{ now()->timezone('Asia/Jakarta')->format('d F Y, H:i:s') }} WIB</p>
    </div>

    @php
        $tanggalDari = request('tanggal_dari');
        $tanggalSampai = request('tanggal_sampai');
    @endphp

    @if($tanggalDari || $tanggalSampai)
    <div class="info-box">
        <strong>Filter yang Diterapkan:</strong>
        @if($tanggalDari)
            <p>📅 Tanggal Dari: {{ \Carbon\Carbon::parse($tanggalDari)->format('d/m/Y') }}</p>
        @endif
        @if($tanggalSampai)
            <p>📅 Tanggal Sampai: {{ \Carbon\Carbon::parse($tanggalSampai)->format('d/m/Y') }}</p>
        @endif
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="12%">Tanggal</th>
                <th width="15%" class="text-center">Produksi</th>
                <th width="15%" class="text-right">Jumlah Terjual (Kg)</th>
                <th width="15%" class="text-right">Harga/Kg (Rp)</th>
                <th width="18%" class="text-right">Total (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @forelse($penjualan as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td class="text-center">
                    @if($item->produksiTelur)
                        Produksi #{{ $item->produksiTelur->id }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-right">{{ number_format($item->jumlah_terjual, 2) }}</td>
                <td class="text-right">{{ number_format($item->harga_per_kg, 0, ',', '.') }}</td>
                <td class="text-right amount">{{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 20px;">
                    Tidak ada data penjualan
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="3" class="text-right"><strong>TOTAL:</strong></td>
                <td class="text-right"><strong>{{ number_format($totalTerjual, 2) }} kg</strong></td>
                <td class="text-right"></td>
                <td class="text-right"><strong>Rp {{ number_format($totalPenjualan, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak dari Sistem Peternakan Ayam Petelur DWI FARM Rombasan</p>
        <p>Dokumen ini digenerate secara otomatis dan sah tanpa tanda tangan</p>
    </div>
</body>
</html>
