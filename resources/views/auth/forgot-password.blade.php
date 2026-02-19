<x-guest-layout title="Şifremi Unuttum - DrDrink">
    <h1 class="font-display text-2xl font-light text-gray-900 mb-2">Şifremi Unuttum</h1>
    <p class="text-sm text-gray-500 mb-6">
        E-posta adresinizi girin, size şifre sıfırlama bağlantısı gönderelim.
    </p>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5" onsubmit="this.querySelector('button[type=submit]').disabled=true">
        @csrf

        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center gap-4 pt-2">
            <a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 order-2 sm:order-1">← Girişe dön</a>
            <x-primary-button class="w-full sm:w-auto sm:flex-shrink-0 order-1 sm:order-2">
                Sıfırlama Bağlantısı Gönder
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
