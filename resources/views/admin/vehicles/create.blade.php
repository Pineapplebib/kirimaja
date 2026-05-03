@extends('layouts.app')
@section('title', 'Tambah Kendaraan')
@section('page-title', 'Tambah Kendaraan Baru')

@section('content')
<div class="max-w-xl">
    <x-ui.back-link :href="route('admin.vehicles.index')" />

    <x-ui.card class="p-6 !overflow-visible">
        <form action="{{ route('admin.vehicles.store') }}" method="POST" class="space-y-5">
            @csrf

            <x-form.input-group 
                label="Plat Nomor" 
                name="plate_number" 
                :value="old('plate_number')" 
                placeholder="B 1234 KA" 
                required="true"
            />

            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-gray-700">Tipe Kendaraan <span class="text-red-500">*</span></label>
                <x-form.select-dropdown 
                    name="type" 
                    label="Pilih Tipe" 
                    :options="[
                        ['value' => 'motor', 'label' => 'Motor'],
                        ['value' => 'mobil', 'label' => 'Mobil'],
                        ['value' => 'truck', 'label' => 'Truck'],
                    ]" 
                    :selected="old('type', 'motor')"
                    required="true"
                />
            </div>

            <div class="space-y-1.5">
                <label class="block text-sm font-semibold text-gray-700">Kepemilikan <span class="text-red-500">*</span></label>
                <x-form.select-dropdown 
                    name="ownership" 
                    label="Pilih Kepemilikan" 
                    :options="[
                        ['value' => 'company', 'label' => 'Perusahaan'],
                        ['value' => 'personal', 'label' => 'Pribadi'],
                    ]" 
                    :selected="old('ownership', 'company')"
                    required="true"
                />
            </div>

            @if(Auth::user()->role === 'admin')
                <div class="space-y-1.5">
                    <label class="block text-sm font-semibold text-gray-700">Cabang <span class="text-red-500">*</span></label>
                    <x-form.select-dropdown 
                        name="branch_id" 
                        label="Pilih Cabang" 
                        :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->name])->toArray()" 
                        :selected="old('branch_id')"
                        required="true"
                    />
                </div>
            @else
                <input type="hidden" name="branch_id" value="{{ Auth::user()->branch_id }}">
                <x-form.input-group 
                    label="Cabang" 
                    name="branch_name" 
                    :value="Auth::user()->branch->name ?? '-'" 
                    readonly="true" 
                />
            @endif

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Simpan Kendaraan
                </button>
                <a href="{{ route('admin.vehicles.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>
@endsection
