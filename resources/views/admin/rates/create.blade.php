@extends('layouts.app')
@section('title', 'Tambah Tarif')
@section('page-title', 'Tambah Tarif')

@section('content')
<div class="max-w-lg">
    <x-ui.back-link :href="route('admin.rates.index')" />
    
    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.rates.store') }}" class="space-y-5">
            @csrf
            
            <div class="grid grid-cols-2 gap-4">
                <x-form.input-group label="Kota Asal" name="origin_city" :value="old('origin_city')" required list="cityList" placeholder="Jakarta" />
                <x-form.input-group label="Kota Tujuan" name="destination_city" :value="old('destination_city')" required list="cityList" placeholder="Surabaya" />
            </div>

            <datalist id="cityList">
                @foreach($cities as $c)
                    <option value="{{ $c }}">
                @endforeach
            </datalist>

            <div class="grid grid-cols-2 gap-4">
                <x-form.input-group label="Tarif per kg (Rp)" name="price_per_kg" type="number" :value="old('price_per_kg')" required min="0" step="100" placeholder="15000" />
                <x-form.input-group label="Estimasi (hari)" name="estimated_days" type="number" :value="old('estimated_days')" required min="1" placeholder="2" />
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Simpan Tarif
                </button>
                <a href="{{ route('admin.rates.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
