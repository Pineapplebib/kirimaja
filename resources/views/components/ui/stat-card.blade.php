@props(['label', 'value', 'icon', 'color' => 'blue'])

@php
    $colors = [
        'blue' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-600'],
        'orange' => ['bg' => 'bg-orange-50', 'text' => 'text-orange-600'],
        'green' => ['bg' => 'bg-green-50', 'text' => 'text-green-600'],
        'purple' => ['bg' => 'bg-purple-50', 'text' => 'text-purple-600'],
        'red' => ['bg' => 'bg-red-50', 'text' => 'text-red-600'],
        'yellow' => ['bg' => 'bg-yellow-50', 'text' => 'text-yellow-600'],
    ];
    $c = $colors[$color] ?? $colors['blue'];
@endphp

<x-ui.card class="p-5">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 rounded-lg {{ $c['bg'] }} flex items-center justify-center">
            <i data-lucide="{{ $icon }}" class="w-6 h-6 {{ $c['text'] }}"></i>
        </div>
        <div>
            <p class="text-xs font-bold text-gray-500/70 uppercase tracking-widest mb-1">{{ $label }}</p>
            <p class="text-2xl font-bold text-gray-800">{{ $value }}</p>
        </div>
    </div>
</x-ui.card>
