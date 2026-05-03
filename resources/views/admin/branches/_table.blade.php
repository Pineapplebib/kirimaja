<x-data.table :items="$branches" emptyMessage="Belum ada data cabang" emptyIcon="building-2">
    <x-slot:thead>
        <tr>
            <th class="text-left">Nama Cabang</th>
            <th class="text-left">Kota</th>
            <th class="text-left">Alamat</th>
            <th class="text-left">Telepon</th>
            <th class="text-center">Staff</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($branches as $branch)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-5 py-4 font-bold text-gray-800">{{ $branch->name }}</td>
        <td class="px-5 py-4 text-gray-700 font-bold whitespace-nowrap">
            <i data-lucide="map-pin" class="w-3.5 h-3.5 inline mr-1 text-[#F47B20]"></i> {{ $branch->city }}
        </td>
        <td class="px-5 py-4 text-gray-500 max-w-xs truncate font-medium">{{ $branch->address }}</td>
        <td class="px-5 py-4 text-gray-600 font-mono text-sm tracking-tight font-bold">{{ $branch->phone }}</td>
        <td class="px-5 py-4 text-center">
            <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-blue-50 text-[#1B3A6B] font-black text-xs border border-blue-100">
                {{ $branch->users_count }}
            </span>
        </td>
        <td class="px-5 py-4 text-right">
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('admin.branches.edit', $branch) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                </a>
                <form method="POST" action="{{ route('admin.branches.destroy', $branch) }}" data-confirm="Hapus cabang {{ $branch->name }}? Semua data terkait di cabang ini akan tetap ada namun cabang tidak lagi aktif." data-confirm-title="Hapus Cabang?" data-confirm-button="Ya, Hapus">
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
