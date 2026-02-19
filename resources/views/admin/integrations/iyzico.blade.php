@extends('admin.layouts.app')

@section('title', 'İyzico Ayarları')
@section('header', 'İyzico Ayarları')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.integrations.index') }}" class="text-amber-600 hover:text-amber-700 text-sm font-medium">← Entegrasyonlara Dön</a>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">İyzico Ödeme Entegrasyonu</h2>
        <p class="text-sm text-gray-500 mt-1">Sandbox (test) veya canlı ortam için API bilgilerinizi girin. Bu bilgileri <a href="https://merchant.iyzipay.com" target="_blank" rel="noopener" class="text-amber-600 hover:underline">iyzico merchant panelinden</a> alabilirsiniz.</p>
    </div>

    <form action="{{ route('admin.integrations.iyzico.update') }}" method="POST" class="p-6">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="api_key" class="block text-sm font-medium text-gray-700 mb-1">API Key</label>
                <input type="text" name="api_key" id="api_key" value="{{ old('api_key', $apiKey) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('api_key') border-red-500 @enderror"
                    placeholder="sandbox-xxxx veya live-xxxx">
                @error('api_key')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="secret_key" class="block text-sm font-medium text-gray-700 mb-1">Secret Key</label>
                <input type="password" name="secret_key" id="secret_key" value="{{ old('secret_key', $secretKey) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('secret_key') border-red-500 @enderror"
                    placeholder="••••••••••••">
                @error('secret_key')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="base_url" class="block text-sm font-medium text-gray-700 mb-1">API Ortamı</label>
                <select name="base_url" id="base_url" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('base_url') border-red-500 @enderror">
                    <option value="https://sandbox-api.iyzipay.com" {{ $baseUrl === 'https://sandbox-api.iyzipay.com' ? 'selected' : '' }}>Sandbox (Test Ortamı)</option>
                    <option value="https://api.iyzipay.com" {{ $baseUrl === 'https://api.iyzipay.com' ? 'selected' : '' }}>Canlı Ortam</option>
                </select>
                @error('base_url')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-200">
            <button type="submit" class="bg-amber-600 hover:bg-amber-500 text-white px-6 py-2.5 rounded-lg font-medium">
                Kaydet
            </button>
        </div>
    </form>
</div>
@endsection
