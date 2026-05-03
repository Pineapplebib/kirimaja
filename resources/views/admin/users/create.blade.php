@extends('layouts.app')
@section('title', 'Tambah Pengguna')
@section('page-title', 'Tambah Pengguna')

@section('content')
<div class="max-w-xl">
    <x-ui.back-link :href="route('admin.users.index')" />

    <x-ui.card class="p-6">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-5" id="userForm">
            @csrf
            
            <x-form.input-group label="Nama Lengkap" name="name" :value="old('name')" required />
            <x-form.input-group label="Email" name="email" type="email" :value="old('email')" required />
            <x-form.input-group label="Password" name="password" type="password" required minlength="8" placeholder="Min. 8 karakter" />

            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Role <span class="text-red-500">*</span></label>
                    <x-form.select-dropdown 
                        name="role" 
                        id="roleSelect" 
                        label="Pilih Role" 
                        :options="[
                            ['value' => 'admin', 'label' => 'Admin'],
                            ['value' => 'manager', 'label' => 'Manager'],
                            ['value' => 'cashier', 'label' => 'Kasir'],
                            ['value' => 'courier', 'label' => 'Kurir'],
                        ]" 
                        :selected="old('role')"
                        required="true"
                    />
                </div>
                <div class="space-y-1.5">
                    <label class="block text-sm font-medium text-gray-700">Cabang <span class="text-red-500">*</span></label>
                    <x-form.select-dropdown 
                        name="branch_id" 
                        label="Pilih Cabang" 
                        :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->name])" 
                        :selected="old('branch_id')"
                        searchable="true"
                        required="true"
                    />
                </div>
            </div>

            {{-- Courier vehicle field --}}
            <div id="vehicleFields" class="hidden space-y-4 p-4 bg-gray-50 rounded-lg border border-gray-200 transition-all">
                <p class="text-xs font-semibold text-gray-600 uppercase tracking-wide">Kendaraan Kurir</p>
                <x-form.select-dropdown 
                    name="vehicle_id" 
                    label="Pilih Kendaraan" 
                    :options="$vehicles->map(fn($v) => ['value' => $v->id, 'label' => $v->plate_number . ' (' . ucfirst($v->type) . ' - ' . ($v->ownership === 'company' ? 'Perusahaan' : 'Pribadi') . ')'])" 
                    :selected="old('vehicle_id')"
                    searchable="true"
                />
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="flex-1 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors">
                    Simpan Pengguna
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-4 py-2.5 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </x-ui.card>
</div>

@push('scripts')
<script>
document.getElementById('roleSelect')?.addEventListener('change', function() {
    const vf = document.getElementById('vehicleFields');
    vf.classList.toggle('hidden', this.value !== 'courier');
});
</script>
@endpush
@endsection
