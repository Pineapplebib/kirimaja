@extends('layouts.app')
@section('title', 'Proses Pembayaran')
@section('page-title', 'Proses Pembayaran')

@section('content')
<div class="max-w-2xl">
    <x-ui.back-link :href="route('cashier.shipments.show', $shipment)" />

    {{-- Summary Card --}}
    <div class="bg-gradient-to-r from-[#0F2347] to-[#1B3A6B] rounded-xl p-6 text-white mb-6 shadow-lg shadow-blue-900/20">
        <div class="flex items-center justify-between mb-2">
            <p class="text-blue-300 text-xs font-bold">Nomor resi</p>
            <x-ui.badge type="info" class="!bg-white/10 !text-white !border-white/20 !py-0.5">Unpaid</x-ui.badge>
        </div>
        <p class="font-mono font-bold text-xl tracking-wider leading-none">{{ $shipment->tracking_number }}</p>
        <div class="flex items-center justify-between mt-6 pt-4 border-t border-white/10">
            <div class="text-blue-100 text-sm">
                <p class="font-bold text-white">{{ $shipment->sender->name }}</p>
                <p class="text-xs opacity-70 mt-0.5"><i data-lucide="arrow-right" class="w-3 h-3 inline"></i> {{ $shipment->receiver->name }}</p>
            </div>
            <div class="text-right">
                <p class="text-blue-300 text-xs font-bold mb-1">Total tagihan</p>
                <p class="text-3xl font-black">Rp {{ number_format($shipment->total_price,0,',','.') }}</p>
            </div>
        </div>
    </div>

    {{-- Payment Methods --}}
    <x-ui.card class="p-6 space-y-5">
        <h3 class="font-bold text-[#0F2347] flex items-center gap-2">
            <i data-lucide="shield-check" class="w-5 h-5 text-green-500"></i>
            Pilih Metode Pembayaran
        </h3>

        {{-- Cash --}}
        <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm transition-all hover:border-blue-100">
            <button type="button" id="cashToggle" class="w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50/50 transition-colors group">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl bg-green-50 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="banknote" class="w-6 h-6 text-green-600"></i>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-gray-800">Tunai (Cash)</p>
                        <p class="text-xs text-gray-500 font-medium">Bayar langsung di kasir</p>
                    </div>
                </div>
                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-300 transition-transform" id="cashChevron"></i>
            </button>
            <div id="cashPanel" class="hidden px-5 pb-5 border-t border-gray-100 pt-5 bg-gray-50/30">
                <form method="POST" action="{{ route('cashier.payments.cash', $shipment) }}">
                    @csrf
                    <div class="flex items-center justify-between p-4 bg-green-50/50 border border-green-100 rounded-xl mb-4">
                        <span class="text-sm text-green-800 font-semibold tracking-tight">Total tunai:</span>
                        <span class="text-2xl font-black text-green-700">Rp {{ number_format($shipment->total_price,0,',','.') }}</span>
                    </div>
                    <input type="hidden" name="amount" value="{{ $shipment->total_price }}">
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3.5 rounded-xl text-sm transition-all flex items-center justify-center gap-2 shadow-lg shadow-green-600/20 active:scale-[0.98]">
                        <i data-lucide="check-circle-2" class="w-5 h-5"></i> Konfirmasi Pembayaran Tunai
                    </button>
                </form>
            </div>
        </div>

        {{-- Digital / Bank Transfer --}}
        @foreach([
            ['type'=>'qris','label'=>'QRIS','desc'=>'Scan QR dengan aplikasi apapun','icon'=>'qr-code','color'=>'text-purple-600','bg'=>'bg-purple-50'],
            ['type'=>'gopay','label'=>'GoPay','desc'=>'Bayar via GoPay / GoTagihan','icon'=>'wallet','color'=>'text-green-600','bg'=>'bg-green-50'],
            ['type'=>'bca','label'=>'Transfer BCA','desc'=>'Virtual Account BCA','icon'=>'building','color'=>'text-blue-600','bg'=>'bg-blue-50'],
            ['type'=>'bri','label'=>'Transfer BRI','desc'=>'Virtual Account BRI','icon'=>'building','color'=>'text-indigo-600','bg'=>'bg-indigo-50'],
            ['type'=>'bni','label'=>'Transfer BNI','desc'=>'Virtual Account BNI','icon'=>'building','color'=>'text-orange-600','bg'=>'bg-orange-50'],
            ['type'=>'mandiri','label'=>'Mandiri Bill','desc'=>'Bayar via ATM/Mandiri Online','icon'=>'building','color'=>'text-yellow-600','bg'=>'bg-yellow-50'],
        ] as $method)
        <div class="border border-gray-100 rounded-xl overflow-hidden shadow-sm transition-all hover:border-blue-100">
            <button type="button" class="method-toggle w-full flex items-center justify-between px-5 py-4 hover:bg-gray-50/50 transition-colors group" data-type="{{ $method['type'] }}">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-xl {{ $method['bg'] }} flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i data-lucide="{{ $method['icon'] }}" class="w-6 h-6 {{ $method['color'] }}"></i>
                    </div>
                    <div class="text-left">
                        <p class="font-bold text-gray-800">{{ $method['label'] }}</p>
                        <p class="text-xs text-gray-500 font-medium">{{ $method['desc'] }}</p>
                    </div>
                </div>
                <i data-lucide="chevron-down" class="w-5 h-5 text-gray-300 transition-transform"></i>
            </button>
            <div class="method-panel hidden px-5 pb-5 border-t border-gray-100 pt-5 bg-gray-50/30" data-type="{{ $method['type'] }}">
                <div class="flex items-center justify-between p-4 bg-blue-50/50 border border-blue-100 rounded-xl mb-4">
                    <span class="text-sm text-[#1B3A6B] font-semibold tracking-tight">Total tagihan:</span>
                    <span class="text-2xl font-black text-[#1B3A6B]">Rp {{ number_format($shipment->total_price,0,',','.') }}</span>
                </div>
                <button class="charge-btn w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-bold py-3.5 rounded-xl text-sm transition-all flex items-center justify-center gap-2 shadow-lg shadow-blue-900/10 active:scale-[0.98]"
                        data-type="{{ $method['type'] }}" data-label="{{ $method['label'] }}">
                    <i data-lucide="zap" class="w-5 h-5"></i> Bayar dengan {{ $method['label'] }}
                </button>
                {{-- Payment instruction --}}
                <div class="payment-instruction hidden mt-5 p-5 bg-white rounded-xl border-2 border-dashed border-[#1B3A6B]/20 shadow-inner" data-type="{{ $method['type'] }}">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-full bg-yellow-400 flex items-center justify-center shadow-lg shadow-yellow-400/30">
                            <i data-lucide="clock" class="w-4 h-4 text-white animate-pulse"></i>
                        </div>
                        <p class="font-black text-sm text-[#0F2347]">Menunggu pembayaran</p>
                    </div>
                    <div class="instruction-content text-sm text-gray-600 space-y-2 bg-gray-50 p-4 rounded-lg border border-gray-100"></div>
                    <div class="mt-5 flex items-center gap-3 text-xs font-bold text-gray-400">
                        <div class="w-4 h-4 border-2 border-[#1B3A6B] border-t-transparent rounded-full animate-spin"></div>
                        <span>Memverifikasi otomatis...</span>
                    </div>
                    <div class="expire-info text-xs font-black text-red-500 mt-3 uppercase tracking-tighter"></div>
                </div>
            </div>
        </div>
        @endforeach
    </x-ui.card>
