@extends('layouts.app')
@section('title', 'Pembayaran')
@section('page-title', 'Daftar Pembayaran')

@section('content')
<x-layout.page-header>
    <form method="GET" action="{{ route('cashier.payments.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <div class="w-48">
            <x-form.select-dropdown 
                name="status" 
                label="Semua Status" 
                :options="[
                    ['value' => 'pending', 'label' => 'Pending'],
                    ['value' => 'paid', 'label' => 'Lunas'],
                    ['value' => 'failed', 'label' => 'Gagal'],
                ]" 
                :selected="request('status')"
            />
        </div>
        <a href="{{ route('cashier.payments.index') }}" 
           class="inline-flex items-center gap-1.5 px-3 py-2 text-gray-400 hover:text-red-500 transition-all text-xs font-semibold {{ !request()->anyFilled(['status']) ? 'hidden' : '' }}" 
           title="Reset Filter"
           data-clear-filter>
            <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
            Clear
        </a>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('cashier.payments._table')
</x-ui.card>
@endsection
