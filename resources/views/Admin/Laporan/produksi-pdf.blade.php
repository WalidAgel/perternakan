<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Produksi Telur</title>
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

        .stats-box {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
        }

        .stats-item {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            border: 2px solid #ddd;
            vertical-align: middle;
        }

        .stats-item.blue {
            background-color: #3B82F6;
            color: white;
        }

        .stats-item.green {
            background-color: #10B981;
            color: white;
        }

        .stats-item.red {
            background-color: #EF4444;
            color: white;
        }

        .stats-item.purple {
            background-color: #8B5CF6;
            color: white;
        }

        .stats-label {
            font-size: 9px;
            margin-bottom: 5px;
        }

        .stats-value {
            font-size: 16px;
            font-weight: bold;
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
            background-color: #3B82F6;
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

        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-orange {
            background-color: #FED7AA;
            color: #C2410C;
        }

        .badge-green {
            background-color: #D1FAE5;
            color: #065F46;
        }

        .badge-red {
            background-color: #FEE2E2;
            color: #991B1B;
        }

        .total-row {
            font-weight: bold;
            background-color: #DBEAFE;
            font-size: 12px;
        }

        .amount-blue {
            font-weight: 600;
            color: #2563EB;
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
        <h2>LAPORAN PRODUKSI TELUR</h2>
        <p>Sistem Peternakan Ayam Petelur DWI FARM Rombasan</p>
        <p>Tanggal Cetak: {{ now()->timezone('Asia/Jakarta')->format('d F Y, H:i:s') }} WIB</p>
    </div>

    @php
        $tanggalDari = request('tanggal_dari');
        $tanggalSampai = request('tanggal_sampai');
        $karyawanId = request('karyawan_id');
        $kandangId = request('kandang_id');
    @endphp

    @if($tanggalDari || $tanggalSampai || $karyawanId || $kandangId)
    <div class="info-box">
        <strong>Filter yang Diterapkan:</strong>
        @if($tanggalDari)
            <p>Tanggal Dari: {{ \Carbon\Carbon::parse($tanggalDari)->format('d/m/Y') }}</p>
        @endif
        @if($tanggalSampai)
            <p>Tanggal Sampai: {{ \Carbon\Carbon::parse($tanggalSampai)->format('d/m/Y') }}</p>
        @endif
        @if($kandangId)
            <p>Kandang: {{ $produksi->first()->kandang->nama_kandang ?? '-' }}</p>
        @endif
        @if($karyawanId)
            <p>Karyawan: {{ $produksi->first()->karyawan->nama ?? '-' }}</p>
        @endif
    </div>
    @endif

    {{-- STATISTIK --}}
    <div class="stats-box">
        <div class="stats-item blue">
            <div class="stats-label">Total Produksi</div>
            <div class="stats-value">{{ number_format($totalJumlah) }} Butir</div>
        </div>
        <div class="stats-item green">
            <div class="stats-label">Telur Bagus</div>
            <div class="stats-value">{{ number_format($totalBagus) }} Butir</div>
        </div>
        <div class="stats-item red">
            <div class="stats-label">Telur Rusak</div>
            <div class="stats-value">{{ number_format($totalRusak) }} Butir</div>
        </div>
        <div class="stats-item purple">
            <div class="stats-label">Rata-rata / Hari</div>
            <div class="stats-value">
                {{ $produksi->count() ? number_format($totalJumlah / $produksi->count()) : 0 }} Butir
            </div>
        </div>
    </div>

    {{-- TABEL --}}
    <table>
        <thead>
            <tr>
                <th width="10%" class="text-center">Tanggal</th>
                <th width="12%">Kandang</th>
                <th width="15%">Karyawan</th>
                <th width="13%" class="text-center">Telur Bagus</th>
                <th width="13%" class="text-center">Telur Rusak</th>
                <th width="12%" class="text-center">Total</th>
                <th width="25%">Catatan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produksi as $index => $p)
            <tr>
                <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal)->format('d/m/Y') }}</td>
                <td>
                    @if($p->kandang)
                        <span class="badge badge-orange">{{ $p->kandang->nama_kandang }}</span>
                    @else
                        -
                    @endif
                </td>
                <td>{{ $p->karyawan->nama }}</td>
                <td class="text-center">
                    <span class="badge badge-green">{{ number_format($p->jumlah_bagus) }} butir</span>
                </td>
                <td class="text-center">
                    <span class="badge badge-red">{{ number_format($p->jumlah_rusak) }} butir</span>
                </td>
                <td class="text-center amount-blue">
                    <strong>{{ number_format($p->jumlah) }} butir</strong>
                </td>
                <td>{{ $p->catatan ?: '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center" style="padding: 20px;">
                    Tidak ada data produksi
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>TOTAL KESELURUHAN:</strong></td>
                <td class="text-center"><strong>{{ number_format($totalBagus) }} butir</strong></td>
                <td class="text-center"><strong>{{ number_format($totalRusak) }} butir</strong></td>
                <td class="text-center"><strong>{{ number_format($totalJumlah) }} butir</strong></td>
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