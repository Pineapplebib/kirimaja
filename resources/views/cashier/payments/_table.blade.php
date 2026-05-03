<x-data.table :items="$payments" emptyMessage="Belum ada data pembayaran" emptyIcon="banknote">
    <x-slot:thead>
        <tr>
            <th class="text-left">Resi</th>
            <th class="text-left">Pengirim</th>
            <th class="text-left">Tujuan</th>
            <th class="text-left">Metode</th>
            <th class="text-right">Jumlah</th>
            <th class="text-left">Status</th>
            <th class="text-left">Tanggal</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($payments as $payment)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-5 py-4">
            <span class="font-mono text-sm font-black text-[#1B3A6B] tracking-tight">{{ $payment->shipment->tracking_number ?? '-' }}</span>
        </td>
        <td class="px-5 py-4 font-bold text-gray-800">{{ $payment->shipment->sender->name ?? '-' }}</td>
        <td class="px-5 py-4">
            <p class="text-sm font-bold text-gray-500">{{ $payment->shipment->destinationBranch->city ?? '-' }}</p>
        </td>
        <td class="px-5 py-3.5">
            <span class="inline-flex items-center gap-1.5 text-sm font-semibold text-gray-600">
                <i data-lucide="{{ $payment->payment_method === 'cash' ? 'banknote' : 'credit-card' }}" class="w-3.5 h-3.5 opacity-50"></i>
                {{ $payment->method_label }}
            </span>
        </td>
        <td class="px-5 py-3.5 text-right font-black text-gray-800">Rp {{ number_format($payment->amount,0,',','.') }}</td>
        <td class="px-5 py-3.5">
            <x-ui.badge :type="match($payment->payment_status) {
                'paid' => 'success',
                'failed' => 'danger',
                'pending' => 'warning',
                default => 'info'
            }" :label="ucfirst($payment->payment_status)" />
        </td>
        <td class="px-5 py-3.5 text-sm font-bold text-gray-400">{{ $payment->payment_date?->format('d F Y') ?? '-' }}</td>
        <td class="px-5 py-3.5 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('cashier.shipments.show', $payment->shipment) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100" title="Detail Pengiriman">
                    <i data-lucide="eye" class="w-4 h-4"></i>
                </a>
                @if($payment->shipment && $payment->payment_status !== 'paid')
                <a href="{{ route('cashier.payments.create', $payment->shipment) }}" class="p-2 text-[#F47B20] hover:bg-orange-50 rounded-lg transition-all border border-transparent hover:border-orange-100" title="Proses Pembayaran">
                    <i data-lucide="credit-card" class="w-4 h-4"></i>
                </a>
                @endif
                @if($payment->payment_status === 'paid')
                <a href="{{ route('cashier.payments.print-receipt', $payment) }}" target="_blank" class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-all border border-transparent hover:border-green-100" title="Cetak Receipt (Struk)">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                </a>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data.table>
