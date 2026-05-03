<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Resi Pengiriman - KirimAja</title>
    <style>
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-Regular.ttf') }}') format('truetype');
            font-weight: 400;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-Bold.ttf') }}') format('truetype');
            font-weight: 700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            size: A5 landscape;
            margin: 0;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 10px;
            color: #000;
            background: #fff;
            padding: 5mm;
            line-height: 1.2;
        }

        .label-wrapper {
            width: 100%;
            border: 1px solid #000;
            page-break-inside: avoid;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td, th {
            border: 1px solid #000;
            padding: 1.5mm 2mm;
            vertical-align: top;
            word-wrap: break-word;
        }

        /* ── UTILS ── */
        .no-border { border: none !important; }
        .no-border-top { border-top: none !important; }
        .no-border-bottom { border-bottom: none !important; }
        .no-border-left { border-left: none !important; }
        .no-border-right { border-right: none !important; }
        
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .v-middle { vertical-align: middle; }

        /* ── BRANDING ── */
        .logo-img { height: 12mm; width: auto; margin: 1mm 0; }
        
        /* ── ADDRESS SECTION ── */
        .address-label { font-size: 8px; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5mm; color: #444; }
        .address-name { font-size: 11px; font-weight: 700; margin-bottom: 0.5mm; }
        .address-detail { font-size: 9px; line-height: 1.2; }

        /* ── QR CODE ── */
        .barcode-1d-img { height: 14mm; width: auto; max-width: 90%; display: block; margin: 0 auto; }
        .barcode-1d-number { font-size: 8px; font-weight: 700; letter-spacing: 2px; text-align: center; margin-top: 0.5mm; }

        .qrcode-img { height: 22mm; width: auto; display: block; margin: 0 auto; }
        .tracking-label { font-size: 7px; color: #666; margin-top: 1mm; font-weight: 700; }
        .tracking-number { font-size: 10px; font-weight: 700; letter-spacing: 0.5px; }

        /* ── INFO BOXES ── */
        .info-label { font-size: 7.5px; font-weight: 700; text-transform: uppercase; color: #555; }
        .info-value { font-size: 12px; font-weight: 700; }

        /* ── ITEMS TABLE ── */
        .item-table th { font-size: 8.5px; font-weight: 700; text-transform: uppercase; text-align: left; }
        .item-table td { font-size: 9px; }

        .footer-note { padding: 1.5mm; font-size: 7px; color: #666; text-align: center; }
    </style>
</head>
<body>

<div class="label-wrapper">
    {{-- Header: Logo --}}
    <table>
        <tr>
            <td colspan="3" class="text-center no-border-top no-border-left no-border-right" style="padding: 2mm;">
                <img src="{{ public_path('images/branding/logo.png') }}" class="logo-img" alt="KirimAja">
            </td>
        </tr>
        
        {{-- 1D Barcode Section --}}
        <tr>
            <td colspan="3" class="text-center no-border-left no-border-right" style="padding: 2mm 0;">
                <img src="data:image/png;base64,{{ $barcode }}" class="barcode-1d-img" alt="1D Barcode">
                <div class="barcode-1d-number">{{ $shipment->tracking_number }}</div>
            </td>
        </tr>
        
        {{-- Main Row: Sender | Receiver | QR Code --}}
        <tr>
            {{-- Sender --}}
            <td style="width: 35%;" class="no-border-left">
                <div class="address-label">Pengirim:</div>
                <div class="address-name">{{ $shipment->sender->name }}</div>
                <div class="address-detail">
                    {{ $shipment->sender->phone }}<br>
                    {{ $shipment->sender->address }}<br>
                    {{ $shipment->originBranch->city }}
                </div>
            </td>
            
            {{-- Receiver --}}
            <td style="width: 35%;">
                <div class="address-label">Penerima:</div>
                <div class="address-name">{{ $shipment->receiver->name }}</div>
                <div class="address-detail">
                    {{ $shipment->receiver->phone }}<br>
                    {{ $shipment->receiver->address }}<br>
                    {{ $shipment->destinationBranch->city }}
                </div>
            </td>
            
            {{-- QR Code (2D Barcode) --}}
            <td style="width: 30%;" class="text-center v-middle no-border-right">
                <img src="data:image/svg+xml;base64,{{ $qrcode }}" class="qrcode-img" alt="QR Code">
            </td>
        </tr>
    </table>

    {{-- City & Details Grid --}}
    <table>
        <tr>
            <td style="width: 20%;" class="text-center no-border-left no-border-top">
                <div class="info-label">Asal</div>
                <div class="info-value">{{ strtoupper($shipment->originBranch->city) }}</div>
            </td>
            <td style="width: 20%;" class="text-center no-border-top">
                <div class="info-label">Tujuan</div>
                <div class="info-value">{{ strtoupper($shipment->destinationBranch->city) }}</div>
            </td>
            <td style="width: 30%;" class="no-border-top">
                <div class="info-label">Tanggal Kirim:</div>
                <div class="info-value">{{ ($shipment->shipment_date ?? now())->format('d-m-Y') }}</div>
            </td>
            <td style="width: 30%;" class="no-border-right no-border-top">
                <div class="info-label">Berat Paket:</div>
                <div class="info-value">{{ number_format($shipment->total_weight, 2) }} KG</div>
            </td>
        </tr>
    </table>

    {{-- COD Section (Optional) --}}
    @if(($shipment->payer_type ?? 'sender') === 'receiver')
    <table>
        <tr>
            <td colspan="4" class="text-center no-border-left no-border-right no-border-top" style="padding: 3mm;">
                <div style="border: 1.5px solid #000; padding: 2mm 6mm; font-weight: 800; font-size: 16px; display: inline-block;">
                    CASH ON DELIVERY (COD): Rp {{ number_format($shipment->total_price, 0, ',', '.') }}
                </div>
            </td>
        </tr>
    </table>
    @endif

    {{-- Items Table --}}
    <table class="item-table">
        <thead>
            <tr>
                <th style="width: 7%;" class="no-border-left no-border-top">No.</th>
                <th style="width: 63%;" class="no-border-top">Nama Barang</th>
                <th style="width: 15%; text-align: center;" class="no-border-top">Qty</th>
                <th style="width: 15%; text-align: right;" class="no-border-right no-border-top">Berat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($shipment->items as $index => $item)
            <tr>
                <td class="no-border-left">{{ $index + 1 }}</td>
                <td>{{ $item->item_name }}</td>
                <td class="text-center">{{ $item->quantity }}</td>
                <td class="text-right no-border-right">{{ number_format($item->weight, 1) }} kg</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer-note">
        Dicetak otomatis oleh KirimAja pada {{ now()->format('d/m/Y H:i') }} · Terima kasih telah menggunakan jasa kami
    </div>
</div>

</body>
</html>
