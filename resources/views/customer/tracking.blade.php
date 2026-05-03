@extends('layouts.app')
@section('title','Lacak Paket')
@section('page-title','')

@section('content')
<div class="max-w-3xl mx-auto space-y-5">
    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1B3A6B] mb-8 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard
    </a>

    <div class="bg-gradient-to-r from-[#0F2347] to-[#1B3A6B] rounded-xl p-6 text-white">
        <div class="flex items-start justify-between flex-wrap gap-3 mb-4">
            <div>
                <p class="text-blue-300 text-xs mb-1">Nomor Resi</p>
                <p class="text-2xl font-bold font-mono tracking-wider">{{ $shipment->tracking_number }}</p>
            </div>
            <span class="px-3 py-1.5 rounded-full text-xs font-bold {{ $shipment->status_badge }}">{{ $shipment->status_label }}</span>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div><p class="text-blue-300 text-xs">Dari</p><p class="font-semibold">{{ $shipment->originBranch->city ?? '-' }}</p></div>
            <div><p class="text-blue-300 text-xs">Ke</p><p class="font-semibold">{{ $shipment->destinationBranch->city ?? '-' }}</p></div>
            <div><p class="text-blue-300 text-xs">Tanggal</p><p class="font-semibold">{{ $shipment->shipment_date?->format('d F Y') ?? '-' }}</p></div>
            <div><p class="text-blue-300 text-xs">Estimasi</p><p class="font-semibold">{{ $shipment->rate?->estimated_days ?? '-' }} Hari</p></div>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-4">
        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] text-sm mb-3 flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-[#F47B20]"></i> Pengirim</h3>
            <p class="font-bold text-gray-800">{{ $shipment->sender->name ?? '-' }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $shipment->sender->phone ?? '-' }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] text-sm mb-3 flex items-center gap-2"><i data-lucide="user-check" class="w-4 h-4 text-[#F47B20]"></i> Penerima</h3>
            <p class="font-bold text-gray-800">{{ $shipment->receiver->name ?? '-' }}</p>
            <p class="text-sm text-gray-500 mt-1">{{ $shipment->receiver->phone ?? '-' }}</p>
        </div>
    </div>

    <div class="bg-white rounded-xl p-6 border border-gray-100 premium-shadow">
        <h3 class="font-semibold text-[#0F2347] mb-5 flex items-center gap-2"><i data-lucide="map-pin" class="w-5 h-5 text-[#F47B20]"></i> Riwayat Perjalanan</h3>
        @if($shipment->trackings->count())
        <div>
            @foreach($shipment->trackings->sortByDesc('tracked_at') as $i => $t)
            <div class="timeline-item {{ $i===0?'done':'' }} flex gap-4 pb-6">
                <div class="w-10 h-10 rounded-full {{ $i===0?'bg-[#1B3A6B]':'bg-gray-100' }} flex items-center justify-center shrink-0">
                    <i data-lucide="{{ $i===0?'map-pin':'circle' }}" class="w-4 h-4 {{ $i===0?'text-white':'text-gray-400' }}"></i>
                </div>
                <div class="flex-1 pt-1.5">
                    <p class="font-semibold text-sm {{ $i===0?'text-[#1B3A6B]':'text-gray-700' }}">{{ $t->status_label }}</p>
                    <p class="text-sm text-gray-600 mt-0.5">{{ $t->description }}</p>

                    @if($t->images->count())
                    <div class="flex flex-wrap gap-2 mt-3">
                        @php
                            $allImages = $t->images->pluck('image_path')->toArray();
                        @endphp
                        @foreach($t->images as $imgIndex => $img)
                        <button type="button" 
                                onclick="openImageGallery({{ json_encode($allImages) }}, {{ $imgIndex }})" 
                                class="block w-14 h-14 rounded-lg overflow-hidden border border-gray-100 hover:border-[#1B3A6B] transition-all shadow-sm">
                            <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                        </button>
                        @endforeach
                    </div>
                    @endif

                    <div class="flex items-center gap-3 mt-1.5 text-xs text-gray-400">
                        <span class="flex items-center gap-1"><i data-lucide="map-pin" class="w-3 h-3"></i>{{ $t->location }}</span>
                        <span class="flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i>{{ $t->tracked_at?->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-10 text-gray-400">
            <i data-lucide="package" class="w-12 h-12 mx-auto mb-3 opacity-30"></i>
            <p class="text-sm">Belum ada update tracking.</p>
        </div>
        @endif
    </div>
</div>
@endsection

<x-ui.image-gallery-modal />
