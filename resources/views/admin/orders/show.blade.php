@extends('admin.layouts.app')

@section('title', 'Sipariş #' . $order->order_number)

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.orders.index') }}" class="text-amber-600 hover:text-amber-700">← Siparişlere Dön</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden mb-6">
    <div class="p-6 border-b flex justify-between items-start">
        <div>
            <h1 class="text-2xl font-bold">Sipariş #{{ $order->order_number }}</h1>
            <p class="text-gray-500 mt-1">{{ $order->created_at->format('d.m.Y H:i') }} - {{ $order->city->name }}</p>
        </div>
        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-end gap-2">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Durum Güncelle</label>
                <select name="status" class="border rounded px-3 py-2">
                    @foreach(\App\Models\Order::getStatusLabels() as $key => $label)
                        <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Not (opsiyonel)</label>
                <input type="text" name="notes" class="border rounded px-3 py-2" placeholder="Not...">
            </div>
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded font-medium">Güncelle</button>
        </form>
    </div>

    <div class="p-6">
        <h2 class="font-bold mb-4">Sipariş Kalemleri</h2>
        <table class="min-w-full">
            <thead>
                <tr class="border-b">
                    <th class="text-left py-2">Ürün</th>
                    <th class="text-right py-2">Adet</th>
                    <th class="text-right py-2">Fiyat</th>
                    <th class="text-right py-2">Toplam</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="border-b">
                        <td class="py-2">{{ $item->product_name }}</td>
                        <td class="text-right py-2">{{ $item->quantity }}</td>
                        <td class="text-right py-2">{{ number_format($item->price, 2) }} ₺</td>
                        <td class="text-right py-2">{{ number_format($item->total, 2) }} ₺</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4 pt-4 border-t flex justify-end gap-8">
            <span>Ara Toplam: {{ number_format($order->subtotal, 2) }} ₺</span>
            <span>Kurye: {{ number_format($order->delivery_fee, 2) }} ₺</span>
            <span class="font-bold">Toplam: {{ number_format($order->total, 2) }} ₺</span>
        </div>
    </div>

    <div class="p-6 bg-gray-50">
        <h2 class="font-bold mb-2">Teslimat Bilgileri</h2>
        <p><strong>Müşteri:</strong> {{ $order->customer_name }}</p>
        <p><strong>Adres:</strong> {{ $order->address }}</p>
        <p><strong>Telefon:</strong> {{ $order->phone }}</p>
        @if($order->notes)
            <p><strong>Sipariş Notu:</strong> {{ $order->notes }}</p>
        @endif
    </div>

    @if($order->statusLogs->isNotEmpty())
        <div class="p-6 border-t">
            <h2 class="font-bold mb-4">Durum Geçmişi</h2>
            <div class="space-y-2">
                @foreach($order->statusLogs->sortByDesc('created_at') as $log)
                    <div class="flex justify-between text-sm">
                        <span>{{ \App\Models\Order::getStatusLabels()[$log->status] ?? $log->status }}</span>
                        <span class="text-gray-500">{{ $log->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
