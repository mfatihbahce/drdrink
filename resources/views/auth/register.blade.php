<x-guest-layout title="Kayıt - DrDrink">
    <h1 class="font-display text-2xl font-light text-gray-900 mb-6">Kayıt Ol</h1>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" onsubmit="this.querySelector('button[type=submit]').disabled=true">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Ad Soyad')" />
            <x-text-input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="phone" :value="__('Telefon')" />
            <x-text-input id="phone" type="tel" name="phone" :value="old('phone')" required autocomplete="tel" placeholder="05XX XXX XX XX" />
            <x-input-error :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Şifre')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Şifre Tekrar')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
            <a class="text-sm text-gray-500 hover:text-gray-700" href="{{ route('login') }}">
                Zaten hesabınız var mı? Giriş yapın
            </a>
            <x-primary-button class="sm:flex-shrink-0">
                Kayıt Ol
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
