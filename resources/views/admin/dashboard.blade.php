@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">{{ now()->locale('tr')->translatedFormat('d F Y, l') }}</p>
</div>

{{-- Mağazalar --}}
<p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-3">Mağazalar</p>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6 min-w-0">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Toplam Mağaza</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $totalStores }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Aktif Mağaza</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $activeStores }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bugünkü Sipariş</p>
                <p class="text-2xl font-bold text-amber-600 mt-1">{{ $todayOrders }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bekleyen Sipariş</p>
                <p class="text-2xl font-bold text-orange-600 mt-1">{{ $pendingOrders }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

{{-- Gelir --}}
<p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-3">Gelir</p>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 min-w-0 w-full">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Bugünkü Gelir</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($todayRevenue, 2) }} ₺</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Haftalık Gelir</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($weeklyRevenue, 2) }} ₺</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Aylık Gelir</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($monthlyRevenue, 2) }} ₺</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Geçen Ay Gelir</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ number_format($lastMonthRevenue, 2) }} ₺</p>
    </div>
</div>

{{-- Grafik --}}
<div class="grid grid-cols-2 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-4 py-2 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-900 truncate">Son 7 Gün Sipariş</h2>
        </div>
        <div class="p-3 h-32">
            <canvas id="ordersChart"></canvas>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-4 py-2 border-b border-gray-100">
            <h2 class="text-sm font-semibold text-gray-900 truncate">Son 7 Gün Gelir (₺)</h2>
        </div>
        <div class="p-3 h-32">
            <canvas id="earningsChart"></canvas>
        </div>
    </div>
</div>

{{-- Son Siparişler + Bu Ay En Çok Sipariş + Bekleyen Siparişler + Bu Ay En Çok Gelir --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8 w-full">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Son Siparişler</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Tümünü Gör →</a>
        </div>
        <div class="overflow-x-auto max-h-80 overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sipariş No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mağaza</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toplam</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($recentOrders as $order)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $order->order_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->store?->name ?? '-' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $order->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap font-medium">{{ number_format($order->total, 2) }} ₺</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 py-1 text-xs rounded
                                    @if($order->status === 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status === 'delivered') bg-green-100 text-green-800
                                    @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ \App\Models\Order::getStatusLabels()[$order->status] ?? $order->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <a href="{{ route('admin.orders.show', $order) }}" class="text-amber-600 hover:text-amber-700 font-medium">Detay</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Bu Ay En Çok Sipariş</h2>
            <a href="{{ route('admin.stores.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Mağazalar →</a>
        </div>
        <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
            @forelse($topStores as $store)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $store->name }}</p>
                        <p class="text-sm text-gray-500">{{ $store->city->name ?? '-' }}</p>
                    </div>
                    <div class="shrink-0 text-right ml-4">
                        <p class="font-bold text-amber-600">{{ $store->orders_this_month ?? 0 }}</p>
                        <p class="text-xs text-gray-500">sipariş</p>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-gray-500 text-sm">Henüz sipariş yok.</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Bekleyen Siparişler</h2>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Tümünü Gör →</a>
        </div>
        <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
            @forelse($pendingOrdersList as $order)
                <div class="px-6 py-3 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="min-w-0">
                        <p class="font-medium text-gray-900 truncate text-sm">{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ $order->store?->name ?? '-' }}</p>
                    </div>
                    <a href="{{ route('admin.orders.show', $order) }}" class="shrink-0 text-amber-600 hover:text-amber-700 text-xs font-medium">Detay</a>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-gray-500 text-sm">Bekleyen sipariş yok.</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Bu Ay En Çok Gelir</h2>
            <a href="{{ route('admin.stores.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Mağazalar →</a>
        </div>
        <div class="divide-y divide-gray-100 max-h-80 overflow-y-auto">
            @forelse($topStoresByRevenue as $store)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $store->name }}</p>
                        <p class="text-sm text-gray-500">{{ $store->city->name ?? '-' }}</p>
                    </div>
                    <div class="shrink-0 text-right ml-4">
                        <p class="font-bold text-amber-600">{{ number_format($store->revenue_this_month ?? 0, 0) }} ₺</p>
                        <p class="text-xs text-gray-500">gelir</p>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-gray-500 text-sm">Henüz gelir yok.</div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var labels = @json($chartLabels);

    new Chart(document.getElementById('ordersChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Sipariş Sayısı',
                data: @json($chartOrders),
                backgroundColor: 'rgba(217, 119, 6, 0.7)',
                borderColor: 'rgb(217, 119, 6)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });

    new Chart(document.getElementById('earningsChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Gelir (₺)',
                data: @json($chartEarnings),
                fill: true,
                borderColor: 'rgb(217, 119, 6)',
                backgroundColor: 'rgba(217, 119, 6, 0.1)',
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
});
</script>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastCheck = new Date().toISOString();
    setInterval(function() {
        fetch('{{ route("admin.api.new-orders") }}?last_check=' + encodeURIComponent(lastCheck))
            .then(r => r.json())
            .then(data => {
                if (data.has_new && data.count > 0) {
                    if ('Notification' in window) {
                        if (Notification.permission === 'granted') {
                            new Notification('DrDrink - Yeni Sipariş!', { body: data.count + ' yeni sipariş geldi. Sayfa yenileniyor...' });
                        } else if (Notification.permission !== 'denied') {
                            Notification.requestPermission();
                        }
                    }
                    location.reload();
                }
            });
    }, 15000);
});
</script>
@endpush
