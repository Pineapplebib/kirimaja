<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KirimAja - Ekspedisi Cepat, Aman & Terpercaya')</title>
    <meta name="description" content="@yield('meta_description', 'KirimAja: layanan ekspedisi pengiriman paket ke seluruh Indonesia. Lacak paket real-time, tarif terjangkau.')">
    <link rel="icon" href="/images/branding/icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-white font-sans text-gray-800 flex flex-col min-h-screen">

{{-- Navbar --}}
<nav class="sticky top-0 z-50 bg-white/95 backdrop-blur border-b border-gray-200 premium-shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('home') }}" id="logoLink" class="flex items-center gap-2">
                <img src="/images/branding/logo.png" alt="KirimAja" class="h-9">
            </a>
            <div class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-600">
                <a href="{{ route('home') }}#layanan" class="hover:text-[#1B3A6B] transition-colors">Layanan</a>
                <a href="{{ route('home') }}#tracking" class="hover:text-[#1B3A6B] transition-colors">Lacak Paket</a>
                <a href="{{ route('home') }}#cek-ongkir" class="hover:text-[#1B3A6B] transition-colors">Cek Ongkir</a>
                <a href="{{ route('home') }}#cabang" class="hover:text-[#1B3A6B] transition-colors">Cabang</a>
            </div>
            <div class="flex items-center gap-3">
                @auth('customer')
                    <a href="{{ route('customer.dashboard') }}" class="inline-flex items-center gap-1.5 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors premium-shadow">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @elseauth('web')
                    @php
                        $dashboardRoute = match(auth()->user()->role) {
                            'admin', 'manager' => 'admin.dashboard',
                            'cashier'           => 'cashier.dashboard',
                            'courier'           => 'courier.dashboard',
                            default             => 'home'
                        };
                    @endphp
                    <a href="{{ route($dashboardRoute) }}" class="inline-flex items-center gap-1.5 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors premium-shadow">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('customer.login') }}" class="hidden md:inline-flex items-center gap-1.5 text-sm font-medium text-[#1B3A6B] border border-[#1B3A6B] px-4 py-2 rounded-lg hover:bg-[#EBF2FF] transition-colors">
                        <i data-lucide="user" class="w-4 h-4"></i> Masuk
                    </a>
                    <a href="{{ route('customer.register') }}" class="inline-flex items-center gap-1.5 bg-[#F47B20] hover:bg-orange-600 text-white text-sm font-semibold px-4 py-2 rounded-lg transition-colors premium-shadow">
                        Daftar Gratis
                    </a>
                @endauth
                <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>
    </div>
    {{-- Mobile Menu --}}
    <div id="mobileMenu" class="md:hidden absolute top-full left-0 right-0 border-t border-gray-100 bg-white px-4 py-4 space-y-2 shadow-xl z-50 transition-all duration-300 ease-in-out opacity-0 invisible -translate-y-2 pointer-events-none">
        <a href="{{ route('home') }}#layanan" class="block py-2 text-sm text-gray-600 hover:text-[#1B3A6B]">Layanan</a>
        <a href="{{ route('home') }}#tracking" class="block py-2 text-sm text-gray-600 hover:text-[#1B3A6B]">Lacak Paket</a>
        <a href="{{ route('home') }}#cek-ongkir" class="block py-2 text-sm text-gray-600 hover:text-[#1B3A6B]">Cek Ongkir</a>
        <a href="{{ route('home') }}#cabang" class="block py-2 text-sm text-gray-600 hover:text-[#1B3A6B]">Cabang</a>
        @auth('customer')
            <a href="{{ route('customer.dashboard') }}" class="block py-2 text-sm font-semibold text-[#1B3A6B]">Dashboard</a>
        @elseauth('web')
            @php
                $dashboardRoute = match(auth()->user()->role) {
                    'admin', 'manager' => 'admin.dashboard',
                    'cashier'           => 'cashier.dashboard',
                    'courier'           => 'courier.dashboard',
                    default             => 'home'
                };
            @endphp
            <a href="{{ route($dashboardRoute) }}" class="block py-2 text-sm font-semibold text-[#1B3A6B]">Dashboard</a>
        @else
            <a href="{{ route('customer.login') }}" class="block py-2 text-sm font-semibold text-[#1B3A6B]">Masuk</a>
        @endauth
    </div>
</nav>

<main class="flex-1">
    @yield('content')
</main>

{{-- Footer --}}
<footer class="bg-[#0A1A3A] text-blue-200 py-14">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid md:grid-cols-4 gap-10 mb-10">
            <div class="md:col-span-2">
                <img src="/images/branding/logo_white.png" alt="KirimAja" class="h-10 mb-4 opacity-90">
                <p class="text-sm text-blue-300 leading-relaxed max-w-xs">
                    Layanan ekspedisi pengiriman paket ke seluruh Indonesia. Cepat, aman, dan terpercaya.
                </p>
                <div class="flex gap-3 mt-4">
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-[#F47B20] flex items-center justify-center transition-colors">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-[#F47B20] flex items-center justify-center transition-colors">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                    <a href="#" class="w-8 h-8 rounded-lg bg-white/10 hover:bg-[#F47B20] flex items-center justify-center transition-colors">
                        <i data-lucide="twitter" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Layanan</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('home') }}#cek-ongkir" class="hover:text-white transition-colors">Cek Ongkir</a></li>
                    <li><a href="{{ route('home') }}#tracking" class="hover:text-white transition-colors">Lacak Paket</a></li>
                    <li><a href="{{ route('home') }}#cabang" class="hover:text-white transition-colors">Cari Cabang</a></li>
                    <li><a href="{{ route('home') }}#layanan" class="hover:text-white transition-colors">Layanan Kami</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold text-sm mb-4">Hubungi Kami</h4>
                <ul class="space-y-2.5 text-sm">
                    <li class="flex items-center gap-2"><i data-lucide="phone" class="w-4 h-4 text-[#F47B20] shrink-0"></i> 021-555-1234</li>
                    <li class="flex items-center gap-2">
                        <i data-lucide="mail" class="w-4 h-4 text-[#F47B20] shrink-0"></i> 
                        <a href="mailto:info{{ '@' }}{{ config('app.domain', 'kirimaja.id') }}" class="hover:text-white transition-colors">
                            info{{ '@' }}{{ config('app.domain', 'kirimaja.id') }}
                        </a>
                    </li>
                    <li class="flex items-start gap-2"><i data-lucide="map-pin" class="w-4 h-4 text-[#F47B20] shrink-0 mt-0.5"></i> Jl. Sudirman No. 45, Jakarta Pusat</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-white/10 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-blue-400">© {{ date('Y') }} KirimAja. Semua hak cipta dilindungi.</p>
            <div class="flex gap-4 text-xs text-blue-400">
                <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </div>
