@extends('layouts.app')
@section('title','Detail Pengiriman')
@section('page-title','Detail Pengiriman')

@section('content')
<div class="flex items-center justify-between mb-6 flex-wrap gap-3">
    <a href="{{ route('cashier.shipments.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1B3A6B]">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>
    <a href="{{ route('cashier.shipments.print-waybill', $shipment) }}" target="_blank"
       class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 text-white rounded-xl text-sm font-bold shadow-md shadow-slate-200 transition-all active:scale-95">
        <i data-lucide="printer" class="w-4 h-4"></i> Cetak Resi
    </a>
</div>

<div class="grid lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-5">
        <div class="bg-gradient-to-r from-[#0F2347] to-[#1B3A6B] rounded-xl p-6 text-white">
            <div class="flex items-start justify-between flex-wrap gap-3 mb-4">
                <div>
                    <p class="text-blue-300 text-xs mb-1">Nomor Resi</p>
                    <p class="text-xl font-bold font-mono tracking-wider">{{ $shipment->tracking_number }}</p>
                </div>
                <span class="px-3 py-1.5 rounded-full text-xs font-bold {{ $shipment->status_badge }}">{{ $shipment->status_label }}</span>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div><p class="text-blue-300 text-xs">Dari</p><p class="font-semibold">{{ $shipment->originBranch->city ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs">Ke</p><p class="font-semibold">{{ $shipment->destinationBranch->city ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs">Tanggal</p><p class="font-semibold">{{ $shipment->shipment_date?->format('d F Y') ?? '-' }}</p></div>
                <div><p class="text-blue-300 text-xs">Berat</p><p class="font-semibold">{{ $shipment->total_weight }} kg</p></div>
            </div>
        </div>

        <div class="grid md:grid-cols-2 gap-4">
            <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
                <h3 class="font-semibold text-[#0F2347] text-sm mb-3 flex items-center gap-2"><i data-lucide="user" class="w-4 h-4 text-[#F47B20]"></i> Pengirim</h3>
                <p class="font-bold text-gray-800">{{ $shipment->sender->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $shipment->sender->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500">{{ $shipment->sender->city ?? '-' }}</p>
            </div>
            <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
                <h3 class="font-semibold text-[#0F2347] text-sm mb-3 flex items-center gap-2"><i data-lucide="user-check" class="w-4 h-4 text-[#F47B20]"></i> Penerima</h3>
                <p class="font-bold text-gray-800">{{ $shipment->receiver->name ?? '-' }}</p>
                <p class="text-sm text-gray-500 mt-1">{{ $shipment->receiver->phone ?? '-' }}</p>
                <p class="text-sm text-gray-500">{{ $shipment->receiver->city ?? '-' }}</p>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2"><i data-lucide="package" class="w-4 h-4 text-[#F47B20]"></i> Isi Paket</h3>
            <table class="w-full text-sm">
                <thead><tr class="border-b border-gray-100 text-xs text-gray-500 font-semibold">
                    <th class="pb-2 text-left">Nama Barang</th><th class="pb-2 text-center">Qty</th><th class="pb-2 text-right">Berat</th>
                </tr></thead>
                <tbody>
                @foreach($shipment->items as $item)
                <tr class="border-b border-gray-50">
                    <td class="py-2 font-medium text-gray-800">{{ $item->item_name }}</td>
                    <td class="py-2 text-center text-gray-600">{{ $item->quantity }}</td>
                    <td class="py-2 text-right text-gray-600">{{ $item->weight }} kg</td>
                </tr>
                @endforeach
                </tbody>
                <tfoot><tr>
                    <td colspan="2" class="pt-3 font-semibold text-gray-700">Total Berat</td>
                    <td class="pt-3 text-right font-bold text-[#1B3A6B]">{{ $shipment->total_weight }} kg</td>
                </tr></tfoot>
            </table>
        </div>
    </div>

    <div class="space-y-5">
        {{-- Terima Paket Action --}}
        @php
            $canReceive = false;
            if ($shipment->status === 'picked_up') {
                $canReceive = true;
            } elseif ($shipment->status === 'in_transit' && $shipment->current_branch_id !== Auth::user()->branch_id) {
                $canReceive = true;
            }
        @endphp
        @if($canReceive)
        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-3 flex items-center gap-2">
                <i data-lucide="inbox" class="w-4 h-4 text-[#F47B20]"></i> Penerimaan Paket
            </h3>
            <form action="{{ route('cashier.shipments.receive', $shipment) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin telah menerima paket ini secara fisik?')">
                @csrf
                <button type="submit" class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-bold py-3.5 rounded-xl text-sm transition-all shadow-lg shadow-blue-900/10 active:scale-[0.98] flex items-center justify-center gap-2">
                    <i data-lucide="package-check" class="w-4 h-4"></i> Terima Paket (Scan In)
                </button>
            </form>
        </div>
        @endif

        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2"><i data-lucide="credit-card" class="w-4 h-4 text-[#F47B20]"></i> Pembayaran</h3>
            @if($shipment->payment)
            <div class="space-y-4 text-sm">
                <div class="p-3 {{ $shipment->payer_type === 'sender' ? 'bg-blue-50 border-blue-100' : 'bg-orange-50 border-orange-100' }} border rounded-xl flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg {{ $shipment->payer_type === 'sender' ? 'bg-[#1B3A6B]' : 'bg-[#F47B20]' }} flex items-center justify-center text-white shrink-0">
                        <i data-lucide="{{ $shipment->payer_type === 'sender' ? 'wallet' : 'hand-coins' }}" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider {{ $shipment->payer_type === 'sender' ? 'text-[#1B3A6B]' : 'text-[#F47B20]' }} opacity-70">Penanggung Jawab</p>
                        <p class="font-bold text-gray-800">{{ $shipment->payer_type === 'sender' ? 'Pengirim (Prepaid)' : 'Penerima (COD)' }}</p>
                    </div>
                </div>
                <div class="space-y-2.5 px-1">
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Jumlah Tagihan</span><span class="font-extrabold text-[#1B3A6B]">Rp {{ number_format($shipment->payment->amount ?? $shipment->total_price,0,',','.') }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Metode Bayar</span><span class="font-bold text-gray-700">{{ $shipment->payment->method_label ?? '-' }}</span></div>
                    <div class="flex justify-between items-center"><span class="text-gray-500 font-medium">Status</span>
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-black uppercase {{ $shipment->payment->status_badge ?? 'bg-gray-100 text-gray-600' }}">{{ ucfirst($shipment->payment->payment_status ?? 'pending') }}</span>
                    </div>
                </div>
            </div>
            @else
            <p class="text-sm text-gray-400 mb-3">Belum ada pembayaran.</p>
            @endif
            @if(!$shipment->payment || $shipment->payment->payment_status !== 'paid')
            <div class="mt-4 flex gap-2">
                <button type="button" onclick="checkStatus()" id="checkStatusBtn" class="w-11 h-11 shrink-0 flex items-center justify-center bg-gray-50 border border-gray-100 hover:bg-gray-100 text-gray-400 hover:text-[#1B3A6B] rounded-xl transition-all active:scale-95" title="Cek Status Pembayaran">
                    <i data-lucide="refresh-cw" class="w-4 h-4" id="refreshIcon"></i>
                </button>

                <button type="button" onclick="confirmCashPayment()" class="flex-1 inline-flex items-center justify-center gap-2 bg-[#F47B20] hover:bg-orange-600 text-white text-sm font-bold py-2.5 rounded-xl transition-all shadow-lg shadow-orange-500/10 active:scale-[0.98]">
                    <i data-lucide="banknote" class="w-4 h-4"></i> Bayar Tunai (Cash)
                </button>
                
                <form id="cashPaymentForm" action="{{ route('cashier.shipments.pay-cash', $shipment) }}" method="POST" class="hidden">
                    @csrf
                </form>
            </div>
            @endif
        </div>

        @push('scripts')
        <script>
            function confirmCashPayment() {
                window.Swal.fire({
                    title: 'Konfirmasi Pembayaran',
                    text: "Apakah Anda yakin ingin menerima pembayaran tunai untuk resi ini?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Bayar Sekarang',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('cashPaymentForm').submit();
                    }
                });
            }

            async function checkStatus() {
                const icon = document.getElementById('refreshIcon');
                icon.classList.add('animate-spin');
                
                try {
                    const res = await fetch('{{ route("cashier.shipments.payment-status", $shipment) }}');
                    const data = await res.json();
                    
                    if (data.status === 'paid') {
                        window.Swal.fire({
                            icon: 'success',
                            title: 'Pembayaran Lunas',
                            text: 'Pembayaran digital telah terverifikasi.'
                        }).then(() => window.location.reload());
                    }
                } catch (e) {
                    console.error(e);
                } finally {
                    setTimeout(() => {
                        icon.classList.remove('animate-spin');
                    }, 500);
                }
            }
        </script>
        @endpush

        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-3 flex items-center gap-2"><i data-lucide="tag" class="w-4 h-4 text-[#F47B20]"></i> Ringkasan Biaya</h3>
            <div class="space-y-2 text-sm">
                <div class="flex justify-between"><span class="text-gray-500">Tarif/kg</span><span>Rp {{ number_format($shipment->rate?->price_per_kg??0,0,',','.') }}</span></div>
                <div class="flex justify-between"><span class="text-gray-500">Berat</span><span>{{ $shipment->total_weight }} kg</span></div>
                <div class="flex justify-between font-bold border-t border-gray-100 pt-2"><span>Total</span><span class="text-[#1B3A6B]">Rp {{ number_format($shipment->total_price,0,',','.') }}</span></div>
            </div>
        </div>

        @if($shipment->trackings->count())
        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-3 flex items-center gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-[#F47B20]"></i> Status Terkini</h3>
            @php $latest = $shipment->trackings->sortByDesc('tracked_at')->first(); @endphp
            <p class="font-semibold text-sm text-[#1B3A6B]">{{ $latest->status_label }}</p>
            <p class="text-xs text-gray-500 mt-1">{{ $latest->description }}</p>
            <p class="text-xs text-gray-400 mt-1 flex items-center gap-1"><i data-lucide="clock" class="w-3 h-3"></i>{{ $latest->tracked_at?->format('d M Y, H:i') }}</p>
        </div>
        @endif
    </div>
</div>
@endsection
