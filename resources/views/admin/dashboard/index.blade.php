@extends('layouts.app')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Overview')

@section('content')
{{-- Stats Row --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    <x-ui.stat-card label="Total Pengiriman" :value="number_format($totalShipments ?? 0)" icon="package" color="blue" />
    <x-ui.stat-card label="Total Pelanggan" :value="number_format($totalCustomers ?? 0)" icon="users" color="orange" />
    <x-ui.stat-card label="Pendapatan Bulan Ini" :value="'Rp ' . number_format($monthRevenue ?? 0, 0, ',', '.')" icon="banknote" color="green" />
    <x-ui.stat-card label="Cabang Aktif" :value="number_format($totalBranches ?? 0)" icon="building-2" color="purple" />
</div>

<div class="grid lg:grid-cols-3 gap-6 mb-6">
    {{-- Chart Section --}}
    <x-ui.card class="lg:col-span-2 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-bold text-gray-800">Tren Pendapatan</h3>
            <span class="text-xs font-bold text-gray-400 bg-gray-50 px-2 py-1 rounded border border-gray-100">12 bulan terakhir</span>
        </div>
        <div class="h-[300px]">
            <canvas id="revenueChart"></canvas>
        </div>
    </x-ui.card>

    {{-- Status Distribution --}}
    <x-ui.card class="p-6">
        <h3 class="font-bold text-gray-800 mb-6">Status Pengiriman</h3>
        <div class="space-y-5">
            @php
            $statuses = [
                ['label' => 'Menunggu', 'value' => $pendingShipments ?? 0, 'color' => 'bg-yellow-400', 'badge' => 'warning'],
                ['label' => 'In Transit', 'value' => $inTransitShipments ?? 0, 'color' => 'bg-blue-500', 'badge' => 'info'],
                ['label' => 'Terkirim', 'value' => $deliveredShipments ?? 0, 'color' => 'bg-green-500', 'badge' => 'success'],
                ['label' => 'Dibatalkan', 'value' => $cancelledShipments ?? 0, 'color' => 'bg-red-400', 'badge' => 'danger'],
            ];
            $totalS = max(($totalShipments ?? 1), 1);
            @endphp
            @foreach($statuses as $st)
            <div>
                <div class="flex justify-between items-center text-sm mb-2">
                    <span class="text-gray-600 font-bold text-sm">{{ $st['label'] }}</span>
                    <span class="font-extrabold text-gray-800">{{ number_format($st['value']) }}</span>
                </div>
                <div class="h-2 bg-gray-50 rounded-full overflow-hidden border border-gray-100/50">
                    <div class="{{ $st['color'] }} h-full rounded-full transition-all duration-1000 shadow-sm shadow-black/5" style="width: {{ round(($st['value'] / $totalS) * 100) }}%"></div>
                </div>
            </div>
            @endforeach
            <div class="pt-6 mt-6 border-t border-gray-100">
                <div class="p-4 bg-blue-50/50 rounded-xl border border-blue-100 flex justify-between items-center">
                    <span class="text-sm font-bold text-[#1B3A6B]">Total akumulasi</span>
                    <span class="text-lg font-black text-[#1B3A6B]">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </x-ui.card>
</div>

{{-- Recent Shipments Table --}}
<x-ui.card>
    <div class="px-6 py-4 border-b border-gray-50 flex items-center justify-between">
        <h3 class="font-bold text-gray-800 flex items-center gap-2">
            Pengiriman Terbaru
        </h3>
        <a href="{{ route('admin.shipments.index') }}" class="text-xs font-bold text-[#1B3A6B] hover:text-[#0F2347] flex items-center gap-1.5 transition-colors">
            Lihat semua <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
        </a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="thead-premium">
                <tr>
                    <th class="text-left">Resi</th>
                    <th class="text-left">Pengirim</th>
                    <th class="text-left">Tujuan</th>
                    <th class="text-left">Status</th>
                    <th class="text-right">Nilai</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($recentShipments ?? [] as $s)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5 font-mono text-sm font-bold text-[#1B3A6B] tracking-wider">{{ $s->tracking_number ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-gray-700 font-bold">{{ $s->sender->name ?? '-' }}</td>
                    <td class="px-5 py-3.5 text-sm font-bold text-gray-500">{{ $s->destinationBranch?->city ?? '-' }}</td>
                    <td class="px-5 py-3.5">
                        <x-ui.badge :type="match($s->status) {
                            'delivered' => 'success',
                            'cancelled' => 'danger',
                            'pending' => 'warning',
                            default => 'info'
                        }" :label="$s->status_label" />
                    </td>
                    <td class="px-5 py-3.5 text-right font-extrabold text-gray-800">Rp {{ number_format($s->total_price, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-5 py-12 text-center">
                    <i data-lucide="package-search" class="w-10 h-10 text-gray-200 mx-auto mb-2"></i>
                    <p class="text-sm text-gray-400 font-medium">Belum ada aktivitas</p>
                </td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-ui.card>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const chartData = @json($chartData ?? []);
    
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: chartData.map(d => d.label),
            datasets: [{
                label: 'Pendapatan',
                data: chartData.map(d => d.revenue),
                backgroundColor: '#1B3A6B',
                borderRadius: 6,
                hoverBackgroundColor: '#0F2347',
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    padding: 12,
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 13, weight: 'bold' },
                    displayColors: false,
                    cornerRadius: 12,
                    callbacks: {
                        title: function(context) {
                            return chartData[context[0].dataIndex].full_label;
                        },
                        label: function(context) {
                            return ' Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F3F4F6' },
                    ticks: {
                        font: { size: 11, weight: 'bold' },
                        color: '#9CA3AF',
                        callback: function(value) {
                            if (value >= 1000000) return 'Rp ' + (value/1000000).toFixed(1) + 'M';
                            return 'Rp ' + (value/1000).toFixed(0) + 'rb';
                        }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 11, weight: 'bold' },
                        color: '#9CA3AF'
                    }
                }
            }
        }
    });
});
</script>
@endpush
@endsection
