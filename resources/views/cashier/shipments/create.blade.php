@extends('layouts.app')
@section('title','Buat Pengiriman')
@section('page-title','Buat Pengiriman Baru')

@section('content')
<div class="w-full">
    <a href="{{ route('cashier.shipments.index') }}" class="inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1B3A6B] mb-6">
        <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali
    </a>

    @if($errors->any())
    <div class="p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-700 mb-5 space-y-1">
        @foreach($errors->all() as $e)<p class="flex items-center gap-2"><i data-lucide="x-circle" class="w-4 h-4 shrink-0"></i>{{ $e }}</p>@endforeach
    </div>
    @endif

    <form method="POST" action="{{ route('cashier.shipments.store') }}" id="shipmentForm" class="space-y-6">
        @csrf

        <div class="grid md:grid-cols-2 gap-6">
            {{-- Sender --}}
            <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-[#0F2347] flex items-center gap-2">
                        <i data-lucide="user" class="w-4 h-4 text-[#F47B20]"></i> Pengirim
                    </h3>
                    <button type="button" id="addSenderBtn" class="text-xs text-[#1B3A6B] font-medium hover:underline flex items-center gap-1">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Baru
                    </button>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Pengirim</label>
                    <x-form.select-dropdown 
                        name="sender_id" 
                        id="senderId" 
                        label="- Pilih Pengirim -" 
                        :options="$customers->map(fn($c) => ['value' => $c->id, 'label' => $c->name . ' (' . $c->phone . ')'])" 
                        :selected="old('sender_id')"
                        searchable="true"
                        required="true"
                    />
                </div>
            </div>

            {{-- Receiver --}}
            <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold text-[#0F2347] flex items-center gap-2">
                        <i data-lucide="user-check" class="w-4 h-4 text-[#F47B20]"></i> Penerima
                    </h3>
                    <button type="button" id="addReceiverBtn" class="text-xs text-[#1B3A6B] font-medium hover:underline flex items-center gap-1">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Baru
                    </button>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Pilih Penerima</label>
                    <x-form.select-dropdown 
                        name="receiver_id" 
                        id="receiverId" 
                        label="- Pilih Penerima -" 
                        :options="$customers->map(fn($c) => ['value' => $c->id, 'label' => $c->name . ' (' . $c->phone . ')'])" 
                        :selected="old('receiver_id')"
                        searchable="true"
                        required="true"
                    />
                </div>
            </div>
        </div>

        {{-- Route & Rate --}}
        <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
            <h3 class="font-semibold text-[#0F2347] mb-4 flex items-center gap-2">
                <i data-lucide="map" class="w-4 h-4 text-[#F47B20]"></i> Rute Pengiriman
            </h3>
            <div class="grid md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Cabang Asal</label>
                    <x-form.select-dropdown 
                        name="origin_branch_id" 
                        id="originBranch" 
                        label="Pilih Cabang" 
                        :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->name, 'data' => ['city' => $b->city]])" 
                        :selected="old('origin_branch_id', $userBranch?->id)"
                        searchable="true"
                        required="true"
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Cabang Tujuan</label>
                    <x-form.select-dropdown 
                        name="destination_branch_id" 
                        id="destBranch" 
                        label="Pilih Cabang" 
                        :options="$branches->map(fn($b) => ['value' => $b->id, 'label' => $b->name, 'data' => ['city' => $b->city]])" 
                        :selected="old('destination_branch_id')"
                        searchable="true"
                        required="true"
                    />
                </div>
                <div>
                    <label for="shipment_date" class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Pengiriman</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                            <i data-lucide="calendar" class="w-4 h-4 text-gray-400"></i>
                        </div>
                        <input datepicker datepicker-autohide datepicker-format="yyyy-mm-dd" datepicker-orientation="bottom left" 
                               type="text" id="shipment_date" name="shipment_date" 
                               value="{{ old('shipment_date', date('Y-m-d')) }}" required
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full ps-10 p-2.5 transition-all" 
                               placeholder="Pilih tanggal">
                    </div>
                </div>
                <div class="md:col-span-3">
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Tarif Pengiriman</label>
                    <x-form.select-dropdown 
                        name="rate_id" 
                        id="rateId" 
                        label="- Pilih Rute untuk Melihat Tarif -" 
                        :options="$rates->map(fn($r) => [
                            'value' => $r->id, 
                            'label' => $r->origin_city . ' → ' . $r->destination_city . ' | Rp ' . number_format($r->price_per_kg,0,',','.') . '/kg | ' . $r->estimated_days . ' hari',
                            'data' => [
                                'origin' => $r->origin_city,
                                'dest' => $r->destination_city,
                                'price' => $r->price_per_kg,
                                'days' => $r->estimated_days
                            ]
                        ])" 
                        :selected="old('rate_id')"
                        searchable="true"
                        required="true"
                    />
                </div>
            </div>
        </div>

        {{-- Items --}}
        <div class="grid md:grid-cols-3 gap-6">
            <div class="md:col-span-2 bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-semibold text-[#0F2347] flex items-center gap-2">
                        <i data-lucide="package" class="w-4 h-4 text-[#F47B20]"></i> Isi Paket
                    </h3>
                    <button type="button" id="addItemBtn" class="inline-flex items-center gap-1.5 text-xs font-semibold text-[#1B3A6B] border border-[#1B3A6B] px-3 py-1.5 rounded-lg hover:bg-[#EBF2FF] transition-colors">
                        <i data-lucide="plus" class="w-3.5 h-3.5"></i> Tambah Item
                    </button>
                </div>
                <div id="itemsContainer" class="space-y-3">
                    <div class="item-row grid grid-cols-12 gap-3 items-end">
                        <div class="col-span-6">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Nama Barang</label>
                            <input type="text" name="items[0][item_name]" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]" placeholder="Nama barang">
                        </div>
                        <div class="col-span-2">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Qty</label>
                            <input type="number" name="items[0][quantity]" min="1" value="1" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]">
                        </div>
                        <div class="col-span-3">
                            <label class="block text-xs font-medium text-gray-600 mb-1">Berat (kg)</label>
                            <input type="number" name="items[0][weight]" min="0.01" step="0.01" value="1" required
                                class="item-weight w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]">
                        </div>
                        <div class="col-span-1 flex justify-end pb-0.5">
                            <span class="w-8 h-8 flex items-center justify-center text-gray-400 cursor-not-allowed" title="Baris pertama tidak dapat dihapus">
                                <i data-lucide="trash-2" class="w-4 h-4 opacity-50"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                {{-- Payment Type --}}
                <div class="bg-white rounded-xl p-5 border border-gray-100 premium-shadow">
                    <h3 class="font-semibold text-[#0F2347] flex items-center gap-2 mb-4">
                        <i data-lucide="credit-card" class="w-4 h-4 text-[#F47B20]"></i> Penanggung Jawab
                    </h3>
                    <div class="grid grid-cols-2 gap-4">
                        {{-- Sender (Prepaid) --}}
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="payer_type" value="sender" checked class="peer sr-only">
                            <div class="h-full p-4 rounded-2xl border-2 border-gray-100 bg-white shadow-sm transition-all duration-300 peer-checked:border-[#1B3A6B] peer-checked:bg-blue-50/50 peer-checked:shadow-md hover:border-blue-200">
                                <div class="flex flex-col items-center text-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 transition-all duration-300 peer-checked:bg-[#1B3A6B] peer-checked:text-white">
                                        <i data-lucide="wallet" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#0F2347] transition-colors peer-checked:text-[#1B3A6B] text-sm">Pengirim</p>
                                        <p class="text-xs text-gray-400 font-extrabold mt-1 leading-tight">Bayar di Awal<br>(Prepaid)</p>
                                    </div>
                                </div>
                                {{-- Active Indicator --}}
                                <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-all duration-300">
                                    <div class="w-5 h-5 rounded-full bg-[#1B3A6B] flex items-center justify-center ring-4 ring-white">
                                        <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </label>

                        {{-- Receiver (COD) --}}
                        <label class="relative cursor-pointer group">
                            <input type="radio" name="payer_type" value="receiver" class="peer sr-only">
                            <div class="h-full p-4 rounded-2xl border-2 border-gray-100 bg-white shadow-sm transition-all duration-300 peer-checked:border-[#F47B20] peer-checked:bg-orange-50/50 peer-checked:shadow-md hover:border-orange-200">
                                <div class="flex flex-col items-center text-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 transition-all duration-300 peer-checked:bg-[#F47B20] peer-checked:text-white">
                                        <i data-lucide="hand-coins" class="w-6 h-6"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-[#0F2347] transition-colors peer-checked:text-[#F47B20] text-sm">Penerima</p>
                                        <p class="text-xs text-gray-400 font-extrabold mt-1 leading-tight">Bayar di Tujuan<br>(COD)</p>
                                    </div>
                                </div>
                                {{-- Active Indicator --}}
                                <div class="absolute top-2 right-2 opacity-0 peer-checked:opacity-100 transition-all duration-300">
                                    <div class="w-5 h-5 rounded-full bg-[#F47B20] flex items-center justify-center ring-4 ring-white">
                                        <i data-lucide="check" class="w-3 h-3 text-white"></i>
                                    </div>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Total calc --}}
                <div class="p-5 bg-gradient-to-br from-[#1B3A6B] to-[#0F2347] rounded-xl shadow-lg shadow-blue-900/10 text-white">
                    <div class="flex items-center justify-between text-xs font-bold text-blue-200/60 uppercase tracking-widest mb-3">
                        <span>Ringkasan Biaya</span>
                        <i data-lucide="receipt" class="w-4 h-4"></i>
                    </div>
                    <div class="flex items-center justify-between text-sm mb-2 text-blue-100/80 font-medium">
                        <span>Total Berat:</span>
                        <span id="totalWeight">0 kg</span>
                    </div>
                    <div class="pt-3 border-t border-white/10">
                        <span class="text-xs text-blue-200/60 uppercase font-bold">Estimasi Biaya</span>
                        <div id="estimatedCost" class="text-2xl font-black mt-1">Rp 0</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="flex-1 md:flex-none md:w-48 bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-3 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Pengiriman
            </button>
            <a href="{{ route('cashier.shipments.index') }}" class="px-6 py-3 border border-gray-300 text-gray-600 rounded-lg text-sm hover:bg-gray-50 transition-colors">Batal</a>
        </div>
    </form>
