@extends('layouts.app')
@section('title', 'Selesaikan Pembayaran')
@section('page-title', '')

@section('content')
<div class="max-w-lg mx-auto py-10">
    {{-- Only show back link if already paid --}}
    @if($payment->payment_status === 'paid')
    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-2 text-sm font-bold text-gray-400 hover:text-[#1B3A6B] mb-6 transition-colors">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali ke Dashboard
    </a>
    @endif

    <div class="bg-white rounded-[2rem] shadow-2xl shadow-blue-900/10 border border-gray-100 overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-[#1B3A6B] p-8 text-white relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <span class="px-3 py-1 bg-[#F47B20] text-white text-[10px] font-black uppercase tracking-widest rounded-full">
                            Menunggu Pembayaran
                        </span>
                        <h2 class="text-2xl font-black mt-3 tracking-tight">{{ $payment->shipment->tracking_number }}</h2>
                    </div>
                    <div class="w-14 h-14 rounded-2xl bg-white/10 flex items-center justify-center border border-white/20">
                        <i data-lucide="clock" class="w-7 h-7 text-white animate-pulse"></i>
                    </div>
                </div>
                
                <div class="flex items-end justify-between gap-4">
                    <div>
                        <p class="text-blue-200 text-xs font-bold uppercase tracking-wider mb-1">Total Tagihan</p>
                        <h3 class="text-4xl font-black tracking-tighter">Rp {{ number_format($payment->amount, 0, ',', '.') }}</h3>
                    </div>
                    <div class="bg-white rounded-2xl p-3 shadow-xl">
                        <img src="{{ asset('images/payments/'.$payment->midtrans_bank.'.svg') }}" alt="{{ $payment->midtrans_bank }}" class="h-8">
                    </div>
                </div>
            </div>
            
            {{-- Subtle Background Pattern --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -mr-32 -mt-32"></div>
        </div>

        {{-- Payment Instructions Section --}}
        <div class="p-8">
            <div class="space-y-8">
                @if($payment->payment_method === 'transfer')
                    @if($payment->midtrans_bank === 'mandiri')
                    {{-- Mandiri Bill Payment specific UI --}}
                    <div class="space-y-6">
                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-5 bg-[#F47B20] rounded-full"></div>
                                <h4 class="text-[11px] font-black text-[#0F2347] uppercase tracking-wider">Kode Perusahaan</h4>
                            </div>
                            <div class="relative flex items-center justify-between p-5 border-2 border-gray-50 bg-gray-50/50 rounded-2xl">
                                <span class="text-xl font-black tracking-[0.15em] text-[#1B3A6B] font-mono" id="billerCode">{{ $payment->midtrans_biller_code }}</span>
                                <button onclick="copyText('billerCode', this)" class="btn-copy flex items-center gap-2 px-4 py-2 bg-white shadow-sm border border-gray-100 text-[#1B3A6B] rounded-xl font-bold text-xs hover:bg-[#1B3A6B] hover:text-white transition-all active:scale-95">
                                    <i data-lucide="copy" class="w-3.5 h-3.5 icon-copy"></i>
                                    <i data-lucide="check" class="w-3.5 h-3.5 icon-check hidden"></i>
                                    <span class="copy-label">Salin</span>
                                </button>
                            </div>
                        </div>

                        <div>
                            <div class="flex items-center gap-2 mb-3">
                                <div class="w-1 h-5 bg-[#F47B20] rounded-full"></div>
                                <h4 class="text-[11px] font-black text-[#0F2347] uppercase tracking-wider">Nomor Virtual Account</h4>
                            </div>
                            <div class="relative flex items-center justify-between p-5 border-2 border-gray-50 bg-gray-50/50 rounded-2xl">
                                <span class="text-xl font-black tracking-[0.15em] text-[#1B3A6B] font-mono" id="vaNumber">{{ $payment->midtrans_va_number }}</span>
                                <button onclick="copyText('vaNumber', this)" class="btn-copy flex items-center gap-2 px-4 py-2 bg-white shadow-sm border border-gray-100 text-[#1B3A6B] rounded-xl font-bold text-xs hover:bg-[#1B3A6B] hover:text-white transition-all active:scale-95">
                                    <i data-lucide="copy" class="w-3.5 h-3.5 icon-copy"></i>
                                    <i data-lucide="check" class="w-3.5 h-3.5 icon-check hidden"></i>
                                    <span class="copy-label">Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- Standard VA Payment --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-1.5 h-6 bg-[#F47B20] rounded-full"></div>
                            <h4 class="text-sm font-black text-[#0F2347] uppercase tracking-wider">Nomor Virtual Account</h4>
                        </div>
                        
                        <div class="relative flex items-center justify-between p-6 border-2 border-gray-50 bg-gray-50/50 rounded-2xl">
                            <span class="text-2xl font-black tracking-[0.15em] text-[#1B3A6B] font-mono" id="vaNumber">{{ $payment->midtrans_va_number }}</span>
                            <button onclick="copyText('vaNumber', this)" class="btn-copy flex items-center gap-2 px-4 py-2 bg-white shadow-sm border border-gray-100 text-[#1B3A6B] rounded-xl font-bold text-xs hover:bg-[#1B3A6B] hover:text-white transition-all active:scale-95">
                                <i data-lucide="copy" class="w-3.5 h-3.5 icon-copy"></i>
                                <i data-lucide="check" class="w-3.5 h-3.5 icon-check hidden"></i>
                                <span class="copy-label">Salin</span>
                            </button>
                        </div>
                    </div>
                    @endif
                    @php
                        $bankDisplay = \App\Enums\PaymentBank::getLabel($payment->midtrans_bank);
                    @endphp
                    <p class="mt-4 text-xs text-gray-400 font-medium leading-relaxed">
                        Silakan transfer sesuai nominal di atas ke nomor VA <strong>{{ $bankDisplay }}</strong> sebelum batas waktu berakhir.
                    </p>
                @endif

                @if(in_array($payment->midtrans_bank, ['qris', 'gopay']) && $payment->midtrans_payment_code)
                <div class="space-y-6">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-1.5 h-6 bg-[#F47B20] rounded-full"></div>
                        <h4 class="text-sm font-black text-[#0F2347] uppercase tracking-wider">
                            Metode {{ $payment->midtrans_bank === 'gopay' ? 'Scan GoPay' : 'Scan QRIS' }}
                        </h4>
                    </div>

                    <div class="flex flex-col items-center gap-6">
                        <div class="inline-block p-6 bg-white border-2 border-gray-50 rounded-[2.5rem] relative transition-all">
                            <img id="qrisImage" src="{{ $payment->midtrans_payment_code }}" alt="QRIS" class="w-64 h-64 rounded-2xl">
                        </div>

                        <div class="flex flex-wrap items-center justify-center gap-4 w-full">
                            <a href="{{ route('customer.payments.download-qris', $payment) }}" 
                               class="inline-flex items-center justify-center gap-2 px-6 py-4 bg-white border-2 border-gray-100 text-[#1B3A6B] rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all active:scale-95 w-fit">
                                <i data-lucide="download" class="w-4 h-4"></i>
                                Unduh Kode QR
                            </a>

                            @if($payment->midtrans_bank === 'gopay')
                            <a href="{{ $payment->midtrans_va_number }}" target="_blank" class="inline-flex items-center justify-center gap-3 bg-[#00AED6] hover:bg-[#0096B8] text-white px-8 py-4 rounded-2xl font-black text-sm transition-all shadow-lg shadow-blue-500/20 active:scale-95 w-fit">
                                Bayar dengan GoPay
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @endif
            </div>

            {{-- Footer Status --}}
            <div class="mt-10 pt-8 border-t border-dashed border-gray-200 text-center">
                <div class="inline-flex items-center gap-3 px-6 py-2.5 bg-blue-50 text-[#1B3A6B] rounded-full text-[10px] font-black uppercase tracking-[0.2em]">
                    <div class="w-3 h-3 border-2 border-[#1B3A6B] border-t-transparent rounded-full animate-spin"></div>
                    <span>Cek Pembayaran Otomatis...</span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    async function copyText(elementId, btn) {
        const textToCopy = document.getElementById(elementId).textContent;
        const iconCopy = btn.querySelector('.icon-copy');
        const iconCheck = btn.querySelector('.icon-check');
        const label = btn.querySelector('.copy-label');

        try {
            if (navigator.clipboard && window.isSecureContext) {
                await navigator.clipboard.writeText(textToCopy);
            } else {
                const textArea = document.createElement("textarea");
                textArea.value = textToCopy;
                textArea.style.position = "fixed";
                textArea.style.left = "-9999px";
                textArea.style.top = "0";
                document.body.appendChild(textArea);
                textArea.focus();
                textArea.select();
                document.execCommand('copy');
                textArea.remove();
            }

            btn.classList.add('!bg-green-500', '!text-white', '!border-green-500');
            iconCopy.classList.add('hidden');
            iconCheck.classList.remove('hidden');
            label.textContent = 'Berhasil';
            
            setTimeout(() => {
                btn.classList.remove('!bg-green-500', '!text-white', '!border-green-500');
                iconCopy.classList.remove('hidden');
                iconCheck.classList.add('hidden');
                label.textContent = 'Salin';
            }, 2000);
        } catch (err) {
            console.error('Copy failed:', err);
        }
    }

    const pollInterval = setInterval(async () => {
        try {
            const res = await fetch('{{ route("customer.payments.status", $payment) }}');
            const data = await res.json();
            
            if (data.status === 'paid') {
                clearInterval(pollInterval);
                window.Swal.fire({
                    icon: 'success',
                    title: 'Pembayaran Berhasil!',
                    text: 'Terima kasih, paket Anda segera kami proses.',
                    confirmButtonColor: '#1B3A6B'
                }).then(() => {
                    window.location.href = '{{ route("customer.dashboard") }}';
                });
            }
        } catch (e) {
            console.error('Polling error:', e);
        }
    }, 5000);
</script>
@endpush
@endsection
