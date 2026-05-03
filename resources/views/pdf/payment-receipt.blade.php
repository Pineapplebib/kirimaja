<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Struk Pembayaran - KirimAja</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0;
        }

        body {
            font-family: 'Courier', monospace;
            font-size: 9px;
            color: #000000;
            background: #ffffff;
            width: 52mm;
            padding: 6mm 1mm 2mm 1mm;
            line-height: 1.2;
            margin: 0 auto;
        }

        .text-center { text-align: center; }
        .text-right  { text-align: right; }
        .font-bold   { font-weight: bold; }
        .uppercase   { text-transform: uppercase; }

        /* ── HEADER ── */
        .header {
            margin-bottom: 3mm;
            border-bottom: 0.5pt dashed #000;
            padding-bottom: 3mm;
        }

        .logo {
            width: 20mm;
            height: auto;
            margin-bottom: 1mm;
            filter: grayscale(100%);
            -webkit-filter: grayscale(100%);
        }

        .branch-name {
            font-size: 10px;
            font-weight: bold;
            margin-top: 1mm;
        }

        .branch-info {
            font-size: 7px;
            margin-top: 1px;
        }

        /* ── TRACKING ── */
        .tracking-section {
            padding: 3mm 0;
            text-align: center;
        }

        .tracking-label {
            font-size: 7px;
            letter-spacing: 1px;
            margin-bottom: 1mm;
        }

        .tracking-number {
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        /* ── INFO ── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 2mm;
        }

        .info-table td {
            font-size: 8px;
            padding: 0.5mm 0;
            vertical-align: top;
        }

        /* ── ITEMS ── */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin: 2mm 0;
            border-top: 0.5pt solid #000;
            border-bottom: 0.5pt solid #000;
        }

        .items-table th {
            font-size: 7px;
            text-align: left;
            padding: 1mm 0;
            border-bottom: 0.5pt dashed #ccc;
        }

        .items-table td {
            font-size: 8px;
            padding: 1.5mm 0;
            vertical-align: top;
        }

        /* ── TOTALS ── */
        .total-section {
            margin-top: 2mm;
        }

        .total-row {
            width: 100%;
            margin-bottom: 0.5mm;
        }

        .grand-total {
            border-top: 0.5pt dashed #000;
            margin-top: 3mm;
            padding-top: 3mm;
            font-size: 12px;
            font-weight: bold;
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 5mm;
            border-top: 0.5pt dashed #000;
            padding-top: 3mm;
            font-size: 7px;
            line-height: 1.4;
        }

        .footer .thank-you {
            font-size: 10px;
            font-weight: bold;
            margin-bottom: 1mm;
        }

        .divider {
            border: none;
            border-top: 0.5pt dashed #000;
            margin: 2mm 0;
        }

        .status-badge {
            display: inline-block;
            padding: 1mm 2mm;
            border: 1px solid #000;
            font-weight: bold;
            margin-top: 2mm;
        }
    </style>
</head>
<body>

    {{-- HEADER --}}
    <div class="header text-center">
        <img src="{{ public_path('images/branding/logo.png') }}" class="logo" alt="Logo" style="filter: grayscale(100%); -webkit-filter: grayscale(100%);">
        <div class="branch-name">{{ $shipment->originBranch->name ?? 'Cabang Utama' }}</div>
        <div class="branch-info">
            {{ $shipment->originBranch->address ?? 'Alamat Cabang' }}<br>
            Telp: {{ $shipment->originBranch->phone ?? '-' }}
        </div>
    </div>

    {{-- TRACKING --}}
    <div class="tracking-section">
        <div class="tracking-label uppercase">Nomor Resi</div>
        <div class="tracking-number">{{ $shipment->tracking_number ?? 'KAXXXXXXXXX' }}</div>
    </div>

    <div class="divider"></div>

    {{-- TRANSACTION INFO --}}
    <table class="info-table">
        <tr>
            <td style="width: 15mm;">Tanggal</td>
            <td>: {{ now()->format('d/m/Y H:i') }}</td>
        </tr>
        <tr>
            <td>Kasir</td>
            <td>: {{ auth()->user()->name ?? 'Admin' }}</td>
        </tr>
    </table>

    <div class="divider"></div>

    {{-- SENDER / RECEIVER --}}
    <table class="info-table">
        <tr>
            <td style="width: 15mm;">Dari</td>
            <td class="font-bold">{{ $shipment->sender->name ?? '-' }}</td>
        </tr>
        <tr>
            <td>Tujuan</td>
            <td class="font-bold">{{ $shipment->destinationBranch->city ?? '-' }}</td>
        </tr>
    </table>

    {{-- ITEMS --}}
    <table class="items-table">
        <thead>
            <tr>
                <th style="width: 32mm;">Barang</th>
                <th style="width: 8mm;" class="text-center">Qty</th>
                <th class="text-right">Berat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shipment->items ?? [] as $item)
            <tr>
                <td>{{ $item->item_name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right">{{ $item->weight }} kg</td>
            </tr>
            @empty
            <tr>
                <td>Paket Dokumen/Barang</td>
                <td class="text-center">1</td>
                <td class="text-right">1.0 kg</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- TOTALS --}}
    <div class="total-section">
        <table class="info-table">
            <tr>
                <td>Total Berat</td>
                <td class="text-right">{{ $shipment->total_weight ?? '0' }} kg</td>
            </tr>
            <tr>
                <td>Biaya Kirim</td>
                <td class="text-right">Rp {{ number_format($shipment->total_price ?? 0, 0, ',', '.') }}</td>
            </tr>
            @if($shipment->payment)
            <tr>
                <td>Metode Bayar</td>
                <td class="text-right">{{ $shipment->payment->method_label }}</td>
            </tr>
            @endif
            <tr class="grand-total">
                <td>TOTAL BAYAR</td>
                <td class="text-right">Rp {{ number_format($shipment->total_price ?? 0, 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer text-center">
        <div class="thank-you">TERIMA KASIH!</div>
        <p>Lacak paket Anda di:</p>
        <p class="font-bold">{{ config('app.domain', 'kirimaja.id') }}/tracking</p>
        <div style="margin-top: 2mm;">
            Simpan struk ini sebagai bukti pembayaran yang sah.
        </div>
        <div style="margin-top: 2mm; font-size: 6px; color: #666;">
            © {{ date('Y') }} KirimAja · Dicetak otomatis
        </div>
    </div>

</body>
</html>
