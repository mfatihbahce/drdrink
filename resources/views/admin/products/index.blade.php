@extends('admin.layouts.app')

@section('title', 'Ürünler')
@section('header', 'Ürünler')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">Ürünler</h1>
    <a href="{{ route('admin.products.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded font-medium">Yeni Ürün</a>
</div>

<form method="GET" class="mb-4 flex gap-2">
    <select name="store_id" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">Tüm Mağazalar</option>
        @foreach($stores as $s)
            <option value="{{ $s->id }}" {{ request('store_id') == $s->id ? 'selected' : '' }}>{{ $s->name }} ({{ $s->city->name }})</option>
        @endforeach
    </select>
    <select name="category_id" class="border rounded px-3 py-2" onchange="this.form.submit()">
        <option value="">Tüm Kategoriler</option>
        @foreach($categories as $cat)
            <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }} ({{ $cat->store?->name }})</option>
        @endforeach
    </select>
</form>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ürün</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mağaza</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fiyat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($products as $product)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                    <td class="px-6 py-4">{{ $product->category->name }}</td>
                    <td class="px-6 py-4">{{ $product->store?->name ?? '-' }}</td>
                    <td class="px-6 py-4">{{ number_format($product->price, 2) }} ₺</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $product->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $product->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.products.edit', $product) }}" class="text-amber-600 hover:text-amber-700 mr-2">Düzenle</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $products->links() }}</div>
</div>
@endsection
