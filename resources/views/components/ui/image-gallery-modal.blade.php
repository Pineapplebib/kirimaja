{{-- Image Gallery Modal Component --}}
<div id="image-gallery-modal" 
     class="fixed inset-0 z-[300] flex items-center justify-center p-4 bg-black/80 backdrop-blur-md hidden opacity-0 transition-all duration-300 pointer-events-none" 
     onclick="closeImageGallery()">
    
    {{-- Navigation Buttons --}}
    <button type="button" id="gallery-prev-btn" onclick="event.stopPropagation(); navigateGallery(-1)" 
            class="absolute left-4 md:left-8 p-2 text-white/50 hover:text-white transition-all z-[310] hidden">
        <i data-lucide="chevron-left" class="w-8 h-8"></i>
    </button>
    
    <button type="button" id="gallery-next-btn" onclick="event.stopPropagation(); navigateGallery(1)" 
            class="absolute right-4 md:right-8 p-2 text-white/50 hover:text-white transition-all z-[310] hidden">
        <i data-lucide="chevron-right" class="w-8 h-8"></i>
    </button>

    {{-- Content --}}
    <div class="relative max-w-4xl w-full flex flex-col items-center gap-4 transform scale-95 transition-all duration-300 pointer-events-auto" onclick="event.stopPropagation()">
        {{-- Close Button --}}
        <button type="button" onclick="closeImageGallery()" 
                class="absolute -top-12 right-0 p-2 text-white/50 hover:text-white transition-all">
            <i data-lucide="x" class="w-6 h-6"></i>
        </button>

        {{-- Main Image --}}
        <div class="relative group w-full flex justify-center">
            <img id="gallery-img" src="" alt="Gallery Image" 
                 class="max-w-full max-h-[80vh] rounded-2xl shadow-2xl border-2 border-white/20 object-contain shadow-black/40">
        </div>
        
        {{-- Counter & Info --}}
        <div class="flex items-center gap-4 px-6 py-2.5 bg-white/10 backdrop-blur-md rounded-full border border-white/10 shadow-xl">
            <p class="text-white text-[10px] font-black uppercase tracking-[0.2em]">Detail Bukti Foto</p>
            <div class="h-4 w-px bg-white/20"></div>
            <p id="gallery-counter" class="text-white text-[10px] font-black italic">1 / 1</p>
        </div>
    </div>
</div>

@once
@push('scripts')
<script>
    let galleryImages = [];
    let galleryCurrentIndex = 0;

    function openImageGallery(images, startIndex = 0) {
        galleryImages = images;
        galleryCurrentIndex = startIndex;
        
        const modal = document.getElementById('image-gallery-modal');
        const prevBtn = document.getElementById('gallery-prev-btn');
        const nextBtn = document.getElementById('gallery-next-btn');

        if (galleryImages.length > 1) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
        } else {
            prevBtn.classList.add('hidden');
            nextBtn.classList.add('hidden');
        }

        updateGalleryContent();

        modal.classList.remove('hidden', 'pointer-events-none');
        setTimeout(() => {
            modal.classList.add('opacity-100');
            modal.querySelector('.transform').classList.remove('scale-95');
        }, 10);
        
        document.body.classList.add('overflow-hidden');
    }

    function updateGalleryContent() {
        const img = document.getElementById('gallery-img');
        const counter = document.getElementById('gallery-counter');
        
        if (galleryImages[galleryCurrentIndex]) {
            img.style.opacity = '0';
            setTimeout(() => {
                img.src = '/storage/' + galleryImages[galleryCurrentIndex];
                img.onload = () => { img.style.opacity = '1'; };
            }, 150);
            
            counter.innerText = `${galleryCurrentIndex + 1} / ${galleryImages.length}`;
        }
    }

    function navigateGallery(direction) {
        if (galleryImages.length <= 1) return;
        galleryCurrentIndex = (galleryCurrentIndex + direction + galleryImages.length) % galleryImages.length;
        updateGalleryContent();
    }

    function closeImageGallery() {
        const modal = document.getElementById('image-gallery-modal');
        if (modal) {
            modal.classList.remove('opacity-100');
            modal.querySelector('.transform').classList.add('scale-95');
            document.body.classList.remove('overflow-hidden');
            setTimeout(() => {
                modal.classList.add('hidden', 'pointer-events-none');
            }, 300);
        }
    }

    window.addEventListener('keydown', (e) => {
        const modal = document.getElementById('image-gallery-modal');
        if (modal && !modal.classList.contains('hidden')) {
            if (e.key === 'ArrowRight') navigateGallery(1);
            if (e.key === 'ArrowLeft') navigateGallery(-1);
            if (e.key === 'Escape') closeImageGallery();
        }
    });
</script>
@endpush
@endonce
