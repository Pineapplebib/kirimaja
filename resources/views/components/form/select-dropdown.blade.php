@props([
    'name',
    'id' => null,
    'label' => 'Pilih...',
    'options' => [], 
    'selected' => null,
    'searchable' => false,
    'placeholder' => 'Cari...',
    'required' => false,
    'class' => '',
])

@php
    $finalId = $id ?? $name;
    $selectedLabel = $label;
    $selectedData = [];
    foreach($options as $opt) {
        if ((string)($opt['value'] ?? '') === (string)($selected ?? '')) {
            $selectedLabel = $opt['label'];
            $selectedData = $opt['data'] ?? [];
            break;
        }
    }
@endphp

<div class="relative w-full x-select-container" id="container_{{ $finalId }}" data-default-label="{{ $label }}">
    <!-- Hidden Input -->
    <input type="hidden" name="{{ $name }}" id="{{ $finalId }}" value="{{ $selected }}" 
           @foreach($selectedData as $key => $val) data-{{ $key }}="{{ $val }}" @endforeach
           @if($required) required @endif class="x-select-hidden">

    <!-- Button Trigger -->
    <button type="button" 
            id="{{ $finalId }}_btn"
            data-dropdown-toggle="{{ $finalId }}_dropdown"
            class="inline-flex items-center justify-between w-full px-4 py-2.5 text-sm font-medium leading-5 transition-all duration-200 border border-default-medium rounded-base shadow-xs focus:ring-4 focus:ring-brand-medium focus:outline-none min-h-[42px] {{ str_contains($class, 'bg-') ? $class : 'bg-white text-body hover:bg-neutral-tertiary-medium' }} {{ $class }}">
        <span class="truncate x-select-label">{{ $selectedLabel }}</span>
        <i data-lucide="chevron-down" class="w-4 h-4 ms-1.5 -me-0.5 text-gray-400 shrink-0"></i>
    </button>

    <!-- Dropdown Menu -->
    <div id="{{ $finalId }}_dropdown" class="z-[70] hidden bg-neutral-primary-medium border border-default-medium rounded-base shadow-lg w-full min-w-[200px] max-h-80 flex flex-col overflow-hidden">
        @if($searchable)
        <div class="p-2 border-b border-default-medium bg-neutral-tertiary-medium/50">
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i data-lucide="search" class="w-4 h-4 text-gray-400 shrink-0"></i>
                </div>
                <input type="text" 
                       class="bg-white border border-default-medium text-sm rounded-md focus:ring-brand focus:border-brand block w-full ps-9 p-2 x-select-search" 
                       placeholder="{{ $placeholder }}"
                       autocomplete="off">
            </div>
        </div>
        @endif
        <ul class="p-2 text-sm text-body font-medium overflow-y-auto x-select-list">
            @foreach($options as $opt)
            <li>
                <button type="button" 
                        class="x-select-item inline-flex items-center w-full p-2 hover:bg-neutral-tertiary-medium hover:text-heading rounded transition-colors text-left {{ (string)$selected === (string)$opt['value'] ? 'bg-neutral-tertiary-medium text-heading' : '' }}"
                        data-value="{{ $opt['value'] }}"
                        data-label="{{ $opt['label'] }}"
                        @foreach($opt['data'] ?? [] as $key => $val) data-{{ $key }}="{{ $val }}" @endforeach>
                    {{ $opt['label'] }}
                </button>
            </li>
            @endforeach
            <li class="x-select-no-results hidden p-8 text-center text-gray-400 italic text-xs">
                Data tidak ditemukan
            </li>
        </ul>
    </div>
</div>

