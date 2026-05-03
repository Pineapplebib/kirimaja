import 'flowbite';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto';

window.Chart = Chart;

import { createIcons, icons } from 'lucide';
window.lucide = { createIcons, icons };

const KirimAjaSwal = Swal.mixin({
    width: '32rem',
    padding: '1.5rem',
    customClass: {
        confirmButton: 'inline-flex items-center justify-center px-6 py-2.5 rounded-xl text-[13px] font-bold bg-[#1B3A6B] text-white hover:bg-[#0F2347] transition-all focus:outline-none focus:ring-4 focus:ring-[#1B3A6B]/20 min-w-[100px]',
        cancelButton: 'inline-flex items-center justify-center px-6 py-2.5 rounded-xl text-[13px] font-bold bg-gray-100 text-gray-600 hover:bg-gray-200 transition-all focus:outline-none focus:ring-4 focus:ring-gray-100 min-w-[100px]',
        popup: '!rounded-[24px] border border-gray-100 shadow-2xl',
        title: '!text-heading !font-extrabold !text-lg !mt-2',
        htmlContainer: '!text-body !text-[13px] !leading-relaxed !m-0 !mt-2',
        actions: '!mt-8 !gap-3'
    },
    buttonsStyling: false,
});

window.Swal = KirimAjaSwal;

