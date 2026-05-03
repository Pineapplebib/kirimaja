@extends('layouts.app')
@section('title', 'Tarif Pengiriman')
@section('page-title', 'Manajemen Tarif')

@section('content')
<x-layout.page-header buttonText="Tambah Tarif" :buttonLink="route('admin.rates.create')">
    <form method="GET" action="{{ route('admin.rates.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <div class="w-48">
            <x-form.select-dropdown 
                name="origin_city" 
                label="Semua Asal" 
                :options="$cities->map(fn($c) => ['value' => $c, 'label' => $c])" 
                :selected="request('origin_city')"
                searchable="true"
            />
        </div>
        <div class="w-48">
            <x-form.select-dropdown 
                name="destination_city" 
                label="Semua Tujuan" 
                :options="$cities->map(fn($c) => ['value' => $c, 'label' => $c])" 
                :selected="request('destination_city')"
                searchable="true"
            />
        </div>
        <a href="{{ route('admin.rates.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['origin_city', 'destination_city']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('admin.rates._table')
</x-ui.card>
@endsection
