@extends('admin.layouts.app')

@section('title', 'İller')
@section('header', 'İller')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-gray-800">İller</h1>
    <a href="{{ route('admin.cities.create') }}" class="bg-amber-600 hover:bg-amber-500 text-white px-4 py-2 rounded font-medium">Yeni İl</a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">İl</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Slug</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Durum</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Sıra</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Minimum Sipariş Tutarı</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">İşlem</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($cities as $city)
                <tr>
                    <td class="px-6 py-4 font-medium">{{ $city->name }}</td>
                    <td class="px-6 py-4 text-gray-500">{{ $city->slug }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $city->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-600' }}">
                            {{ $city->is_active ? 'Aktif' : 'Pasif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">{{ $city->sort_order }}</td>
                    <td class="px-6 py-4 font-medium">{{ number_format($city->min_order_amount ?? 0, 2) }} ₺</td>
                    <td class="px-6 py-4 text-right">
                        <a href="{{ route('admin.cities.edit', $city) }}" class="text-amber-600 hover:text-amber-700 mr-2">Düzenle</a>
                        <form action="{{ route('admin.cities.destroy', $city) }}" method="POST" class="inline" onsubmit="return confirm('Silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="px-6 py-4">{{ $cities->links() }}</div>
</div>
@endsection
