@props(['title', 'buttonText' => null, 'buttonLink' => null, 'buttonIcon' => 'plus'])

<div {{ $attributes->merge(['class' => 'flex items-center justify-between mb-6 flex-wrap gap-4']) }}>
    <div>
        {{ $slot }}
    </div>
    
    <div class="flex items-center gap-3">
        @if(isset($actions))
            {{ $actions }}
        @endif

        @if($buttonText && $buttonLink)
            <a href="{{ $buttonLink }}" class="inline-flex items-center gap-2 bg-[#1B3A6B] hover:bg-[#0F2347] text-white text-sm font-semibold px-4 py-2.5 rounded-lg transition-colors">
                <i data-lucide="{{ $buttonIcon }}" class="w-4 h-4"></i> {{ $buttonText }}
            </a>
        @endif
    </div>
</div>
