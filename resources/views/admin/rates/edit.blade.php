@extends('layouts.app')
@section('title', 'Edit Tarif')
@section('page-title', 'Edit Tarif')

@section('content')
<div class="max-w-lg">
    <x-ui.back-link :href="route('admin.rates.index')" />
    
    <x-ui.card class="p-6">
        <div class="p-4 bg-[#EBF2FF] rounded-lg mb-5 text-sm text-[#1B3A6B] font-medium flex items-center gap-2">
            <i data-lucide="info" class="w-4 h-4 shrink-0"></i>
            Rute: <strong>{{ $rate->origin_city }}</strong> → <strong>{{ $rate->destination_city }}</strong>
        </div>
        
        <form method="POST" action="{{ route('admin.rates.update', $rate) }}" class="space-y-5">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-2 gap-4">
                <x-form.input-group label="Tarif per kg (Rp)" name="price_per_kg" type="number" :value="old('price_per_kg', $rate->price_per_kg)" required min="0" step="100" />
                <x-form.input-group label="Estimasi (hari)" name="estimated_days" type="number" :value="old('estimated_days', $rate->estimated_days)" required min="1" />
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Perbarui Tarif
                </button>
                <a href="{{ route('admin.rates.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