</div>

{{-- Quick Add Customer Modal --}}
<div id="customerModal" class="fixed inset-0 bg-black/50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl w-full max-w-md shadow-2xl p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-[#0F2347]" id="modalTitle">Tambah Pelanggan Baru</h3>
            <button id="closeModal" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>
        </div>
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" id="newName" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full p-2.5" placeholder="Nama lengkap">
            </div>
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">No. HP</label>
                    <input type="text" id="newPhone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full p-2.5" placeholder="08xxxxxxxxxx">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                    <input type="text" id="newCity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full p-2.5" placeholder="Jakarta">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                <input type="text" id="newAddress" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full p-2.5" placeholder="Alamat lengkap">
            </div>
            <div id="modalError" class="hidden text-sm text-red-600 bg-red-50 p-3 rounded-lg"></div>
            <button id="saveCustomerBtn" class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-2.5 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                <i data-lucide="save" class="w-4 h-4"></i> Simpan Pelanggan
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
let itemCount = 1;
let currentTarget = null;
const rates = {!! json_encode($rates->map(function($r) {
    return [
        'id' => $r->id,
        'origin' => $r->origin_city,
        'dest' => $r->destination_city,
        'price' => $r->price_per_kg,
        'days' => $r->estimated_days
    ];
})->values()) !!};
const fmt = v => 'Rp ' + parseInt(v).toLocaleString('id-ID');

