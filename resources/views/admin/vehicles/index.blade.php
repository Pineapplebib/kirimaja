@extends('layouts.app')
@section('title', 'Kendaraan')
@section('page-title', 'Manajemen Kendaraan')

@section('content')
<x-layout.page-header buttonText="Tambah Kendaraan" :buttonLink="route('admin.vehicles.create')">
    <form method="GET" action="{{ route('admin.vehicles.index') }}" class="flex items-center gap-2 flex-wrap" data-ajax-filter>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari plat nomor..."
               class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B] w-48 transition-all">
        
        <div class="w-48">
            <x-form.select-dropdown 
                name="type" 
                label="Semua Tipe" 
                :options="[
                    ['value' => 'motor', 'label' => 'Motor'],
                    ['value' => 'mobil', 'label' => 'Mobil'],
                    ['value' => 'truck', 'label' => 'Truck'],
                ]" 
                :selected="request('type')"
            />
        </div>

        <div class="w-48">
            <x-form.select-dropdown 
                name="ownership" 
                label="Kepemilikan" 
                :options="[
                    ['value' => 'company', 'label' => 'Perusahaan'],
                    ['value' => 'personal', 'label' => 'Pribadi'],
                ]" 
                :selected="request('ownership')"
            />
        </div>

        <a href="{{ route('admin.vehicles.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['search', 'type', 'ownership']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('admin.vehicles._table')
</x-ui.card>
@endsection
