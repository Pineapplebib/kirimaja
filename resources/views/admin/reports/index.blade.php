@extends('layouts.app')
@section('title', 'Laporan Pengiriman')
@section('page-title', 'Pusat Laporan')

@section('content')
<div class="space-y-6">
    <x-layout.page-header title="Pusat Laporan" />

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Filter Card --}}
        <div class="lg:col-span-2">
            <x-ui.card overflow="visible">
                <form action="{{ route('admin.reports.generate') }}" method="GET" target="_blank" id="reportForm" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-form.input-group 
                            label="Tanggal Mulai" 
                            name="start_date" 
                            type="text" 
                            icon="calendar" 
                            required
                            datepicker
                            datepicker-autohide
                            datepicker-format="dd-mm-yyyy"
                            datepicker-orientation="bottom left"
                            placeholder="Pilih tanggal mulai"
                        />
                        
                        <x-form.input-group 
                            label="Tanggal Selesai" 
                            name="end_date" 
                            type="text" 
                            icon="calendar" 
                            required
                            datepicker
                            datepicker-autohide
                            datepicker-format="dd-mm-yyyy"
                            datepicker-orientation="bottom left"
                            placeholder="Pilih tanggal selesai"
                        />

                        <div class="md:col-span-2 space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Status Pengiriman</label>
                            <x-form.select-dropdown 
                                name="status" 
                                label="Semua Status" 
                                :options="[
                                    ['value' => '', 'label' => 'Semua Status'],
                                    ['value' => 'pending', 'label' => 'Menunggu'],
                                    ['value' => 'picked_up', 'label' => 'Dijemput'],
                                    ['value' => 'in_transit', 'label' => 'Dalam Perjalanan'],
                                    ['value' => 'arrived_at_branch', 'label' => 'Tiba di Cabang'],
                                    ['value' => 'out_for_delivery', 'label' => 'Sedang Diantar'],
                                    ['value' => 'delivered', 'label' => 'Terkirim'],
                                    ['value' => 'cancelled', 'label' => 'Dibatalkan'],
                                ]" 
                            />
                        </div>
                    </div>

                    <div class="pt-4 border-t border-gray-50">
                        <button type="submit" 
                                class="inline-flex items-center justify-center gap-2 w-full px-6 py-3.5 bg-[#1B3A6B] hover:bg-[#0F2347] text-white rounded-xl font-bold text-sm transition-all shadow-sm">
                            <i data-lucide="printer" class="w-4.5 h-4.5"></i>
                            Cetak Laporan PDF
                        </button>
                    </div>
                </form>
            </x-ui.card>
        </div>

        {{-- Presets & Info --}}
        <div class="space-y-6">
            <x-ui.card class="p-6">
                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-5">Quick Presets</h3>
                <div class="grid grid-cols-1 gap-2.5">
                    <button type="button" onclick="setPreset('today')" class="flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 text-gray-600 hover:text-[#1B3A6B] transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-50 group-hover:bg-blue-100 rounded-lg text-gray-400 group-hover:text-blue-600 transition-colors">
                                <i data-lucide="clock" class="w-4 h-4"></i>
                            </div>
                            <span class="text-sm font-bold">Hari Ini</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0"></i>
                    </button>

                    <button type="button" onclick="setPreset('month')" class="flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 text-gray-600 hover:text-[#1B3A6B] transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-50 group-hover:bg-blue-100 rounded-lg text-gray-400 group-hover:text-blue-600 transition-colors">
                                <i data-lucide="calendar" class="w-4 h-4"></i>
                            </div>
                            <span class="text-sm font-bold">Bulan Ini</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0"></i>
                    </button>

                    <button type="button" onclick="setPreset('year')" class="flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 text-gray-600 hover:text-[#1B3A6B] transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-50 group-hover:bg-blue-100 rounded-lg text-gray-400 group-hover:text-blue-600 transition-colors">
                                <i data-lucide="calendar-range" class="w-4 h-4"></i>
                            </div>
                            <span class="text-sm font-bold">Tahun Ini</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0"></i>
                    </button>

                    <button type="button" onclick="setPreset('last30')" class="flex items-center justify-between p-3.5 rounded-xl border border-gray-100 hover:border-blue-200 hover:bg-blue-50/50 text-gray-600 hover:text-[#1B3A6B] transition-all group">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-gray-50 group-hover:bg-blue-100 rounded-lg text-gray-400 group-hover:text-blue-600 transition-colors">
                                <i data-lucide="history" class="w-4 h-4"></i>
                            </div>
                            <span class="text-sm font-bold">30 Hari Terakhir</span>
                        </div>
                        <i data-lucide="chevron-right" class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-all -translate-x-2 group-hover:translate-x-0"></i>
                    </button>
                </div>
            </x-ui.card>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function setPreset(type) {
        const startInput = document.getElementById('start_date');
        const endInput = document.getElementById('end_date');
        const today = new Date();
        const formatDate = (date) => {
            const d = date.getDate().toString().padStart(2, '0');
            const m = (date.getMonth() + 1).toString().padStart(2, '0');
            const y = date.getFullYear();
            return `${d}-${m}-${y}`;
        };

        const parseDate = (str) => {
            if (!str) return null;
            const parts = str.split('-');
            if (parts.length !== 3) return new Date(str);
            return new Date(parts[2], parts[1] - 1, parts[0]);
        };

        switch(type) {
            case 'today':
                startInput.value = formatDate(today);
                endInput.value = formatDate(today);
                break;
            case 'month':
                const firstDayMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                startInput.value = formatDate(firstDayMonth);
                endInput.value = formatDate(today);
                break;
            case 'year':
                const firstDayYear = new Date(today.getFullYear(), 0, 1);
                startInput.value = formatDate(firstDayYear);
                endInput.value = formatDate(today);
                break;
            case 'last30':
                const thirtyDaysAgo = new Date();
                thirtyDaysAgo.setDate(today.getDate() - 30);
                startInput.value = formatDate(thirtyDaysAgo);
                endInput.value = formatDate(today);
                break;
        }
        
        const event = new Event('change', { bubbles: true });
        startInput.dispatchEvent(event);
        endInput.dispatchEvent(event);
        
        startInput.classList.add('ring-2', 'ring-blue-400');
        endInput.classList.add('ring-2', 'ring-blue-400');
        setTimeout(() => {
            startInput.classList.remove('ring-2', 'ring-blue-400');
            endInput.classList.remove('ring-2', 'ring-blue-400');
        }, 500);
    }

    document.addEventListener('DOMContentLoaded', () => {
        setPreset('month');

        const form = document.getElementById('reportForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                const startInput = document.getElementById('start_date');
                const endInput = document.getElementById('end_date');
                
                if (startInput.value && endInput.value) {
                    const parseDate = (str) => {
                        const parts = str.split('-');
                        return new Date(parts[2], parts[1] - 1, parts[0]);
                    };
                    const start = parseDate(startInput.value);
                    const end = parseDate(endInput.value);

                    if (start > end) {
                        e.preventDefault();
                        if (window.Swal) {
                            window.Swal.fire({
                                icon: 'warning',
                                title: 'Rentang Tanggal Tidak Valid',
                                text: 'Tanggal Mulai tidak boleh lebih besar dari Tanggal Selesai.',
                                confirmButtonText: 'Perbaiki'
                            });
                        } else {
                            alert('Tanggal Mulai tidak boleh lebih besar dari Tanggal Selesai.');
                        }
                        return false;
                    }
                }
            });
        }
    });
</script>
@endpush
@endsection