document.getElementById('addItemBtn').addEventListener('click', () => {
    const c = document.getElementById('itemsContainer');
    const row = document.createElement('div');
    row.className = 'item-row grid grid-cols-12 gap-3 items-end';
    row.innerHTML = `
        <div class="col-span-6"><label class="block text-xs font-medium text-gray-600 mb-1">Nama Barang</label>
        <input type="text" name="items[${itemCount}][item_name]" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]" placeholder="Nama barang"></div>
        <div class="col-span-2"><label class="block text-xs font-medium text-gray-600 mb-1">Qty</label>
        <input type="number" name="items[${itemCount}][quantity]" min="1" value="1" required class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]"></div>
        <div class="col-span-3"><label class="block text-xs font-medium text-gray-600 mb-1">Berat (kg)</label>
        <input type="number" name="items[${itemCount}][weight]" min="0.01" step="0.01" value="1" required class="item-weight w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#1B3A6B]"></div>
        <div class="col-span-1 flex justify-end pb-0.5"><button type="button" class="remove-item w-8 h-8 flex items-center justify-center text-red-500 hover:text-red-700 hover:bg-red-50 rounded-lg transition-colors"><i data-lucide="trash-2" class="w-4 h-4"></i></button></div>`;
    c.appendChild(row);
    row.querySelector('.remove-item').addEventListener('click', () => { row.remove(); recalc(); });
    if (window.lucide) {
        window.lucide.createIcons({ icons: window.lucide.icons });
    }
    itemCount++;
});

