@extends('admin.layouts.app')

@section('title', 'Kasiyer Dashboard')
@section('header', 'Kasiyer Dashboard')

@section('content')
<div class="mb-8">
    <h1 class="text-2xl font-bold text-gray-800">Kasiyer Paneli</h1>
    <p class="text-gray-500 text-sm mt-1">{{ now()->locale('tr')->translatedFormat('d F Y, l') }}</p>
</div>

{{-- Özet Kartlar --}}
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8 min-w-0">
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

{{-- Bekleyen Siparişler + Son Siparişler --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-8 w-full">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Bekleyen Siparişler</h2>
            <a href="{{ route('admin.orders.index', ['status' => 'pending']) }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Tümünü Gör →</a>
        </div>
        <div class="divide-y divide-gray-100 max-h-96 overflow-y-auto">
            @forelse($pendingOrdersList as $order)
                <div class="px-6 py-4 flex items-center justify-between hover:bg-gray-50/50 transition-colors">
                    <div class="min-w-0">
                        <p class="font-medium text-gray-900 truncate">{{ $order->order_number }}</p>
                        <p class="text-sm text-gray-500 truncate">{{ $order->store?->name ?? '-' }} · {{ $order->customer_name }}</p>
                        <p class="text-sm font-medium text-amber-600 mt-1">{{ number_format($order->total, 2) }} ₺</p>
                    </div>
                    <a href="{{ route('admin.orders.show', $order) }}" class="shrink-0 ml-4 px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white text-sm font-medium rounded-lg transition">Detay</a>
                </div>
            @empty
                <div class="px-6 py-12 text-center text-gray-500">Bekleyen sipariş yok.</div>
            @endforelse
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden min-w-0">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Son Siparişler</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">Tümünü Gör →</a>
        </div>
        <div class="overflow-x-auto max-h-96 overflow-y-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50 sticky top-0">
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
</div>
@endsection
