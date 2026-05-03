@extends('layouts.app')
@section('title','Daftar Pengiriman')
@section('page-title','Daftar Pengiriman')

@section('content')
<div class="bg-gradient-to-r from-[#0F2347] to-[#1B3A6B] rounded-xl p-5 mb-6 shadow-lg relative overflow-hidden">
    <div class="relative z-10 flex flex-col md:flex-row items-center gap-4">
        <div class="flex-1 text-white">
            <h2 class="font-bold text-lg mb-1 flex items-center gap-2"><i data-lucide="scan-line" class="w-5 h-5 text-blue-300"></i> Scan Paket Masuk</h2>
            <p class="text-xs text-blue-200">Scan resi untuk proses penerimaan barang di cabang.</p>
        </div>
        <form method="POST" action="{{ route('cashier.shipments.scan') }}" class="w-full md:w-1/2 flex items-center gap-2">
            @csrf
            <div class="relative flex-1">
                <i data-lucide="barcode" class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                <input type="text" name="tracking_number" placeholder="Nomor Resi..." required autofocus
                       class="w-full pl-10 pr-4 py-3 bg-white/5 border border-white/10 text-white placeholder-blue-200 rounded-xl text-sm font-bold focus:outline-none focus:border-white/30 focus:bg-white/10 transition-all shadow-inner">
            </div>
            <button type="submit" class="bg-[#F47B20] hover:bg-orange-600 text-white px-5 py-3 rounded-xl transition-all shadow-md font-bold text-sm active:scale-95 shrink-0 flex items-center gap-2">
                Proses <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>

<div class="flex items-center justify-between mb-6 flex-wrap gap-4">
    <div class="flex flex-wrap items-center gap-4">
        {{-- Filter Form --}}
        <form method="GET" action="{{ route('cashier.shipments.index') }}" class="flex items-center gap-2 flex-wrap" data-ajax-filter>
            <div class="relative">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari..."
                       class="pl-9 pr-4 py-2 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 w-48 transition-all">
            </div>
        <div class="w-48">
            <x-form.select-dropdown 
                name="status" 
                label="Semua Status" 
                :options="[
                    ['value' => 'pending', 'label' => 'Menunggu'],
                    ['value' => 'picked_up', 'label' => 'Dijemput'],
                    ['value' => 'in_transit', 'label' => 'Dalam Perjalanan'],
                    ['value' => 'arrived_at_branch', 'label' => 'Tiba di Cabang'],
                    ['value' => 'out_for_delivery', 'label' => 'Sedang Diantar'],
                    ['value' => 'delivered', 'label' => 'Terkirim'],
                    ['value' => 'cancelled', 'label' => 'Dibatalkan'],
                ]" 
                :selected="request('status')"
            />
        </div>

        <a href="{{ route('cashier.shipments.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['search', 'status']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>

        <button type="submit" class="hidden">Filter</button>
        </form>
    </div>
    <a href="{{ route('cashier.shipments.create') }}" class="inline-flex items-center gap-2 bg-[#F47B20] hover:bg-orange-600 text-white text-sm font-bold px-5 py-2.5 rounded-xl transition-all shadow-lg shadow-orange-500/20">
        <i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Pengiriman
    </a>
</div>

<div id="table-container">
<x-data.table :items="$shipments" emptyMessage="Belum ada data pengiriman" emptyIcon="package-search">
    <x-slot:thead>
        <tr>
            <th class="text-left">Resi</th>
            <th class="text-left">Pihak Terlibat</th>
            <th class="text-left">Tujuan</th>
            <th class="text-left font-center">Status</th>
            <th class="text-left">Bayar</th>
            <th class="text-right">Total</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($shipments as $s)
    <tr class="hover:bg-gray-50/50 transition-colors">
        <td class="px-5 py-4">
            <span class="font-mono text-sm font-black text-[#1B3A6B] tracking-tight">{{ $s->tracking_number }}</span>
            <p class="text-[11px] font-bold text-gray-400 mt-1 uppercase">{{ $s->shipment_date?->format('d F Y') }}</p>
        </td>
        <td class="px-5 py-4">
            <p class="font-bold text-gray-800">{{ $s->sender->name ?? '-' }}</p>
            <p class="text-xs font-bold text-gray-400 mt-0.5"><i data-lucide="arrow-right" class="w-3 h-3 inline"></i> {{ $s->receiver->name ?? '-' }}</p>
        </td>
        <td class="px-5 py-4">
            <p class="text-sm font-bold text-gray-500">{{ $s->destinationBranch->city ?? '-' }}</p>
        </td>
        <td class="px-5 py-4">
            <x-ui.badge :type="match($s->status) {
                'delivered' => 'success',
                'cancelled' => 'danger',
                'pending' => 'warning',
                default => 'info'
            }" :label="$s->status_label" />
        </td>
        <td class="px-5 py-4">
            @if($s->payment)
                <x-ui.badge :type="$s->payment->payment_status === 'paid' ? 'success' : 'warning'" :label="ucfirst($s->payment->payment_status)" />
            @else
                <a href="{{ route('cashier.payments.create', $s) }}" class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-orange-50 text-orange-600 hover:bg-orange-100 transition-colors border border-orange-100">
                    Bayar Sekarang
                </a>
            @endif
        </td>
        <td class="px-5 py-4 text-right font-black text-gray-800">Rp {{ number_format($s->total_price,0,',','.') }}</td>
        <td class="px-5 py-4 text-right flex items-center justify-end gap-2">
            @if($s->status === 'in_transit' && $s->destination_branch_id === Auth::user()->branch_id)
                <form action="{{ route('cashier.shipments.receive', $s) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="p-2 text-green-500 hover:text-green-700 hover:bg-green-50 rounded-lg transition-all border border-transparent hover:border-green-100 flex items-center gap-1.5 text-xs font-bold" title="Terima Barang">
                        <i data-lucide="package-check" class="w-4 h-4"></i> Terima
                    </button>
                </form>
            @endif
            <a href="{{ route('cashier.shipments.show', $s) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100 inline-flex" title="Lihat Detail">
                <i data-lucide="eye" class="w-4 h-4"></i>
            </a>
        </td>
    </tr>
    @endforeach
</x-data.table>
</div>
@endsection
