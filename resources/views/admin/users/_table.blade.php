<x-data.table :items="$users" emptyMessage="Belum ada pengguna" emptyIcon="users">
    <x-slot:thead>
        <tr>
            <th class="text-left">Nama</th>
            <th class="text-left">Email</th>
            <th class="text-left">Role</th>
            <th class="text-left">Cabang</th>
            <th class="text-left">Status</th>
            <th class="text-right">Aksi</th>
        </tr>
    </x-slot:thead>

    @foreach($users as $user)
    <tr class="hover:bg-gray-50 transition-colors">
        <td class="px-5 py-4">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-[#1B3A6B] flex items-center justify-center text-white text-xs font-bold shadow-md shadow-blue-900/10">
                    {{ strtoupper(substr($user->name,0,1)) }}
                </div>
                <span class="font-bold text-gray-800">{{ $user->name }}</span>
            </div>
        </td>
        <td class="px-5 py-4 text-gray-500 font-medium">{{ $user->email }}</td>
        <td class="px-5 py-4">
            @php
            $roleTypes = ['admin'=>'danger','manager'=>'purple','cashier'=>'info','courier'=>'success'];
            $roleLabels = ['admin'=>'Admin','manager'=>'Manager','cashier'=>'Kasir','courier'=>'Kurir'];
            @endphp
            <x-ui.badge :type="$roleTypes[$user->role] ?? 'gray'" :label="$roleLabels[$user->role] ?? $user->role" />
        </td>
        <td class="px-5 py-4 text-gray-500 font-semibold text-xs">{{ $user->branch->name ?? '-' }}</td>
        <td class="px-5 py-4">
            @if($user->trashed())
                <x-ui.badge type="gray" class="flex items-center gap-1.5 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-gray-400"></span> Non-aktif
                </x-ui.badge>
            @else
                <x-ui.badge type="success" class="flex items-center gap-1.5 w-fit">
                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Aktif
                </x-ui.badge>
            @endif
        </td>
        <td class="px-5 py-4 text-right">
            <div class="flex items-center justify-end gap-2">
                @if(!$user->trashed())
                    @if($user->role !== 'admin')
                    <a href="{{ route('admin.users.edit', $user) }}" class="p-2 text-gray-400 hover:text-[#1B3A6B] hover:bg-blue-50 rounded-lg transition-all border border-transparent hover:border-blue-100">
                        <i data-lucide="pencil" class="w-4 h-4"></i>
                    </a>
                    @if($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" data-confirm="Apakah Anda yakin ingin menonaktifkan pengguna {{ $user->name }}? Pengguna ini tidak akan dapat login sampai diaktifkan kembali." data-confirm-title="Nonaktifkan Pengguna?" data-confirm-button="Ya, Nonaktifkan">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all border border-transparent hover:border-red-100">
                            <i data-lucide="user-minus" class="w-4 h-4"></i>
                        </button>
                    </form>
                    @endif
                    @else
                    <span class="px-3 py-1 text-xs font-bold text-gray-400 bg-gray-50 rounded border border-gray-100">Locked</span>
                    @endif
                @else
                    <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" data-confirm="Aktifkan kembali pengguna {{ $user->name }}?" data-confirm-title="Aktifkan Pengguna?" data-confirm-button="Ya, Aktifkan">
                        @csrf
                        <button type="submit" class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition-all border border-transparent hover:border-green-100">
                            <i data-lucide="user-check" class="w-4 h-4"></i>
                        </button>
                    </form>
                @endif
            </div>
        </td>
    </tr>
    @endforeach
</x-data.table>
