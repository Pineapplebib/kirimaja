@extends('layouts.app')
@section('title', 'Detail Pengiriman')
@section('page-title', 'Detail Pengiriman')

@section('content')
<x-ui.back-link :href="route('courier.shipments.index')" />

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

        {{-- Parties --}}
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

        {{-- Tracking History --}}
        <x-ui.card class="p-5">
            <h3 class="font-semibold text-[#0F2347] mb-6 flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-[#F47B20]"></i> Riwayat Tracking
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
            <div class="py-12 text-center text-gray-400">
                <i data-lucide="package-search" class="w-12 h-12 mx-auto mb-3 opacity-20"></i>
                <p class="text-sm">Belum ada riwayat tracking</p>
            </div>
            @endif
        </x-ui.card>
    </div>

    {{-- Sidebar Actions --}}
    <div class="space-y-5">
        {{-- Update Status Card --}}
        @if(!in_array($shipment->status, ['delivered','cancelled']))
        <x-ui.card class="p-5 !overflow-visible">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="refresh-cw" class="w-4 h-4 text-[#F47B20]"></i> Update Status
            </h3>
            <form method="POST" action="{{ route('courier.shipments.update-status', $shipment) }}" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 ml-1">Status Baru</label>
                    <x-form.select-dropdown 
                        name="status" 
                        label="Pilih Status" 
                        :options="$statusOptions" 
                        required="true"
                    />
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 ml-1">Lokasi Saat Ini</label>
                    <x-form.select-dropdown 
                        name="location_id" 
                        label="Pilih Kantor Cabang" 
                        :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->city . ' (' . $b->name . ')'])" 
                        :selected="old('location_id', $defaultLocationId)"
                        searchable="true"
                        required="true"
                    />
                </div>
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1.5 ml-1">Keterangan</label>
                    <textarea name="description" required rows="3"
                              class="w-full px-4 py-2.5 bg-gray-50 border border-gray-100 rounded-xl text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#1B3A6B] transition-all"
                              placeholder="Contoh: Paket sedang dalam pengiriman ke kurir..." >{{ old('description') }}</textarea>
                </div>
                {{-- Multi Photo Upload Component --}}
                <x-form.multi-image-preview 
                    name="images" 
                    label="Unggah Bukti Foto (Opsional)" 
                    max="5" 
                    helperText="Maksimal 5 foto sekaligus (Max 3MB per foto)" 
                />
                <button type="submit" class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-bold py-3.5 rounded-2xl text-sm transition-all shadow-lg shadow-blue-900/10 active:scale-95 flex items-center justify-center gap-2">
                    <i data-lucide="check-circle-2" class="w-4 h-4"></i> Update Status
                </button>
            </form>
        </x-ui.card>
        @else
        <x-ui.card class="p-8 text-center bg-gray-50/50">
            <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                <i data-lucide="{{ $shipment->status === 'delivered' ? 'check-circle-2' : 'x-circle' }}" class="w-8 h-8 {{ $shipment->status === 'delivered' ? 'text-green-500' : 'text-red-500' }}"></i>
            </div>
            <p class="text-sm font-bold text-gray-500">Pengiriman ini sudah {{ $shipment->status === 'delivered' ? 'selesai' : 'dibatalkan' }}.</p>
        </x-ui.card>
        @endif
    </div>
</div>
@endsection

<x-ui.image-gallery-modal />

