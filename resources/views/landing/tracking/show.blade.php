@extends('layouts.landing')

@section('title', 'Lacak Paket ' . $shipment->tracking_number . ' - KirimAja')

@section('content')
<div class="bg-gray-50 flex-1">
    <div class="max-w-3xl mx-auto px-4 py-8 space-y-6">

        {{-- Simple Back Link --}}
        <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#1B3A6B] hover:text-[#0F2347] transition-colors">
            <i data-lucide="arrow-left" class="w-4 h-4"></i>
            Kembali
        </a>

        {{-- Header Card --}}
        <div class="premium-gradient rounded-3xl p-8 text-white shadow-xl relative overflow-hidden">
            {{-- Decorative pattern --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/3 blur-3xl"></div>
            
            <div class="relative z-10">
                <div class="flex items-start justify-between flex-wrap gap-4">
                    <div>
                        <p class="text-blue-200 text-xs font-bold uppercase tracking-widest mb-1">Nomor Resi</p>
                        <p class="text-3xl font-black tracking-widest">{{ $shipment->tracking_number }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-xl text-xs font-bold shadow-lg {{ $shipment->status_badge }}">
                        {{ $shipment->status_label }}
                    </span>
                </div>
                <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-6 border-t border-white/10 pt-6">
                    <div>
                        <p class="text-blue-200 text-xs mb-1">Dari</p>
                        <p class="text-sm font-bold">{{ $shipment->originBranch->city ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-blue-200 text-xs mb-1">Ke</p>
                        <p class="text-sm font-bold">{{ $shipment->destinationBranch->city ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-blue-200 text-xs mb-1">Tanggal</p>
                        <p class="text-sm font-bold">{{ $shipment->shipment_date?->format('d M Y') ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-blue-200 text-xs mb-1">Estimasi</p>
                        <p class="text-sm font-bold">{{ $shipment->rate?->estimated_days ?? '-' }} Hari</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Shipment Info --}}
        <div class="grid md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl p-6 border border-gray-100 premium-shadow">
                <h3 class="font-bold text-[#0F2347] text-sm mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-orange-50 flex items-center justify-center">
                        <i data-lucide="user" class="w-4 h-4 text-[#F47B20]"></i>
                    </div>
                    Pengirim
                </h3>
                <div class="space-y-1">
                    <p class="font-bold text-gray-900 text-base">{{ $shipment->sender->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $shipment->sender->phone ?? '-' }}</p>
                    <p class="text-sm text-gray-400 italic">{{ $shipment->originBranch->city ?? '-' }}</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl p-6 border border-gray-100 premium-shadow">
                <h3 class="font-bold text-[#0F2347] text-sm mb-4 flex items-center gap-2">
                    <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center">
                        <i data-lucide="user-check" class="w-4 h-4 text-[#1B3A6B]"></i>
                    </div>
                    Penerima
                </h3>
                <div class="space-y-1">
                    <p class="font-bold text-gray-900 text-base">{{ $shipment->receiver->name ?? '-' }}</p>
                    <p class="text-sm text-gray-500">{{ $shipment->receiver->phone ?? '-' }}</p>
                    <p class="text-sm text-gray-400 italic">{{ $shipment->destinationBranch->city ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Tracking Timeline --}}
        <div class="bg-white rounded-2xl p-8 border border-gray-100 premium-shadow">
            <h3 class="font-bold text-[#0F2347] mb-8 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-orange-50 flex items-center justify-center">
                    <i data-lucide="map-pin" class="w-5 h-5 text-[#F47B20]"></i>
                </div>
                Riwayat Perjalanan
            </h3>

            @if($shipment->trackings->count() > 0)
                <div class="space-y-0 ml-1">
                    @foreach($shipment->trackings->sortByDesc('tracked_at') as $i => $track)
                        <div class="timeline-item {{ $i === 0 ? 'done' : '' }} flex gap-6 pb-10 last:pb-0">
                            <div class="shrink-0 relative">
                                <div class="w-10 h-10 rounded-full {{ $i === 0 ? 'bg-[#1B3A6B] shadow-lg shadow-blue-200' : 'bg-gray-100' }} flex items-center justify-center relative z-10 transition-all">
                                    <i data-lucide="{{ $i === 0 ? 'map-pin' : 'circle' }}" class="w-4 h-4 {{ $i === 0 ? 'text-white' : 'text-gray-400' }}"></i>
                                </div>
                            </div>
                            <div class="flex-1 pt-1">
                                <div class="flex flex-col md:flex-row md:items-center justify-between gap-2 mb-2">
                                    <p class="font-bold text-base {{ $i === 0 ? 'text-[#1B3A6B]' : 'text-gray-700' }}">{{ $track->status_label }}</p>
                                    <div class="flex items-center gap-3 text-xs font-medium text-gray-400">
                                        <span class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5"></i>{{ $track->tracked_at?->format('d M Y') }}</span>
                                        <span class="flex items-center gap-1.5"><i data-lucide="clock" class="w-3.5 h-3.5"></i>{{ $track->tracked_at?->format('H:i') }}</span>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-500 leading-relaxed">{{ $track->description }}</p>
                                
                                <div class="flex items-center gap-1.5 mt-2 text-sm font-bold text-gray-400 tracking-tight">
                                    <i data-lucide="map-pin" class="w-3 h-3 text-[#F47B20]"></i>{{ $track->location }}
                                </div>

                                @if($track->images->count())
                                <div class="flex flex-wrap gap-2 mt-4">
                                    @php
                                        $allImages = $track->images->pluck('image_path')->toArray();
                                    @endphp
                                    @foreach($track->images as $imgIndex => $img)
                                    <button type="button" 
                                            onclick="openImageGallery({{ json_encode($allImages) }}, {{ $imgIndex }})" 
                                            class="block w-16 h-16 rounded-xl overflow-hidden border-2 border-gray-50 hover:border-[#1B3A6B] transition-all shadow-sm group">
                                        <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                                    </button>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-16 bg-gray-50 rounded-2xl border border-dashed border-gray-200">
                    <i data-lucide="package" class="w-16 h-16 mx-auto mb-4 text-gray-300"></i>
                    <p class="text-gray-500 font-medium">Belum ada pembaruan lokasi.</p>
                    <p class="text-xs text-gray-400 mt-1">Kami akan menginformasikan update segera setelah barang diproses.</p>
                </div>
            @endif
        </div>

        {{-- Items --}}
        @if($shipment->items->count() > 0)
        <div class="bg-white rounded-2xl p-8 border border-gray-100 premium-shadow">
            <h3 class="font-bold text-[#0F2347] mb-6 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center">
                    <i data-lucide="package" class="w-5 h-5 text-[#1B3A6B]"></i>
                </div>
                Rincian Barang
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-100">
                            <th class="text-left py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Deskripsi Item</th>
                            <th class="text-center py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Qty</th>
                            <th class="text-right py-4 text-xs font-bold text-gray-400 uppercase tracking-widest">Berat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($shipment->items as $item)
                        <tr>
                            <td class="py-5 font-bold text-gray-800 text-base">{{ $item->item_name }}</td>
                            <td class="py-5 text-center font-medium text-gray-600">{{ $item->quantity }}</td>
                            <td class="py-5 text-right font-medium text-gray-600">{{ $item->weight }} kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="pt-6 font-bold text-gray-500">Total Berat Paket</td>
                            <td class="pt-6 text-right font-black text-xl text-[#1B3A6B]">{{ $shipment->total_weight }} kg</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endif

        {{-- End Content --}}
    </div>
</div>

<x-ui.image-gallery-modal />
@endsection