document.addEventListener('click', e => {
    if(e.target.closest('.remove-item')) { e.target.closest('.item-row').remove(); recalc(); }
});

function recalc() {
    const weights = [...document.querySelectorAll('.item-weight')].map(i=>parseFloat(i.value)||0);
    const total = weights.reduce((a,b)=>a+b,0);
    document.getElementById('totalWeight').textContent = total.toFixed(2) + ' kg';
    const sel = document.getElementById('rateId');
    const price = parseFloat(sel.dataset.price || 0);
    if(price > 0) {
        document.getElementById('estimatedCost').textContent = fmt(total * price);
    } else {
        document.getElementById('estimatedCost').textContent = 'Rp 0';
    }
}
document.getElementById('itemsContainer').addEventListener('input', recalc);
document.getElementById('rateId').addEventListener('change', recalc);

let modalTarget = null;
document.getElementById('addSenderBtn').addEventListener('click', () => { modalTarget = 'sender'; openModal('Tambah Pengirim Baru'); });
document.getElementById('addReceiverBtn').addEventListener('click', () => { modalTarget = 'receiver'; openModal('Tambah Penerima Baru'); });
document.getElementById('closeModal').addEventListener('click', closeModal);
document.getElementById('customerModal').addEventListener('click', e => { if(e.target===document.getElementById('customerModal')) closeModal(); });

function openModal(title) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('customerModal').classList.remove('hidden');
    document.getElementById('newName').focus();
}
function closeModal() {
    document.getElementById('customerModal').classList.add('hidden');
    ['newName','newPhone','newCity','newAddress'].forEach(id => document.getElementById(id).value = '');
    document.getElementById('modalError').classList.add('hidden');
}

document.getElementById('saveCustomerBtn').addEventListener('click', async () => {
    const name = document.getElementById('newName').value;
    const phone = document.getElementById('newPhone').value;
    const city = document.getElementById('newCity').value;
    const address = document.getElementById('newAddress').value;
    const errEl = document.getElementById('modalError');
    errEl.classList.add('hidden');
    if(!name||!phone||!city||!address){ errEl.textContent='Semua field wajib diisi.'; errEl.classList.remove('hidden'); return; }
    try {
        const res = await fetch('{{ route("cashier.customers.quick-store") }}', {
            method:'POST',
            headers:{'Content-Type':'application/json','X-CSRF-TOKEN':'{{ csrf_token() }}'},
            body: JSON.stringify({name,phone,city,address})
        });
        const data = await res.json();
        if(!res.ok) throw new Error(data.message||'Gagal menyimpan');
        const target = modalTarget === 'sender' ? document.getElementById('senderId') : document.getElementById('receiverId');
        const opt = document.createElement('option');
        opt.value = data.id; opt.textContent = `${data.name} (${data.phone})`; opt.selected = true;
        target.appendChild(opt);
        closeModal();
    } catch(e) { errEl.textContent = e.message; errEl.classList.remove('hidden'); }
});

function tryAutoSelectRate() {
    const originBranch = document.getElementById('originBranch');
    const destBranch = document.getElementById('destBranch');
    
    const originCity = originBranch.dataset.city;
    const destCity = destBranch.dataset.city;
    
    if (!originCity || !destCity) return;
    
    const match = rates.find(r => 
        r.origin.toLowerCase() === originCity.toLowerCase() && 
        r.dest.toLowerCase() === destCity.toLowerCase()
    );
    
    if (match) {
        const container = document.getElementById('container_rateId');
        const item = container.querySelector(`.x-select-item[data-value="${match.id}"]`);
        if (item) {
            item.click();
        }
    }
}

document.getElementById('originBranch').addEventListener('change', tryAutoSelectRate);
document.getElementById('destBranch').addEventListener('change', tryAutoSelectRate);

tryAutoSelectRate();
</script>
@endpush
@endsection
