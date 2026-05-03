@props(['id' => null, 'class' => '', 'overflow' => 'hidden'])

<div @if($id) id="{{ $id }}" @endif 
     {{ $attributes->merge(['class' => 'bg-white rounded-xl border border-gray-100 premium-shadow ' . ($overflow === 'hidden' ? 'overflow-hidden ' : '') . $class]) }}>
    {{ $slot }}
</div>
