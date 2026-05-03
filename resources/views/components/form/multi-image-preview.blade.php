@props([
    'name',
    'label' => 'Unggah Foto',
    'max' => 5,
    'helperText' => null,
    'id' => null
])

@php
    $id = $id ?? $name;
@endphp

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    @if($label)
        <label class="block text-sm font-bold text-gray-700 ml-1">
            {{ $label }}
        </label>
    @endif

    <div class="p-4 bg-gray-50/50 rounded-2xl border border-gray-100">
        {{-- Grid of Previews --}}
        <div id="{{ $id }}-grid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3 mb-3 hidden">
        </div>

        {{-- Dropzone / Upload Area --}}
        <div id="{{ $id }}-dropzone" 
             onclick="document.getElementById('{{ $id }}-input').click()"
             class="relative group cursor-pointer border-2 border-dashed border-gray-200 hover:border-[#1B3A6B] hover:bg-white rounded-xl p-6 transition-all duration-300 flex flex-col items-center justify-center gap-2">
            
            <div class="w-11 h-11 flex items-center justify-center text-[#1B3A6B]">
                <i data-lucide="camera" class="w-5 h-5"></i>
            </div>
            
            <div class="text-center">
                <p id="{{ $id }}-dropzone-text" class="text-xs font-black text-gray-700 uppercase tracking-wide">Pilih Foto</p>
                <p class="text-[10px] text-gray-400 font-bold mt-0.5">Maksimal {{ $max }} file (Format: JPG, PNG)</p>
            </div>

            <input type="file" 
                   id="{{ $id }}-input" 
                   multiple 
                   accept="image/*" 
                   class="hidden"
                   onchange="handleMultiImageUpload(event, '{{ $id }}', {{ $max }})">
            
            <input type="file" name="{{ $name }}[]" id="{{ $id }}-final-input" multiple class="hidden">
        </div>

        @if($helperText)
            <p class="text-[10px] text-gray-400 mt-3 font-bold flex items-center gap-1.5 opacity-80 ml-1">
                <i data-lucide="info" class="w-3.5 h-3.5"></i> {{ $helperText }}
            </p>
        @endif
    </div>

    {{-- Carousel Modal --}}
    <div id="{{ $id }}-modal" 
         class="fixed inset-0 z-[200] flex items-center justify-center p-4 bg-black/80 backdrop-blur-md hidden opacity-0 transition-all duration-300 pointer-events-none" 
         onclick="closeMultiPreview('{{ $id }}')">
        
        <button type="button" id="{{ $id }}-prev-btn" onclick="event.stopPropagation(); navigateMultiPreview('{{ $id }}', -1)" 
                class="absolute left-4 md:left-8 p-2 text-white/50 hover:text-white transition-all z-20 hidden">
            <i data-lucide="chevron-left" class="w-8 h-8"></i>
        </button>
        
        <button type="button" id="{{ $id }}-next-btn" onclick="event.stopPropagation(); navigateMultiPreview('{{ $id }}', 1)" 
                class="absolute right-4 md:right-8 p-2 text-white/50 hover:text-white transition-all z-20 hidden">
            <i data-lucide="chevron-right" class="w-8 h-8"></i>
        </button>

        <div class="relative max-w-4xl w-full flex flex-col items-center gap-4 transform scale-95 transition-all duration-300 pointer-events-auto" onclick="event.stopPropagation()">
            <button type="button" onclick="closeMultiPreview('{{ $id }}')" class="absolute -top-12 right-0 p-2 text-white/50 hover:text-white transition-all">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
            <img id="{{ $id }}-modal-img" src="" alt="Full Preview" class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl border-2 border-white/20 object-contain">
            
            <div class="flex items-center gap-4 px-6 py-2.5 bg-white/10 backdrop-blur-md rounded-full border border-white/10 shadow-xl">
                <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Detail Bukti Foto</p>
                <div class="h-4 w-px bg-white/20"></div>
                <p id="{{ $id }}-modal-counter" class="text-white text-[10px] font-black italic">1 / 5</p>
            </div>
        </div>
    </div>
