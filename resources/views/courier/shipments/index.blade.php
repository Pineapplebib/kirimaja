@extends('layouts.app')
@section('title','Pengiriman Saya')
@section('page-title','Pengiriman Saya')

@section('content')
<div class="grid sm:grid-cols-2 gap-4 mb-6">
    <div class="bg-[#1B3A6B] rounded-xl p-4 text-white flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-white/20 flex items-center justify-center shrink-0">
            <i data-lucide="truck" class="w-5 h-5"></i>
        </div>
        <div><p class="text-2xl font-bold">{{ $activeCount }}</p><p class="text-blue-200 text-xs">Sedang Berjalan</p></div>
    </div>
    <div class="bg-white rounded-xl p-4 border border-gray-100 premium-shadow flex items-center gap-3">
        <div class="w-10 h-10 rounded-lg bg-green-50 flex items-center justify-center shrink-0">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-green-600"></i>
        </div>
        <div><p class="text-2xl font-bold text-gray-800">{{ $deliveredCount }}</p><p class="text-gray-500 text-xs">Total Terkirim</p></div>
    </div>
</div>

<div class="mb-4">
    <form method="GET" action="{{ route('courier.shipments.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <div class="w-48">
            <x-form.select-dropdown 
                name="status" 
                label="Semua Status" 
                :options="[
                    ['value' => 'picked_up', 'label' => 'Dijemput'],
                    ['value' => 'in_transit', 'label' => 'Dalam Perjalanan'],
                    ['value' => 'arrived_at_branch', 'label' => 'Tiba di Cabang'],
                    ['value' => 'out_for_delivery', 'label' => 'Sedang Diantar'],
                    ['value' => 'delivered', 'label' => 'Terkirim'],
                ]" 
                :selected="request('status')"
                class="!py-2 !text-xs"
            />
        </div>

        <a href="{{ route('courier.shipments.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['status']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>

        <button type="submit" class="hidden">Filter</button>
    </form>
</div>

<div id="table-container">
<div class="space-y-3">
    @forelse($shipments as $s)
    <div class="bg-white rounded-xl border border-gray-100 premium-shadow p-5 hover:border-[#1B3A6B]/20 transition-all">
        <div class="flex items-start justify-between gap-3">
            <div class="flex-1 min-w-0">
                <div class="flex items-center gap-2 mb-2 flex-wrap">
                    <span class="font-mono text-sm font-bold text-[#1B3A6B]">{{ $s->tracking_number }}</span>
                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $s->status_badge }}">{{ $s->status_label }}</span>
                </div>
                <div class="grid sm:grid-cols-2 gap-x-6 gap-y-1 text-sm">
                    <p class="text-gray-600"><span class="text-gray-400 text-xs">Penerima:</span> {{ $s->receiver->name ?? '-' }}</p>
                    <p class="text-gray-600"><span class="text-gray-400 text-xs">Tujuan:</span> {{ $s->destinationBranch->city ?? '-' }}</p>
                    <p class="text-gray-600"><span class="text-gray-400 text-xs">Berat:</span> {{ $s->total_weight }} kg</p>
                    <p class="text-gray-600"><span class="text-gray-400 text-xs">Tanggal:</span> {{ $s->shipment_date?->format('d F Y') }}</p>
                </div>
            </div>
            <a href="{{ route('courier.shipments.show', $s) }}" class="shrink-0 inline-flex items-center gap-1.5 px-4 py-2 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-xs font-semibold rounded-lg transition-colors">
                <i data-lucide="eye" class="w-3.5 h-3.5"></i> Detail
            </a>
        </div>
    </div>
    @empty
    <div class="bg-white rounded-xl p-12 text-center text-gray-400 border border-gray-100">
        <i data-lucide="package" class="w-12 h-12 mx-auto mb-3 opacity-30"></i>
        <p>Tidak ada pengiriman</p>
    </div>
    @endforelse
</div>
    @if($shipments->hasPages())
    <div class="mt-4">{{ $shipments->links() }}</div>
    @endif
</div>
@endsection
