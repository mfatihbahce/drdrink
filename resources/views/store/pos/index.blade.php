@extends('store.layouts.pos')

@section('title', 'Satış Ekranı')

@section('content')
@php
    $categoriesWithProducts = $categories->filter(fn($c) => $c->products->isNotEmpty());
    $categoriesJson = $categoriesWithProducts->map(fn($c) => [
        'id' => $c->id,
        'name' => $c->name,
        'products' => $c->products->map(fn($p) => [
            'id' => $p->id,
            'name' => $p->name,
            'price' => (float) $p->price,
        ])->values()->toArray(),
    ])->values()->toJson();
    $cartJson = json_encode([
        'items' => array_map(fn($i) => [
            'product_id' => $i['product']->id,
            'name' => $i['product']->name,
            'price' => (float) $i['product']->price,
            'quantity' => $i['quantity'],
            'total' => (float) $i['total'],
        ], $cartData['items'] ?? []),
        'subtotal' => (float) ($cartData['subtotal'] ?? 0),
        'count' => (int) ($cartData['count'] ?? 0),
    ]);
@endphp

<div class="pos-app" x-data="posApp({{ $categoriesJson }}, {{ $cartJson }})" x-init="init()">
    <header class="pos-header">
        <div class="pos-header-left">
            <div class="pos-brand">
                <div class="pos-logo">☕</div>
                <h1>DrDrink</h1>
            </div>
            <div class="pos-mode-tabs">
                <button type="button" class="pos-mode-tab active">Hızlı Satış</button>
                <a href="{{ route('store.orders.index') }}" class="pos-mode-tab">Paket Sipariş</a>
            </div>
        </div>
        <div class="pos-header-meta">
            <span class="pos-time" x-text="clock"></span>
            <span x-text="dateStr"></span>
            <span>{{ $store->name ?? '' }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;" onsubmit="this.querySelector('button').disabled=true">
                @csrf
                <button type="submit" style="background: none; border: 1px solid var(--pos-border); color: var(--pos-text-muted); padding: 6px 12px; border-radius: 8px; cursor: pointer; font-size: 0.875rem;">Çıkış</button>
            </form>
        </div>
    </header>

    <main class="pos-main">
        <div class="pos-categories">
            <template x-for="(cat, idx) in categories" :key="cat.id">
                <button type="button" class="pos-cat-btn" :class="{ 'active': activeCategoryId === cat.id }"
                        @click="activeCategoryId = cat.id">
                    <span x-text="cat.name"></span>
                </button>
            </template>
        </div>
        <div class="pos-products-wrap">
            <div class="pos-products-grid">
                <template x-for="product in activeProducts" :key="product.id">
                    <button type="button" class="pos-product-card" @click="addProduct(product.id)">
                        <span class="icon">☕</span>
                        <span class="name" x-text="product.name"></span>
                        <span class="price" x-text="formatPrice(product.price) + ' ₺'"></span>
                    </button>
                </template>
            </div>
        </div>
    </main>

    <aside class="pos-cart-panel">
        <div class="pos-cart-header">
            <h2>Sepet</h2>
            <span class="pos-cart-count" x-text="cart.count + ' ürün'"></span>
        </div>
        <div class="pos-cart-list">
            <div class="pos-cart-empty" x-show="cart.count === 0">
                <span class="empty-icon">🛒</span>
                <p>Henüz ürün eklenmedi.<br>Ürünlere tıklayarak sepete ekleyin.</p>
            </div>
            <template x-for="item in cart.items" :key="item.product_id">
                <div class="pos-cart-item">
                    <span class="item-name" x-text="item.name"></span>
                    <div class="item-qty">
                        <button type="button" class="qty-btn" @click="updateQty(item.product_id, item.quantity - 1)">−</button>
                        <span class="qty-num" x-text="item.quantity"></span>
                        <button type="button" class="qty-btn" @click="updateQty(item.product_id, item.quantity + 1)">+</button>
                    </div>
                    <span class="item-total" x-text="formatPrice(item.total) + ' ₺'"></span>
                </div>
            </template>
        </div>
        <div class="pos-cart-footer">
            <div class="pos-cart-row">
                <span class="label">Ara toplam</span>
                <span class="value" x-text="formatPrice(cart.subtotal) + ' ₺'"></span>
            </div>
            <div class="pos-cart-row highlight">
                <span class="label">Toplam</span>
                <span class="value" x-text="formatPrice(cart.subtotal) + ' ₺'"></span>
            </div>
            <div class="pos-cart-actions">
                <button type="button" class="pos-btn pos-btn-primary" :disabled="cart.count === 0 || loading"
                        @click="openPaymentModal()">
                    <span x-show="!loading">Ödemeyi Tamamla</span>
                    <span x-show="loading" class="flex items-center gap-2">
                        <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        İşleniyor...
                    </span>
                </button>
                <button type="button" class="pos-btn pos-btn-secondary" @click="clearCart()">Sepeti Temizle</button>
            </div>
        </div>
    </aside>

    <!-- Ödeme modalı - pos-app içinde olmalı (Alpine scope) -->
    <div class="pos-modal-overlay" :class="{ 'open': paymentModalOpen }" @click.self="paymentModalOpen = false">
    <div class="pos-modal">
        <div class="pos-modal-header">
            <h3>Ödeme</h3>
            <button type="button" class="pos-modal-close" @click="paymentModalOpen = false" aria-label="Kapat">×</button>
        </div>
        <div class="pos-modal-body">
            <div class="pos-payment-summary">
                <div class="row">
                    <span>Ara toplam</span>
                    <span x-text="formatPrice(cart.subtotal) + ' ₺'"></span>
                </div>
                <div class="pos-form-group">
                    <label>İndirim</label>
                    <div class="pos-discount-options">
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'none' }" @click="setDiscount('none')">Yok</button>
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'pct' && paymentDiscountValue === 5 }" @click="setDiscount('pct', 5)">%5</button>
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'pct' && paymentDiscountValue === 10 }" @click="setDiscount('pct', 10)">%10</button>
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'pct' && paymentDiscountValue === 15 }" @click="setDiscount('pct', 15)">%15</button>
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'pct' && paymentDiscountValue === 20 }" @click="setDiscount('pct', 20)">%20</button>
                        <button type="button" class="pos-discount-opt" :class="{ 'active': paymentDiscountType === 'fixed' }" @click="setDiscount('fixed')">Sabit (₺)</button>
                    </div>
                    <div class="pos-form-group" x-show="paymentDiscountType === 'fixed'" x-transition style="margin-top:10px">
                        <label>Sabit indirim (₺)</label>
                        <input type="number" x-model.number="paymentDiscountFixed" min="0" step="0.01" placeholder="0,00" @input="recalcPayment()">
                    </div>
                </div>
                <div class="row">
                    <span>İndirim tutarı</span>
                    <span x-text="formatPrice(paymentDiscountAmount) + ' ₺'"></span>
                </div>
                <div class="row final">
                    <span>Ödenecek</span>
                    <span x-text="formatPrice(paymentFinalAmount) + ' ₺'"></span>
                </div>
            </div>
            <div class="pos-form-group">
                <label>Ödeme bölüşümü</label>
                <template x-for="(split, idx) in paymentSplits" :key="idx">
                    <div class="pos-split-item">
                        <select x-model="split.method" class="split-method">
                            <template x-for="m in paymentMethods" :key="m.value">
                                <option :value="m.value" x-text="m.label"></option>
                            </template>
                        </select>
                        <input type="number" x-model.number="split.amount" min="0" step="0.01" placeholder="0,00" @input="recalcPayment()">
                        <button type="button" class="remove-split" @click="removePaymentSplit(idx)" title="Kaldır">×</button>
                    </div>
                </template>
                <button type="button" class="pos-add-split" @click="addPaymentSplit()">+ Ödeme ekle</button>
                <div class="pos-payment-total-row" :class="paymentSplitTotal >= paymentFinalAmount && paymentSplitTotal > 0 ? 'ok' : 'missing'">
                    <span>Toplam ödeme</span>
                    <span x-text="formatPrice(paymentSplitTotal) + ' ₺'"></span>
                </div>
            </div>
        </div>
        <div class="pos-modal-footer">
            <button type="button" class="pos-btn pos-btn-primary" :disabled="paymentSplitTotal < paymentFinalAmount || paymentSplitTotal <= 0 || paymentModalLoading"
                    @click="completeSaleFromModal()">
                <span x-show="!paymentModalLoading">Ödemeyi Tamamla</span>
                <span x-show="paymentModalLoading" class="flex items-center gap-2">
                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    İşleniyor...
                </span>
            </button>
        </div>
    </div>
    </div>

    <!-- Başarı toast (alert yerine) -->
    <div class="pos-success-overlay" :class="{ 'open': successToastOpen }" @click="closeSuccessToast()"></div>
    <div class="pos-success-toast" :class="{ 'open': successToastOpen }">
        <div class="icon-wrap">✓</div>
        <h3>Satış Tamamlandı</h3>
        <div class="order-no" x-text="successOrderNumber ? 'Sipariş No: ' + successOrderNumber : ''"></div>
        <button type="button" class="pos-btn pos-btn-primary" @click="closeSuccessToast()">Tamam</button>
    </div>
