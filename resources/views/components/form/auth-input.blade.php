@props(['label', 'name', 'type' => 'text', 'icon', 'placeholder' => '', 'required' => false, 'theme' => 'blue'])

@php
    $themes = [
        'blue' => [
            'ring' => 'focus:ring-[#1B3A6B]/5 focus:border-[#1B3A6B]',
            'icon' => 'group-focus-within:text-[#1B3A6B]'
        ],
        'orange' => [
            'ring' => 'focus:ring-[#F47B20]/5 focus:border-[#F47B20]',
            'icon' => 'group-focus-within:text-[#F47B20]'
        ],
    ];
    $activeTheme = $themes[$theme] ?? $themes['blue'];
@endphp

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    <label class="block text-sm font-semibold text-gray-700">{{ $label }}</label>
    <div class="relative group">
        <i data-lucide="{{ $icon }}" class="absolute left-4 {{ $type === 'textarea' ? 'top-4' : 'top-1/2 -translate-y-1/2' }} w-5 h-5 text-gray-400 {{ $activeTheme['icon'] }} transition-colors"></i>
        @if($type === 'textarea')
            <textarea name="{{ $name }}" @if($required) required @endif
                      {{ $attributes->whereDoesntStartWith('class')->merge(['class' => 'w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 transition-all focus:outline-none focus:ring-4 ' . $activeTheme['ring'] . ' placeholder-gray-300']) }}
                      placeholder="{{ $placeholder }}">{{ old($name) }}</textarea>
        @else
            <input type="{{ $type }}" name="{{ $name }}" value="{{ old($name) }}" @if($required) required @endif
                   {{ $attributes->whereDoesntStartWith('class')->merge(['class' => 'w-full pl-12 pr-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm text-gray-900 transition-all focus:outline-none focus:ring-4 ' . $activeTheme['ring'] . ' placeholder-gray-300']) }}
                   placeholder="{{ $placeholder }}">
        @endif
    </div>
    @error($name)
        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
    @enderror
</div>
