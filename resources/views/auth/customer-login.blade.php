@extends('layouts.guest')
@section('title', 'Masuk Pelanggan - KirimAja')

@section('content')
<div class="px-10 pt-10 pb-8 bg-gradient-to-b from-orange-50/50 to-transparent">
    <h2 class="text-3xl font-extrabold text-[#0F2347] tracking-tight">Masuk</h2>
    <p class="text-gray-500 mt-2 font-medium">Pantau pengiriman Anda dengan mudah</p>
</div>

<form method="POST" action="{{ route('customer.login.post') }}" class="px-10 pb-10 space-y-6">
    @csrf
    
    <x-form.auth-input label="Email" name="email" icon="mail" placeholder="email@contoh.com" required theme="orange" />
    
    <div class="space-y-2">
        <div class="flex items-center justify-between">
            <label class="block text-sm font-semibold text-gray-700">Password</label>
            <a href="#" class="text-xs font-semibold text-[#F47B20] hover:underline">Lupa password?</a>
        </div>
        <div class="relative group">
            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400 group-focus-within:text-[#F47B20] transition-colors"></i>
            <input type="password" name="password" id="pwdField" required
                   class="w-full pl-12 pr-12 py-3.5 bg-white border border-gray-200 rounded-xl text-sm transition-all focus:outline-none focus:ring-4 focus:ring-[#F47B20]/5 focus:border-[#F47B20] placeholder-gray-300"
                   placeholder="••••••••">
            <button type="button" id="togglePwd" class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                <i data-lucide="eye" class="w-5 h-5"></i>
            </button>
        </div>
        @error('password')
            <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit"
            class="w-full bg-[#F47B20] hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-sm transition-all active:scale-[0.98] flex items-center justify-center gap-3">
        <i data-lucide="log-in" class="w-5 h-5 text-orange-200/50"></i>
        Masuk Sekarang
    </button>

    <div class="text-center pt-2">
        <p class="text-sm text-gray-500 font-bold border-t border-gray-100 pt-6">
            Belum punya akun?
            <a href="{{ route('customer.register') }}" class="text-[#F47B20] font-black hover:underline ml-1">Daftar sekarang</a>
        </p>
    </div>

    <div class="pt-2">
        <button type="button" id="togglePortal" class="flex items-center justify-center gap-2 w-full py-2 text-xs font-black text-gray-400 uppercase tracking-[0.3em] hover:text-[#1B3A6B] transition-colors group">
            <span class="w-8 border-t border-gray-100 group-hover:border-[#1B3A6B]/20"></span>
            Portal
            <i data-lucide="chevron-down" class="w-3 h-3 transition-transform duration-300" id="portalChevron"></i>
            <span class="w-8 border-t border-gray-100 group-hover:border-[#1B3A6B]/20"></span>
        </button>
        
        <div id="staffPortal" class="hidden mt-4 animate-in fade-in slide-in-from-top-2 duration-300">
            <a href="{{ route('staff.login') }}" 
               class="w-full bg-slate-50 hover:bg-slate-100 text-slate-800 font-bold py-3.5 rounded-xl text-sm border border-slate-200 transition-all flex items-center justify-center gap-2">
                <i data-lucide="shield" class="w-4 h-4 text-slate-400"></i>
                Masuk sebagai Staff
            </a>
        </div>
    </div>
</form>

@push('scripts')
<script>
document.getElementById('togglePwd')?.addEventListener('click', function() {
    const f = document.getElementById('pwdField');
    if (f.type === 'password') {
        f.type = 'text';
        this.innerHTML = '<i data-lucide="eye-off" class="w-5 h-5"></i>';
    } else {
        f.type = 'password';
        this.innerHTML = '<i data-lucide="eye" class="w-5 h-5"></i>';
    }
    lucide.createIcons({ icons: lucide.icons });
});

document.getElementById('togglePortal')?.addEventListener('click', function() {
    const portal = document.getElementById('staffPortal');
    const chevron = this.querySelector('#portalChevron');
    const isHidden = portal.classList.toggle('hidden');
    chevron.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
});
</script>
@endpush
@endsection
