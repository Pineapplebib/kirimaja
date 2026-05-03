@props(['label', 'name', 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false, 'icon' => null])

<div {{ $attributes->except(['label', 'name', 'type', 'value', 'placeholder', 'required', 'icon', 'datepicker', 'datepicker-autohide', 'datepicker-format', 'datepicker-orientation', 'datepicker-buttons', 'datepicker-autoselect-today'])->merge(['class' => 'space-y-1.5']) }}>
    <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700">
        {{ $label }}
        @if($required) <span class="text-red-500">*</span> @endif
    </label>
    
    <div class="relative group">
        @if($icon)
            <i data-lucide="{{ $icon }}" class="absolute left-4 {{ $type === 'textarea' ? 'top-4' : 'top-1/2 -translate-y-1/2' }} w-4.5 h-4.5 text-gray-400 group-focus-within:text-[#1B3A6B] transition-colors"></i>
        @endif

        @if($type === 'textarea')
            <textarea name="{{ $name }}" id="{{ $name }}" @if($required) required @endif
                      {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-4 focus:ring-[#1B3A6B]/5 focus:border-[#1B3A6B] block w-full ' . ($icon ? 'pl-11' : 'pl-4') . ' pr-4 py-3.5 transition-all outline-none placeholder-gray-300 font-medium']) }}
                      placeholder="{{ $placeholder }}">{{ $value }}</textarea>
        @else
            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ $value }}" @if($required) required @endif
                   {{ $attributes->merge(['class' => 'bg-gray-50 border border-gray-200 text-gray-900 text-sm rounded-xl focus:ring-4 focus:ring-[#1B3A6B]/5 focus:border-[#1B3A6B] block w-full ' . ($icon ? 'pl-11' : 'pl-4') . ' ' . ($type === 'password' ? 'pr-11' : 'pr-4') . ' py-3.5 transition-all outline-none placeholder-gray-300 font-medium']) }}
                   placeholder="{{ $placeholder }}">
            
            @if($type === 'password')
                <button type="button" class="toggle-password absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition-colors" data-target="{{ $name }}">
                    <i data-lucide="eye" class="w-4.5 h-4.5"></i>
                </button>
            @endif
        @endif
    </div>

    @error($name)
        <p class="text-xs text-red-500 mt-1 font-medium">{{ $message }}</p>
    @enderror
</div>
