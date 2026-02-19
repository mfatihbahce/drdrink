@extends('layouts.frontend')

@section('title', $city->name . ' - Ürünler - DrDrink')

@section('content')
@php $categoriesWithProducts = $categories->filter(fn($c) => $c->products->isNotEmpty()); $firstCategoryId = $categoriesWithProducts->first()?->id; @endphp
<section class="pt-6 sm:pt-8 px-4 sm:px-6 lg:px-12 {{ ($cartData['count'] ?? 0) > 0 ? 'pb-32 lg:pb-24' : 'pb-24' }}"
         x-data="{ selectedCategory: {{ $firstCategoryId ?? 'null' }} }"
         x-init="
           const h = window.location.hash;
           if (h && h.startsWith('#category-')) { const id = parseInt(h.replace('#category-', '')); if (!isNaN(id)) selectedCategory = id; }
           $watch('selectedCategory', v => { if (v) history.replaceState(null, '', '#category-' + v); });
         ">
    <div class="max-w-7xl mx-auto">
        {{-- Page header --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6 sm:mb-8">
            <div>
                <a href="{{ route('city.select') }}" class="text-amber-600 text-sm font-medium hover:text-amber-500 transition inline-flex items-center gap-1.5 mb-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    İl değiştir
                </a>
                <h1 class="font-display text-2xl sm:text-4xl lg:text-5xl font-light tracking-tight text-gray-900">{{ $city->name }}</h1>
                <p class="text-gray-500 text-sm mt-1">Ürünler</p>
                @if(($minOrderAmount ?? 0) > 0)
                    <p class="text-amber-600 text-sm font-medium mt-2">Minimum sipariş tutarı: {{ number_format($minOrderAmount, 2) }} ₺</p>
                @endif
            </div>
            <a href="{{ route('cart.index') }}" class="flex items-center justify-center gap-2.5 bg-amber-500 text-black px-5 py-3 sm:px-6 sm:py-3.5 rounded-xl font-medium hover:bg-amber-400 transition shadow-lg shadow-amber-500/20 w-full sm:w-auto min-h-[48px] sm:min-h-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                <span>Sepet</span>
                @if(($cartData['count'] ?? 0) > 0)
                    <span class="bg-black/20 text-black px-2 py-0.5 rounded-full text-xs font-bold">{{ $cartData['count'] }}</span>
                @endif
            </a>
        </div>

        {{-- Sabit yatay kategori listesi --}}
        @if($categoriesWithProducts->count() > 0)
            <div class="sticky top-[65px] sm:top-[73px] z-30 -mx-4 sm:-mx-6 lg:-mx-12 px-4 sm:px-6 lg:px-12 py-3 sm:py-4 mb-6 sm:mb-8 bg-white/95 backdrop-blur-md border-b border-gray-200 shadow-sm">
                <div class="overflow-x-auto scrollbar-hide overscroll-x-contain" style="-webkit-overflow-scrolling: touch;">
                    <div class="flex gap-2 sm:gap-3 min-w-max sm:min-w-0 sm:flex-wrap">
                        @foreach($categoriesWithProducts as $category)
                            <button type="button"
                                    @click="selectedCategory = {{ $category->id }}"
                                    :class="selectedCategory === {{ $category->id }} ? 'bg-amber-500 text-black' : 'bg-gray-100 text-gray-700 hover:bg-gray-200'"
                                    class="inline-flex items-center px-4 py-2.5 sm:px-5 sm:py-3 rounded-xl font-medium text-sm sm:text-base transition whitespace-nowrap min-h-[44px] sm:min-h-0 touch-manipulation">
                                {{ $category->name }}
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @foreach($categories as $category)
            @if($category->products->isNotEmpty())
                <div x-show="selectedCategory === {{ $category->id }}"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-cloak
                     class="mb-12 sm:mb-16 reveal">
                    <h2 class="text-base sm:text-lg font-medium text-gray-700 tracking-wide mb-4 sm:mb-6 flex items-center gap-3">
                        <span class="w-1 h-5 sm:h-6 bg-amber-500 rounded-full shrink-0"></span>
                        {{ $category->name }}
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-5 lg:gap-6">
                        @foreach($category->products as $product)
                            {{-- Mobil: yatay kart | Masaüstü: dikey kart --}}
                            <div class="group relative bg-white rounded-xl sm:rounded-2xl border border-gray-200 hover:border-amber-300 active:border-amber-400 overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-amber-500/10 sm:hover:-translate-y-1 active:scale-[0.99] flex sm:flex-col">
                                {{-- Image area --}}
                                <div class="sm:aspect-[4/3] w-24 h-24 sm:w-full sm:h-auto shrink-0 relative overflow-hidden bg-gradient-to-br from-amber-50 to-white">
                                    @if($product->image)
                                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-3xl sm:text-6xl opacity-40 group-hover:opacity-60 transition-opacity duration-300">☕</span>
                                        </div>
                                    @endif
                                    <div class="absolute inset-0 bg-gradient-to-t from-white/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 sm:block hidden"></div>
                                </div>

                                {{-- Content --}}
                                <div class="flex-1 flex flex-col min-w-0 p-3 sm:p-4 lg:p-6">
                                    <h3 class="font-display text-base sm:text-xl font-medium mb-0.5 sm:mb-1.5 text-gray-900 line-clamp-2">{{ $product->name }}</h3>
                                    <p class="text-amber-600 font-semibold text-sm sm:text-lg mb-2 sm:mb-4">{{ number_format($product->price, 2) }} ₺</p>

                                    <form action="{{ route('cart.add') }}" method="POST" class="flex gap-2 mt-auto" x-data="{ qty: 1 }">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" :value="qty">
                                        <div class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50 shrink-0">
                                            <button type="button" @click="qty = Math.max(1, qty - 1)" class="p-2.5 sm:px-3 sm:py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 active:bg-gray-200 transition min-h-[40px] min-w-[40px] sm:min-h-[44px] sm:min-w-[44px] flex items-center justify-center touch-manipulation">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                            </button>
                                            <span class="px-2 sm:px-4 py-1.5 sm:py-2 min-w-[1.75rem] sm:min-w-[2rem] text-center font-medium text-gray-900 text-sm" x-text="qty"></span>
                                            <button type="button" @click="qty = qty + 1" class="p-2.5 sm:px-3 sm:py-2.5 text-gray-600 hover:text-gray-900 hover:bg-gray-100 active:bg-gray-200 transition min-h-[40px] min-w-[40px] sm:min-h-[44px] sm:min-w-[44px] flex items-center justify-center touch-manipulation">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            </button>
                                        </div>
                                        <button type="submit" class="product-card-add flex-1 bg-amber-500 text-black py-2 sm:py-2.5 px-3 sm:px-4 rounded-lg font-medium text-sm hover:bg-amber-400 active:bg-amber-600 transition flex items-center justify-center gap-1.5 sm:gap-2 min-h-[40px] sm:min-h-[44px] touch-manipulation">
                                            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                                            <span>Ekle</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</section>

{{-- Mobile sticky cart --}}
@if(($cartData['count'] ?? 0) > 0)
<div class="fixed bottom-0 left-0 right-0 z-40 p-4 bg-white/95 backdrop-blur-lg border-t border-gray-200 shadow-[0_-4px_20px_rgba(0,0,0,0.08)] lg:hidden">
    <a href="{{ route('cart.index') }}" class="flex items-center justify-between w-full bg-amber-500 text-black py-4 px-6 rounded-xl font-semibold">
        <span class="flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            Sepete Git
        </span>
        <span>{{ $cartData['count'] }} ürün · {{ number_format($cartData['subtotal'] ?? 0, 2) }} ₺</span>
    </a>
</div>
@endif
@endsection
