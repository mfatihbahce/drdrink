@extends('layouts.frontend')

@section('title', 'Ödeme - DrDrink')

@section('content')
<section class="pt-32 pb-24 px-6 lg:px-12">
    <div class="w-full max-w-7xl mx-auto">
        <div class="mb-10">
            <h1 class="font-display text-3xl sm:text-4xl font-light tracking-tight text-gray-900">Ödeme</h1>
            <p class="text-gray-500 text-sm mt-1">Siparişinizi tamamlamak için bilgilerinizi kontrol edin</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                {{-- Form section --}}
                <div class="flex-1 space-y-6">
                    {{-- Customer info --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="font-display text-lg font-medium text-gray-900">Teslimat Bilgileri</h2>
                        </div>
                        <div class="p-6 space-y-5">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Ad Soyad</label>
                                <input type="text" name="customer_name" value="{{ auth()->user()->name }}" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none transition">
                                @error('customer_name')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Telefon: <span class="font-medium text-gray-900">{{ auth()->user()->phone ?? '—' }}</span></p>
                                <p class="text-xs text-gray-400 mt-1">Kayıtlı profil numaranız kullanılacak</p>
                            </div>
                        </div>
                    </div>

                    {{-- Delivery address --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="font-display text-lg font-medium text-gray-900">Teslimat Adresi</h2>
                        </div>
                        <div class="p-6 space-y-3">
                            @if($addresses->isNotEmpty())
                                @php $defaultAddr = $addresses->first(fn($a) => $a->is_default) ?? $addresses->first(); @endphp
                                <div class="space-y-2">
                                    @foreach($addresses as $addr)
                                        <label class="flex items-start gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all duration-200 has-[:checked]:border-amber-500 has-[:checked]:bg-amber-50/30 hover:border-gray-300">
                                            <input type="radio" name="address_id" value="{{ $addr->id }}" {{ old('address_id', $defaultAddr->id) == $addr->id ? 'checked' : '' }} class="mt-1.5 w-4 h-4 text-amber-500 focus:ring-amber-500 border-gray-300">
                                            <div class="flex-1 min-w-0">
                                                <span class="font-medium text-gray-900">{{ $addr->title }}</span>
                                                @if($addr->is_default)<span class="ml-2 text-xs font-medium text-amber-600 bg-amber-100 px-2 py-0.5 rounded-full">Varsayılan</span>@endif
                                                <p class="text-sm text-gray-600 mt-1 leading-relaxed">{{ $addr->full_address }}</p>
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            @else
                                <textarea name="address" rows="4" required class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none resize-none" placeholder="Mahalle, sokak, bina no, daire...">{{ old('address') }}</textarea>
                            @endif
                            @error('address')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                            <p class="text-sm"><a href="{{ route('addresses.index') }}" class="text-amber-600 hover:text-amber-500 font-medium">Adreslerinizi yönetin →</a></p>
                        </div>
                    </div>

                    {{-- Order notes --}}
                    <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sipariş Notu (Opsiyonel)</label>
                            <textarea name="notes" rows="3" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-2 focus:ring-amber-500/20 focus:outline-none resize-none" placeholder="Örn: Kapı zili çalışmıyor, lütfen arayın..."></textarea>
                        </div>
                    </div>
                </div>

                {{-- Order summary (sticky) --}}
                <div class="lg:w-96 shrink-0">
                    <div class="lg:sticky lg:top-28 bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="font-display text-lg font-medium text-gray-900">Sipariş Özeti</h2>
                        </div>
                        <div class="p-6">
                            <div class="space-y-4 mb-6">
                                @foreach($cartData['items'] as $item)
                                    <div class="flex gap-4">
                                        @if($item['product']->image)
                                            <img src="{{ asset('storage/' . $item['product']->image) }}" alt="{{ $item['product']->name }}" class="w-14 h-14 rounded-lg object-cover shrink-0">
                                        @else
                                            <div class="w-14 h-14 rounded-lg bg-amber-50 flex items-center justify-center shrink-0">
                                                <span class="text-2xl opacity-40">☕</span>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p class="font-medium text-gray-900 truncate">{{ $item['product']->name }}</p>
                                            <p class="text-sm text-gray-500">x {{ $item['quantity'] }}</p>
                                        </div>
                                        <p class="font-medium text-gray-900 shrink-0">{{ number_format($item['total'], 2) }} ₺</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="space-y-3 pt-4 border-t border-gray-100">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Ara Toplam</span>
                                    <span class="text-gray-900">{{ number_format($cartData['subtotal'], 2) }} ₺</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Kurye Ücreti</span>
                                    <span class="text-gray-900">{{ number_format($deliveryFee, 2) }} ₺</span>
                                </div>
                                <div class="flex justify-between pt-3 border-t border-gray-100">
                                    <span class="font-display text-lg font-medium text-gray-900">Toplam</span>
                                    <span class="font-display text-xl font-semibold text-amber-600">{{ number_format($total, 2) }} ₺</span>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 pt-0">
                            <button type="submit" class="flex items-center justify-center gap-2 w-full bg-amber-500 text-black py-4 rounded-xl font-medium hover:bg-amber-400 transition shadow-lg shadow-amber-500/20">
                                Siparişi Tamamla
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                            </button>
                            <a href="{{ route('cart.index') }}" class="flex items-center justify-center gap-2 mt-3 text-sm text-gray-500 hover:text-amber-600 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                                Sepete dön
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
