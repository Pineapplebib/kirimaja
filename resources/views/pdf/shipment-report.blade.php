<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Pengiriman - KirimAja</title>
    <style>
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-Regular.ttf') }}') format('truetype');
            font-weight: 400;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-Medium.ttf') }}') format('truetype');
            font-weight: 500;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-SemiBold.ttf') }}') format('truetype');
            font-weight: 600;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-Bold.ttf') }}') format('truetype');
            font-weight: 700;
            font-style: normal;
        }
        @font-face {
            font-family: 'Plus Jakarta Sans';
            src: url('{{ resource_path('fonts/plus-jakarta-sans/PlusJakartaSans-ExtraBold.ttf') }}') format('truetype');
            font-weight: 800;
            font-style: normal;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        @page {
            margin: 0cm;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            color: #1e293b;
            background: #ffffff;
            line-height: 1.5;
            padding: 30px 40px;
        }

        /* ── HEADER ── */
        .header-container {
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .logo-cell {
            width: 60%;
            vertical-align: middle;
        }

        .logo {
            height: 45px;
            width: auto; /* Prevent squashing */
            display: block;
        }

        .meta-cell {
            width: 40%;
            text-align: right;
            vertical-align: middle;
        }

        .report-title {
            font-size: 22px;
            font-weight: 800;
            color: #0f172a;
            letter-spacing: -0.5px;
            margin-bottom: 4px;
        }

        .report-period {
            font-size: 11px;
            color: #64748b;
            font-weight: 500;
        }

        .report-info {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* ── SUMMARY GRID ── */
        .summary-container {
            width: 100%;
            margin-bottom: 30px;
        }

        .summary-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 10px 0;
            margin-left: -10px;
        }

        .summary-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px 15px;
            width: 20%;
            vertical-align: top;
        }

        .summary-label {
            font-size: 9px;
            color: #64748b;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            margin-bottom: 6px;
        }

        .summary-value {
            font-size: 18px;
            font-weight: 800;
            color: #0f172a;
        }

        .card-primary { background: #f8fbff; }
        .card-success { background: #f0fdf4; }
        .card-warning { background: #fffbeb; }
        .card-danger  { background: #fef2f2; }

        /* ── SECTIONS ── */
        .section-title {
            font-size: 13px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            padding-left: 10px;
            border-left: 4px solid #0f172a;
            letter-spacing: 0.5px;
        }

        /* ── MAIN TABLE ── */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .data-table thead th {
            background: #0f172a;
            color: #ffffff;
            font-weight: 600;
            padding: 10px 12px;
            text-align: left;
            font-size: 9px;
            letter-spacing: 0.5px;
        }

        .data-table tbody td {
            padding: 10px 12px;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 10px;
        }

        .data-table tbody tr:nth-child(even) { background: #fcfcfc; }

        .data-table tfoot td {
            padding: 12px;
            background: #f8fafc;
            font-weight: 800;
            font-size: 11px;
            border-top: 2px solid #e2e8f0;
        }

        /* ── RECAP SECTION ── */
        .recap-container {
            width: 100%;
            margin-top: 10px;
        }

        .recap-table {
            width: 450px; /* Precise width for better look */
            border-collapse: collapse;
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .recap-table th {
            background: #f8fafc;
            text-align: left;
            padding: 10px 15px;
            font-size: 10px;
            color: #64748b;
            border-bottom: 1px solid #e2e8f0;
        }

        .recap-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .recap-row-total {
            background: #f8fafc;
            font-weight: 800;
        }

        /* ── BADGES ── */
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: 700;
        }
        .badge-success { background: #dcfce7; color: #166534; }
        .badge-warning { background: #fef9c3; color: #854d0e; }
        .badge-danger  { background: #fee2e2; color: #991b1b; }
        .badge-info    { background: #e0f2fe; color: #075985; }

        /* ── SIGNATURE ── */
        .signature-section {
            width: 100%;
            margin-top: 50px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-box {
            width: 33.33%;
            text-align: center;
            vertical-align: top;
            padding: 0 20px;
        }

        .sig-label {
            font-size: 10px;
            color: #64748b;
            margin-bottom: 60px; /* Space for handwriting */
        }

        .sig-name {
            font-size: 11px;
            font-weight: 700;
            color: #0f172a;
            border-bottom: 1px solid #94a3b8;
            padding-bottom: 2px;
            display: inline-block;
            min-width: 150px;
        }

        .sig-role {
            font-size: 9px;
            color: #94a3b8;
            margin-top: 4px;
        }

        /* ── FOOTER ── */
        .footer {
            margin-top: 40px;
            padding-top: 15px;
            border-top: 1px solid #f1f5f9;
            width: 100%;
        }

        .footer-text {
            font-size: 9px;
            color: #94a3b8;
            float: left;
        }

        .page-number {
            font-size: 9px;
            color: #94a3b8;
            float: right;
        }

        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .font-bold { font-weight: 700; }
        .clr-primary { color: #3b82f6; }
    </style>
</head>
<body>

    @php
        $shipments = collect($shipments);
        $statsTotal = $shipments->count();
        $statsDelivered = $shipments->where('status', 'delivered')->count();
        $statsCancelled = $shipments->where('status', 'cancelled')->count();
        $statsInProcess = $shipments->whereNotIn('status', ['delivered', 'cancelled'])->count();
        
        $calcRevenue = $shipments->filter(function($shipment) {
            return ($shipment->payment->payment_status ?? '') === 'paid';
        })->sum('total_price');
    @endphp

    {{-- HEADER --}}
    <div class="header-container">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    <img src="{{ public_path('images/branding/logo.png') }}" class="logo" alt="Logo">
                </td>
                <td class="meta-cell">
                    <div class="report-title">Laporan Pengiriman</div>
                    <div class="report-period">Periode: {{ $period_start }} - {{ $period_end }}</div>
                    <div class="report-info">
                        Dicetak pada: {{ now()->translatedFormat('d F Y, H:i') }} WIB &nbsp;•&nbsp; Oleh: {{ auth()->user()->name ?? 'Administrator' }}
                    </div>
                </td>
            </tr>
        </table>
    </div>

    {{-- SUMMARY --}}
    <div class="summary-container">
        <table class="summary-table">
            <tr>
                <td class="summary-card card-primary">
                    <div class="summary-label">Total Pengiriman</div>
                    <div class="summary-value">{{ number_format($statsTotal, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card card-success">
                    <div class="summary-label">Terkirim</div>
                    <div class="summary-value">{{ number_format($statsDelivered, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card card-warning">
                    <div class="summary-label">Dalam Proses</div>
                    <div class="summary-value">{{ number_format($statsInProcess, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card card-danger">
                    <div class="summary-label">Dibatalkan</div>
                    <div class="summary-value">{{ number_format($statsCancelled, 0, ',', '.') }}</div>
                </td>
                <td class="summary-card card-success">
                    <div class="summary-label">Total Pendapatan</div>
                    <div class="summary-value" style="font-size: 15px;">Rp {{ number_format($calcRevenue, 0, ',', '.') }}</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- DATA TABLE --}}
    <div class="section-title">Detail Transaksi Pengiriman</div>
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 40px;">#</th>
                <th style="width: 140px;">No. Resi</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th style="width: 150px;">Asal → Tujuan</th>
                <th style="width: 100px;" class="text-right">Biaya</th>
                <th style="width: 100px;" class="text-center">Status</th>
                <th style="width: 100px;" class="text-center">Pembayaran</th>
                <th style="width: 80px;">Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($shipments ?? [] as $i => $shipment)
            <tr>
                <td class="text-center" style="color: #94a3b8;">{{ $i + 1 }}</td>
                <td class="font-bold clr-primary">{{ $shipment->tracking_number ?? '-' }}</td>
                <td>{{ $shipment->sender->name ?? '-' }}</td>
                <td>{{ $shipment->receiver->name ?? '-' }}</td>
                <td>{{ ($shipment->originBranch->city ?? '-') }} → {{ ($shipment->destinationBranch->city ?? '-') }}</td>
                <td class="text-right font-bold">Rp {{ number_format($shipment->total_price ?? 0, 0, ',', '.') }}</td>
                <td class="text-center">
                    @php
                        $status = $shipment->status ?? 'pending';
                        $class = match($status) {
                            'delivered' => 'badge-success',
                            'cancelled' => 'badge-danger',
                            'pending'   => 'badge-warning',
                            default     => 'badge-info'
                        };
                        $label = match($status) {
                            'delivered'         => 'Terkirim',
                            'cancelled'         => 'Batal',
                            'pending'           => 'Menunggu',
                            'in_transit'        => 'Perjalanan',
                            'picked_up'         => 'Dijemput',
                            'arrived_at_branch' => 'Di Cabang',
                            'out_for_delivery'  => 'Diantar',
                            default             => ucfirst($status)
                        };
                    @endphp
                    <span class="badge {{ $class }}">{{ $label }}</span>
                </td>
                <td class="text-center">
                    @php
                        $paymentStatus = $shipment->payment->payment_status ?? 'pending';
                        $pmtClass = $paymentStatus === 'paid' ? 'badge-success' : 'badge-warning';
                        $pmtLabel = $paymentStatus === 'paid' ? 'Lunas' : 'Belum Bayar';
                    @endphp
                    <span class="badge {{ $pmtClass }}">{{ $pmtLabel }}</span>
                </td>
                <td>{{ isset($shipment->shipment_date) ? $shipment->shipment_date->format('d/m/Y') : '-' }}</td>
            </tr>
            @empty
            {{-- Fallback Dummy for Preview --}}
            @foreach([
                ['KA65F2A1B3C99', 'Budi Santoso', 'Rina Dewi', 'Jakarta', 'Surabaya', 85000, 'delivered', '12/01/2026'],
                ['KA72D9E4F1A22', 'Siti Rahayu', 'Ahmad Fauzi', 'Bandung', 'Medan', 145000, 'in_transit', '14/01/2026'],
                ['KA81C3B7D2E55', 'Dian Permata', 'Hendra Wijaya', 'Surabaya', 'Makassar', 210000, 'delivered', '15/01/2026']
            ] as $idx => $row)
            <tr>
                <td class="text-center" style="color: #94a3b8;">{{ $idx + 1 }}</td>
                <td class="font-bold clr-primary">{{ $row[0] }}</td>
                <td>{{ $row[1] }}</td>
                <td>{{ $row[2] }}</td>
                <td>{{ $row[3] }} → {{ $row[4] }}</td>
                <td class="text-right font-bold">Rp {{ number_format($row[5], 0, ',', '.') }}</td>
                <td class="text-center">
                    <span class="badge {{ $row[6] == 'delivered' ? 'badge-success' : 'badge-info' }}">
                        {{ $row[6] == 'delivered' ? 'Terkirim' : 'Perjalanan' }}
                    </span>
                </td>
                <td class="text-center">
                    <span class="badge badge-success">Lunas</span>
                </td>
                <td>{{ $row[7] }}</td>
            </tr>
            @endforeach
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="6" class="text-right">TOTAL PENDAPATAN</td>
                <td class="text-right" style="color: #10b981;">Rp {{ number_format($calcRevenue, 0, ',', '.') }}</td>
                <td colspan="2"></td>
            </tr>
        </tfoot>
    </table>

    {{-- RECAP SECTION --}}
    <div style="width: 100%; margin-bottom: 40px;">
        <div style="float: left; width: 50%;">
            <div class="section-title">Rekapitulasi Status Pengiriman</div>
            <table class="recap-table">
                <thead>
                    <tr>
                        <th>Status Pengiriman</th>
                        <th class="text-right">Jumlah</th>
                        <th class="text-right">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $statuses = [
                            'delivered'         => 'Terkirim',
                            'in_transit'        => 'Dalam Perjalanan',
                            'pending'           => 'Menunggu',
                            'cancelled'         => 'Dibatalkan',
                            'picked_up'         => 'Dijemput',
                            'arrived_at_branch' => 'Tiba di Cabang',
                            'out_for_delivery'  => 'Sedang Diantar'
                        ];
                        
                        $shipmentGroup = $shipments->groupBy('status');
                        $totalCount = $shipments->count() ?: 1;
                    @endphp
                    @foreach($statuses as $key => $label)
                        @php
                            $count = $shipmentGroup->has($key) ? $shipmentGroup->get($key)->count() : 0;
                            $percentage = ($count / $totalCount) * 100;
                        @endphp
                        @if($count > 0 || in_array($key, ['delivered', 'in_transit', 'pending', 'cancelled']))
                        <tr>
                            <td>{{ $label }}</td>
                            <td class="text-right font-bold">{{ number_format($count, 0, ',', '.') }}</td>
                            <td class="text-right" style="color: #64748b;">{{ number_format($percentage, 1) }}%</td>
                        </tr>
                        @endif
                    @endforeach
                    <tr class="recap-row-total">
                        <td>TOTAL KESELURUHAN</td>
                        <td class="text-right">{{ number_format($shipments->count(), 0, ',', '.') }}</td>
                        <td class="text-right">100%</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="clear: both;"></div>
    </div>

    {{-- SIGNATURE SECTION --}}
    <div class="signature-section">
        <table class="signature-table">
            <tr>
                <td class="signature-box">
                    <div class="sig-label">Dibuat oleh,</div>
                    <div class="sig-name">{{ auth()->user()->name ?? 'Budi Santoso' }}</div>
                    <div class="sig-role">Administrator</div>
                </td>
                <td class="signature-box">
                    <div class="sig-label">Diketahui oleh,</div>
                    <div class="sig-name">&nbsp;</div>
                    <div class="sig-role">Kepala Cabang</div>
                </td>
                <td class="signature-box">
                    <div class="sig-label">Disetujui oleh,</div>
                    <div class="sig-name">&nbsp;</div>
                    <div class="sig-role">Manajer Operasional</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- FOOTER --}}
    <div class="footer">
        <div class="footer-text">
            © {{ date('Y') }} KirimAja · Dokumen ini dihasilkan secara otomatis oleh sistem inti KirimAja.
        </div>
        <div class="page-number">
            Halaman <script type="text/php">if (isset($pdf)) { $pdf->page_script('echo $PAGE_NUM . " dari " . $PAGE_COUNT;'); }</script>
        </div>
    </div>

</body>
</html>
