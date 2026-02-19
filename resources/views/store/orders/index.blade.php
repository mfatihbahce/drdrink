@extends('store.layouts.pos')

@section('title', 'Paket Sipariş')

@section('content')
<div class="pos-orders-page" style="display: flex; flex-direction: column; min-height: 100vh;" x-data="{
    clock: '--:--:--',
    dateStr: '',
    init() {
        const update = () => {
            const now = new Date();
            this.clock = now.toLocaleTimeString('tr-TR', { hour12: false });
            this.dateStr = now.toLocaleDateString('tr-TR', { weekday: 'short', day: 'numeric', month: 'short' });
        };
        update();
        setInterval(update, 1000);
    }
}"
     data-orders-poll data-last-order-id="{{ $orders->isNotEmpty() ? $orders->first()->id : 0 }}" data-last-order-at="{{ $orders->isNotEmpty() ? $orders->first()->created_at->toIso8601String() : now()->toIso8601String() }}" data-poll-url="{{ route('store.orders.index') }}" data-poll-q="{{ request('q') }}" data-poll-status="{{ request('status') }}">
    <header class="pos-orders-header">
        <div style="display: flex; align-items: center; gap: 20px;">
            <a href="{{ route('store.pos.index') }}" style="display: flex; align-items: center; gap: 12px; text-decoration: none; color: inherit;">
                <div class="pos-logo">☕</div>
                <h1 style="font-size: 1.25rem; font-weight: 700; margin: 0;">DrDrink</h1>
            </a>
            <div class="pos-mode-tabs">
                <a href="{{ route('store.pos.index') }}" class="pos-mode-tab">Hızlı Satış</a>
                <span class="pos-mode-tab active">Paket Sipariş</span>
            </div>
        </div>
        <div style="display: flex; align-items: center; gap: 16px; font-size: 0.875rem; color: var(--pos-text-muted);">
            <span class="pos-time" style="font-variant-numeric: tabular-nums; font-weight: 500; color: var(--pos-text);" x-text="clock"></span>
            <span x-text="dateStr"></span>
            <span>{{ $store->name ?? '' }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;" onsubmit="this.querySelector('button').disabled=true">
                @csrf
                <button type="submit" style="background: none; border: 1px solid var(--pos-border); color: var(--pos-text-muted); padding: 6px 12px; border-radius: 8px; cursor: pointer; font-size: 0.875rem;">Çıkış</button>
            </form>
        </div>
    </header>

    <div id="new-order-alert-banner" class="hidden" style="margin: 16px 24px 0; padding: 16px 20px; background: rgba(34, 197, 94, 0.15); border: 1px solid rgba(34, 197, 94, 0.3); border-radius: 12px; display: flex; align-items: center; gap: 12px; color: #22c55e;">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <span class="font-semibold">Yeni paket sipariş geldi! Liste güncellendi.</span>
    </div>

    <div class="pos-orders-content">
        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 20px;">
            <h2 style="font-size: 1.5rem; font-weight: 700; margin: 0;">Paket Sipariş</h2>
            <form action="{{ route('store.orders.index') }}" method="GET" style="display: flex; gap: 10px;">
                <input type="hidden" name="status" value="{{ request('status') }}">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="İsim, soyisim veya sipariş no ara..." class="pos-orders-input" style="width: 200px;">
                <button type="submit" class="pos-btn pos-btn-primary" style="width: auto; padding: 10px 20px;">Ara</button>
            </form>
        </div>

        <div class="pos-orders-card">
            <div style="overflow-x: auto;">
                <table class="pos-orders-table">
                    <thead>
                        <tr>
                            <th>Sipariş No</th>
                            <th>Müşteri</th>
                            <th>Toplam</th>
                            <th>Durum</th>
                            <th>Ödeme</th>
                            <th class="pos-date-cell">Tarih</th>
                            <th style="text-align: right; width: 100px;">İşlem</th>
                        </tr>
                    </thead>
                    <tbody id="orders-tbody">
                        @include('store.orders._table')
                    </tbody>
                </table>
            </div>
            <div id="orders-pagination" style="padding: 16px 20px; border-top: 1px solid var(--pos-border); background: var(--pos-bg-secondary);">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function() {
    var pollEl = document.querySelector('[data-orders-poll]');
    if (!pollEl) return;
    var lastId = parseInt(pollEl.dataset.lastOrderId || '0', 10) || 0;
    var lastCheck = pollEl.dataset.lastOrderAt || new Date().toISOString();
    var skipFirst = true;
    function poll() {
        var base = pollEl.dataset.pollUrl || '{{ route("store.orders.index") }}';
        var q = pollEl.dataset.pollQ || '';
        var status = pollEl.dataset.pollStatus || '';
        var params = new URLSearchParams();
        if (lastId) params.set('last_id', lastId); else params.set('last_check', lastCheck);
        if (q) params.set('q', q);
        if (status) params.set('status', status);
        var url = base + (base.includes('?') ? '&' : '?') + params.toString();
        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function(r) { return r.json(); })
            .then(function(d) {
                var newLastId = d.last_order_id != null ? d.last_order_id : lastId;
                var hasNewOrder = !skipFirst && newLastId > lastId;
                if (skipFirst) skipFirst = false;
                if (d.tbody) {
                    var tb = document.getElementById('orders-tbody');
                    if (tb) tb.innerHTML = d.tbody;
                    var p = document.getElementById('orders-pagination');
                    if (p && d.pagination) p.innerHTML = d.pagination;
                }
                if (hasNewOrder) {
                    var banner = document.getElementById('new-order-alert-banner');
                    if (banner) { banner.classList.remove('hidden'); setTimeout(function(){ banner.classList.add('hidden'); }, 5000); }
                }
                if (d.last_order_id != null) lastId = d.last_order_id;
            })
            .catch(function() {});
    }
    setInterval(poll, 2000);
    setTimeout(poll, 500);
})();
</script>
@endpush
@endsection
