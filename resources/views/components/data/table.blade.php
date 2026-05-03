@props([
    'items' => [],
    'emptyMessage' => 'Belum ada data',
    'emptyIcon' => 'database'
])

<div class="bg-white rounded-2xl border border-gray-100 premium-shadow overflow-hidden">
    <div class="overflow-x-auto">
        <table {{ $attributes->merge(['class' => 'w-full text-sm']) }}>
            <thead class="thead-premium">
                {{ $thead }}
            </thead>
            <tbody class="divide-y divide-gray-50">
                {{ $slot }}
                @if(count($items) === 0)
                    <tr>
                        <td colspan="100" class="px-5 py-12 text-center">
                            <div class="flex flex-col items-center gap-2">
                                <i data-lucide="{{ $emptyIcon }}" class="w-10 h-10 text-gray-200"></i>
                                <p class="text-sm text-gray-400 font-medium">{{ $emptyMessage }}</p>
                            </div>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@if(isset($items) && method_exists($items, 'hasPages') && $items->hasPages())
    <div class="px-5 py-4 border-t border-gray-100">
        {{ $items->links() }}
    </div>
@endif
