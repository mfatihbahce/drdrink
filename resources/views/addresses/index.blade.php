@extends('layouts.user-dashboard')

@section('title', 'Adreslerim')

@section('content')
<div class="w-full">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <h1 class="font-display text-2xl sm:text-3xl font-light text-gray-900">Adreslerim</h1>
        <a href="{{ route('addresses.create') }}" class="inline-flex items-center gap-2 bg-amber-500 text-black px-5 py-2.5 rounded-lg font-medium text-sm hover:bg-amber-400 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Yeni Adres
        </a>
    </div>

    <p class="text-gray-500 text-sm mb-6">Teslimat adreslerinizi yönetin. Sipariş verirken kayıtlı adreslerinizden seçim yapabilirsiniz.</p>

    @if($addresses->isEmpty())
        <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/></svg>
            <p class="text-gray-500 mb-6">Henüz kayıtlı adresiniz yok.</p>
            <a href="{{ route('addresses.create') }}" class="inline-block bg-amber-500 text-black px-6 py-3 rounded-lg font-medium hover:bg-amber-400 transition">İlk Adresinizi Ekleyin</a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($addresses as $address)
                <div class="bg-white rounded-xl border border-gray-200 p-6 flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div class="flex-1">
                        <div class="flex items-center gap-2 mb-2">
                            <h3 class="font-medium text-gray-900">{{ $address->title }}</h3>
                            @if($address->is_default)
                                <span class="px-2 py-0.5 text-xs bg-amber-100 text-amber-700 rounded">Varsayılan</span>
                            @endif
                        </div>
                        <p class="text-gray-600 text-sm">{{ $address->full_address }}</p>
                    </div>
                    <div class="flex gap-2 shrink-0">
                        <a href="{{ route('addresses.edit', $address) }}" class="px-4 py-2 text-sm text-gray-600 hover:text-amber-600 border border-gray-200 rounded-lg hover:border-amber-300 transition">Düzenle</a>
                        <form action="{{ route('addresses.destroy', $address) }}" method="POST" onsubmit="return confirm('Bu adresi silmek istediğinize emin misiniz?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 text-sm text-red-500 hover:text-red-600 border border-red-200 rounded-lg hover:border-red-300 transition">Sil</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
