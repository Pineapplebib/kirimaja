@extends('layouts.app')
@section('title', 'Pengiriman')
@section('page-title', 'Manajemen Pengiriman')

@section('content')
<x-layout.page-header>
    <form method="GET" action="{{ route('admin.shipments.index') }}" class="flex items-center gap-2 flex-wrap" data-ajax-filter>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nomor resi..."
               class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B] w-48 transition-all">
        
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

        <a href="{{ route('admin.shipments.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['search', 'status']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('admin.shipments._table')
</x-ui.card>
@endsection
