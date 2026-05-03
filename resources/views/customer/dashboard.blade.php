@extends('layouts.app')
@section('title', 'Dashboard Pelanggan')
@section('page-title', '')

@section('content')
<div class="grid sm:grid-cols-3 gap-4 mb-6">
    <x-ui.card class="bg-gradient-to-br from-[#0F2347] to-[#1B3A6B] p-5 border-none shadow-lg shadow-blue-900/20">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-lg bg-white/20 flex items-center justify-center">
                <i data-lucide="send" class="w-6 h-6 text-white"></i>
            </div>
            <div>
                <p class="text-xs font-bold text-blue-200/60 uppercase tracking-widest mb-1">Total dikirim</p>
                <p class="text-3xl font-black text-white">{{ $totalSent }}</p>
            </div>
        </div>
    </x-ui.card>

    <x-ui.stat-card label="Sedang Dikirim" :value="$activeShipments" icon="truck" color="orange" />
    <x-ui.stat-card label="Paket Masuk" :value="$totalReceived" icon="inbox" color="blue" />
</div>

<x-ui.card>
    <div class="p-5 border-b border-gray-50 flex items-center justify-between flex-wrap gap-4">
        <h3 class="font-bold text-gray-800 flex items-center gap-2">
            <i data-lucide="history" class="w-4 h-4 text-orange-500"></i>
            Riwayat Pengiriman
        </h3>
        <form method="POST" action="{{ route('track') }}" class="flex gap-2 w-full sm:w-auto">
            @csrf
            <div class="relative flex-1 sm:w-56">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-gray-400"></i>
                <input type="text" name="tracking_number" placeholder="Cari nomor resi..."
                       class="w-full pl-9 pr-4 py-2 border border-gray-100 bg-gray-50 rounded-xl text-sm font-bold focus:outline-none focus:ring-2 focus:ring-[#1B3A6B] transition-all">
            </div>
            <button type="submit" class="px-4 py-2 bg-[#1B3A6B] text-white rounded-xl text-sm font-bold hover:bg-[#0F2347] transition-all active:scale-95">
                Lacak
            </button>
        </form>
    </div>
    <div class="px-5 border-b border-gray-100 flex items-center gap-8 overflow-x-auto">
        <a href="{{ route('customer.dashboard', ['tab' => 'outgoing']) }}" 
           class="py-4 text-sm font-black transition-all relative whitespace-nowrap {{ $tab === 'outgoing' ? 'text-[#1B3A6B]' : 'text-gray-400 hover:text-gray-600' }}">
            Paket Keluar
            <span class="ml-1.5 px-1.5 py-0.5 rounded-md bg-gray-100 text-[10px]">{{ $totalSent }}</span>
            @if($tab === 'outgoing')
                <div class="absolute bottom-0 left-0 w-full h-1 bg-[#1B3A6B] rounded-t-full"></div>
            @endif
        </a>
        <a href="{{ route('customer.dashboard', ['tab' => 'incoming']) }}" 
           class="py-4 text-sm font-black transition-all relative whitespace-nowrap {{ $tab === 'incoming' ? 'text-[#1B3A6B]' : 'text-gray-400 hover:text-gray-600' }}">
            Paket Masuk
            <span class="ml-1.5 px-1.5 py-0.5 rounded-md bg-gray-100 text-[10px]">{{ $totalReceived }}</span>
            @if($tab === 'incoming')
                <div class="absolute bottom-0 left-0 w-full h-1 bg-[#1B3A6B] rounded-t-full"></div>
            @endif
        </a>
    </div>
    
    <div class="divide-y divide-gray-50">
        @forelse($shipments as $s)
        <div class="p-5 hover:bg-gray-50/50 transition-colors group">
            <div class="flex items-start justify-between gap-4">
                <div class="flex-1 min-w-0">
                    @php
                        $isSender = $s->sender_id === Auth::guard('customer')->id();
                    @endphp

                    <div class="flex items-center gap-3 mb-2 flex-wrap">
                        <span class="font-mono text-sm font-bold text-[#1B3A6B] tracking-wider">{{ $s->tracking_number }}</span>
                        <x-ui.badge :type="match($s->status) {
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                            'pending' => 'warning',
                            default => 'info'
                        }" :label="$s->status_label" />
                        
                        @if($s->payment)
                            <x-ui.badge :type="$s->payment->payment_status === 'paid' ? 'success' : 'warning'" :label="ucfirst($s->payment->payment_status)" />
                        @endif
                    </div>

                    <div class="grid sm:grid-cols-3 gap-x-6 gap-y-1 text-[11px] font-bold text-gray-400 mt-2">
                        @if($isSender)
                            <p class="flex items-center gap-1.5"><i data-lucide="user" class="w-3.5 h-3.5 text-gray-300"></i> <span class="text-gray-300 mr-0.5 font-medium">Penerima:</span> <span class="text-gray-500">{{ $s->receiver->name ?? '-' }}</span></p>
                        @else
                            <p class="flex items-center gap-1.5"><i data-lucide="user" class="w-3.5 h-3.5 text-gray-300"></i> <span class="text-gray-300 mr-0.5 font-medium">Pengirim:</span> <span class="text-gray-500">{{ $s->sender->name ?? '-' }}</span></p>
                        @endif
                        <p class="flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-orange-400"></i> <span class="text-gray-300 mr-0.5 font-medium">Tujuan:</span> <span class="text-gray-500">{{ $s->destinationBranch->city ?? '-' }}</span></p>
                        <p class="flex items-center gap-1.5"><i data-lucide="calendar" class="w-3.5 h-3.5 text-gray-300"></i> <span class="text-gray-300 mr-0.5 font-medium">Tanggal:</span> <span class="text-gray-500">{{ $s->shipment_date?->format('d F Y') }}</span></p>
                    </div>
                </div>
                <div class="shrink-0 flex items-center gap-2">
                    @if($s->payer_type === 'sender' && (!$s->payment || $s->payment->payment_status !== 'paid'))
                        <button onclick="openPaymentModal('{{ $s->tracking_number }}', '{{ route('customer.payments.pay', $s) }}', {{ (int)$s->total_price }})" 
                                class="inline-flex items-center gap-2 px-4 py-2 bg-[#F47B20] text-white text-sm font-bold rounded-xl hover:bg-[#D66A1B] transition-all active:scale-95 shadow-lg shadow-orange-500/20">
                            <i data-lucide="credit-card" class="w-3.5 h-3.5"></i> Bayar Sekarang
                        </button>
                    @endif
                    <a href="{{ route('customer.track', $s) }}" class="inline-flex items-center gap-2 px-4 py-2 border border-blue-100 hover:bg-[#EBF2FF] hover:border-[#1B3A6B]/20 text-[#1B3A6B] text-sm font-bold rounded-xl transition-all active:scale-95">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> Lacak
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="p-20 text-center">
            <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100">
                <i data-lucide="package" class="w-8 h-8 text-gray-200"></i>
            </div>
            <p class="text-sm text-gray-400 font-medium">Belum ada riwayat pengiriman</p>
        </div>
        @endforelse
    </div>
    
    @if($shipments->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">{{ $shipments->links() }}</div>
    @endif
</x-ui.card>

{{-- Payment Modal --}}
<div id="paymentModal" class="fixed inset-0 bg-[#0F2347]/40 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-3xl w-full max-w-md shadow-2xl overflow-hidden animate-in fade-in zoom-in duration-200">
        <div class="p-6 bg-gradient-to-r from-[#1B3A6B] to-[#0F2347] text-white">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h3 class="text-lg font-black tracking-tight">Pilih Pembayaran</h3>
                    <p class="text-blue-200 text-[10px] font-bold uppercase tracking-widest mt-0.5" id="payResi">RESINUMBER</p>
                </div>
                <button onclick="closePaymentModal()" class="w-8 h-8 flex items-center justify-center rounded-full bg-white/10 hover:bg-white/20 transition-colors">
                    <i data-lucide="x" class="w-4 h-4"></i>
                </button>
            </div>
            <div class="bg-white/10 rounded-2xl p-4 backdrop-blur-md">
                <p class="text-xs text-blue-200 font-bold uppercase tracking-wider mb-1">Total yang harus dibayar</p>
                <p class="text-2xl font-black tracking-tight" id="payAmount">Rp 0</p>
            </div>
        </div>
        
        <form id="paymentForm" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">QRIS & E-Wallet</p>
                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="relative">
                        <input type="radio" id="pay_qris" name="payment_method" value="qris" required class="peer sr-only">
                        <label for="pay_qris" class="payment-opt group relative flex flex-col items-center justify-center h-24 border-2 border-gray-100 rounded-3xl cursor-pointer hover:border-brand/20 transition-all text-center peer-checked:border-brand peer-checked:bg-brand/5 peer-checked:[&_img]:grayscale-0">
                            <img src="{{ asset('images/payments/qris.svg') }}" alt="QRIS" class="h-8 grayscale group-hover:grayscale-0 transition-all">
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <div class="w-5 h-5 rounded-full bg-brand flex items-center justify-center ring-4 ring-white">
                                    <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="relative">
                        <input type="radio" id="pay_gopay" name="payment_method" value="gopay" required class="peer sr-only">
                        <label for="pay_gopay" class="payment-opt group relative flex flex-col items-center justify-center h-24 border-2 border-gray-100 rounded-3xl cursor-pointer hover:border-brand/20 transition-all text-center peer-checked:border-brand peer-checked:bg-brand/5 peer-checked:[&_img]:grayscale-0">
                            <img src="{{ asset('images/payments/gopay.svg') }}" alt="GoPay" class="h-8 grayscale group-hover:grayscale-0 transition-all">
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <div class="w-5 h-5 rounded-full bg-brand flex items-center justify-center ring-4 ring-white">
                                    <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-3">Virtual Account (Transfer Bank)</p>
                <div class="grid grid-cols-2 gap-3">
                    @foreach(['bca', 'mandiri', 'bni', 'bri', 'bsi'] as $bank)
                    <div class="relative">
                        <input type="radio" id="pay_{{ $bank }}" name="payment_method" value="{{ $bank }}" required class="peer sr-only">
                        <label for="pay_{{ $bank }}" class="payment-opt group relative flex flex-col items-center justify-center h-24 border-2 border-gray-100 rounded-3xl cursor-pointer hover:border-brand/20 transition-all text-center peer-checked:border-brand peer-checked:bg-brand/5 peer-checked:[&_img]:grayscale-0">
                            <img src="{{ asset('images/payments/'.$bank.'.svg') }}" alt="{{ strtoupper($bank) }}" class="h-7 grayscale group-hover:grayscale-0 transition-all">
                            <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                <div class="w-5 h-5 rounded-full bg-brand flex items-center justify-center ring-4 ring-white">
                                    <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                </div>
                            </div>
                        </label>
                    </div>
                    @endforeach
                </div>
            </div>

            <button type="submit" class="w-full py-4 bg-[#1B3A6B] text-white rounded-2xl font-black text-sm hover:bg-[#0F2347] transition-all active:scale-[0.98] shadow-xl shadow-blue-900/10 flex items-center justify-center gap-2">
                Bayar Sekarang <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
function openPaymentModal(resi, url, amount) {
    document.getElementById('payResi').textContent = resi;
    document.getElementById('payAmount').textContent = 'Rp ' + amount.toLocaleString('id-ID');
    document.getElementById('paymentForm').action = url;
    document.getElementById('paymentModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}
function closePaymentModal() {
    document.getElementById('paymentModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const rawMethod = form.querySelector('input[name="payment_method"]:checked').value;
    const methodNames = @json(\App\Enums\PaymentBank::allLabels());
    const formattedMethod = methodNames[rawMethod] || rawMethod;
    
    window.Swal.fire({
        title: 'Konfirmasi Pembayaran',
        text: `Apakah Anda yakin ingin membayar menggunakan ${formattedMethod}?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        confirmButtonColor: '#1B3A6B'
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
});
</script>
@endpush

@endsection