</div>

@push('scripts')
<script>
const shipmentId = {{ $shipment->id }};
const pollUrl = '{{ route("cashier.payments.poll", $shipment) }}';
const redirectUrl = '{{ route("cashier.shipments.show", $shipment) }}';
let pollInterval = null;

document.getElementById('cashToggle').addEventListener('click', () => {
    document.getElementById('cashPanel').classList.toggle('hidden');
    document.getElementById('cashChevron').classList.toggle('rotate-180');
});

document.querySelectorAll('.method-toggle').forEach(btn => {
    btn.addEventListener('click', () => {
        const type = btn.dataset.type;
        const panel = document.querySelector(`.method-panel[data-type="${type}"]`);
        const chevron = btn.querySelector('[data-lucide="chevron-down"]');
        panel.classList.toggle('hidden');
        chevron.classList.toggle('rotate-180');
    });
});

document.querySelectorAll('.charge-btn').forEach(btn => {
    btn.addEventListener('click', async () => {
        const type = btn.dataset.type;
        const label = btn.dataset.label;
        btn.disabled = true;
        btn.innerHTML = `<div class="w-4 h-4 border-2 border-white border-t-transparent rounded-full animate-spin"></div> Memproses...`;
        try {
            const res = await fetch('{{ route("cashier.payments.midtrans", $shipment) }}', {
                method:'POST',
                headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
                body: JSON.stringify({payment_type: type})
            });
            const data = await res.json();
            if(!res.ok) throw new Error(data.error||'Gagal memproses');
            showInstruction(type, data);
            startPolling();
        } catch(e) {
            btn.disabled = false;
            btn.innerHTML = `<i data-lucide="zap" class="w-5 h-5"></i> Bayar dengan ${label}`;
            import('lucide').then(({createIcons,icons})=>createIcons({icons}));
            Swal.fire({
                icon: 'error',
                title: 'Gagal Memproses',
                text: e.message,
                confirmButtonText: 'Tutup',
                customClass: {
                    confirmButton: 'bg-[#1B3A6B] text-white font-bold px-6 py-2.5 rounded-lg'
                }
            });
        }
    });
});

