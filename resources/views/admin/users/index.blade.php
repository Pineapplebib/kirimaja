@extends('layouts.app')
@section('title', 'Pengguna')
@section('page-title', 'Manajemen Pengguna')

@section('content')
<x-layout.page-header buttonText="Tambah Pengguna" :buttonLink="route('admin.users.create')" buttonIcon="user-plus">
    <form method="GET" action="{{ route('admin.users.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama / email..."
               class="px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B] w-56 transition-all">
        
        <div class="w-48">
            <x-form.select-dropdown 
                name="role" 
                label="Semua Role" 
                :options="[
                    ['value' => 'admin', 'label' => 'Admin'],
                    ['value' => 'manager', 'label' => 'Manager'],
                    ['value' => 'cashier', 'label' => 'Kasir'],
                    ['value' => 'courier', 'label' => 'Kurir'],
                ]" 
                :selected="request('role')"
            />
        </div>

        @if(Auth::user()->role === 'admin')
        <div class="w-48">
            <x-form.select-dropdown 
                name="branch_id" 
                label="Semua Wilayah" 
                :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->name])->toArray()" 
                :selected="request('branch_id')"
            />
        </div>
        @endif

        <a href="{{ route('admin.users.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['search', 'role']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('admin.users._table')
</x-ui.card>
@endsection