</div>

@once
    @push('scripts')
    <script>
        const multiImageStores = {};

        const svgEye = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"/><circle cx="12" cy="12" r="3"/></svg>';
        const svgTrash = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>';
        const svgDots = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="1"/><circle cx="19" cy="12" r="1"/><circle cx="5" cy="12" r="1"/></svg>';

        function handleMultiImageUpload(event, id, max) {
            const files = Array.from(event.target.files);
            if (!multiImageStores[id]) multiImageStores[id] = [];
            
            files.forEach(file => {
                if (multiImageStores[id].length < max) {
                    multiImageStores[id].push({
                        file: file,
                        url: URL.createObjectURL(file)
                    });
                }
            });
            
            event.target.value = '';
            updateMultiImageUI(id, max);
            syncMultiImageInput(id);
        }

        function updateMultiImageUI(id, max) {
            const grid = document.getElementById(id + '-grid');
            const dropzone = document.getElementById(id + '-dropzone');
            const dropzoneText = document.getElementById(id + '-dropzone-text');
            const store = multiImageStores[id] || [];
            
            grid.innerHTML = '';
            
            if (store.length > 0) {
                grid.classList.remove('hidden');
                dropzoneText.innerText = 'Tambah Foto';
                
                store.forEach((item, index) => {
                    const container = document.createElement('div');
                    container.className = 'relative z-10';
                    
                    const imgWrap = document.createElement('div');
                    imgWrap.className = 'aspect-square rounded-xl overflow-hidden shadow-sm border border-gray-100 cursor-pointer active:scale-95 transition-all relative group';
                    imgWrap.onclick = (e) => { e.stopPropagation(); toggleMultiImageMenu(id, index); };
                    
                    const img = document.createElement('img');
                    img.src = item.url;
                    img.className = 'w-full h-full object-cover';
                    imgWrap.appendChild(img);
                    
                    const overlay = document.createElement('div');
                    overlay.className = 'absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all bg-black/20';
                    overlay.innerHTML = svgDots;
                    overlay.querySelector('svg').classList.add('text-white');
                    imgWrap.appendChild(overlay);
                    
                    container.appendChild(imgWrap);
                    
                    const menu = document.createElement('div');
                    menu.id = `${id}-menu-${index}`;
                    menu.className = 'x-multi-image-dropdown absolute left-0 w-40 bg-white rounded-xl shadow-2xl border border-gray-100 p-1.5 hidden z-[100]';
                    menu.style.top = 'calc(100% + 8px)';
                    menu.onclick = (e) => e.stopPropagation();
                    
                    const viewBtn = document.createElement('button');
                    viewBtn.type = 'button';
                    viewBtn.className = 'flex items-center gap-2.5 w-full px-3 py-2.5 rounded-lg text-xs font-bold text-gray-700 hover:bg-gray-50 transition-all text-left';
                    viewBtn.innerHTML = `<span class="text-gray-400">${svgEye}</span> Lihat Foto`;
                    viewBtn.onclick = (e) => { e.stopPropagation(); openMultiPreview(id, index); hideMultiImageMenu(id, index); };
                    menu.appendChild(viewBtn);
                    
                    const divider = document.createElement('div');
                    divider.className = 'h-px bg-gray-50 mx-1 my-0.5';
                    menu.appendChild(divider);
                    
                    const delBtn = document.createElement('button');
                    delBtn.type = 'button';
                    delBtn.className = 'flex items-center gap-2.5 w-full px-3 py-2.5 rounded-lg text-xs font-bold text-red-500 hover:bg-red-50 transition-all text-left';
                    delBtn.innerHTML = `<span class="text-red-300">${svgTrash}</span> Hapus Foto`;
                    delBtn.onclick = (e) => { e.stopPropagation(); removeMultiImage(id, index, max); };
                    menu.appendChild(delBtn);
                    
                    container.appendChild(menu);
                    grid.appendChild(container);
                });
            } else {
                grid.classList.add('hidden');
                dropzoneText.innerText = 'Pilih Foto';
            }
            
            if (store.length >= max) dropzone.classList.add('hidden');
            else dropzone.classList.remove('hidden');
        }

        function toggleMultiImageMenu(id, index) {
            const menu = document.getElementById(`${id}-menu-${index}`);
            if (!menu) return;
            const isHidden = menu.classList.contains('hidden');
            document.querySelectorAll('.x-multi-image-dropdown').forEach(m => m.classList.add('hidden'));
            if (isHidden) menu.classList.remove('hidden');
        }

        function hideMultiImageMenu(id, index) {
            const menu = document.getElementById(`${id}-menu-${index}`);
            if (menu) menu.classList.add('hidden');
        }

        function removeMultiImage(id, index, max) {
            const store = multiImageStores[id];
            if (store && store[index]) {
                URL.revokeObjectURL(store[index].url);
                store.splice(index, 1);
            }
            updateMultiImageUI(id, max);
            syncMultiImageInput(id);
        }

        function syncMultiImageInput(id) {
            const finalInput = document.getElementById(id + '-final-input');
            const dataTransfer = new DataTransfer();
            (multiImageStores[id] || []).forEach(item => dataTransfer.items.add(item.file));
            finalInput.files = dataTransfer.files;
        }

        let currentModalId = '';
        let currentModalIndex = 0;

        function openMultiPreview(id, index) {
            currentModalId = id;
            currentModalIndex = index;
            
            const modal = document.getElementById(id + '-modal');
            const prevBtn = document.getElementById(id + '-prev-btn');
            const nextBtn = document.getElementById(id + '-next-btn');
            const store = multiImageStores[id] || [];
            
            if (store.length > 1) {
                prevBtn?.classList.remove('hidden');
                nextBtn?.classList.remove('hidden');
            } else {
                prevBtn?.classList.add('hidden');
                nextBtn?.classList.add('hidden');
            }
            
            updateModalContent();
            
            modal.classList.remove('hidden', 'pointer-events-none', 'opacity-0');
            modal.querySelector('.transform').classList.remove('scale-95');
            document.body.classList.add('overflow-hidden');
        }

        function updateModalContent() {
            const store = multiImageStores[currentModalId];
            if (!store || !store[currentModalIndex]) return;
            document.getElementById(currentModalId + '-modal-img').src = store[currentModalIndex].url;
            document.getElementById(currentModalId + '-modal-counter').innerText = `${currentModalIndex + 1} / ${store.length}`;
        }

        function navigateMultiPreview(id, direction) {
            const store = multiImageStores[id];
            if (!store || store.length <= 1) return;
            currentModalIndex = (currentModalIndex + direction + store.length) % store.length;
            updateModalContent();
        }

        function closeMultiPreview(id) {
            const modal = document.getElementById(id + '-modal');
            if (modal) {
                modal.classList.add('opacity-0');
                modal.querySelector('.transform').classList.add('scale-95');
                document.body.classList.remove('overflow-hidden');
                setTimeout(() => modal.classList.add('hidden', 'pointer-events-none'), 300);
            }
        }

        window.addEventListener('click', () => {
            document.querySelectorAll('.x-multi-image-dropdown').forEach(m => m.classList.add('hidden'));
        });

        window.addEventListener('keydown', (e) => {
            const openModal = document.querySelector('[id$="-modal"]:not(.hidden)');
            if (!openModal) return;
            const id = openModal.id.replace('-modal', '');
            if (e.key === 'ArrowRight') navigateMultiPreview(id, 1);
            if (e.key === 'ArrowLeft') navigateMultiPreview(id, -1);
            if (e.key === 'Escape') closeMultiPreview(id);
        });
    </script>
    @endpush
@endonce
