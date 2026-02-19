@extends('store.layouts.app')

@section('title', 'Yeni Ürün')

@section('content')
<div class="mb-6">
    <a href="{{ route('store.products.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">← Ürünlere Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h1 class="text-xl font-bold text-gray-900">Yeni Ürün Ekle</h1>
        <p class="text-sm text-gray-500 mt-1">Menüye yeni bir ürün ekleyin.</p>
    </div>
    <form action="{{ route('store.products.store') }}" method="POST" class="p-6">
        @csrf
        <div class="grid gap-6 sm:grid-cols-2">
            <div class="sm:col-span-2">
                <label class="block font-medium text-gray-700 mb-2">Ürün Adı</label>
                <input type="text" name="name" value="{{ old('name') }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Kategori</label>
                <select name="category_id" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Fiyat (₺)</label>
                <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('price')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Sıra</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div class="sm:col-span-2">
                <label class="block font-medium text-gray-700 mb-2">Açıklama</label>
                <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ old('description') }}</textarea>
            </div>
            <div class="flex items-end sm:col-span-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-teal-500">
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
