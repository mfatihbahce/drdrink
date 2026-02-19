@extends('admin.layouts.app')

@section('title', 'Entegrasyonlar')
@section('header', 'Entegrasyonlar')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Entegrasyonlar</h1>
    <p class="text-gray-500 mt-1">Ödeme, bildirim ve diğer harici servis ayarlarını yönetin.</p>
</div>

<div class="space-y-4">
    <a href="{{ route('admin.integrations.iyzico') }}" class="block bg-white rounded-xl shadow-sm border border-gray-200 p-6 hover:border-amber-300 hover:shadow-md transition-all group">
        <div class="flex items-start gap-4">
            <div class="w-12 h-12 rounded-xl bg-amber-100 flex items-center justify-center shrink-0 group-hover:bg-amber-200 transition">
                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
            </div>
            <div class="flex-1 min-w-0">
                <h2 class="text-lg font-semibold text-gray-900">İyzico Ödeme</h2>
                <p class="text-sm text-gray-500 mt-0.5">Kredi kartı ödeme entegrasyonu. API anahtarları ve ortam ayarlarını yapılandırın.</p>
            </div>
            <svg class="w-5 h-5 text-gray-400 group-hover:text-amber-600 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        </div>
    </a>

    {{-- Gelecekte eklenebilecek entegrasyonlar için placeholder --}}
    {{-- <div class="block bg-white rounded-xl border border-gray-200 border-dashed p-6 opacity-60">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
            </div>
            <div>
                <h2 class="text-lg font-semibold text-gray-600">SMS / Bildirim</h2>
                <p class="text-sm text-gray-500">Yakında eklenecek</p>
            </div>
        </div>
    </div> --}}
</div>
@endsection