document.addEventListener('DOMContentLoaded', () => {
    createIcons({ icons });

    const flashSuccess = document.getElementById('flash-success-message');
    const flashError = document.getElementById('flash-error-message');
    const flashInfo = document.getElementById('flash-info-message');
    const flashValidation = document.getElementById('flash-validation-message');

    if (flashSuccess && flashSuccess.value) {
        KirimAjaSwal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: flashSuccess.value,
            iconColor: '#F47B20',
            timer: 3500,
            showConfirmButton: false,
        });
    }

    if (flashError && flashError.value || flashValidation && flashValidation.value) {
        KirimAjaSwal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: (flashError ? flashError.value : '') || (flashValidation ? flashValidation.value : ''),
            confirmButtonText: 'Perbaiki'
        });
    }

    if (flashInfo && flashInfo.value) {
        KirimAjaSwal.fire({
            icon: 'info',
            title: 'Informasi',
            text: flashInfo.value,
            confirmButtonText: 'Mengerti'
        });
    }

    document.addEventListener('submit', (e) => {
        const form = e.target.closest('form');
        if (!form || !form.hasAttribute('data-confirm')) return;
        if (form.dataset.confirmed) return;
        e.preventDefault();

        const message = form.getAttribute('data-confirm') || 'Apakah Anda yakin ingin melanjutkan?';
        const title = form.getAttribute('data-confirm-title') || 'Konfirmasi Tindakan';
        const confirmText = form.getAttribute('data-confirm-button') || 'Ya, Lanjutkan';

        KirimAjaSwal.fire({
            title: title,
            text: message,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: confirmText,
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.dataset.confirmed = "true";
                form.submit();
            }
        });
    });

    const initLiveFilters = () => {
        const filterForms = document.querySelectorAll('form[data-ajax-filter]');
        const tableContainer = document.getElementById('table-container');
        
        if (!filterForms.length || !tableContainer) return;

        const debounce = (func, wait) => {
            let timeout;
            return (...args) => {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), wait);
            };
        };

        const toggleClearButton = (form) => {
            const clearBtn = form.querySelector('[data-clear-filter]');
            if (!clearBtn) return;
            
            const formData = new FormData(form);
            let hasValue = false;
            for (let [key, value] of formData.entries()) {
                if (value && value.trim() !== '') {
                    hasValue = true;
                    break;
                }
            }
            
            if (hasValue) {
                clearBtn.classList.remove('hidden');
            } else {
                clearBtn.classList.add('hidden');
            }
        };

        const updateTable = async (form) => {
            tableContainer.classList.add('opacity-50', 'pointer-events-none');
            toggleClearButton(form);
            
            const formData = new FormData(form);
            const params = new URLSearchParams(formData);
            const url = `${form.action}?${params.toString()}`;

            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                
                if (!response.ok) throw new Error('Network response was not ok');
                
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.getElementById('table-container');

                if (newTable) {
                    tableContainer.innerHTML = newTable.innerHTML;
                    if (window.lucide) window.lucide.createIcons({ icons: window.lucide.icons });
                    window.history.pushState({}, '', url);
                }
            } catch (error) {
                console.error('AJAX Error:', error);
            } finally {
                tableContainer.classList.remove('opacity-50', 'pointer-events-none');
            }
        };

        const debouncedUpdate = debounce((form) => updateTable(form), 500);

        filterForms.forEach(form => {
            form.addEventListener('input', (e) => {
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'TEXTAREA') {
                    debouncedUpdate(form);
                } else if (e.target.tagName === 'SELECT' || e.target.classList.contains('x-select-hidden')) {
                    updateTable(form);
                }
            });

            form.addEventListener('submit', (e) => e.preventDefault());
        });

        tableContainer.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link || !link.href || link.closest('form')) return;

            const url = new URL(link.href);
            if (url.searchParams.has('page')) {
                e.preventDefault();
                fetchPage(link.href);
            }
        });

        document.addEventListener('click', (e) => {
            const clearBtn = e.target.closest('[data-clear-filter]');
            if (!clearBtn) return;
            e.preventDefault();

            const form = clearBtn.closest('form');
            if (form) {
                form.reset();
                
                form.querySelectorAll('select').forEach(select => {
                    select.value = '';
                    select.dispatchEvent(new Event('change', { bubbles: true }));
                });

                form.querySelectorAll('.x-select-container').forEach(container => {
                    const hiddenInput = container.querySelector('.x-select-hidden');
                    const labelEl = container.querySelector('.x-select-label');
                    const defaultLabel = container.dataset.defaultLabel || 'Pilih...';
                    
                    if (hiddenInput) {
                        hiddenInput.value = '';
                        container.querySelectorAll('.x-select-item').forEach(i => {
                            i.classList.remove('bg-neutral-tertiary-medium', 'text-heading');
                        });
                    }
                    if (labelEl) {
                        labelEl.textContent = defaultLabel;
                    }
                });

                updateTable(form);
            } else {
                fetchPage(clearBtn.href);
            }
        });

        const fetchPage = async (url) => {
            tableContainer.classList.add('opacity-50', 'pointer-events-none');
            try {
                const response = await fetch(url, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });
                const html = await response.text();
                const parser = new DOMParser();
                const doc = parser.parseFromString(html, 'text/html');
                const newTable = doc.getElementById('table-container');

                if (newTable) {
                    tableContainer.innerHTML = newTable.innerHTML;
                    if (window.lucide) window.lucide.createIcons({ icons: window.lucide.icons });
                    window.history.pushState({}, '', url);
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            } catch (error) {
                console.error('Pagination Error:', error);
            } finally {
                tableContainer.classList.remove('opacity-50', 'pointer-events-none');
            }
        };
    };

    initLiveFilters();
});

document.addEventListener('click', (e) => {
    const btn = e.target.closest('.toggle-password');
    if (!btn) return;
    
    e.preventDefault();
    const targetId = btn.getAttribute('data-target');
    const field = document.getElementById(targetId) || document.querySelector(`input[name="${targetId}"]`);
    
    if (field) {
        if (field.type === 'password') {
            field.type = 'text';
            btn.innerHTML = '<i data-lucide="eye-off" class="w-4.5 h-4.5"></i>';
        } else {
            field.type = 'password';
            btn.innerHTML = '<i data-lucide="eye" class="w-4.5 h-4.5"></i>';
        }
        
        if (window.lucide && window.lucide.createIcons) {
            window.lucide.createIcons({
                icons: window.lucide.icons,
                attrs: { class: 'w-4.5 h-4.5' }
            });
        }
    }
});
