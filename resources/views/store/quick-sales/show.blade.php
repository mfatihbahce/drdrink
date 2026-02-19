@extends('store.layouts.app')

@section('title', 'Hızlı Satış #' . $order->order_number)
@section('header', 'Hızlı Satış Detay')

@section('content')
@php
    $methodLabels = [
        'nakit' => 'Nakit',
        'kart' => 'Kredi/Banka Kartı',
        'yemek_karti' => 'Yemek Kartı',
        'diger' => 'Diğer',
    ];
@endphp

<div class="mb-6">
    <a href="{{ route('store.quick-sales.index') }}" class="inline-flex items-center gap-2 text-amber-600 hover:text-amber-700 font-medium">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        Hızlı Satışlara Dön
    </a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
    <div class="px-6 py-5 border-b border-gray-200 bg-gray-50/50">
        <div class="flex flex-wrap items-start justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Hızlı Satış #{{ $order->order_number }}</h1>
                <p class="text-gray-500 mt-1">{{ $order->created_at->format('d.m.Y H:i') }} · {{ $order->city->name ?? '' }}</p>
                <div class="flex flex-wrap gap-3 mt-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 text-amber-800 text-sm font-medium">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Kasiyer: {{ $order->user?->name ?? '-' }}
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-gray-100 text-gray-700 text-sm">
                        Müşteri: {{ $order->customer_name }}
                    </span>
                    <span class="px-3 py-1 rounded-lg text-sm font-medium
                        @if($order->status === 'confirmed') bg-green-100 text-green-800
                        @elseif($order->status === 'cancelled') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800
                        @endif">
                        {{ \App\Models\Order::getStatusLabels()[$order->status] ?? $order->status }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <div class="text-2xl font-bold text-amber-600">{{ number_format($order->total, 2) }} ₺</div>
                <p class="text-sm text-gray-500 mt-1">Toplam</p>
            </div>
        </div>
    </div>

    <div class="p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Satış Kalemleri</h2>
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ürün</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Adet</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Birim Fiyat</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Toplam</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($order->items as $item)
                    <tr class="hover:bg-gray-50/50">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $item->product_name }}</td>
                        <td class="px-6 py-4 text-right">{{ $item->quantity }}</td>
                        <td class="px-6 py-4 text-right text-gray-600">{{ number_format($item->price, 2) }} ₺</td>
                        <td class="px-6 py-4 text-right font-medium text-amber-600">{{ number_format($item->total, 2) }} ₺</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 pt-6 border-t border-gray-200 space-y-2 max-w-sm ml-auto">
            <div class="flex justify-between text-gray-600">
                <span>Ara toplam</span>
                <span>{{ number_format($order->subtotal, 2) }} ₺</span>
            </div>
            @if(($order->discount_amount ?? 0) > 0)
                <div class="flex justify-between text-red-600">
                    <span>İndirim</span>
                    <span>-{{ number_format($order->discount_amount, 2) }} ₺</span>
                </div>
            @endif
            <div class="flex justify-between text-lg font-bold text-gray-900 pt-2">
                <span>Toplam</span>
                <span class="text-amber-600">{{ number_format($order->total, 2) }} ₺</span>
            </div>
        </div>
    </div>

    @if($order->payments->isNotEmpty())
    <div class="px-6 py-5 border-t border-gray-200 bg-gray-50/30">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Ödeme Bölüşümü (Kasiyer İşlemleri)</h2>
        <div class="flex flex-wrap gap-3">
            @foreach($order->payments as $payment)
                @if($payment->status === 'paid' || $payment->amount > 0)
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white border border-gray-200 shadow-sm">
                    <span class="text-gray-600">{{ $methodLabels[$payment->payment_method] ?? $payment->payment_method }}</span>
                    <span class="font-semibold text-amber-600">{{ number_format($payment->amount, 2) }} ₺</span>
                </div>
                @endif
            @endforeach
        </div>
    </div>
    @else
    <div class="px-6 py-5 border-t border-gray-200 bg-gray-50/30">
        <h2 class="text-lg font-semibold text-gray-900 mb-3">Ödeme</h2>
        <p class="text-gray-600">{{ $methodLabels[$order->payment_method] ?? $order->payment_method ?? 'Nakit' }} · {{ number_format($order->total, 2) }} ₺</p>
    </div>
    @endif

    @if($order->notes)
    <div class="px-6 py-4 border-t border-gray-200">
        <p class="text-sm text-gray-600"><strong>Not:</strong> {{ $order->notes }}</p>
    </div>
    @endif
</div>
@endsection
