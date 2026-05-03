@extends('layouts.app')
@section('title', 'Profil - KirimAja')
@section('page-title', auth('customer')->check() ? '' : 'Pengaturan Akun')

@section('content')
    <div class="max-w-4xl {{ auth('customer')->check() ? 'mx-auto' : '' }} space-y-8 pb-12">
        @if (auth('customer')->check())
            <a href="{{ route('customer.dashboard') }}"
                class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1B3A6B] mb-6 transition-colors font-semibold group">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard
            </a>
        @endif

        {{-- Section 1: Profile Information --}}
        <x-ui.card class="overflow-hidden border-none shadow-2xl shadow-blue-900/5">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-8 border-b border-gray-50 flex items-center gap-6 bg-gradient-to-r from-gray-50/50 to-transparent">
                    {{-- Compact Image Preview in Header --}}
                    <x-form.image-preview 
                        name="photo" 
                        :value="$user->photo" 
                        :placeholder="strtoupper(substr($user->name, 0, 1))"
                        shape="square"
                        size="md"
                        compact="true"
                        class="!space-y-0"
                        :readonly="!auth('customer')->check()"
                    >
                        @if($user->photo && auth('customer')->check())
                            <x-slot name="removeSlot">
                                <button type="button" 
                                        onclick="document.getElementById('remove-photo-form').requestSubmit();"
                                        class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-bold text-red-500 hover:bg-red-50 rounded-xl transition-colors w-full text-left">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    Hapus Foto
                                </button>
                            </x-slot>
                        @endif
                    </x-form.image-preview>

                    <div class="flex-1">
                        <div class="flex items-center gap-3">
                            <h3 class="text-xl font-black text-[#0F2347]">Informasi Profil</h3>
                            @php
                                $roleType = match ($user->role ?? null) {
                                    'admin' => 'danger',
                                    'manager' => 'purple',
                                    'cashier' => 'info',
                                    'courier' => 'success',
                                    default => 'warning',
                                };
                            @endphp
                            <x-ui.badge :type="$roleType" :label="$user instanceof \App\Models\Customer
                                ? 'Customer'
                                : ucfirst($user->role)" />
                        </div>
                        <p class="text-sm text-gray-400 font-medium mt-1">
                            @if($user instanceof \App\Models\Customer)
                                Member aktif sejak {{ $user->created_at->format('d M Y') }}
                            @else
                                Penempatan: <span class="text-[#1B3A6B] font-bold">{{ $user->branch?->name ?? 'Pusat' }}</span>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="p-8 space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <x-form.input-group label="Nama Lengkap" name="name" :value="old('name', $user->name)" required icon="user" placeholder="Nama sesuai KTP" />
                        
                        <div class="space-y-2">
                            <label class="text-sm font-bold text-gray-700">Alamat Email</label>
                            <div class="relative group">
                                <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-gray-400"></i>
                                <input type="email" name="email" value="{{ $user->email }}" readonly
                                    class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-400 cursor-not-allowed focus:outline-none font-medium">
                                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <x-ui.badge type="success" label="Verified" class="!py-0.5 !text-[11px] !font-black" />
                                </div>
                            </div>
                        </div>

                        @if ($user instanceof \App\Models\Customer)
                            <x-form.input-group label="Nomor Telepon" name="phone" :value="old('phone', $user->phone)" icon="phone" placeholder="Contoh: 0812..." />
                            <x-form.input-group label="Kota" name="city" :value="old('city', $user->city)" icon="map-pin" placeholder="Kota domisili" />
                            <div class="md:col-span-2">
                                <x-form.input-group label="Alamat Lengkap" name="address" type="textarea" :value="old('address', $user->address)"
                                    icon="home" rows="3" placeholder="Alamat lengkap pengiriman" />
                            </div>
                        @else
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">Jabatan</label>
                                <div class="relative">
                                    <i data-lucide="shield" class="absolute left-4 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-gray-400"></i>
                                    <input type="text" value="{{ ucfirst($user->role) }}" readonly
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-400 cursor-not-allowed font-bold">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700">Cabang</label>
                                <div class="relative">
                                    <i data-lucide="building-2" class="absolute left-4 top-1/2 -translate-y-1/2 w-4.5 h-4.5 text-gray-400"></i>
                                    <input type="text" value="{{ $user->branch?->name ?? 'Pusat' }}" readonly
                                        class="w-full pl-11 pr-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl text-sm text-gray-400 cursor-not-allowed font-bold">
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="pt-6 flex items-center justify-end border-t border-gray-50">
                        <button type="submit"
                            class="px-8 py-3.5 bg-[#1B3A6B] hover:bg-[#0F2347] text-white rounded-xl text-sm font-black shadow-xl shadow-blue-900/10 transition-all active:scale-[0.98] flex items-center gap-2 group">
                            <i data-lucide="save" class="w-4 h-4 group-hover:scale-110 transition-transform"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </form>

            @if($user->photo)
                <form id="remove-photo-form" action="{{ route('profile.remove-photo') }}" method="POST" class="hidden"
                      data-confirm="Apakah Anda yakin ingin menghapus foto profil ini?"
                      data-confirm-title="Hapus Foto"
                      data-confirm-button="Ya, Hapus">
                    @csrf
                    @method('DELETE')
                </form>
            @endif
        </x-ui.card>

        {{-- Section 2: Account Security --}}
        <x-ui.card class="overflow-hidden border-none shadow-2xl shadow-blue-900/5">
            <div class="p-8 border-b border-gray-50 bg-gradient-to-r from-gray-50/50 to-transparent flex items-center gap-4">
                <div>
                    <h3 class="text-xl font-black text-[#0F2347]">Ganti Password</h3>
                    <p class="text-sm text-gray-400 font-medium">Amankan akun Anda dengan kata sandi yang kuat</p>
                </div>
            </div>

            <form action="{{ route('profile.update-password') }}" method="POST" class="p-8 space-y-6">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="md:col-span-2">
                        <x-form.input-group label="Kata Sandi Saat Ini" name="current_password" type="password" icon="key"
                            placeholder="••••••••" required />
                    </div>

                    <x-form.input-group label="Kata Sandi Baru" name="password" type="password" icon="lock"
                        placeholder="Min. 8 karakter" required />
                    <x-form.input-group label="Konfirmasi Kata Sandi" name="password_confirmation" type="password"
                        icon="lock-keyhole" placeholder="••••••••" required />
                </div>

                <div class="pt-6 flex items-center justify-end border-t border-gray-50">
                    <button type="submit"
                        class="px-8 py-3.5 bg-[#1B3A6B] hover:bg-[#0F2347] text-white rounded-xl text-sm font-black shadow-xl shadow-blue-900/10 transition-all active:scale-[0.98]">
                        Perbarui Password
                    </button>
                </div>
            </form>
        </x-ui.card>
    </div>
@endsection
