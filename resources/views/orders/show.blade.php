@extends('layouts.user-dashboard')

@section('title', 'Sipariş #' . $order->order_number)

@section('content')
<div class="w-full">
        <a href="{{ route('orders.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mb-8 inline-block">← Siparişlerime Dön</a>

        <div class="border border-gray-200 bg-white rounded-2xl overflow-hidden">
            <div class="p-6 lg:p-8 border-b border-gray-200">
                <h1 class="font-display text-3xl font-light text-gray-900">#{{ $order->order_number }}</h1>
                <p class="text-gray-500 mt-2">{{ $order->created_at->format('d.m.Y H:i') }} · {{ $order->city->name }}</p>
                <div class="flex flex-wrap gap-2 mt-4">
                    <span class="inline-block px-3 py-1 text-sm border rounded
                        @if($order->status === 'delivered') border-emerald-300 text-emerald-600 bg-emerald-50
                        @elseif($order->status === 'cancelled') border-red-300 text-red-600 bg-red-50
                        @else border-amber-300 text-amber-600 bg-amber-50
                        @endif">
                        Sipariş: {{ \App\Models\Order::getStatusLabels()[$order->status] ?? $order->status }}
                    </span>
                    <span class="inline-block px-3 py-1 text-sm border rounded
                        @if($order->payment_status === 'paid') border-emerald-300 text-emerald-600 bg-emerald-50
                        @elseif($order->payment_status === 'failed') border-red-300 text-red-600 bg-red-50
                        @else border-gray-300 text-gray-600 bg-gray-50
                        @endif">
                        Ödeme: {{ \App\Models\Order::getPaymentStatusLabels()[$order->payment_status] ?? $order->payment_status }}
                    </span>
                </div>
            </div>

            <div class="p-6 lg:p-8">
                <h2 class="font-display text-xl font-light mb-6 text-gray-900">Sipariş Kalemleri</h2>
                <div class="space-y-3 mb-8">
                    @foreach($order->items as $item)
                        <div class="flex justify-between text-sm text-gray-700">
                            <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
                            <span>{{ number_format($item->total, 2) }} ₺</span>
                        </div>
                    @endforeach
                </div>
                <div class="border-t border-gray-200 pt-6 space-y-2">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Ara Toplam</span>
                        <span class="text-gray-900">{{ number_format($order->subtotal, 2) }} ₺</span>
                    </div>
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-500">Kurye</span>
                        <span class="text-gray-900">{{ number_format($order->delivery_fee, 2) }} ₺</span>
                    </div>
                    <div class="flex justify-between font-display text-xl pt-2">
                        <span class="text-gray-900">Toplam</span>
                        <span class="text-amber-600">{{ number_format($order->total, 2) }} ₺</span>
                    </div>
                </div>
            </div>

            <div class="p-6 lg:p-8 bg-gray-50">
                <h2 class="font-display text-xl font-light mb-4 text-gray-900">Teslimat Bilgileri</h2>
                <p class="text-sm text-gray-700"><span class="text-gray-500">Adres:</span> {{ $order->address }}</p>
                <p class="text-sm mt-2 text-gray-700"><span class="text-gray-500">Telefon:</span> {{ $order->phone }}</p>
                @if($order->notes)
                    <p class="text-sm mt-2 text-gray-700"><span class="text-gray-500">Not:</span> {{ $order->notes }}</p>
                @endif
            </div>

            <div class="p-6 lg:p-8 border-t border-gray-200">
                <h2 class="font-display text-xl font-light mb-4 text-gray-900">Ödeme Durumu</h2>
                <div class="flex items-center gap-2">
                    @if($order->payment_status === 'paid')
                        <span class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-emerald-300 text-emerald-700 bg-emerald-50">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Ödeme Alındı
                        </span>
                    @else
                        <span class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium rounded-lg border border-gray-300 text-gray-600 bg-gray-50">
                            {{ \App\Models\Order::getPaymentStatusLabels()[$order->payment_status] ?? $order->payment_status }}
                        </span>
                    @endif
                </div>
            </div>

            @if($order->statusLogs->isNotEmpty())
                <div class="p-6 lg:p-8 border-t border-gray-200">
                    <h2 class="font-display text-xl font-light mb-4 text-gray-900">Sipariş Durumu</h2>
                    <div class="space-y-2">
                        @foreach($order->statusLogs->sortBy('created_at') as $log)
                            <div class="flex justify-between text-sm text-gray-700">
                                <span>{{ \App\Models\Order::getStatusLabels()[$log->status] ?? $log->status }}</span>
                                <span class="text-gray-500">{{ $log->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
</div>
@endsection
