@extends('layouts.landing')

@section('content')
{{-- Hero Carousel --}}
<section class="relative overflow-hidden" id="hero">
    <div id="heroCarousel" class="relative min-h-[650px] md:min-h-[800px]">

        {{-- Slide 1 --}}
        <div class="carousel-slide absolute inset-0 opacity-100 z-20 pointer-events-auto transition-opacity duration-500 ease-in-out">
            <div class="absolute inset-0">
                <img src="/images/carousel/carousel-1.webp" alt="Kurir KirimAja" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0F2347]/85 via-[#1B3A6B]/70 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-24 md:py-36 flex items-center h-full">
                <div class="text-white max-w-xl space-y-6">
                    <div class="inline-flex items-center gap-2 bg-[#F47B20]/20 border border-[#F47B20]/40 text-[#F47B20] text-xs font-semibold px-3 py-1.5 rounded-full">
                        <i data-lucide="zap" class="w-3.5 h-3.5"></i> Pengiriman Express Tersedia
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Kirim Paket ke<br>
                        <span class="text-[#F47B20]">Seluruh Indonesia</span><br>
                        dengan Mudah
                    </h1>
                    <p class="text-blue-100 text-base leading-relaxed">
                        Layanan ekspedisi terpercaya dengan jangkauan luas, tracking real-time, dan harga bersaing. Kirim sekarang, tiba tepat waktu.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="#tracking" class="bg-[#F47B20] hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg text-sm transition-colors flex items-center gap-2 shadow-lg">
                            <i data-lucide="search" class="w-4 h-4"></i> Lacak Paket
                        </a>
                        <a href="#cek-ongkir" class="bg-white/15 hover:bg-white/25 border border-white/30 text-white font-semibold px-6 py-3 rounded-lg text-sm transition-colors flex items-center gap-2 backdrop-blur-sm">
                            <i data-lucide="calculator" class="w-4 h-4"></i> Cek Ongkir
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 2 --}}
        <div class="carousel-slide absolute inset-0 opacity-0 z-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <div class="absolute inset-0">
                <img src="/images/carousel/carousel-2.webp" alt="Tim KirimAja" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0F2347]/85 via-[#1B3A6B]/70 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-24 md:py-36 flex items-center h-full">
                <div class="text-white max-w-xl space-y-6">
                    <div class="inline-flex items-center gap-2 bg-white/15 border border-white/30 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
                        <i data-lucide="users" class="w-3.5 h-3.5"></i> Tim Profesional Berpengalaman
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Tim Kurir Terlatih<br>
                        <span class="text-[#F47B20]">Siap Melayani</span><br>
                        Anda 24 Jam
                    </h2>
                    <p class="text-blue-100 text-base leading-relaxed">
                        Lebih dari 200 kurir profesional KirimAja siap menjemput dan mengantar paket Anda dengan cepat, tepat, dan penuh tanggung jawab.
                    </p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('customer.register') }}" class="bg-[#F47B20] hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg text-sm transition-colors flex items-center gap-2 shadow-lg">
                            <i data-lucide="user-plus" class="w-4 h-4"></i> Daftar Sekarang
                        </a>
                        <a href="#cabang" class="bg-white/15 hover:bg-white/25 border border-white/30 text-white font-semibold px-6 py-3 rounded-lg text-sm transition-colors flex items-center gap-2 backdrop-blur-sm">
                            <i data-lucide="building-2" class="w-4 h-4"></i> Lihat Cabang
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Slide 3 --}}
        <div class="carousel-slide absolute inset-0 opacity-0 z-0 pointer-events-none transition-opacity duration-500 ease-in-out">
            <div class="absolute inset-0">
                <img src="/images/carousel/carousel-3.webp" alt="Proses Pengiriman" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-r from-[#0F2347]/90 via-[#1B3A6B]/75 to-transparent"></div>
            </div>
            <div class="relative max-w-7xl mx-auto px-6 lg:px-8 py-24 md:py-36 flex items-center h-full">
                <div class="text-white max-w-xl space-y-6">
                    <div class="inline-flex items-center gap-2 bg-[#F47B20]/20 border border-[#F47B20]/40 text-[#F47B20] text-xs font-semibold px-3 py-1.5 rounded-full">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Aman & Terpercaya
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-extrabold leading-tight">
                        Proses Pengiriman<br>
                        <span class="text-[#F47B20]">Terstandarisasi</span><br>
                        & Terjamin
                    </h2>
                    <p class="text-blue-100 text-base leading-relaxed">
                        Setiap paket dikemas, dilabeli, dan ditangani dengan standar keamanan tinggi. Bayar mudah via QRIS, GoPay, BCA, BRI, BNI, atau Mandiri.
                    </p>
                    <div class="flex flex-wrap gap-2 pt-1">
                        @foreach(['QRIS','GoPay','BCA','BRI','BNI','Mandiri','Tunai'] as $method)
                            <span class="bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-lg backdrop-blur-sm">{{ $method }}</span>
                        @endforeach
                    </div>
                    <a href="#cek-ongkir" class="inline-flex items-center gap-2 bg-[#F47B20] hover:bg-orange-600 text-white font-semibold px-6 py-3 rounded-lg text-sm transition-colors shadow-lg w-fit">
                        <i data-lucide="calculator" class="w-4 h-4"></i> Cek Ongkir Sekarang
                    </a>
                </div>
            </div>
        </div>

        {{-- Carousel Buttons --}}
        <button id="prevBtn" class="absolute left-4 bottom-5 md:top-1/2 md:-translate-y-1/2 md:bottom-auto w-11 h-11 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-colors backdrop-blur-sm border border-white/20 z-30">
            <i data-lucide="chevron-left" class="w-5 h-5"></i>
        </button>

        <button id="nextBtn" class="absolute right-4 bottom-5 md:top-1/2 md:-translate-y-1/2 md:bottom-auto w-11 h-11 rounded-full bg-white/20 hover:bg-white/40 text-white flex items-center justify-center transition-colors backdrop-blur-sm border border-white/20 z-30">
            <i data-lucide="chevron-right" class="w-5 h-5"></i>
        </button>

        {{-- Carousel Dots --}}
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-30">
            <button class="carousel-dot w-8 h-1.5 rounded-full bg-white opacity-100 transition-all" data-index="0"></button>
            <button class="carousel-dot w-2.5 h-1.5 rounded-full bg-white opacity-50 transition-all" data-index="1"></button>
            <button class="carousel-dot w-2.5 h-1.5 rounded-full bg-white opacity-50 transition-all" data-index="2"></button>
        </div>
    </div>
</section>

{{-- Quick Track Bar --}}
<div class="bg-[#1B3A6B] py-6">
    <div class="max-w-4xl mx-auto px-4">
        <form method="POST" action="{{ route('track') }}" class="flex gap-3 items-center tracking-form">
            @csrf
            <div class="flex-1 relative">
                <i data-lucide="package-search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                <input type="text" name="tracking_number" value="{{ old('tracking_number') }}"
                       class="w-full pl-12 pr-4 py-3.5 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#F47B20] bg-white"
                       placeholder="Masukkan nomor resi (contoh: KA20240001ABC)">
            </div>
            <button type="submit" class="bg-[#F47B20] hover:bg-orange-600 text-white font-semibold px-6 py-3.5 rounded-lg text-sm transition-colors flex items-center gap-2 whitespace-nowrap shadow-lg">
                <i data-lucide="search" class="w-4 h-4"></i>
                <span class="hidden sm:inline">Lacak Paket</span>
                <span class="sm:hidden">Lacak</span>
            </button>
        </form>
        @if($errors->has('tracking_number'))
            <p class="mt-2 text-sm text-red-300 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i>
                {{ $errors->first('tracking_number') }}
            </p>
        @endif
    </div>
</div>

{{-- Services --}}
<section id="layanan" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-bold text-[#F47B20] uppercase tracking-widest mb-2">Layanan Kami</span>
            <h2 class="text-3xl font-extrabold text-[#0F2347]">Solusi Pengiriman Lengkap</h2>
            <p class="text-gray-500 mt-2 max-w-2xl mx-auto">Dari dokumen penting hingga barang besar, kami punya solusi untuk semua kebutuhan pengiriman Anda</p>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @php
            $services = [
                ['icon'=>'zap','title'=>'Pengiriman Express','desc'=>'Paket sampai 1–2 hari kerja untuk kota terdekat. Cocok untuk dokumen dan barang mendesak.','color'=>'text-orange-500','bg'=>'bg-orange-50','border'=>'hover:border-orange-200'],
                ['icon'=>'package','title'=>'Pengiriman Reguler','desc'=>'Solusi hemat untuk pengiriman ke seluruh Indonesia. Estimasi 2–5 hari kerja tergantung tujuan.','color'=>'text-blue-600','bg'=>'bg-blue-50','border'=>'hover:border-blue-200'],
                ['icon'=>'truck','title'=>'Kargo & Besar','desc'=>'Layanan pengiriman barang berat dan besar menggunakan armada truck kami yang terawat.','color'=>'text-green-600','bg'=>'bg-green-50','border'=>'hover:border-green-200'],
                ['icon'=>'map-pin','title'=>'Tracking Real-Time','desc'=>'Pantau perjalanan paket setiap saat. Update otomatis dari penjemputan hingga tiba di penerima.','color'=>'text-purple-600','bg'=>'bg-purple-50','border'=>'hover:border-purple-200'],
                ['icon'=>'shield-check','title'=>'Asuransi Paket','desc'=>'Jaminan keamanan barang Anda. KirimAja bertanggung jawab penuh atas keselamatan setiap paket.','color'=>'text-red-500','bg'=>'bg-red-50','border'=>'hover:border-red-200'],
                ['icon'=>'credit-card','title'=>'Pembayaran Fleksibel','desc'=>'Bayar dengan QRIS, GoPay, transfer bank, atau tunai. Proses cepat, aman, dan mudah.','color'=>'text-yellow-600','bg'=>'bg-yellow-50','border'=>'hover:border-yellow-200'],
            ];
            @endphp
            @foreach($services as $s)
                <div class="group p-6 rounded-xl border border-gray-100 {{ $s['border'] }} hover:shadow-lg transition-all duration-200">
                    <div class="w-12 h-12 rounded-lg {{ $s['bg'] }} flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i data-lucide="{{ $s['icon'] }}" class="w-6 h-6 {{ $s['color'] }}"></i>
                    </div>
                    <h3 class="font-bold text-[#0F2347] mb-2">{{ $s['title'] }}</h3>
                    <p class="text-sm text-gray-500 leading-relaxed">{{ $s['desc'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- How it works --}}
<section class="py-20 bg-[#EBF2FF]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-bold text-[#F47B20] uppercase tracking-widest mb-2">Cara Kerja</span>
            <h2 class="text-3xl font-extrabold text-[#0F2347]">Kirim Paket Semudah 3 Langkah</h2>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @php
            $steps = [
                ['num'=>'01','icon'=>'map-pin','title'=>'Datang ke Cabang','desc'=>'Kunjungi cabang KirimAja terdekat atau hubungi kami untuk penjemputan paket di lokasi Anda.'],
                ['num'=>'02','icon'=>'package','title'=>'Proses Pengiriman','desc'=>'Kasir kami akan mencatat detail paket, menghitung ongkir, dan memproses pembayaran Anda.'],
                ['num'=>'03','icon'=>'check-circle','title'=>'Paket Terkirim','desc'=>'Kurir kami akan mengantarkan paket ke tujuan. Pantau perjalanan paket lewat nomor resi Anda.'],
            ];
            @endphp
            @foreach($steps as $i => $step)
                <div class="relative">
                    <div class="bg-white rounded-xl p-6 premium-shadow border border-blue-100">
                        <div class="flex items-center gap-4 mb-4">
                            <span class="text-4xl font-black text-[#1B3A6B]">{{ $step['num'] }}</span>
                            <div class="w-10 h-10 rounded-lg bg-[#1B3A6B] flex items-center justify-center">
                                <i data-lucide="{{ $step['icon'] }}" class="w-5 h-5 text-white"></i>
                            </div>
                        </div>
                        <h3 class="font-bold text-[#0F2347] mb-2">{{ $step['title'] }}</h3>
                        <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
                    </div>
                    @if($i < count($steps)-1)
                    <div class="hidden md:block absolute top-1/2 -right-[35px] -translate-y-1/2 w-8 text-gray-300">
                        <i data-lucide="arrow-right" class="w-6 h-6"></i>
                    </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Cek Ongkir --}}
<section id="cek-ongkir" class="py-20 bg-white">
    <div class="max-w-2xl mx-auto px-4">
        <div class="text-center mb-8">
            <span class="inline-block text-xs font-bold text-[#F47B20] uppercase tracking-widest mb-2">Kalkulator Ongkir</span>
            <h2 class="text-3xl font-extrabold text-[#0F2347]">Cek Ongkir Gratis</h2>
            <p class="text-gray-500 mt-2">Hitung estimasi biaya pengiriman sebelum mengirim</p>
        </div>
        <div class="bg-white rounded-xl shadow-lg p-8 space-y-5 border border-gray-100">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kota Asal</label>
                    <x-form.select-dropdown 
                        name="origin_city" 
                        id="originCity" 
                        label="Pilih Kota" 
                        :options="$cities->map(fn($c) => ['value' => $c, 'label' => $c])" 
                        searchable="true" 
                    />
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kota Tujuan</label>
                    <x-form.select-dropdown 
                        name="destination_city" 
                        id="destCity" 
                        label="Pilih Kota" 
                        :options="$cities->map(fn($c) => ['value' => $c, 'label' => $c])" 
                        searchable="true" 
                    />
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Berat Paket (kg)</label>
                <input type="number" id="weightInput" step="0.1" min="0.1" max="1000" value="1"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-[#1B3A6B] focus:border-[#1B3A6B] block w-full p-2.5">
            </div>
            <button id="checkRateBtn" class="w-full bg-[#1B3A6B] hover:bg-[#0F2347] text-white font-semibold py-3 rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                <i data-lucide="calculator" class="w-4 h-4"></i> Hitung Ongkir
            </button>
            <div id="rateResult" class="hidden p-5 bg-[#EBF2FF] rounded-lg border border-[#1B3A6B]/20">
                <div class="grid grid-cols-3 gap-4 text-center">
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Tarif/kg</p>
                        <p class="font-bold text-[#1B3A6B] text-sm" id="pricePerKg">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Estimasi</p>
                        <p class="font-bold text-[#1B3A6B] text-sm" id="estDays">-</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-1">Total Biaya</p>
                        <p class="font-bold text-[#F47B20] text-lg" id="totalPrice">-</p>
                    </div>
                </div>
            </div>
            <div id="rateError" class="hidden p-4 bg-red-50 border border-red-200 rounded-lg text-sm text-red-600 flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                <span id="rateErrorMsg"></span>
            </div>
        </div>
    </div>
</section>

{{-- Branches --}}
<section id="cabang" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <span class="inline-block text-xs font-bold text-[#F47B20] uppercase tracking-widest mb-2">Jaringan Kami</span>
            <h2 class="text-3xl font-extrabold text-[#0F2347]">Cabang KirimAja</h2>
            <p class="text-gray-500 mt-2">Temukan cabang terdekat di kota Anda</p>
        </div>
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-5">
            @foreach($branches as $branch)
                <div class="bg-white p-5 rounded-xl border border-gray-100 hover:border-[#1B3A6B]/30 hover:shadow-md transition-all group">
                    <div class="w-10 h-10 rounded-lg bg-[#EBF2FF] flex items-center justify-center mb-3 group-hover:bg-[#1B3A6B] transition-colors">
                        <i data-lucide="building-2" class="w-5 h-5 text-[#1B3A6B] group-hover:text-white transition-colors"></i>
                    </div>
                    <h3 class="font-bold text-[#0F2347] text-sm mb-2">{{ $branch->name }}</h3>
                    <p class="text-xs text-gray-500 flex items-start gap-1.5 mb-1.5">
                        <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#F47B20] mt-0.5 shrink-0"></i>
                        {{ $branch->address }}
                    </p>
                    <p class="text-xs text-gray-500 flex items-center gap-1.5">
                        <i data-lucide="phone" class="w-3.5 h-3.5 text-[#1B3A6B] shrink-0"></i>
                        {{ $branch->phone }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Tracking Section --}}
<section id="tracking" class="py-20 bg-[#0F2347]">
    <div class="max-w-3xl mx-auto px-4 text-center">
        <span class="inline-block text-xs font-bold text-[#F47B20] uppercase tracking-widest mb-2">Cek Status Paket</span>
        <h2 class="text-3xl font-extrabold text-white mb-3">Lacak Paket Anda</h2>
        <p class="text-blue-300 mb-8">Masukkan nomor resi untuk melihat status pengiriman terkini</p>
        <form method="POST" action="{{ route('track') }}" class="flex gap-3 tracking-form">
            @csrf
            <div class="flex-1 relative">
                <i data-lucide="package-search" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400"></i>
                <input type="text" name="tracking_number" value="{{ old('tracking_number') }}"
                       class="w-full pl-12 pr-4 py-4 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-[#F47B20] bg-white"
                       placeholder="Contoh: KA20240001ABC">
            </div>
            <button type="submit" class="bg-[#F47B20] hover:bg-orange-600 text-white font-semibold px-6 py-4 rounded-lg text-sm transition-colors flex items-center gap-2 whitespace-nowrap shadow-lg">
                <i data-lucide="search" class="w-4 h-4"></i> Lacak
            </button>
        </form>
        @if($errors->has('tracking_number'))
            <p class="mt-3 text-sm text-red-400 flex items-center justify-center gap-2">
                <i data-lucide="alert-circle" class="w-4 h-4"></i> {{ $errors->first('tracking_number') }}
            </p>
        @endif
    </div>
</section>

{{-- CTA --}}
<section class="bg-white py-24">
    <div class="max-w-5xl mx-auto px-4">
        <div class="bg-gradient-to-br from-[#F47B20] to-orange-600 rounded-[2.5rem] p-10 md:p-16 text-center text-white shadow-2xl shadow-orange-100 relative overflow-hidden">
            {{-- Decorative blobs --}}
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-black/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10">
                <h2 class="text-3xl md:text-4xl font-extrabold mb-4">Siap Mulai Kirim?</h2>
                <p class="text-orange-50 text-base md:text-lg mb-10 max-w-2xl mx-auto opacity-90 leading-relaxed">
                    Daftar gratis sekarang dan nikmati kemudahan pengiriman ke seluruh Indonesia dengan layanan terbaik KirimAja.
                </p>
                <a href="{{ route('customer.register') }}" class="bg-white text-[#F47B20] font-bold px-10 py-4 rounded-xl text-sm md:text-base hover:shadow-xl transition-all">
                    Daftar Sekarang - Gratis
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
let current = 0;
const slides = document.querySelectorAll('.carousel-slide');
const dots   = document.querySelectorAll('.carousel-dot');

function goTo(idx) {
    if (slides.length === 0) return;
    
    const oldSlide = slides[current];
    const newIdx = (idx + slides.length) % slides.length;
    if (newIdx === current) return;
    const newSlide = slides[newIdx];

    oldSlide.classList.remove('z-20', 'pointer-events-auto');
    oldSlide.classList.add('z-10', 'pointer-events-none');
    
    newSlide.classList.remove('opacity-0', 'z-0', 'z-10', 'pointer-events-none');
    newSlide.classList.add('opacity-100', 'z-20', 'pointer-events-auto');

    if (dots.length > current) {
        dots[current].classList.remove('opacity-100', 'w-8');
        dots[current].classList.add('opacity-50', 'w-2.5');
    }
    
    current = newIdx;
    
    if (dots.length > current) {
        dots[current].classList.add('opacity-100', 'w-8');
        dots[current].classList.remove('opacity-50', 'w-2.5');
    }

    setTimeout(() => {        
        if (slides[current] !== oldSlide) {
            oldSlide.classList.remove('opacity-100', 'z-10');
            oldSlide.classList.add('opacity-0', 'z-0');
        }
    }, 500);
}

document.getElementById('prevBtn')?.addEventListener('click', () => {
    goTo(current - 1);
    resetAutoSlide();
});
document.getElementById('nextBtn')?.addEventListener('click', () => {
    goTo(current + 1);
    resetAutoSlide();
});
dots.forEach(d => d.addEventListener('click', () => {
    goTo(parseInt(d.dataset.index));
    resetAutoSlide();
}));

let autoSlide = setInterval(() => goTo(current + 1), 6000);
function resetAutoSlide() {
    clearInterval(autoSlide);
    autoSlide = setInterval(() => goTo(current + 1), 6000);
}

const carouselEl = document.getElementById('heroCarousel');
carouselEl?.addEventListener('mouseenter', () => clearInterval(autoSlide));
carouselEl?.addEventListener('mouseleave', () => {
    clearInterval(autoSlide);
    autoSlide = setInterval(() => goTo(current + 1), 6000);
});

const checkBtn = document.getElementById('checkRateBtn');
if (checkBtn) {
    const fmt = v => 'Rp ' + parseInt(v).toLocaleString('id-ID');
    checkBtn.addEventListener('click', async () => {
        const origin = document.getElementById('originCity').value;
        const dest   = document.getElementById('destCity').value;
        const weight = document.getElementById('weightInput').value;
        const resEl  = document.getElementById('rateResult');
        
        if (!resEl) return;
        resEl.classList.add('hidden'); 

        
        if (!origin || !dest || !weight) { 
            window.Swal.fire({
                icon: 'warning',
                title: 'Data Tidak Lengkap',
                text: 'Silakan pilih kota asal, tujuan, dan masukkan berat paket.'
            });
            return; 
        }
        
        if (origin === dest) { 
            window.Swal.fire({
                icon: 'warning',
                title: 'Lokasi Sama',
                text: 'Kota asal dan tujuan tidak boleh sama.'
            });
            return; 
        }

        if (weight > 1000) {
            window.Swal.fire({
                icon: 'error',
                title: 'Berat Melebihi Batas',
                text: 'Maksimum berat untuk pengecekan mandiri adalah 1.000 kg. Silakan hubungi admin untuk pengiriman kargo besar.'
            });
            return;
        }
        
        const originalText = checkBtn.innerHTML;
        checkBtn.disabled = true;
        checkBtn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i> Memproses...';
        refreshIcons();

        try {
            const response = await fetch('{{ route("check-rate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    origin_city: origin, 
                    destination_city: dest, 
                    weight: weight
                })
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.error || data.message || 'Gagal menghitung tarif.');
            }
            
            document.getElementById('pricePerKg').textContent = fmt(data.price_per_kg) + '/kg';
            document.getElementById('estDays').textContent    = data.estimated_days + ' Hari';
            document.getElementById('totalPrice').textContent  = fmt(data.total);
            resEl.classList.remove('hidden');
        } catch (e) {
            window.Swal.fire({
                icon: 'error',
                title: 'Gagal Menghitung',
                text: e.message
            });
        } finally {
            checkBtn.disabled = false;
            checkBtn.innerHTML = originalText;
            refreshIcons();
        }
    });
}

const wInput = document.getElementById('weightInput');
if (wInput) {
    wInput.addEventListener('input', function() {
        let v = parseFloat(this.value);
        if (v > 1000) this.value = 1000;
        if (this.value < 0 && this.value !== '') this.value = 0;
    });
    wInput.addEventListener('blur', function() {
        let v = parseFloat(this.value);
        if (isNaN(v) || v < 0.1) this.value = 0.1;
    });
}
</script>
@endpush
