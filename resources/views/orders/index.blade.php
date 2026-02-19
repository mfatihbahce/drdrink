@extends('layouts.user-dashboard')

@section('title', 'Siparişlerim')

@section('content')
<div class="w-full">
    <h1 class="font-display text-2xl sm:text-3xl font-light text-gray-900 mb-8">Siparişlerim</h1>

        @forelse($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="reveal block border border-gray-200 hover:border-amber-300 bg-white rounded-xl p-6 mb-4 transition-all duration-300">
                <div class="flex flex-col sm:flex-row justify-between items-start gap-4">
                    <div>
                        <p class="font-display text-xl font-light text-gray-900">#{{ $order->order_number }}</p>
                        <p class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                        <p class="text-amber-600 font-medium mt-2">{{ number_format($order->total, 2) }} ₺</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 text-xs border rounded
                            @if($order->status === 'delivered') border-emerald-300 text-emerald-600 bg-emerald-50
                            @elseif($order->status === 'cancelled') border-red-300 text-red-600 bg-red-50
                            @else border-amber-300 text-amber-600 bg-amber-50
                            @endif">
                            {{ \App\Models\Order::getStatusLabels()[$order->status] ?? $order->status }}
                        </span>
                        <span class="px-3 py-1 text-xs border rounded
                            @if($order->payment_status === 'paid') border-emerald-300 text-emerald-600 bg-emerald-50
                            @elseif($order->payment_status === 'failed') border-red-300 text-red-600 bg-red-50
                            @else border-gray-300 text-gray-600 bg-gray-50
                            @endif">
                            {{ \App\Models\Order::getPaymentStatusLabels()[$order->payment_status] ?? $order->payment_status }}
                        </span>
                    </div>
                </div>
            </a>
        @empty
            <div class="border border-gray-200 bg-white rounded-2xl p-16 text-center">
                <p class="text-gray-500 mb-6">Henüz siparişiniz bulunmuyor.</p>
                <a href="{{ route('city.select') }}" class="inline-block bg-amber-500 text-black px-8 py-3 rounded-lg hover:bg-amber-400 transition">Sipariş Ver</a>
            </div>
        @endforelse

    {{ $orders->links() }}
</div>
@endsection
