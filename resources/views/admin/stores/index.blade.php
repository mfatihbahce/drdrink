@extends('admin.layouts.app')

@section('title', 'Mağazalar')
@section('header', 'Mağazalar')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Mağazalar</h1>
    <p class="text-gray-500 mt-1">Her il için bir mağaza oluşturulmuştur. Mağaza ayarlarını düzenleyebilirsiniz.</p>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mağaza</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İl</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Min. Sipariş</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Teslimat</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($stores as $store)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $store->name }}</td>
                    <td class="px-6 py-4">{{ $store->city->name }}</td>
                    <td class="px-6 py-4">{{ number_format($store->min_order_amount, 2) }} ₺</td>
                    <td class="px-6 py-4">{{ number_format($store->delivery_fee, 2) }} ₺</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $store->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $store->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.stores.edit', $store) }}" class="text-amber-600 hover:text-amber-700">Düzenle</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $stores->links() }}</div>
</div>
@endsection
