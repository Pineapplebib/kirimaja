@props(['href', 'label' => 'Kembali'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center gap-2 text-sm text-gray-500 hover:text-[#1B3A6B] mb-6 transition-colors']) }}>
    <i data-lucide="arrow-left" class="w-4 h-4"></i> {{ $label }}
</a>
