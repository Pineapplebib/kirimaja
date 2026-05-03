@extends('layouts.app')
@section('title', 'Cabang')
@section('page-title', 'Manajemen Cabang')

@section('content')
<x-layout.page-header buttonText="Tambah Cabang" :buttonLink="route('admin.branches.create')">
    <form method="GET" action="{{ route('admin.branches.index') }}" class="flex items-center gap-2" data-ajax-filter>
        <p class="text-sm text-gray-500 font-medium">Total {{ $branches->total() }} cabang terdaftar</p>
    </form>
</x-layout.page-header>

<x-ui.card id="table-container">
    @include('admin.branches._table')
</x-ui.card>
@endsection
