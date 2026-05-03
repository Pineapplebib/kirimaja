@props(['type' => 'info', 'label' => ''])

@php
    $types = [
        'success' => 'bg-green-100 text-green-700 border-green-200',
        'danger'  => 'bg-red-100 text-red-700 border-red-200',
        'warning' => 'bg-amber-100 text-amber-700 border-amber-200',
        'info'    => 'bg-blue-100 text-blue-700 border-blue-200',
        'gray'    => 'bg-gray-100 text-gray-700 border-gray-200',
        'purple'  => 'bg-purple-100 text-purple-700 border-purple-200',
        'orange'  => 'bg-orange-100 text-orange-700 border-orange-200',
    ];
    $class = $types[$type] ?? $types['info'];
@endphp

<span {{ $attributes->merge(['class' => "px-2.5 py-1 rounded-full text-xs font-semibold border $class"]) }}>
    {{ $label ?: $slot }}
</span>
