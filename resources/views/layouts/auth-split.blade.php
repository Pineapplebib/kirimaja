<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KirimAja Staff')</title>
    <link rel="icon" href="/images/branding/icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white">

@if(session('success')) <input type="hidden" id="flash-success-message" value="{{ session('success') }}"> @endif
@if(session('error'))   <input type="hidden" id="flash-error-message" value="{{ session('error') }}"> @endif
@if(session('info'))    <input type="hidden" id="flash-info-message" value="{{ session('info') }}"> @endif
@if($errors->any())
    <input type="hidden" id="flash-validation-message" value="{{ $errors->first() }}">
@endif

<div class="flex min-h-screen">
    <!-- Left Section: Image/Visual -->
    <div class="hidden lg:flex lg:w-1/2 relative overflow-hidden bg-[#0F2347]">
        <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#0F2347] via-transparent to-[#0F2347]/30"></div>
        <img src="/images/auth/staff-auth.webp" 
             alt="Portal Staf" 
             class="absolute inset-0 object-cover w-full h-full opacity-60 scale-105 hover:scale-100 transition-transform duration-700">
        
        <div class="relative z-20 flex flex-col justify-between h-full p-16 text-white text-left">
            <div>
            <a href="{{ route('home') }}" class="inline-block hover:opacity-80 transition-opacity">
                <img src="/images/branding/logo_white.png" alt="KirimAja" class="h-12 drop-shadow-lg">
            </a>
            </div>
            
            <div class="text-xs text-blue-300/40">
                © {{ date('Y') }} Pusat Operasional Teknologi KirimAja
            </div>
        </div>
    </div>

    <!-- Right Section: Form -->
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 sm:px-12 lg:px-24 py-12 bg-gray-50/50">
        <div class="lg:hidden mb-8">
            <a href="{{ route('home') }}" class="inline-block hover:opacity-80 transition-opacity">
                <img src="/images/branding/logo.png" alt="KirimAja" class="h-10">
            </a>
        </div>
        
        <div class="w-full max-w-md mx-auto">
            @yield('content')
        </div>
        
        <div class="lg:hidden text-center mt-8 pt-8 border-t border-gray-100">
             <p class="text-xs text-gray-400">
                © {{ date('Y') }} KirimAja - Portal Staf
            </p>
        </div>
    </div>
</div>

@stack('scripts')
</body>
</html>
