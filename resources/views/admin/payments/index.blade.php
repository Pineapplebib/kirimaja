@extends('layouts.app')
@section('title', 'Pembayaran')
@section('page-title', 'Daftar Pembayaran')

@section('content')
<x-layout.page-header>
    <form method="GET" action="{{ route('admin.payments.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <div class="w-48">
            <x-form.select-dropdown 
                name="status" 
                label="Semua Status" 
                :options="[
                    ['value' => 'pending', 'label' => 'Pending'],
                    ['value' => 'paid', 'label' => 'Lunas'],
                    ['value' => 'failed', 'label' => 'Gagal'],
                ]" 
                :selected="request('status')"
            />
        </div>
        <a href="{{ route('admin.payments.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['status']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container" class="mt-6">
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
                    {{ $payment->method_label ?? ucfirst($payment->payment_method) }}
                </span>
            </td>
            <td class="px-5 py-3.5 text-right font-black text-gray-800">Rp {{ number_format($payment->amount,0,',','.') }}</td>
            <td class="px-5 py-3.5">
                <x-ui.badge :type="match($payment->payment_status) {
                    'paid' => 'success',
                    'failed' => 'danger',
                    'pending' => 'warning',
                    default => 'info'
                }" :label="$payment->status_label" />
            </td>
            <td class="px-5 py-3.5 text-sm font-bold text-gray-400">{{ $payment->payment_date?->format('d F Y') ?? $payment->created_at->format('d F Y') }}</td>
            <td class="px-5 py-3.5 text-right">
                <div class="flex items-center justify-end gap-2">
                    <a href="{{ route('admin.shipments.show', $payment->shipment) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100" title="Detail Pengiriman">
                        <i data-lucide="eye" class="w-4 h-4"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </x-data.table>
</x-ui.card>
@endsection
