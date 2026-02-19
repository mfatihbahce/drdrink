<x-guest-layout title="Şifre Sıfırla - DrDrink">
    <h1 class="font-display text-2xl font-light text-gray-900 mb-6">Yeni Şifre Belirle</h1>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-5" onsubmit="this.querySelector('button[type=submit]').disabled=true">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Yeni Şifre')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Şifre Tekrar')" />
            <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" />
        </div>

        <div class="pt-2">
            <x-primary-button class="w-full">
                Şifreyi Sıfırla
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
