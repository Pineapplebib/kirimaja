<x-data.table :items="$rates" emptyMessage="Belum ada data tarif" emptyIcon="tag">
    <x-slot:thead>
        <tr>
            <th class="text-left">Kota Asal</th>
            <th class="text-left">Kota Tujuan</th>
            <th class="text-right">Tarif/kg</th>
            <th class="text-center">Estimasi</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($rates as $rate)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-5 py-3.5 font-bold text-gray-800">
            <span class="inline-flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#F47B20]"></i> {{ $rate->origin_city }}</span>
        </td>
        <td class="px-5 py-3.5 font-bold text-gray-800">
            <span class="inline-flex items-center gap-1.5"><i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#1B3A6B]"></i> {{ $rate->destination_city }}</span>
        </td>
        <td class="px-5 py-3.5 text-right font-extrabold text-gray-800">Rp {{ number_format($rate->price_per_kg,0,',','.') }}</td>
        <td class="px-5 py-3.5 text-center">
            <x-ui.badge type="info" :label="$rate->estimated_days . ' Hari'" />
        </td>
        <td class="px-5 py-3.5 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.rates.edit', $rate) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </a>
                <form method="POST" action="{{ route('admin.rates.destroy', $rate) }}" data-confirm="Hapus data tarif ini dari sistem?" data-confirm-title="Hapus Tarif?" data-confirm-button="Ya, Hapus">
                    @csrf @method('DELETE')
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all border border-transparent hover:border-red-100">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</x-data.table>
