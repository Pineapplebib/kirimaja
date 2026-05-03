<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'KirimAja')</title>
    <link rel="icon" href="/images/branding/icon.png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#0F2347] via-[#1B3A6B] to-[#1E4D91] flex items-center justify-center p-4">

@if(session('success')) <input type="hidden" id="flash-success-message" value="{{ session('success') }}"> @endif
@if(session('error'))   <input type="hidden" id="flash-error-message" value="{{ session('error') }}"> @endif
@if(session('info'))    <input type="hidden" id="flash-info-message" value="{{ session('info') }}"> @endif
@if($errors->any())
    <input type="hidden" id="flash-validation-message" value="{{ $errors->first() }}">
@endif


<div class="w-full @yield('max-width', 'max-w-md') transition-all duration-500">
    <div class="text-center mb-8">
        <a href="{{ route('home') }}">
            <img src="/images/branding/logo_white.png" alt="KirimAja" class="h-14 mx-auto drop-shadow-lg">
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-2xl overflow-hidden">
        @yield('content')
    </div>

    <p class="text-center mt-6 text-xs text-blue-200">
        © {{ date('Y') }} KirimAja - Layanan Ekspedisi Terpercaya
    </p>
</div>

@stack('scripts')
</body>
</html>
