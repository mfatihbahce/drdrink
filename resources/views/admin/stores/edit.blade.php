@extends('admin.layouts.app')

@section('title', 'Mağaza Düzenle')
@section('header', 'Mağaza Düzenle')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.stores.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">← Mağazalara Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h1 class="text-xl font-bold text-gray-900">Mağaza Düzenle: {{ $store->name }}</h1>
        <p class="text-sm text-gray-500 mt-1">{{ $store->city->name }}</p>
    </div>
    <form action="{{ route('admin.stores.update', $store) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="block font-medium text-gray-700 mb-2">Mağaza Adı</label>
                <input type="text" name="name" value="{{ old('name', $store->name) }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Minimum Sipariş Tutarı (₺)</label>
                <input type="number" name="min_order_amount" value="{{ old('min_order_amount', $store->min_order_amount) }}" step="0.01" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Teslimat Ücreti (₺)</label>
                <input type="number" name="delivery_fee" value="{{ old('delivery_fee', $store->delivery_fee) }}" step="0.01" min="0" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div class="flex items-end sm:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $store->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                    <span class="text-gray-700">Aktif</span>
                </label>
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium transition">Kaydet</button>
        </div>
    </form>
</div>
@endsection
