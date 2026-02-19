@extends('admin.layouts.app')

@section('title', 'Yeni Kullanıcı')
@section('header', 'Yeni Kullanıcı')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.users.index') }}" class="text-amber-600 hover:text-amber-700 font-medium">← Kullanıcılara Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
        <h1 class="text-xl font-bold text-gray-900">Yeni Kullanıcı Oluştur</h1>
        <p class="text-sm text-gray-500 mt-1">Kullanıcı bilgilerini girin ve rol atayın.</p>
    </div>
    <form action="{{ route('admin.users.store') }}" method="POST" class="p-6">
        @csrf
        <div class="space-y-6">
            <div>
                <label for="name" class="block font-medium text-gray-700 mb-1">Ad Soyad</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('name') border-red-500 @enderror"
                    placeholder="Örn: Ahmet Yılmaz">
                @error('name')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="email" class="block font-medium text-gray-700 mb-1">E-posta</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('email') border-red-500 @enderror"
                    placeholder="ornek@email.com">
                @error('email')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="phone" class="block font-medium text-gray-700 mb-1">Telefon (opsiyonel)</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('phone') border-red-500 @enderror"
                    placeholder="05XX XXX XX XX">
                @error('phone')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="password" class="block font-medium text-gray-700 mb-1">Şifre</label>
                <input type="password" name="password" id="password" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('password') border-red-500 @enderror"
                    placeholder="En az 8 karakter">
                @error('password')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label for="password_confirmation" class="block font-medium text-gray-700 mb-1">Şifre Tekrar</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500"
                    placeholder="Şifreyi tekrar girin">
            </div>
            <div>
                <label for="role" class="block font-medium text-gray-700 mb-1">Rol (opsiyonel)</label>
                <select name="role" id="role"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('role') border-red-500 @enderror">
                    <option value="">Rol seçin</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') === $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                    @endforeach
                </select>
                @error('role')<p class="text-red-600 text-sm mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block font-medium text-gray-700 mb-2">Mağaza Ataması (mağaza paneli erişimi)</label>
                <div class="space-y-2 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-3">
                    @foreach($stores as $store)
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="store_ids[]" value="{{ $store->id }}" {{ in_array($store->id, old('store_ids', [])) ? 'checked' : '' }} class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                            <span>{{ $store->name }} ({{ $store->city->name }})</span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="mt-8 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium transition">
                Kullanıcı Oluştur
            </button>
        </div>
    </form>
</div>
@endsection
