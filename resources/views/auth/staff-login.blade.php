@extends('layouts.auth-split')
@section('title', 'Login Staff - KirimAja')

@section('content')
<div class="mb-10">
    <h2 class="text-3xl font-extrabold text-[#0F2347] tracking-tight">Login Staff</h2>
    <p class="text-gray-500 mt-2 font-medium">Akses Portal Manajemen Operasional</p>
</div>

<form method="POST" action="{{ route('staff.login.post') }}" class="space-y-6">
    @csrf
    
    <x-form.auth-input label="Email Perusahaan" name="email" icon="mail" :placeholder="'nama@' . config('app.domain', 'kirimaja.id')" required />
    
    <div class="space-y-2">
        <div class="flex items-center justify-between">
            <label class="block text-sm font-semibold text-gray-700">Password</label>
            <a href="#" class="text-xs font-semibold text-[#1B3A6B] hover:underline">Lupa password?</a>
        </div>
        <div class="relative group">
            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-[#1B3A6B] transition-colors"></i>
            <input type="password" name="password" id="passwordField" required
                   class="w-full pl-12 pr-12 py-3.5 bg-white border border-gray-200 rounded-xl text-sm transition-all focus:outline-none focus:ring-4 focus:ring-[#1B3A6B]/5 focus:border-[#1B3A6B] placeholder-gray-300"
                   placeholder="••••••••">
            <button type="button" id="togglePwd" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                <i data-lucide="eye" class="w-5 h-5"></i>
            </button>
        </div>
        @error('password')
            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="flex items-center">
        <label class="flex items-center gap-3 text-sm text-gray-600 cursor-pointer group">
            <input type="checkbox" name="remember" class="w-5 h-5 rounded border-gray-300 text-[#1B3A6B] focus:ring-[#1B3A6B] transition-all cursor-pointer shadow-sm">
            <span class="font-medium group-hover:text-gray-900 transition-colors">Ingat sesi ini</span>
        </label>
    </div>

    <button type="submit"
            class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-bold py-4 rounded-xl text-sm transition-all active:scale-[0.98] flex items-center justify-center gap-3">
        <i data-lucide="shield-check" class="w-5 h-5 text-blue-200/50"></i>
        Login
    </button>

    <div class="relative py-4">
        <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-gray-100"></div></div>
        <div class="relative flex justify-center text-xs uppercase"><span class="bg-gray-50/50 px-3 text-gray-400 font-extrabold tracking-widest">Atau</span></div>
    </div>

    <a href="{{ route('customer.login') }}" 
       class="w-full bg-white hover:bg-gray-50 text-gray-800 font-bold py-3.5 rounded-xl text-sm border border-gray-200 transition-all flex items-center justify-center gap-2">
        <i data-lucide="user" class="w-4 h-4 text-gray-400"></i>
        Login sebagai Pelanggan
    </a>
</form>

@push('scripts')
<script>
document.getElementById('togglePwd')?.addEventListener('click', function() {
    const f = document.getElementById('passwordField');
    if (f.type === 'password') {
        f.type = 'text';
        this.innerHTML = '<i data-lucide="eye-off" class="w-5 h-5"></i>';
    } else {
        f.type = 'password';
        this.innerHTML = '<i data-lucide="eye" class="w-5 h-5"></i>';
    }
    lucide.createIcons({ icons: lucide.icons });
});
</script>
@endpush
@endsection
