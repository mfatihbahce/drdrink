@extends('admin.layouts.app')

@section('title', 'Kategori Düzenle')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.categories.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">← Kategorilere Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h1 class="text-xl font-bold text-gray-900">Kategori Düzenle: {{ $category->name }}</h1>
        <p class="text-sm text-gray-500 mt-1">Kategori bilgilerini güncelleyin.</p>
    </div>
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" class="p-6">
        @csrf
        @method('PUT')
        <div class="grid gap-6 sm:grid-cols-2">
            <div>
                <label class="block font-medium text-gray-700 mb-2">Mağaza</label>
                <select name="store_id" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                    @foreach($stores as $s)
                        <option value="{{ $s->id }}" {{ old('store_id', $category->store_id) == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->city->name }})</option>
                    @endforeach
                </select>
            </div>
            <div class="sm:col-span-2">
                <label class="block font-medium text-gray-700 mb-2">Kategori Adı</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}" required class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div class="sm:col-span-2">
                <label class="block font-medium text-gray-700 mb-2">Açıklama</label>
                <textarea name="description" rows="3" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">{{ old('description', $category->description) }}</textarea>
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Sıra</label>
                <input type="number" name="sort_order" value="{{ old('sort_order', $category->sort_order) }}" class="w-full border border-gray-200 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
            </div>
            <div class="flex items-end">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                    <span class="text-gray-700">Aktif</span>
                </label>
            </div>
        </div>
        <div class="mt-6 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium transition">Güncelle</button>
        </div>
    </form>
</div>
@endsection
