@extends('layouts.user-dashboard')

@section('title', 'Yeni Adres')

@section('content')
<div class="w-full">
    <a href="{{ route('addresses.index') }}" class="text-sm text-gray-500 hover:text-gray-700 mb-6 inline-block">← Adreslerime dön</a>
    <h1 class="font-display text-2xl sm:text-3xl font-light text-gray-900 mb-8">Yeni Adres Ekle</h1>

    <form action="{{ route('addresses.store') }}" method="POST" class="bg-white rounded-2xl border border-gray-200 p-6 sm:p-8 space-y-5">
        @csrf

        <div>
            <label class="block text-sm font-medium text-gray-600 mb-1.5">Adres Başlığı</label>
            <input type="text" name="title" value="{{ old('title') }}" required placeholder="Ev, İş, vb." class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
            @error('title')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">İl <span class="text-red-500">*</span></label>
                <select name="city_id" required class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                    <option value="">İl seçin</option>
                    @foreach($cities as $city)
                        <option value="{{ $city->id }}" {{ old('city_id') == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                    @endforeach
                </select>
                @error('city_id')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">İlçe <span class="text-red-500">*</span></label>
                <input type="text" name="district" value="{{ old('district') }}" required placeholder="Örn: Merkez" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('district')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Mahalle <span class="text-red-500">*</span></label>
                <input type="text" name="neighborhood" value="{{ old('neighborhood') }}" required placeholder="Mahalle adı" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('neighborhood')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Sokak <span class="text-red-500">*</span></label>
                <input type="text" name="street" value="{{ old('street') }}" required placeholder="Sokak adı" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('street')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Cadde (Opsiyonel)</label>
                <input type="text" name="avenue" value="{{ old('avenue') }}" placeholder="Cadde adı" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('avenue')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Bina No <span class="text-red-500">*</span></label>
                <input type="text" name="building" value="{{ old('building') }}" required placeholder="Bina numarası" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('building')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-600 mb-1.5">Daire (Opsiyonel)</label>
                <input type="text" name="apartment" value="{{ old('apartment') }}" placeholder="Daire no / Kapı no" class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">
                @error('apartment')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
        </div>

        <div class="pt-2 sm:pt-4 border-t border-gray-100">
            <label class="block text-sm font-medium text-gray-600 mb-1.5">Adres Tarifi (Opsiyonel)</label>
            <p class="text-xs text-gray-500 mb-2">Kurye teslimat sırasında bu bilgiyi görecek</p>
            <textarea name="address_instructions" rows="3" placeholder="Örn: Apartmanın 3. katı, kapıyı çalın, site girişinde bekleyin..." class="block w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-gray-900 focus:border-amber-500 focus:ring-1 focus:ring-amber-500 focus:outline-none">{{ old('address_instructions') }}</textarea>
            @error('address_instructions')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="pt-2 sm:pt-4 border-t border-gray-100 flex items-center">
            <input type="checkbox" name="is_default" id="is_default" value="1" {{ old('is_default') ? 'checked' : '' }} class="rounded border-gray-300 text-amber-500 focus:ring-amber-500">
            <label for="is_default" class="ml-2 text-sm text-gray-600">Varsayılan adres olarak ayarla</label>
        </div>

        <div class="pt-4 flex gap-3">
            <button type="submit" class="bg-amber-500 text-black px-6 py-3 rounded-lg font-medium hover:bg-amber-400 transition">Kaydet</button>
            <a href="{{ route('addresses.index') }}" class="px-6 py-3 text-gray-600 hover:text-gray-900 border border-gray-200 rounded-lg">İptal</a>
        </div>
    </form>
</div>
@endsection
