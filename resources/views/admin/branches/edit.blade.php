@extends('layouts.app')
@section('title', 'Edit Cabang')
@section('page-title', 'Edit Cabang')

@section('content')
<div class="max-w-xl">
    <x-ui.back-link :href="route('admin.branches.index')" />

    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.branches.update', $branch) }}" class="space-y-5">
            @csrf @method('PUT')
            
            <x-form.input-group label="Nama Cabang" name="name" :value="old('name', $branch->name)" required />
            <x-form.input-group label="Kota" name="city" :value="old('city', $branch->city)" required />
            <x-form.input-group label="Alamat" name="address" :value="old('address', $branch->address)" required />
            <x-form.input-group label="Telepon" name="phone" :value="old('phone', $branch->phone)" required />

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Perbarui Cabang
                </button>
                <a href="{{ route('admin.branches.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
