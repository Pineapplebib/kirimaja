@props([
    'name',
    'label' => null,
    'value' => null,
    'placeholder' => null,
    'shape' => 'square',
    'size' => 'md',
    'required' => false,
    'helperText' => null,
    'id' => null,
    'compact' => false,
    'readonly' => false
])

@php
    $id = $id ?? $name;
    $sizeClasses = [
        'sm' => 'w-16 h-16',
        'md' => 'w-20 h-20',
        'lg' => 'w-24 h-24',
        'xl' => 'w-32 h-32',
    ];
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
    $shapeClass = $shape === 'circle' ? 'rounded-full' : 'rounded-2xl';
    
    $hasImage = !empty($value);
@endphp

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if($label && !$compact)
        <label class="block text-sm font-bold text-gray-700">
            {{ $label }} @if($required) <span class="text-red-500">*</span> @endif
        </label>
    @endif

    <div class="flex items-center gap-4">
        <div class="relative">
            {{-- Preview Container --}}
            <div id="{{ $id }}-container" 
                 class="{{ $sizeClass }} {{ $shapeClass }} overflow-hidden bg-[#1B3A6B] flex items-center justify-center text-white text-2xl font-black shadow-xl shadow-blue-900/10 relative transition-transform {{ $readonly ? '' : 'active:scale-95 cursor-pointer group' }}"
                 @if(!$readonly) onclick="handleContainerClick(event, '{{ $id }}')" @endif>
                
                @if($value)
                    <img id="{{ $id }}-preview" src="{{ asset('storage/' . $value) }}" alt="Preview" class="w-full h-full object-cover">
                @else
                    <span id="{{ $id }}-placeholder">{{ $placeholder ?? '?' }}</span>
                    <img id="{{ $id }}-preview" src="" alt="Preview" class="w-full h-full object-cover hidden">
                @endif

                @if(!$readonly)
                    {{-- Action Overlay (Only as indicator) --}}
                    <div id="{{ $id }}-overlay" 
                         class="absolute inset-0 bg-black/40 backdrop-blur-[4px] flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 gap-1 rounded-inherit">
                        <i data-lucide="more-horizontal" class="w-6 h-6 text-white"></i>
                    </div>
                @endif
            </div>

            @if(!$readonly)
                {{-- Dropdown Menu --}}
                <div id="{{ $id }}-dropdown" 
                     class="x-image-preview-dropdown absolute left-0 mt-2 w-44 bg-white rounded-2xl shadow-2xl border border-gray-100 p-1.5 z-[100] hidden transform origin-top-left transition-all">
                    <div class="flex flex-col gap-0.5">
                        <button type="button" onclick="openPreview('{{ $id }}')" id="{{ $id }}-view-btn"
                                class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-bold text-gray-700 hover:bg-gray-50 rounded-xl transition-colors {{ !$value ? 'hidden' : '' }}">
                            <i data-lucide="eye" class="w-4 h-4 text-gray-400"></i>
                            Lihat Foto
                        </button>
                        <button type="button" onclick="document.getElementById('{{ $id }}-input').click(); closeDropdown('{{ $id }}')"
                                class="flex items-center gap-2.5 px-3 py-2.5 text-xs font-bold text-gray-700 hover:bg-gray-50 rounded-xl transition-colors">
                            <i data-lucide="refresh-cw" class="w-4 h-4 text-gray-400"></i>
                            Ubah Foto
                        </button>
                        @if(isset($removeSlot))
                            <div class="border-t border-gray-50 my-1 mx-2"></div>
                            <div onclick="closeDropdown('{{ $id }}')">
                                {{ $removeSlot }}
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Hidden Input --}}
                <input type="file" 
                       name="{{ $name }}" 
                       id="{{ $id }}-input" 
                       accept="image/*" 
                       class="hidden"
                       onchange="handleImagePreview(event, '{{ $id }}')">
            @endif
        </div>

        @if(!$compact && !$readonly)
            <div class="flex flex-col gap-2">
                <button type="button" 
                        onclick="document.getElementById('{{ $id }}-input').click()"
                        class="text-xs font-bold text-[#1B3A6B] hover:text-[#0F2347] flex items-center gap-1.5 px-3 py-1.5 bg-blue-50 rounded-lg transition-colors">
                    <i data-lucide="upload" class="w-3.5 h-3.5"></i>
                    Pilih Gambar
                </button>

                @if($helperText)
                    <p class="text-[10px] text-gray-400 font-medium leading-tight max-w-[150px]">
                        {{ $helperText }}
                    </p>
                @endif
            </div>
        @endif
    </div>

    @if(!$readonly)
        {{-- In-App Preview Modal --}}
        <div id="{{ $id }}-modal" 
             class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm hidden opacity-0 transition-all duration-300 pointer-events-none" 
             onclick="closePreview('{{ $id }}')">
            <div class="relative max-w-4xl w-full flex flex-col items-center gap-4 transform scale-95 transition-all duration-300" onclick="event.stopPropagation()">
                <button type="button" onclick="closePreview('{{ $id }}')" class="absolute -top-12 right-0 p-2 text-white hover:text-gray-300 transition-colors">
                    <i data-lucide="x" class="w-8 h-8"></i>
                </button>
                <img id="{{ $id }}-modal-img" src="" alt="Full Preview" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl border-4 border-white/10 object-contain bg-white/5">
                <div class="flex items-center gap-3 px-6 py-2.5 bg-white/10 backdrop-blur-md rounded-full border border-white/10 shadow-xl">
                    <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Preview Foto</p>
                </div>
            </div>
        </div>
    @endif

    @error($name)
        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
    @enderror
