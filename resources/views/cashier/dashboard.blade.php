@extends('layouts.app')
@section('title', 'Dashboard Kasir')
@section('page-title', 'Dashboard Kasir')

@section('content')
<div class="grid sm:grid-cols-3 gap-4 mb-6">
    <x-ui.stat-card label="Pengiriman Hari Ini" :value="$todayShipments" icon="package" color="blue" />
    <x-ui.stat-card label="Menunggu Pembayaran" :value="$pendingPayments" icon="clock" color="orange" />
    
    <x-ui.card class="bg-gradient-to-br from-[#0F2347] to-[#1B3A6B] p-5 border-none shadow-lg shadow-blue-900/20">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-white/10 flex items-center justify-center">
                <i data-lucide="banknote" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <p class="text-sm font-bold text-blue-100 mb-1">Pendapatan hari ini</p>
                <p class="text-2xl font-black text-white">Rp {{ number_format($todayRevenue,0,',','.') }}</p>
            </div>
        </div>
    </x-ui.card>
</div>

<div class="flex gap-4 mb-8 flex-wrap">
    <a href="{{ route('cashier.shipments.create') }}" class="inline-flex items-center gap-2 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-sm font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-blue-900/10 active:scale-[0.98]">
        <i data-lucide="plus-circle" class="w-4 h-4"></i> Buat Pengiriman Baru
    </a>
    <a href="{{ route('cashier.payments.index') }}" class="inline-flex items-center gap-2 bg-[#F47B20] hover:bg-orange-600 text-white text-sm font-bold px-6 py-3 rounded-xl transition-all shadow-lg shadow-orange-600/20 active:scale-[0.98]">
        <i data-lucide="credit-card" class="w-4 h-4"></i> Daftar Pembayaran
    </a>
</div>

<x-ui.card>
    <div class="flex items-center justify-between p-5 border-b border-gray-50">
        <h3 class="font-bold text-gray-800 flex items-center gap-2">
            Pengiriman Terbaru
        </h3>
        <a href="{{ route('cashier.shipments.index') }}" class="text-xs font-bold text-[#1B3A6B] hover:text-[#0F2347] flex items-center gap-1.5 transition-colors">
            Lihat semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="thead-premium">
                <tr>
                    <th class="text-left">Resi</th>
                    <th class="text-left">Pengirim → Penerima</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Pembayaran</th>
                    <th class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentShipments as $s)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5 font-mono text-sm font-bold text-[#1B3A6B] tracking-wider">{{ $s->tracking_number }}</td>
                    <td class="px-5 py-3.5">
                        <p class="text-gray-800 font-bold">{{ $s->sender->name ?? '-' }}</p>
                        <p class="text-[11px] font-medium text-gray-400 mt-0.5"><i data-lucide="arrow-right" class="w-3 h-3 inline"></i> {{ $s->receiver->name ?? '-' }}</p>
                    </td>
                    <td class="px-5 py-3.5">
                        <x-ui.badge :type="match($s->status) {
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                            'pending' => 'warning',
                            default => 'info'
                        }" :label="$s->status_label" />
                    </td>
                    <td class="px-5 py-3.5">
                        @if($s->payment)
                            <x-ui.badge :type="$s->payment->payment_status === 'paid' ? 'success' : 'warning'" :label="ucfirst($s->payment->payment_status)" />
                        @else
                            <span class="text-xs font-bold text-gray-300 italic">No data</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-right">
                    <a href="{{ route('cashier.shipments.show', $s) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100 inline-flex">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-12 text-center text-gray-400">
                    <i data-lucide="package-search" class="w-10 h-10 mx-auto mb-2 opacity-30"></i>
                    <p class="font-medium">Belum ada pengiriman hari ini</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>
@endsection
