@extends('layouts.app')
@section('title', 'Tambah Cabang')
@section('page-title', 'Tambah Cabang')

@section('content')
<div class="max-w-xl">
    <x-ui.back-link :href="route('admin.branches.index')" />

    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.branches.store') }}" class="space-y-5">
            @csrf
            
            <x-form.input-group label="Nama Cabang" name="name" :value="old('name')" required placeholder="KirimAja Jakarta Pusat" />
            <x-form.input-group label="Kota" name="city" :value="old('city')" required placeholder="Jakarta" />
            <x-form.input-group label="Alamat" name="address" :value="old('address')" required placeholder="Jl. Contoh No. 1" />
            <x-form.input-group label="Telepon" name="phone" :value="old('phone')" required placeholder="021-xxxxxxx" />

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Simpan Cabang
                </button>
                <a href="{{ route('admin.branches.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