</div>

@once
    <style>
        .rounded-inherit { border-radius: inherit; }
    </style>
    @push('scripts')
    <script>
        const imageStates = {};

        function handleContainerClick(event, id) {
            const dropdown = document.getElementById(id + '-dropdown');
            const hasImage = imageStates[id] || {{ $hasImage ? 'true' : 'false' }};

            if (hasImage) {
                event.stopPropagation();
                const isOpen = !dropdown.classList.contains('hidden');
                closeAllDropdowns();
                if (!isOpen) {
                    dropdown.classList.remove('hidden');
                }
            } else {
                document.getElementById(id + '-input').click();
            }
        }

        function handleImagePreview(event, id) {
            const input = event.target;
            const preview = document.getElementById(id + '-preview');
            const placeholder = document.getElementById(id + '-placeholder');
            const viewBtn = document.getElementById(id + '-view-btn');

            if (input.files && input.files[0]) {
                const file = input.files[0];
                const url = URL.createObjectURL(file);
                
                if (preview) {
                    preview.src = url;
                    preview.classList.remove('hidden');
                }
                if (placeholder) {
                    placeholder.classList.add('hidden');
                }
                if (viewBtn) {
                    viewBtn.classList.remove('hidden');
                }
                imageStates[id] = true;
            }
        }

        function openPreview(id) {
            const modal = document.getElementById(id + '-modal');
            const modalImg = document.getElementById(id + '-modal-img');
            const previewImg = document.getElementById(id + '-preview');
            
            if (modal && modalImg && previewImg) {
                modalImg.src = previewImg.src;
                modal.classList.remove('hidden', 'pointer-events-none');
                
                document.body.classList.add('overflow-hidden');
                
                setTimeout(() => {
                    modal.classList.remove('opacity-0');
                    modal.querySelector('.transform').classList.remove('scale-95');
                }, 10);
                
                closeDropdown(id);
            }
        }

        function closePreview(id) {
            const modal = document.getElementById(id + '-modal');
            if (modal) {
                modal.classList.add('opacity-0');
                modal.querySelector('.transform').classList.add('scale-95');
                
                document.body.classList.remove('overflow-hidden');
                
                setTimeout(() => {
                    modal.classList.add('hidden', 'pointer-events-none');
                }, 300);
            }
        }

        function closeDropdown(id) {
            const dropdown = document.getElementById(id + '-dropdown');
            if (dropdown) dropdown.classList.add('hidden');
        }

        function closeAllDropdowns() {
            document.querySelectorAll('.x-image-preview-dropdown').forEach(d => d.classList.add('hidden'));
        }

        window.addEventListener('click', (e) => {
            if (!e.target.closest('[id$="-container"]') && !e.target.closest('.x-image-preview-dropdown')) {
                closeAllDropdowns();
            }
        });

        window.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id$="-modal"]').forEach(m => {
                    const id = m.id.replace('-modal', '');
                    closePreview(id);
                });
            }
        });
    </script>
    @endpush
@endonce
