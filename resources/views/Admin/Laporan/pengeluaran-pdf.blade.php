<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Pengeluaran</title>
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
            background-color: #e74c3c;
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
            background-color: #ffe8e8;
            font-size: 12px;
        }

        .amount {
            font-weight: 600;
            color: #e74c3c;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #333;
            text-align: center;
            font-size: 9px;
            color: #666;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN PENGELUARAN</h2>
        <p>Sistem Peternakan Ayam Petelur</p>
        <p>Tanggal Cetak: {{ now()->timezone('Asia/Jakarta')->format('d F Y, H:i:s') }} WIB</p>
    </div>

    @php
        $tanggalDari = request('tanggal_dari');
        $tanggalSampai = request('tanggal_sampai');
        $kategoriId = request('kategori_id');
    @endphp

    @if($tanggalDari || $tanggalSampai || $kategoriId)
    <div class="info-box">
        <strong>Filter yang Diterapkan:</strong>
        @if($tanggalDari)
            <p>📅 Tanggal Dari: {{ \Carbon\Carbon::parse($tanggalDari)->format('d/m/Y') }}</p>
        @endif
        @if($tanggalSampai)
            <p>📅 Tanggal Sampai: {{ \Carbon\Carbon::parse($tanggalSampai)->format('d/m/Y') }}</p>
        @endif
        @if($kategoriId)
            <p>🏷️ Kategori: {{ $pengeluaran->first()->kategori->nama_kategori ?? '-' }}</p>
        @endif
    </div>
    @endif

    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="12%">Tanggal</th>
                <th width="18%">Kategori</th>
                <th width="15%">Karyawan</th>
                <th width="15%" class="text-right">Jumlah (Rp)</th>
                <th width="35%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pengeluaran as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->tanggal->format('d/m/Y') }}</td>
                <td>{{ $item->kategori->nama_kategori }}</td>
                <td>{{ $item->karyawan->nama }}</td>
                <td class="text-right amount">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                <td>{{ $item->deskripsi ?: '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center" style="padding: 20px;">
                    Tidak ada data pengeluaran
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total">
                <td colspan="4" class="text-right"><strong>TOTAL PENGELUARAN:</strong></td>
                <td class="text-right"><strong>Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong></td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div class="footer">
        <p>Dicetak dari Sistem Peternakan Ayam Petelur DWI FARM Rombasan</p>
        <p>Dokumen ini digenerate secara otomatis dan sah tanpa tanda tangan</p>
    </div>
</body>
</html>
