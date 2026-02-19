@extends('store.layouts.pos')

@section('title', 'Sipariş #' . $order->order_number)

@section('content')
<div class="pos-orders-page" style="display: flex; flex-direction: column; min-height: 100vh;">
    <header class="pos-orders-header">
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('store.pos.index') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: inherit;">
                <div class="pos-logo">☕</div>
                <h1 style="font-size: 1.25rem; font-weight: 700; margin: 0;">DrDrink</h1>
            </a>
            <div class="pos-mode-tabs">
                <a href="{{ route('store.pos.index') }}" class="pos-mode-tab">Hızlı Satış</a>
                <a href="{{ route('store.orders.index') }}" class="pos-mode-tab active">Paket Sipariş</a>
            </div>
        </div>
        <a href="{{ route('store.orders.index') }}" class="pos-link">← Paket Siparişe Dön</a>
    </header>

    <div class="pos-orders-content">
        <div class="pos-orders-card" style="margin-bottom: 24px;">
            <div style="padding: 24px; border-bottom: 1px solid var(--pos-border); display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px;">
                <div>
                    <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Sipariş #{{ $order->order_number }}</h2>
                    <p style="color: var(--pos-text-muted); margin-top: 8px;">{{ $order->created_at->format('d.m.Y H:i') }} - {{ $order->city->name }}</p>
                </div>
                <form action="{{ route('store.orders.update', $order) }}" method="POST" style="display: flex; align-items: flex-end; gap: 12px; flex-wrap: wrap;">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: var(--pos-text-muted); margin-bottom: 6px;">Durum Güncelle</label>
                        <select name="status" class="pos-orders-input" style="min-width: 140px;">
                            @foreach(\App\Models\Order::getStatusLabels() as $key => $label)
                                <option value="{{ $key }}" {{ $order->status === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: var(--pos-text-muted); margin-bottom: 6px;">Not (opsiyonel)</label>
                        <input type="text" name="notes" class="pos-orders-input" placeholder="Not..." style="min-width: 120px;">
                    </div>
                    <button type="submit" class="pos-btn pos-btn-primary" style="width: auto; padding: 10px 20px;">Güncelle</button>
                </form>
            </div>

            <div style="padding: 24px;">
                <h3 style="font-weight: 700; margin-bottom: 16px;">Sipariş Kalemleri</h3>
                <table class="pos-orders-table">
                    <thead>
                        <tr>
                            <th>Ürün</th>
                            <th style="text-align: right;">Adet</th>
                            <th style="text-align: right;">Fiyat</th>
                            <th style="text-align: right;">Toplam</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td style="text-align: right;">{{ $item->quantity }}</td>
                                <td style="text-align: right;">{{ number_format($item->price, 2) }} ₺</td>
                                <td style="text-align: right; color: var(--pos-accent);">{{ number_format($item->total, 2) }} ₺</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="margin-top: 20px; padding-top: 20px; border-top: 1px solid var(--pos-border); display: flex; justify-content: flex-end; gap: 32px; flex-wrap: wrap;">
                    <span style="color: var(--pos-text-muted);">Ara Toplam: {{ number_format($order->subtotal, 2) }} ₺</span>
                    <span style="color: var(--pos-text-muted);">Kurye: {{ number_format($order->delivery_fee, 2) }} ₺</span>
                    <span style="font-weight: 700; color: var(--pos-accent);">Toplam: {{ number_format($order->total, 2) }} ₺</span>
                </div>
            </div>

            <div style="padding: 24px; background: var(--pos-bg-secondary); border-top: 1px solid var(--pos-border);">
                <h3 style="font-weight: 700; margin-bottom: 12px;">Teslimat Bilgileri</h3>
                <p style="margin: 4px 0;"><strong>Müşteri:</strong> {{ $order->customer_name }}</p>
                <p style="margin: 4px 0;"><strong>Adres:</strong> {{ $order->address }}</p>
                <p style="margin: 4px 0;"><strong>Telefon:</strong> {{ $order->phone }}</p>
                @if($order->notes)
                    <p style="margin: 4px 0;"><strong>Sipariş Notu:</strong> {{ $order->notes }}</p>
                @endif
            </div>

            @if($order->statusLogs->isNotEmpty())
                <div style="padding: 24px; border-top: 1px solid var(--pos-border);">
                    <h3 style="font-weight: 700; margin-bottom: 16px;">Durum Geçmişi</h3>
                    <div style="display: flex; flex-direction: column; gap: 8px;">
                        @foreach($order->statusLogs->sortByDesc('created_at') as $log)
                            <div style="display: flex; justify-content: space-between; font-size: 0.9rem;">
                                <span>{{ \App\Models\Order::getStatusLabels()[$log->status] ?? $log->status }}</span>
                                <span style="color: var(--pos-text-muted);">{{ $log->created_at->format('d.m.Y H:i') }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
