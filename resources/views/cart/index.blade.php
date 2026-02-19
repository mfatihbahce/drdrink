@extends('layouts.frontend')

@section('title', 'Sepetim - DrDrink')

@section('content')
<section class="pt-6 sm:pt-8 pb-24 px-4 sm:px-6 lg:px-8 xl:px-12">
    <div class="w-full max-w-7xl mx-auto">
        <div class="mb-6 sm:mb-8 lg:mb-10">
            <h1 class="font-display text-2xl sm:text-3xl lg:text-4xl font-light tracking-tight text-gray-900">Sepetim</h1>
            <p class="text-gray-500 text-sm mt-1">{{ $cartData['count'] ?? 0 }} adet ürün</p>
        </div>

        @if(empty($cartData['items']))
            <div class="relative overflow-hidden bg-white rounded-2xl sm:rounded-3xl border border-gray-200 shadow-sm p-8 sm:p-16 lg:p-20 text-center">
                <div class="absolute inset-0 bg-[radial-gradient(ellipse_80%_50%_at_50%_-20%,rgba(245,158,11,0.08),transparent)] pointer-events-none"></div>
                <div class="relative">
                    <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-amber-50 flex items-center justify-center">
                        <svg class="w-10 h-10 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h2 class="font-display text-lg sm:text-xl font-medium text-gray-900 mb-2">Sepetiniz boş</h2>
                    <p class="text-gray-500 text-sm max-w-sm mx-auto mb-6 sm:mb-8">Lezzetli kahveler ve içecekler sizi bekliyor. Sipariş vermeye başlayın.</p>
                    <a href="{{ route('city.select') }}" class="inline-flex items-center justify-center gap-2 bg-amber-500 text-black px-6 py-3.5 sm:px-8 rounded-xl font-medium hover:bg-amber-400 transition shadow-lg shadow-amber-500/20 w-full sm:w-auto min-h-[48px]">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Sipariş Vermeye Başla
                    </a>
                </div>
            </div>
        @else
            <div class="flex flex-col gap-6 lg:grid lg:grid-cols-[1fr_360px] xl:grid-cols-[1fr_400px] lg:gap-10 xl:gap-12 lg:items-start">
                {{-- Cart items --}}
                <div class="space-y-3 sm:space-y-4">
                    @foreach($cartData['items'] as $item)
                        <div class="group bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm hover:shadow transition-all duration-200">
                            <div class="flex flex-row gap-4 sm:gap-6 p-4 sm:p-5">
                                {{-- Product image --}}
                                <div class="w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 shrink-0 rounded-lg overflow-hidden bg-gradient-to-br from-amber-50 to-gray-50 flex items-center justify-center">
                                    @if($item['product']->image)
                                        <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-full h-full object-cover">
                                    @else
                                        <span class="text-2xl sm:text-3xl lg:text-4xl opacity-40 group-hover:opacity-60 transition-opacity">☕</span>
                                    @endif
                                </div>
                                {{-- Product info & actions --}}
                                <div class="flex-1 min-w-0 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4">
                                    <div class="min-w-0">
                                        <h3 class="font-display text-base sm:text-lg font-semibold text-gray-900 line-clamp-2">{{ $item['product']->name }}</h3>
                                        <p class="text-amber-600 font-medium text-sm mt-0.5">{{ number_format($item['product']->price, 2) }} ₺ <span class="text-gray-400 font-normal">/ adet</span></p>
                                    </div>
                                    <div class="flex items-center justify-between sm:justify-end gap-3 sm:gap-6 flex-wrap sm:flex-nowrap">
                                        {{-- Quantity stepper --}}
                                        <form action="{{ route('cart.update') }}" method="POST" class="flex items-center rounded-lg overflow-hidden border border-gray-200 bg-gray-50/80" x-data="{ qty: {{ $item['quantity'] }} }">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item['product']->id }}">
                                            <input type="hidden" name="quantity" :value="qty">
                                            <button type="button" @click="if(qty>1){qty--}" class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition touch-manipulation">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                            </button>
                                            <span class="w-8 sm:w-10 text-center text-sm font-semibold text-gray-900" x-text="qty"></span>
                                            <button type="button" @click="qty++" class="w-9 h-9 sm:w-10 sm:h-10 flex items-center justify-center text-gray-600 hover:bg-gray-100 active:bg-gray-200 transition touch-manipulation">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            </button>
                                            <button type="submit" class="px-3 sm:px-4 py-2 text-xs sm:text-sm font-medium text-amber-600 hover:bg-amber-50 border-l border-gray-200 h-9 sm:h-10 transition touch-manipulation">Güncelle</button>
                                        </form>
                                        <div class="flex items-center gap-2">
                                            <span class="font-bold text-gray-900 text-base sm:text-lg">{{ number_format($item['total'], 2) }} ₺</span>
                                            <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST" onsubmit="return confirm('Bu ürünü sepetten kaldırmak istediğinize emin misiniz?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition touch-manipulation min-w-[40px] min-h-[40px] flex items-center justify-center" title="Kaldır">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Order summary (sticky) - Profesyonel tasarım --}}
                <div class="lg:sticky lg:top-28">
                    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                            <h2 class="font-semibold text-gray-900">Sipariş Özeti</h2>
                            <p class="text-xs text-gray-500 mt-0.5">{{ $cartData['count'] ?? 0 }} ürün · {{ $city->name }}</p>
                        </div>
                        <div class="p-5 space-y-3">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Ara Toplam</span>
                                <span class="font-medium text-gray-900">{{ number_format($cartData['subtotal'], 2) }} ₺</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-500">Kurye Ücreti</span>
                                <span class="text-gray-700">{{ number_format($deliveryFee ?? 15, 2) }} ₺</span>
                            </div>
                            @if($minOrderAmount > 0)
                            <div class="flex justify-between text-sm pt-2 border-t border-gray-100">
                                <span class="text-gray-500">Minimum sipariş</span>
                                <span class="font-medium {{ $meetsMinimum ? 'text-emerald-600' : 'text-amber-600' }}">{{ number_format($minOrderAmount, 2) }} ₺</span>
                            </div>
                            @endif
                            <div class="flex justify-between items-center pt-3 border-t border-gray-200">
                                <span class="font-semibold text-gray-900">Toplam</span>
                                <span class="text-xl font-bold text-gray-900">{{ number_format($estimatedTotal ?? $cartData['subtotal'], 2) }} ₺</span>
                            </div>
                        </div>
                        <div class="p-5 pt-0 space-y-3">
                            @if($meetsMinimum ?? true)
                            <a href="{{ route('checkout.index') }}" class="flex items-center justify-center gap-2 w-full bg-amber-500 text-black py-3.5 rounded-lg font-semibold text-sm hover:bg-amber-400 active:bg-amber-600 transition min-h-[48px] touch-manipulation">
                                Ödemeye Geç
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </a>
                            @else
                            <div class="bg-amber-50 border border-amber-200/60 rounded-lg p-3">
                                <p class="text-xs text-amber-800 font-medium">Minimum tutara ulaşmadınız</p>
                                <p class="text-xs text-amber-700 mt-0.5">{{ number_format($minOrderAmount - $estimatedTotal, 2) }} ₺ daha ekleyin.</p>
                            </div>
                            <button type="button" disabled class="flex items-center justify-center gap-2 w-full bg-gray-100 text-gray-400 py-3.5 rounded-lg font-medium text-sm cursor-not-allowed">
                                Ödemeye Geç
                            </button>
                            @endif
                            <a href="{{ route('city.select') }}" class="flex items-center justify-center gap-1.5 py-2.5 text-xs text-gray-500 hover:text-amber-600 transition">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Alışverişe devam et
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection
