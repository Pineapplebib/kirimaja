<x-data.table :items="$shipments" emptyMessage="Belum ada pengiriman" emptyIcon="package-search">
    <x-slot:thead>
        <tr>
            <th class="text-left">Resi</th>
            <th class="text-left">Pengirim</th>
            <th class="text-left">Rute</th>
            <th class="text-left">Kurir</th>
            <th class="text-left">Status</th>
            <th class="text-right">Total</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($shipments as $s)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-5 py-3.5">
            <span class="font-mono text-sm font-bold text-[#1B3A6B]">{{ $s->tracking_number }}</span>
            <p class="text-xs font-bold text-gray-400 mt-1">{{ $s->shipment_date?->format('d F Y') }}</p>
        </td>
        <td class="px-5 py-3.5">
            <p class="font-bold text-gray-800">{{ $s->sender->name ?? '-' }}</p>
            <p class="text-xs font-medium text-gray-400 mt-0.5"><i data-lucide="arrow-right" class="w-3 h-3 inline"></i> {{ $s->receiver->name ?? '-' }}</p>
        </td>
        <td class="px-5 py-3.5 text-sm font-bold text-gray-500 tracking-tight">
            {{ $s->originBranch->city ?? '-' }} <i data-lucide="chevrons-right" class="w-3 h-3 inline text-gray-300"></i> {{ $s->destinationBranch->city ?? '-' }}
        </td>
        <td class="px-5 py-3.5">
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded bg-green-50 flex items-center justify-center text-xs font-bold text-green-600 border border-green-100">
                    {{ $s->courier ? strtoupper(substr($s->courier->name, 0, 1)) : '-' }}
                </div>
                <span class="text-sm font-semibold text-gray-700">{{ $s->courier->name ?? 'Belum Ditugaskan' }}</span>
            </div>
        </td>
        <td class="px-5 py-3.5">
            <x-ui.badge :type="match($s->status) {
                'delivered' => 'success',
                'cancelled' => 'danger',
                'pending' => 'warning',
                default => 'info'
            }" :label="$s->status_label" />
        </td>
        <td class="px-5 py-3.5 text-right font-extrabold text-gray-800">Rp {{ number_format($s->total_price,0,',','.') }}</td>
        <td class="px-5 py-3.5 text-right">
            <a href="{{ route('admin.shipments.show', $s) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all inline-flex border border-transparent hover:border-blue-100">
                <i data-lucide="eye" class="w-4 h-4"></i>
            </a>
        </td>
    </tr>
    @endforeach
</x-data.table>
