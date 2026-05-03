<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'KirimAja') - Panel</title>
    <link rel="icon" href="/images/branding/icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-gray-50 font-sans">

<div class="flex h-full">
    {{-- Sidebar --}}
    @if(!auth('customer')->check())
    <aside id="sidebar" class="fixed inset-y-0 left-0 z-[60] w-64 bg-[#0F2347] text-white flex flex-col transition-transform -translate-x-full md:translate-x-0" aria-label="Sidebar">
        {{-- Logo --}}
        <div class="px-5 py-8 border-b border-white/10">
            <a href="{{ route('home') }}" class="block hover:opacity-80 transition-opacity">
                <img src="/images/branding/logo_white.png" alt="KirimAja" class="h-9 w-auto max-w-full object-contain">
            </a>
            <p class="text-xs text-blue-300 font-bold opacity-60 mt-2">{{ auth()->user()->role ?? 'Customer' }} panel</p>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-7">
            @php $role = auth()->user()->role; @endphp

            {{-- Group: Utama --}}
            <div class="flex flex-col gap-1">
                <p class="px-3 py-1 text-xs font-black text-blue-200/60 uppercase tracking-widest mb-2">Utama</p>
                @if(in_array($role, ['admin','manager']))
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @elseif($role === 'cashier')
                    <a href="{{ route('cashier.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('cashier.dashboard') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @elseif($role === 'courier')
                    <a href="{{ route('courier.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('courier.dashboard') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
                    </a>
                @endif
            </div>

            {{-- Group: Manajemen --}}
            @if(in_array($role, ['admin','manager']))
                <div class="flex flex-col gap-1">
                    <p class="px-3 py-1 text-xs font-black text-blue-200/60 uppercase tracking-widest mb-2">Manajemen</p>
                    @if($role === 'admin')
                        <a href="{{ route('admin.branches.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.branches*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="building-2" class="w-4 h-4"></i> Cabang
                        </a>
                        <a href="{{ route('admin.rates.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.rates*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="tag" class="w-4 h-4"></i> Tarif
                        </a>
                    @endif
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.users*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="users" class="w-4 h-4"></i> Pengguna
                    </a>
                    <a href="{{ route('admin.vehicles.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.vehicles*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="truck" class="w-4 h-4"></i> Kendaraan
                    </a>
                </div>
            @endif

            {{-- Group: Operasional --}}
            @if(in_array($role, ['admin','manager','cashier']))
                <div class="flex flex-col gap-1">
                    <p class="px-3 py-1 text-xs font-black text-blue-200/60 uppercase tracking-widest mb-2">Operasional</p>
                    @if(in_array($role, ['admin','manager']))
                        <a href="{{ route('admin.shipments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.shipments*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="package" class="w-4 h-4"></i> Pengiriman
                        </a>
                    @else
                        <a href="{{ route('cashier.shipments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('cashier.shipments*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="package" class="w-4 h-4"></i> Pengiriman
                        </a>
                    @endif
                    
                    @if(in_array($role, ['admin','manager']))
                        <a href="{{ route('admin.payments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.payments*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="credit-card" class="w-4 h-4"></i> Pembayaran
                        </a>
                    @elseif($role === 'cashier')
                        <a href="{{ route('cashier.payments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('cashier.payments*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="credit-card" class="w-4 h-4"></i> Pembayaran
                        </a>
                    @endif

                    @if(in_array($role, ['admin','manager']))
                        <a href="{{ route('admin.reports.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('admin.reports*') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                            <i data-lucide="file-text" class="w-4 h-4"></i> Laporan
                        </a>
                    @endif
                </div>
            @endif

            {{-- Group: Kurir --}}
            @if($role === 'courier')
                <div class="flex flex-col gap-1">
                    <p class="px-3 py-1 text-xs font-black text-blue-200/60 uppercase tracking-widest mb-2">Kurir</p>
                    <a href="{{ route('courier.shipments.index') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-all {{ request()->routeIs('courier.shipments.index') ? 'bg-white/10 text-white premium-shadow ring-1 ring-white/10' : 'text-blue-100 hover:bg-white/5 hover:text-white' }}">
                        <i data-lucide="truck" class="w-4 h-4"></i> Pengiriman Saya
                    </a>
                </div>
            @endif
        </nav>
    </aside>
    @endif

    {{-- Main --}}
    <div class="flex-1 flex flex-col {{ auth('customer')->check() ? '' : 'md:ml-64' }} min-h-full transition-all duration-300">
        {{-- Topbar --}}
        <header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200 px-4 md:px-6 py-3 premium-shadow">
            <div class="{{ auth('customer')->check() ? 'max-w-7xl mx-auto w-full' : '' }} flex items-center justify-between">
                <div class="flex items-center gap-3">
                    @if(!auth('customer')->check())
                        <button id="sidebarToggle" class="md:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition-colors">
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </button>
                    @else
                        <a href="{{ route('home') }}" class="flex items-center gap-2 mr-4">
                            <img src="/images/branding/logo.png" alt="KirimAja" class="h-7 w-auto">
                        </a>
                    @endif
                    <div class="flex flex-col">
                        <h1 class="text-lg font-bold text-gray-800 leading-tight">@yield('page-title', 'Dashboard')</h1>
                    </div>
                </div>
            <div class="flex items-center gap-4">
                <div class="h-6 w-px bg-gray-200 mx-1 hidden sm:block"></div>

                {{-- Profile Dropdown --}}
                <div class="relative">
                    <button type="button" class="flex items-center gap-3 px-3 py-2 rounded-xl hover:bg-gray-50 transition-all focus:ring-4 focus:ring-blue-50" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom-end">
                        <span class="sr-only">Open user menu</span>
                        <div class="w-9 h-9 rounded-xl overflow-hidden bg-brand flex items-center justify-center text-white font-bold text-sm premium-shadow ring-2 ring-white/20">
                            @if(auth()->user()->photo)
                                <img src="{{ asset('storage/'.auth()->user()->photo) }}" alt="Profile" class="w-full h-full object-cover">
                            @else
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            @endif
                        </div>
                        <div class="hidden md:block text-left">
                            <p class="text-sm font-bold text-heading leading-tight">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-body font-medium">{{ auth()->user()->email }}</p>
                        </div>
                        <i data-lucide="chevron-down" class="w-4 h-4 ms-1 text-gray-400 shrink-0"></i>
                    </button>
                    <!-- Dropdown menu -->
                    <div class="z-50 hidden my-1 list-none bg-white divide-y divide-gray-50 rounded-2xl shadow-2xl shadow-blue-900/10 border border-gray-100 min-w-[260px] overflow-hidden" id="user-dropdown">
                        <div class="px-5 py-4 bg-gray-50/50">
                            <span class="block text-md font-black text-gray-800">{{ auth()->user()->name }}</span>
                            <span class="block text-sm text-gray-400 truncate mt-0.5">{{ auth()->user()->email }}</span>
                        </div>

                        <ul class="p-2 space-y-1" aria-labelledby="user-menu-button">
                            <li>
                                <a href="{{ route('profile.index') }}" class="flex items-center gap-3 px-3 py-2.5 text-sm text-gray-600 font-bold hover:bg-blue-50 hover:text-[#1B3A6B] rounded-xl transition-all group">
                                    <i data-lucide="user" class="w-4 h-4 opacity-40 group-hover:opacity-100 transition-opacity"></i> Profil Saya
                                </a>
                            </li>
                        </ul>
                        <div class="p-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 text-sm font-bold text-red-500 hover:bg-red-50 rounded-xl transition-all group">
                                    <i data-lucide="log-out" class="w-4 h-4 opacity-60 group-hover:opacity-100 transition-opacity"></i> Keluar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

        @if(session('success')) <input type="hidden" id="flash-success-message" value="{{ session('success') }}"> @endif
        @if(session('error')) <input type="hidden" id="flash-error-message" value="{{ session('error') }}"> @endif
        @if(session('info')) <input type="hidden" id="flash-info-message" value="{{ session('info') }}"> @endif
        @if($errors->any())
            <input type="hidden" id="flash-validation-message" value="{{ $errors->first() }}">
        @endif

        <main class="flex-1 p-4 md:p-6 {{ auth('customer')->check() ? 'max-w-7xl mx-auto w-full' : '' }}">
            @yield('content')
        </main>

        <footer class="px-6 py-4 border-t border-gray-100 text-center text-xs text-gray-400 {{ auth('customer')->check() ? 'max-w-7xl mx-auto w-full' : '' }}">
            © {{ date('Y') }} KirimAja - Sistem Manajemen Ekspedisi
        </footer>
    </div>
</div>

{{-- Sidebar overlay (mobile) --}}
<div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-[55] hidden md:hidden"></div>

<script>
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggle  = document.getElementById('sidebarToggle');
    toggle?.addEventListener('click', () => {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
    });
    overlay?.addEventListener('click', () => {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    });
</script>

@stack('scripts')
</body>
</html>
