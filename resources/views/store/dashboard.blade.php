@extends('store.layouts.app')

@section('title', 'Dashboard')
@section('header', 'Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">{{ $store->name }} - Dashboard</h1>
    <p class="text-gray-500 text-sm mt-1">{{ now()->locale('tr')->translatedFormat('d F Y, l') }}</p>
</div>

{{-- Bugünkü Durumlar --}}
<p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-3">Bugün</p>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-6 min-w-0">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bugünkü Sipariş</p>
                <p class="text-2xl font-bold text-gray-900 mt-1">{{ $todayOrders }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-amber-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bugünkü Bekleyen</p>
                <p class="text-2xl font-bold text-orange-600 mt-1">{{ $todayPending }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-orange-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bugünkü Teslim Edilen</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $todayDelivered }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Bugünkü İptal</p>
                <p class="text-2xl font-bold text-red-600 mt-1">{{ $todayCancelled }}</p>
            </div>
            <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center shrink-0">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
        </div>
    </div>
</div>

{{-- Bu Ay Özet --}}
<p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-3">Bu Ay</p>
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 min-w-0">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Bu Ay Toplam Sipariş</p>
        <p class="text-2xl font-bold text-gray-900 mt-1">{{ $monthlyOrders }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Bu Ay Teslim Edilen</p>
        <p class="text-2xl font-bold text-emerald-600 mt-1">{{ $monthlyDelivered }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Bu Ay İptal</p>
        <p class="text-2xl font-bold text-red-600 mt-1">{{ $monthlyCancellations }}</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5 min-w-0">
        <p class="text-gray-500 text-sm font-medium">Bu Ay Kazanç</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($monthlyEarnings, 2) }} ₺</p>
    </div>
</div>

{{-- Kazanç Özeti --}}
<p class="text-gray-500 text-xs font-medium uppercase tracking-wider mb-3">Kazanç</p>
<div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
        <p class="text-gray-500 text-sm font-medium">Bugünkü Kazanç</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($todayEarnings, 2) }} ₺</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
        <p class="text-gray-500 text-sm font-medium">Haftalık Kazanç</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($weeklyEarnings, 2) }} ₺</p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
        <p class="text-gray-500 text-sm font-medium">Aylık Kazanç</p>
        <p class="text-2xl font-bold text-amber-600 mt-1">{{ number_format($monthlyEarnings, 2) }} ₺</p>
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
            <h2 class="text-sm font-semibold text-gray-900 truncate">Son 7 Gün Kazanç (₺)</h2>
        </div>
        <div class="p-3 h-32">
            <canvas id="earningsChart"></canvas>
        </div>
    </div>
</div>

{{-- Son Paket Siparişler --}}
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
        <h2 class="text-lg font-semibold text-gray-900">Son Paket Siparişler</h2>
        <a href="{{ route('store.orders.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Tümünü Gör →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sipariş No</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Müşteri</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toplam</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($recentOrders as $order)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $order->order_number }}</td>
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
                            <a href="{{ route('store.orders.show', $order) }}" class="text-amber-600 hover:text-amber-700 font-medium">Detay</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-500">Henüz sipariş yok.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

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
                label: 'Kazanç (₺)',
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
@endsection
