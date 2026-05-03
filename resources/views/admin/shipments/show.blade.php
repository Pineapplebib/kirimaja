@extends('layouts.app')
@section('title', 'Detail Pengiriman')
@section('page-title', 'Detail Pengiriman')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <x-ui.back-link :href="route('admin.shipments.index')" class="mb-0" />
    <div class="flex gap-2">
        @if($shipment->status !== 'cancelled' && $shipment->status !== 'delivered')
        <form method="POST" action="{{ route('admin.shipments.cancel', $shipment) }}" data-confirm="Apakah Anda yakin ingin membatalkan pengiriman ini? Tindakan ini tidak dapat dibatalkan." data-confirm-title="Batalkan Pengiriman?" data-confirm-button="Ya, Batalkan">
            @csrf
            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-red-50 hover:bg-red-500 hover:border-red-500 hover:text-white text-red-600 border border-red-100 rounded-xl text-sm font-bold transition-all active:scale-95 shadow-md">
                <i data-lucide="x-circle" class="w-4 h-4"></i> Batalkan Pengiriman
            </button>
        </form>
        @endif
    </div>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    {{-- Main Info --}}
    <div class="lg:col-span-2 space-y-5">
        {{-- Header Card --}}
        <div class="bg-gradient-to-r from-[#0F2347] to-[#1B3A6B] rounded-xl p-6 text-white shadow-lg">
            <div class="flex items-start justify-between flex-wrap gap-3 mb-4">
                <div>
                    <p class="text-blue-300 text-xs mb-1 font-bold">Nomor resi</p>
                    <p class="text-2xl font-bold font-mono tracking-wider">{{ $shipment->tracking_number }}</p>
                </div>
                <x-ui.badge :type="match($shipment->status) {
                    'delivered' => 'success',
                    'cancelled' => 'danger',
                    'pending' => 'warning',
                    default => 'info'
                }" :label="$shipment->status_label" class="!py-1.5 !px-4" />
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mt-6 border-t border-white/10 pt-4">
                <div><p class="text-blue-300 text-xs font-bold mb-1">Dari</p><p class="font-semibold">{{ $shipment->originBranch->city ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs font-bold mb-1">Ke</p><p class="font-semibold">{{ $shipment->destinationBranch->city ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs font-bold mb-1">Tanggal</p><p class="font-semibold">{{ $shipment->shipment_date?->format('d F Y') ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs font-bold mb-1">Berat</p><p class="font-semibold">{{ $shipment->total_weight }} kg</p></div>
            </div>
        </div>

        {{-- Sender / Receiver --}}
        <div class="grid md:grid-cols-2 gap-4">
            <x-ui.card class="p-5">
                <h3 class="font-semibold text-[#0F2347] text-xs mb-4 flex items-center gap-2 opacity-70">
                    <i data-lucide="user" class="w-4 h-4 text-[#F47B20]"></i> Pengirim
                </h3>
                <p class="font-bold text-gray-800">{{ $shipment->sender->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $shipment->sender->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $shipment->sender->address ?? '-' }}</p>
            </x-ui.card>
            <x-ui.card class="p-5">
                <h3 class="font-semibold text-[#0F2347] text-xs mb-4 flex items-center gap-2 opacity-70">
                    <i data-lucide="user-check" class="w-4 h-4 text-[#F47B20]"></i> Penerima
                </h3>
                <p class="font-bold text-gray-800">{{ $shipment->receiver->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $shipment->receiver->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500 leading-relaxed">{{ $shipment->receiver->address ?? '-' }}</p>
            </x-ui.card>
        </div>

        {{-- Items --}}
        <x-ui.card class="p-5">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="package" class="w-4 h-4 text-[#F47B20]"></i> Isi Paket
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead><tr class="border-b border-gray-100 text-xs text-gray-500 font-bold uppercase tracking-wider">
                        <th class="pb-3 text-left">Nama Barang</th>
                        <th class="pb-3 text-center">Qty</th>
                        <th class="pb-3 text-right">Berat</th>
                    </tr></thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($shipment->items as $item)
                        <tr>
                            <td class="py-3 font-medium text-gray-800">{{ $item->item_name }}</td>
                            <td class="py-3 text-center text-gray-600 font-bold">{{ $item->quantity }}</td>
                            <td class="py-3 text-right text-gray-600">{{ $item->weight }} kg</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot><tr>
                        <td colspan="2" class="pt-4 font-bold text-gray-700">Total Berat</td>
                        <td class="pt-4 text-right font-extrabold text-[#1B3A6B]">{{ $shipment->total_weight }} kg</td>
                    </tr></tfoot>
                </table>
            </div>
        </x-ui.card>

        {{-- Tracking Timeline --}}
        <x-ui.card class="p-5">
            <h3 class="font-semibold text-[#0F2347] mb-6 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-[#F47B20]"></i> Riwayat Tracking
            </h3>
            @if($shipment->trackings->count())
            <div class="space-y-0 pl-1">
                @foreach($shipment->trackings->sortBy('tracked_at') as $i => $t)
                <div class="flex gap-6 pb-8 last:pb-0 relative">
                    @if(!$loop->last)
                        <div class="absolute left-5 top-10 bottom-0 w-px bg-gray-100"></div>
                    @endif
                    <div class="w-10 h-10 rounded-full {{ $loop->last ? 'bg-[#1B3A6B] shadow-lg shadow-blue-900/20' : 'bg-gray-100' }} flex items-center justify-center shrink-0 z-10 transition-all">
                        <i data-lucide="{{ $loop->last ? 'map-pin' : 'circle' }}" class="w-4 h-4 {{ $loop->last ? 'text-white' : 'text-gray-400' }}"></i>
                    </div>
                    <div class="flex-1 pt-1">
                        <div class="flex justify-between items-start flex-wrap gap-2">
                            <p class="font-bold text-sm {{ $loop->last ? 'text-[#1B3A6B]' : 'text-gray-700' }}">{{ $t->status_label }}</p>
                            <span class="text-xs font-bold text-gray-400">{{ $t->tracked_at?->format('d F Y, H:i') }}</span>
                        </div>
                        <p class="text-sm text-gray-500 mt-1 leading-relaxed">{{ $t->description }}</p>

                        @if($t->images->count())
                        <div class="flex flex-wrap gap-2 mt-3">
                            @php
                                $allImages = $t->images->pluck('image_path')->toArray();
                            @endphp
                            @foreach($t->images as $imgIndex => $img)
                            <button type="button" 
                                    onclick="openImageGallery({{ json_encode($allImages) }}, {{ $imgIndex }})" 
                                    class="block w-16 h-16 rounded-lg overflow-hidden border border-gray-100 hover:border-[#1B3A6B] transition-all shadow-sm">
                                <img src="{{ asset('storage/' . $img->image_path) }}" class="w-full h-full object-cover">
                            </button>
                            @endforeach
                        </div>
                        @endif

                        <div class="flex items-center gap-1.5 mt-2 text-xs font-bold text-gray-400">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i>{{ $t->location }}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="py-12 text-center">
                <i data-lucide="package-search" class="w-12 h-12 text-gray-200 mx-auto mb-3"></i>
                <p class="text-sm text-gray-400">Belum ada riwayat tracking</p>
            </div>
            @endif
        </x-ui.card>
    </div>

    {{-- Sidebar --}}
    <div class="space-y-5">
        {{-- Payment --}}
        <x-ui.card class="p-5 !overflow-visible">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="credit-card" class="w-4 h-4 text-[#F47B20]"></i> Pembayaran
            </h3>
            @if($shipment->payment)
            <div class="space-y-4 text-sm mt-2">
                <div class="p-3 {{ $shipment->payer_type === 'sender' ? 'bg-blue-50 border-blue-100' : 'bg-orange-50 border-orange-100' }} border rounded-xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg {{ $shipment->payer_type === 'sender' ? 'bg-[#1B3A6B]' : 'bg-[#F47B20]' }} flex items-center justify-center text-white shrink-0 shadow-sm">
                        <i data-lucide="{{ $shipment->payer_type === 'sender' ? 'wallet' : 'hand-coins' }}" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider {{ $shipment->payer_type === 'sender' ? 'text-[#1B3A6B]' : 'text-[#F47B20]' }} opacity-70">Penanggung Jawab</p>
                        <p class="font-bold text-gray-800">{{ $shipment->payer_type === 'sender' ? 'Pengirim (Prepaid)' : 'Penerima (COD)' }}</p>
                    </div>
                </div>
                <div class="space-y-2.5 px-1 pt-1 border-t border-gray-50 mt-1">
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Tagihan</span><span class="font-extrabold text-[#1B3A6B]">Rp {{ number_format($shipment->payment->amount ?? $shipment->total_price,0,',','.') }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Metode</span><span class="font-bold text-gray-700">{{ $shipment->payment->method_label ?? 'Belum bayar' }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Status</span>
                        <x-ui.badge :type="($shipment->payment?->payment_status === 'paid') ? 'success' : 'warning'" :label="ucfirst($shipment->payment?->payment_status ?? 'pending')" />
                    </div>
                </div>
            </div>
            @endif
        </x-ui.card>

        {{-- Assign Courier --}}
        @if(in_array($shipment->status, ['pending', 'arrived_at_branch']))
        <x-ui.card class="p-5 !overflow-visible">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="truck" class="w-4 h-4 text-[#1B3A6B]"></i> Tugaskan Kurir
            </h3>
            @if($shipment->courier)
            <div class="flex items-center gap-3 p-3 bg-blue-50/50 rounded-xl mb-4 border border-blue-100">
                <div class="w-10 h-10 rounded-lg bg-[#1B3A6B] flex items-center justify-center text-white text-sm font-bold shadow-md">
                    {{ strtoupper(substr($shipment->courier->name,0,1)) }}
                </div>
                <div>
                    <p class="font-bold text-sm text-[#1B3A6B]">{{ $shipment->courier->name }}</p>
                    <p class="text-xs font-bold text-gray-400 mt-0.5">{{ $shipment->courier->vehicle?->plate_number ?? 'Tanpa kendaraan' }}</p>
                </div>
            </div>
            @endif
            <form method="POST" action="{{ route('admin.shipments.assign-courier', $shipment) }}" class="space-y-4">
                @csrf
                <div class="space-y-1.5">
                    <x-form.select-dropdown 
                        name="courier_id" 
                        label="Pilih Kurir" 
                        :options="$couriers->map(fn($c) => ['value' => $c->id, 'label' => $c->name . ($c->vehicle ? ' - ' . $c->vehicle->plate_number : ' - Tanpa kendaraan')])" 
                        :selected="$shipment->courier_id"
                        searchable="true"
                        required="true"
                    />
                </div>
                <button type="submit" class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-bold py-3 rounded-xl text-sm transition-all shadow-lg shadow-blue-900/10 active:scale-[0.98]">
                    {{ $shipment->courier ? 'Ganti Kurir' : 'Tugaskan Kurir' }}
                </button>
            </form>
        </x-ui.card>
        @endif

        {{-- Rate info --}}
        <x-ui.card class="p-5">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="tag" class="w-4 h-4 text-green-600"></i> Rincian Tarif
            </h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between items-center"><span class="text-gray-500">Tarif/kg</span><span class="font-medium">Rp {{ number_format($shipment->rate?->price_per_kg ?? 0,0,',','.') }}</span></div>
                <div class="flex justify-between items-center"><span class="text-gray-500">Berat Total</span><span class="font-medium">{{ $shipment->total_weight }} kg</span></div>
                <div class="flex justify-between items-center font-extrabold pt-3 border-t border-gray-100 text-lg">
                    <span class="text-gray-800">Total Tagihan</span>
                    <span class="text-[#1B3A6B]">Rp {{ number_format($shipment->total_price,0,',','.') }}</span>
                </div>
            </div>
        </x-ui.card>
    </div>
</div>
@endsection

<x-ui.image-gallery-modal />
