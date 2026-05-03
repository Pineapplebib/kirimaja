@extends('layouts.guest')
@section('title', 'Daftar Akun - KirimAja')
@section('max-width', 'max-w-4xl')

@section('content')
<div class="px-10 pt-10 pb-8 bg-gradient-to-b from-orange-50/50 to-transparent text-center md:text-left border-b border-gray-50">
    <h2 class="text-3xl font-extrabold text-[#0F2347] tracking-tight">Buat Akun</h2>
    <p class="text-gray-500 mt-2 font-medium">Daftar gratis dan mulai kirim paket sekarang</p>
</div>

<form method="POST" action="{{ route('customer.register.post') }}" class="px-10 py-10">
    @csrf
    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6">
        {{-- Left Column: Basics --}}
        <div class="space-y-6">
            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Informasi Dasar</h3>
            
            <x-form.auth-input label="Nama Lengkap" name="name" icon="user" placeholder="Nama lengkap Anda" required theme="orange" maxlength="50" />
            
            <x-form.auth-input label="Email" name="email" type="email" icon="mail" placeholder="email@contoh.com" required theme="orange" />

            <div class="grid grid-cols-2 gap-4">
                <x-form.auth-input label="No. HP" name="phone" icon="phone" placeholder="08..." required theme="orange" maxlength="15" />
                <x-form.auth-input label="Kota" name="city" icon="map-pin" placeholder="Jakarta" required theme="orange" />
            </div>
        </div>

        {{-- Right Column: Address & Security --}}
        <div class="space-y-6">
            <h3 class="text-xs font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Alamat & Keamanan</h3>

            <x-form.auth-input label="Alamat Lengkap" name="address" type="textarea" icon="home" placeholder="Alamat lengkap" required theme="orange" rows="2" />

            <div class="space-y-4 pt-2">
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Password</label>
                    <div class="relative group">
                        <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-[#F47B20] transition-colors"></i>
                        <input type="password" name="password" id="passwordField" required minlength="8"
                               class="w-full pl-12 pr-12 py-3.5 bg-white border border-gray-200 rounded-xl text-sm transition-all focus:outline-none focus:ring-4 focus:ring-[#F47B20]/5 focus:border-[#F47B20] placeholder-gray-300"
                               placeholder="Min. 8 karakter">
                        <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors" data-target="passwordField">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-gray-700">Konfirmasi</label>
                    <div class="relative group">
                        <i data-lucide="shield-check" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-[#F47B20] transition-colors"></i>
                        <input type="password" name="password_confirmation" id="passwordConfirmationField" required
                               class="w-full pl-12 pr-12 py-3.5 bg-white border border-gray-200 rounded-xl text-sm transition-all focus:outline-none focus:ring-4 focus:ring-[#F47B20]/5 focus:border-[#F47B20] placeholder-gray-300"
                               placeholder="Ulangi password">
                        <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors" data-target="passwordConfirmationField">
                            <i data-lucide="eye" class="w-5 h-5"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10 pt-6 border-t border-gray-50 flex flex-col md:flex-row items-center justify-between gap-6">
        <div class="text-center md:text-left">
            <p class="text-sm text-gray-500 font-bold">
                Sudah punya akun?
                <a href="{{ route('customer.login') }}" class="text-[#F47B20] font-black hover:underline ml-1">Masuk di sini</a>
            </p>
        </div>

        <button type="submit"
                class="w-full md:w-auto px-12 bg-[#F47B20] hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-sm transition-all active:scale-[0.98] shadow-lg shadow-orange-500/20">
            Daftar Sekarang
        </button>
    </div>
</form>
@endsection
