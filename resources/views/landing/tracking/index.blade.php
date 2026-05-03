@extends('layouts.landing')

@section('title', 'Lacak Paket - KirimAja')

@section('content')
<div class="bg-gray-50 flex-1 flex flex-col pt-8 pb-24">
    <div class="max-w-xl mx-auto w-full px-4 space-y-12">
        
        {{-- Kembali Link --}}
        <div class="flex justify-start">
            <a href="{{ route('home') }}" class="inline-flex items-center gap-2 text-sm font-bold text-[#1B3A6B] hover:text-[#0F2347] transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali
            </a>
        </div>

        {{-- Header --}}
        <div class="text-center space-y-3">
            <h1 class="text-3xl font-extrabold text-[#0F2347]">Lacak Paket Anda</h1>
            <p class="text-gray-500 text-base">Pantau pengiriman paket Anda secara real-time dengan nomor resi.</p>
        </div>

        {{-- Main Search Card --}}
        <div class="bg-white rounded-2xl p-6 md:p-8 border border-gray-100 premium-shadow">
            <form action="{{ route('track') }}" method="POST" class="space-y-6 tracking-form">
                @csrf
                <div class="space-y-2">
                    <label class="block text-sm font-bold text-[#0F2347]">Nomor Resi</label>
                    <div class="relative">
                        <i data-lucide="package-search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                        <input type="text" 
                               name="tracking_number" 
                               value="{{ old('resi', $resi ?? '') }}" 
                               placeholder="Contoh: KA20240001ABC" 
                               class="w-full pl-12 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-xl text-md font-bold text-[#0F2347] focus:outline-none focus:ring-2 focus:ring-[#F47B20] focus:bg-white transition-all outline-none"
                               autofocus
                               required>
                    </div>
                    
                    @if($errors->has('resi') || $errors->has('tracking_number'))
                    <p class="text-red-500 text-xs font-bold flex items-center gap-1.5 mt-2">
                        <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                        {{ $errors->first('resi') ?: $errors->first('tracking_number') }}
                    </p>
                    @endif
                </div>

                <button type="submit" class="w-full bg-[#F47B20] hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-base shadow-lg shadow-orange-200 transition-all active:scale-[0.98] flex items-center justify-center gap-2">
                    <i data-lucide="search" class="w-5 h-5"></i>
                    Lacak Sekarang
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
