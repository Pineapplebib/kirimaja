@extends('layouts.app')
@section('title', 'Dashboard Kurir')
@section('page-title', 'Dashboard Kurir')

@section('content')
<div class="grid sm:grid-cols-3 gap-4 mb-6">
    <x-ui.card class="bg-gradient-to-br from-[#0F2347] to-[#1B3A6B] p-5 border-none shadow-lg shadow-blue-900/20">
        <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center mb-3">
            <i data-lucide="truck" class="w-5 h-5 text-white"></i>
        </div>
        <p class="text-3xl font-black text-white">{{ $activeShipments->count() }}</p>
        <p class="text-blue-100 text-sm uppercase font-bold tracking-widest mt-1">Pengiriman Aktif</p>
    </x-ui.card>

    <x-ui.stat-card label="Terkirim Hari Ini" :value="$todayDelivered" icon="check-circle-2" color="green" />
    <x-ui.stat-card label="Total Terkirim" :value="$totalDelivered" icon="package" color="orange" />
</div>

<x-ui.card>
    <div class="flex items-center justify-between p-5 border-b border-gray-50">
        <h3 class="font-bold text-gray-800 flex items-center gap-2">
            Pengiriman Aktif
        </h3>
        <a href="{{ route('courier.shipments.index') }}" class="text-xs font-bold text-[#1B3A6B] hover:text-[#0F2347] flex items-center gap-1.5 transition-colors">
            Lihat semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
    <div class="divide-y divide-gray-50">
        @forelse($activeShipments as $s)
        <div class="p-5 hover:bg-gray-50/50 transition-colors group">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="font-mono text-sm font-bold text-[#1B3A6B] tracking-wider">{{ $s->tracking_number }}</span>
                        <x-ui.badge :type="match($s->status) {
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                            'pending' => 'warning',
                            default => 'info'
                        }" :label="$s->status_label" />
                    </div>
                    <p class="text-sm font-bold text-gray-800">{{ $s->receiver->name ?? '-' }}</p>
                    <div class="flex items-center gap-1.5 mt-2 transition-all group-hover:translate-x-1">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#F47B20]"></i>
                        <span class="text-sm font-bold text-gray-400 tracking-tighter">{{ $s->destinationBranch->city ?? '-' }}</span>
                    </div>
                </div>
                <a href="{{ route('courier.shipments.show', $s) }}" class="shrink-0 inline-flex items-center gap-2 px-4 py-2 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-sm font-bold rounded-xl transition-all active:scale-95">
                    Update <i data-lucide="chevron-right" class="w-4 h-4"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="p-16 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                <i data-lucide="truck" class="w-8 h-8 text-gray-200"></i>
            </div>
            <p class="text-sm text-gray-400 font-medium">Tidak ada pengiriman aktif</p>
        </div>
        @endforelse
    </div>
</x-ui.card>
@endsection