@pushonce('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    document.addEventListener('click', (e) => {
        const item = e.target.closest('.x-select-item');
        if (!item) return;

        const container = item.closest('.x-select-container');
        const hiddenInput = container.querySelector('.x-select-hidden');
        const labelEl = container.querySelector('.x-select-label');
        const btn = container.querySelector('[data-dropdown-toggle]');
        const dropdownId = btn.getAttribute('data-dropdown-toggle');
        
        hiddenInput.value = item.dataset.value;
        labelEl.textContent = item.dataset.label;
        
        Object.keys(item.dataset).forEach(key => {
            if (['value', 'label'].includes(key)) return;
            hiddenInput.dataset[key] = item.dataset[key];
        });

        container.querySelectorAll('.x-select-item').forEach(i => {
            i.classList.remove('bg-neutral-tertiary-medium', 'text-heading', 'ring-2', 'ring-brand/50');
        });
        item.classList.add('bg-neutral-tertiary-medium', 'text-heading');

        hiddenInput.dispatchEvent(new Event('change', { bubbles: true }));
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));

        if (window.FlowbiteInstances) {
            const instance = window.FlowbiteInstances.getInstance('Dropdown', dropdownId);
            if (instance) instance.hide();
        } else {
            const dropdownEl = document.getElementById(dropdownId);
            if (dropdownEl) dropdownEl.classList.add('hidden');
        }
    });

    document.addEventListener('input', (e) => {
        if (!e.target.classList.contains('x-select-search')) return;
        
        const term = e.target.value.toLowerCase();
        const container = e.target.closest('.x-select-container');
        const items = container.querySelectorAll('.x-select-item');
        const noResults = container.querySelector('.x-select-no-results');
        let found = 0;

        items.forEach(item => {
            const text = (item.dataset.label || '').toLowerCase();
            if (text.includes(term)) {
                item.closest('li').classList.remove('hidden');
                found++;
            } else {
                item.closest('li').classList.add('hidden');
            }
        });

        if (noResults) noResults.classList.toggle('hidden', found > 0);

        const visibleItems = Array.from(items).filter(i => !i.closest('li').classList.contains('hidden'));
        items.forEach(i => i.classList.remove('bg-neutral-tertiary-medium', 'text-heading'));
        if (visibleItems.length > 0) {
            visibleItems[0].classList.add('bg-neutral-tertiary-medium', 'text-heading');
        }
    });

    document.addEventListener('keydown', (e) => {
        const container = e.target.closest('.x-select-container');
        if (!container) return;

        const dropdownId = container.querySelector('[data-dropdown-toggle]').getAttribute('data-dropdown-toggle');
        const dropdownEl = document.getElementById(dropdownId);
        if (dropdownEl.classList.contains('hidden')) return;

        const items = Array.from(container.querySelectorAll('.x-select-item'))
                          .filter(i => !i.closest('li').classList.contains('hidden'));
        
        if (items.length === 0) return;

        let currentIndex = items.findIndex(i => i.classList.contains('bg-neutral-tertiary-medium') && i.classList.contains('text-heading'));
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            const nextIndex = (currentIndex + 1) % items.length;
            updateHighlight(items, currentIndex, nextIndex);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            const nextIndex = (currentIndex - 1 + items.length) % items.length;
            updateHighlight(items, currentIndex, nextIndex);
        } else if (e.key === 'Enter') {
            if (currentIndex !== -1) {
                e.preventDefault();
                items[currentIndex].click();
            }
        }
    });

    function updateHighlight(items, oldIdx, newIdx) {
        if (oldIdx !== -1) items[oldIdx].classList.remove('bg-neutral-tertiary-medium', 'text-heading');
        items[newIdx].classList.add('bg-neutral-tertiary-medium', 'text-heading');
        items[newIdx].scrollIntoView({ block: 'nearest', behavior: 'smooth' });
    }

    document.addEventListener('click', (e) => {
        const btn = e.target.closest('[data-dropdown-toggle]');
        if (!btn) return;
        
        const container = btn.closest('.x-select-container');
        if (!container) return;

        const searchInput = container.querySelector('.x-select-search');
        if (searchInput) {
            setTimeout(() => {
                const dropdownId = btn.getAttribute('data-dropdown-toggle');
                const dropdownEl = document.getElementById(dropdownId);
                if (dropdownEl && !dropdownEl.classList.contains('hidden')) {
                    searchInput.focus();
                }
            }, 50);
        }
    });
});
</script>
@endpushonce