function showInstruction(type, data) {
    const instrEl = document.querySelector(`.payment-instruction[data-type="${type}"]`);
    const contentEl = instrEl.querySelector('.instruction-content');
    const expireEl = instrEl.querySelector('.expire-info');
    let html = '';
        html = `<p class="font-medium text-gray-500">Nomor Virtual Account <strong>${type.toUpperCase()}</strong>:</p>
                <p class="text-3xl font-black text-[#1B3A6B] font-mono my-3 select-all">${data.va_number}</p>
                <p class="text-xs text-gray-400 font-bold">Transfer tepat Rp {{ number_format($shipment->total_price,0,',','.') }}</p>`;
    } else if(type === 'mandiri' && data.va_number) {
        html = `<p class="font-medium text-gray-500">Kode bayar Mandiri:</p>
                <p class="text-2xl font-black text-[#1B3A6B] font-mono my-2 select-all">${data.va_number}</p>
                <p class="text-xs text-gray-400 font-bold">Bayar melalui ATM Mandiri / Livin' by Mandiri</p>`;
    } else if(data.qr_url) {
        html = `<p class="text-center font-bold text-gray-800 mb-3 uppercase tracking-widest">Scan QR Code ini:</p>
                <div class="text-center p-3 bg-white rounded-2xl shadow-inner inline-block mx-auto border border-gray-100 italic">
                    <img src="${data.qr_url}" alt="QR Code" class="w-52 h-52 rounded-xl">
                </div>`;
    } else {
        html = '<p class="font-bold text-gray-700">Ikuti instruksi di aplikasi Anda untuk menyelesaikan pembayaran.</p>';
    }
    contentEl.innerHTML = html;
    if(data.expire_time) expireEl.textContent = 'Batas Waktu: ' + data.expire_time;
    instrEl.classList.remove('hidden');
    instrEl.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function startPolling() {
    if(pollInterval) clearInterval(pollInterval);
    pollInterval = setInterval(async () => {
        try {
            const res = await fetch(pollUrl);
            const data = await res.json();
            if(data.status === 'paid') {
                clearInterval(pollInterval);
                window.location.href = redirectUrl + '?success=1';
            } else if(data.status === 'failed') {
                clearInterval(pollInterval);
                Swal.fire({
                    icon: 'warning',
                    title: 'Pembayaran Gagal',
                    text: 'Pembayaran gagal atau telah kedaluwarsa.',
                    confirmButtonText: 'Tutup'
                });
            }
        } catch(e) {}
    }, 3000);
}
</script>
@endpush
@endsection
