<x-data.table :items="$vehicles" emptyMessage="Tidak ada kendaraan ditemukan" emptyIcon="truck">
    <x-slot:thead>
        <tr>
            <th class="text-left">Kendaraan</th>
            <th class="text-left">Tipe</th>
            <th class="text-left">Kepemilikan</th>
            <th class="text-left">Cabang</th>
            <th class="text-left">Kurir Aktif</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($vehicles as $vehicle)
    <tr class="hover:bg-gray-50 transition-colors group">
        <td class="px-5 py-3.5">
            <span class="font-mono text-sm font-bold text-[#1B3A6B] uppercase">{{ $vehicle->plate_number }}</span>
        </td>
        <td class="px-5 py-3.5 text-sm font-semibold text-gray-700 capitalize">
            <div class="flex items-center gap-2">
                <i data-lucide="{{ $vehicle->type === 'motor' ? 'bike' : ($vehicle->type === 'mobil' ? 'car' : 'truck') }}" class="w-4 h-4 text-blue-400"></i>
                {{ $vehicle->type }}
            </div>
        </td>
        <td class="px-5 py-3.5">
            <x-ui.badge :type="$vehicle->ownership === 'company' ? 'info' : 'warning'" :label="$vehicle->ownership === 'company' ? 'Perusahaan' : 'Pribadi'" />
        </td>
        <td class="px-5 py-3.5 text-sm font-bold text-gray-500 tracking-tight">
            {{ $vehicle->branch->name ?? '-' }}
        </td>
        <td class="px-5 py-3.5">
            <div class="flex flex-col gap-2">
                @forelse($vehicle->couriers as $courier)
                    <div class="flex items-center gap-2">
                        <div class="w-7 h-7 rounded bg-green-50 flex items-center justify-center text-xs font-bold text-green-600 border border-green-100">
                            {{ strtoupper(substr($courier->name, 0, 1)) }}
                        </div>
                        <span class="text-sm font-semibold text-gray-700">{{ $courier->name }}</span>
                    </div>
                @empty
                    <span class="text-xs text-gray-400 italic">Belum Ditugaskan</span>
                @endforelse
            </div>
        </td>
        <td class="px-5 py-3.5 text-right">
            <div class="flex justify-end gap-1">
                <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all inline-flex border border-transparent hover:border-blue-100" title="Edit">
                    <i data-lucide="edit-3" class="w-4 h-4"></i>
                </a>
                <form action="{{ route('admin.vehicles.destroy', $vehicle) }}" method="POST" class="inline" 
                      data-confirm="Kendaraan ini akan dihapus secara permanen dari sistem."
                      data-confirm-title="Hapus Kendaraan?"
                      data-confirm-button="Ya, Hapus">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all inline-flex border border-transparent hover:border-red-100" title="Hapus">
                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</x-data.table>