</footer>

<script>
    const menu = document.getElementById('mobileMenu');
    const menuBtn = document.getElementById('mobileMenuBtn');

    const toggleMenu = (show) => {
        if (show === undefined) {
            menu.classList.toggle('opacity-0');
            menu.classList.toggle('invisible');
            menu.classList.toggle('-translate-y-2');
            menu.classList.toggle('pointer-events-none');
        } else if (show) {
            menu.classList.remove('opacity-0', 'invisible', '-translate-y-2', 'pointer-events-none');
        } else {
            menu.classList.add('opacity-0', 'invisible', '-translate-y-2', 'pointer-events-none');
        }
    };

    menuBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        toggleMenu();
    });

    document.addEventListener('click', (e) => {
        if (!menu.classList.contains('invisible') && !menu.contains(e.target) && !menuBtn.contains(e.target)) {
            toggleMenu(false);
        }
    });

    document.getElementById('logoLink')?.addEventListener('click', (e) => {
        if (window.location.pathname === '/' || window.location.pathname === '') {
            e.preventDefault();
            window.scrollTo({ top: 0, behavior: 'smooth' });
            if (!menu.classList.contains('invisible')) toggleMenu(false);
        }
    });

    document.querySelectorAll('#mobileMenu a[href^="{{ route("home") }}#"]').forEach(link => {
        link.addEventListener('click', () => toggleMenu(false));
    });

    const refreshIcons = () => {
        if (window.lucide) {
            window.lucide.createIcons({ icons: window.lucide.icons });
        }
    };

    document.querySelectorAll('.tracking-form').forEach(form => {
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const input = form.querySelector('input[name="tracking_number"], input[name="resi"]');
            const btn   = form.querySelector('button[type="submit"]');
            const resi  = input.value.trim();
            
            if (!resi) {
                window.Swal.fire({
                    icon: 'warning',
                    title: 'Nomor Resi Kosong',
                    text: 'Silakan masukkan nomor resi terlebih dahulu.'
                });
                return;
            }

            const originalBtnHtml = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>';
            refreshIcons();

            try {
                const response = await fetch('{{ route("track") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ tracking_number: resi })
                });

                const data = await response.json();

                if (response.ok && data.success) {
                    window.location.href = '{{ route("tracking") }}?resi=' + encodeURIComponent(resi);
                } else {
                    throw new Error(data.error || 'Nomor resi tidak ditemukan.');
                }
            } catch (err) {
                window.Swal.fire({
                    icon: 'error',
                    title: 'Tidak Ditemukan',
                    text: err.message
                });
                btn.disabled = false;
                btn.innerHTML = originalBtnHtml;
                refreshIcons();
            }
        });
    });
</script>

@stack('scripts')
</body>
</html>
