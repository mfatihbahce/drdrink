@extends('store.layouts.app')

@section('title', 'Mağaza Ayarları')
@section('header', 'Mağaza Ayarları')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">{{ $store->name }} - Ayarlar</h1>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h2 class="text-lg font-bold text-gray-900">Mağaza Ayarları</h2>
        <p class="text-sm text-gray-500 mt-1">Minimum sipariş tutarı ve teslimat ücreti ayarlayın.</p>
    </div>
    <form action="{{ route('store.settings.update') }}" method="POST" class="p-6">
        @csrf
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block font-medium text-gray-700 mb-2">Minimum Sipariş Tutarı (₺)</label>
                <input type="number" name="min_order_amount" value="{{ old('min_order_amount', $store->min_order_amount) }}" step="0.01" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('min_order_amount')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Teslimat Ücreti (₺)</label>
                <input type="number" name="delivery_fee" value="{{ old('delivery_fee', $store->delivery_fee) }}" step="0.01" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('delivery_fee')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium transition">Kaydet</button>
        </div>
    </form>
</div>
@endsection
