@extends('layouts.guest')
@section('title', 'Verifikasi Email - KirimAja')

@section('content')
{{-- Header --}}
<div class="px-10 pt-10 pb-8 bg-gradient-to-b from-orange-50/50 to-transparent text-center">
    <h2 class="text-2xl font-extrabold text-[#0F2347] tracking-tight">Verifikasi Email</h2>
    <p class="text-gray-500 mt-2 font-medium text-sm">
        Klik tautan verifikasi di email Anda
    </p>
</div>

{{-- Content --}}
<div class="px-10 pb-10 space-y-6">
    <div class="p-4 rounded-xl bg-slate-50 border border-slate-100 text-slate-600 text-sm leading-relaxed text-center font-medium">
        Silakan periksa kotak masuk email Anda untuk melakukan verifikasi akun.
    </div>

    <div class="flex flex-col gap-4">
        <form id="resendForm" method="POST" action="{{ route('customer.verification.send') }}">
            @csrf
            <button type="submit" id="resendBtn" class="w-full bg-[#F47B20] disabled:bg-gray-200 disabled:text-gray-400 disabled:shadow-none hover:bg-orange-600 text-white font-bold py-4 rounded-xl text-sm transition-all active:scale-[0.98] shadow-lg shadow-orange-500/20 flex items-center justify-center gap-2 font-sans">
                <i data-lucide="send" class="w-4 h-4 text-orange-200" id="resendIcon"></i>
                <span id="resendText">Kirim Ulang Email</span>
            </button>
        </form>
        
        <div class="text-center pt-2">
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf
                <button type="submit" class="text-xs font-bold text-gray-400 hover:text-red-500 transition-colors flex items-center justify-center gap-2 mx-auto group">
                    <span class="w-4 border-t border-gray-100 group-hover:border-red-100"></span>
                    Keluar Sejenak
                    <span class="w-4 border-t border-gray-100 group-hover:border-red-100"></span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const resendForm = document.getElementById('resendForm');
    const resendBtn = document.getElementById('resendBtn');
    const resendText = document.getElementById('resendText');
    const resendIcon = document.getElementById('resendIcon');
    const storageKey = 'kirimaja_resend_cooldown';
    const cooldownTime = 60;

    function startTimer(seconds) {
        resendBtn.disabled = true;
        resendIcon.classList.add('hidden');
        
        const timer = setInterval(() => {
            seconds--;
            resendText.innerText = `Kirim Ulang (${seconds}s)`;
            
            if (seconds <= 0) {
                clearInterval(timer);
                resendBtn.disabled = false;
                resendText.innerText = 'Kirim Ulang Email';
                resendIcon.classList.remove('hidden');
                localStorage.removeItem(storageKey);
            }
        }, 1000);
    }

    const savedExpiry = localStorage.getItem(storageKey);
    if (savedExpiry) {
        const remaining = Math.ceil((savedExpiry - Date.now()) / 1000);
        if (remaining > 0) {
            startTimer(remaining);
        } else {
            localStorage.removeItem(storageKey);
        }
    }

    const flashMessage = document.getElementById('flash-success-message');
    if (flashMessage && flashMessage.value && flashMessage.value.includes('dikirim')) {
        const expiry = Date.now() + (cooldownTime * 1000);
        localStorage.setItem(storageKey, expiry);
        startTimer(cooldownTime);
    }

    resendForm.addEventListener('submit', function() {
        const expiry = Date.now() + (cooldownTime * 1000);
        localStorage.setItem(storageKey, expiry);
    });
});
</script>
@endsection