</div>

@push('scripts')
<script>
const PAYMENT_METHODS = [
    { value: 'nakit', label: 'Nakit' },
    { value: 'kart', label: 'Kredi/Banka Kartı' },
    { value: 'yemek_karti', label: 'Yemek Kartı' },
    { value: 'diger', label: 'Diğer' }
];

function posApp(categoriesData, initialCart) {
    return {
        categories: categoriesData,
        activeCategoryId: categoriesData[0]?.id ?? null,
        cart: { items: initialCart.items, subtotal: initialCart.subtotal, count: initialCart.count },
        loading: false,
        clock: '--:--:--',
        dateStr: '',
        paymentModalOpen: false,
        paymentModalLoading: false,
        paymentDiscountType: 'none',
        paymentDiscountValue: 0,
        paymentDiscountFixed: 0,
        paymentSplits: [{ method: 'nakit', amount: 0 }],
        paymentMethods: PAYMENT_METHODS,
        successToastOpen: false,
        successOrderNumber: '',

        get activeProducts() {
            const cat = this.categories.find(c => c.id === this.activeCategoryId);
            return cat ? cat.products : [];
        },

        get paymentDiscountAmount() {
            const sub = this.cart.subtotal || 0;
            if (this.paymentDiscountType === 'pct') return (sub * (this.paymentDiscountValue || 0)) / 100;
            if (this.paymentDiscountType === 'fixed') return Math.min(this.paymentDiscountFixed || 0, sub);
            return 0;
        },

        get paymentFinalAmount() {
            return Math.max(0, (this.cart.subtotal || 0) - this.paymentDiscountAmount);
        },

        get paymentSplitTotal() {
            return (this.paymentSplits || []).reduce((s, p) => s + (Number(p.amount) || 0), 0);
        },

        init() {
            if (this.categories.length && !this.activeCategoryId) this.activeCategoryId = this.categories[0].id;
            this.updateClock();
            setInterval(() => this.updateClock(), 1000);
        },

        updateClock() {
            const now = new Date();
            this.clock = now.toLocaleTimeString('tr-TR', { hour12: false });
            this.dateStr = now.toLocaleDateString('tr-TR', { weekday: 'short', day: 'numeric', month: 'short' });
        },

        formatPrice(n) {
            return Number(n).toLocaleString('tr-TR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        },

        openPaymentModal() {
            if (this.cart.count === 0 || this.loading) return;
            this.paymentDiscountType = 'none';
            this.paymentDiscountValue = 0;
            this.paymentDiscountFixed = 0;
            this.paymentSplits = [{ method: 'nakit', amount: this.cart.subtotal || 0 }];
            this.paymentModalOpen = true;
        },

        setDiscount(type, value) {
            this.paymentDiscountType = type;
            this.paymentDiscountValue = value || 0;
            if (type !== 'fixed') this.paymentDiscountFixed = 0;
            this.recalcPayment();
        },

        recalcPayment() {
            const final = this.paymentFinalAmount;
            if (this.paymentSplits.length === 1) {
                this.paymentSplits = [{ ...this.paymentSplits[0], amount: final }];
            }
        },

        addPaymentSplit() {
            this.paymentSplits.push({ method: 'nakit', amount: 0 });
        },

        removePaymentSplit(idx) {
            if (this.paymentSplits.length > 1) this.paymentSplits.splice(idx, 1);
        },

        closeSuccessToast() {
            this.successToastOpen = false;
            window.location.reload();
        },

        addProduct(productId) {
            fetch('{{ route("store.pos.cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ product_id: productId, quantity: 1 })
            })
            .then(r => r.json())
            .then(d => { if (d.success) this.cart = d.cart; });
        },

        updateQty(productId, qty) {
            if (qty < 1) return this.removeProduct(productId);
            fetch('{{ route("store.pos.cart.update") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ product_id: productId, quantity: qty })
            })
            .then(r => r.json())
            .then(d => { if (d.success) this.cart = d.cart; });
        },

        removeProduct(productId) {
            fetch('{{ route("store.pos.cart.remove") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(r => r.json())
            .then(d => { if (d.success) this.cart = d.cart; });
        },

        clearCart() {
            if (this.cart.count === 0) return;
            fetch('{{ route("store.pos.cart.clear") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({})
            })
            .then(r => r.json())
            .then(d => { if (d.success) this.cart = d.cart; });
        },

        completeSaleFromModal() {
            const totalPaid = this.paymentSplitTotal;
            const final = this.paymentFinalAmount;
            if (totalPaid < final || totalPaid <= 0) {
                alert('Ödeme tutarı yetersiz. Ödenecek: ' + this.formatPrice(final) + ' ₺');
                return;
            }
            this.paymentModalLoading = true;
            const payments = this.paymentSplits
                .filter(p => (Number(p.amount) || 0) > 0)
                .map(p => ({ method: p.method, amount: Number(p.amount) }));
            if (payments.length === 0) {
                this.paymentModalLoading = false;
                alert('En az bir ödeme yöntemi girin.');
                return;
            }
            fetch('{{ route("store.pos.complete") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({
                    customer_name: 'Mağaza Müşterisi',
                    discount_type: this.paymentDiscountType,
                    discount_value: this.paymentDiscountType === 'pct' ? this.paymentDiscountValue : this.paymentDiscountFixed,
                    payments: payments
                })
            })
            .then(r => r.json())
            .then(d => {
                this.paymentModalLoading = false;
                if (d.success) {
                    this.paymentModalOpen = false;
                    this.cart = { items: [], subtotal: 0, count: 0 };
                    this.successOrderNumber = d.order_number;
                    this.successToastOpen = true;
                } else {
                    alert(d.message || 'Bir hata oluştu.');
                }
            })
            .catch(() => { this.paymentModalLoading = false; alert('Bir hata oluştu.'); });
        }
    };
}
</script>
@endpush
@endsection
