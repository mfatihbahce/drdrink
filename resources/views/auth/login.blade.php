<x-guest-layout title="Giriş - DrDrink">
    <h1 class="font-display text-2xl font-light text-gray-900 mb-6">Giriş</h1>

    <x-auth-session-status :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5" onsubmit="this.querySelector('button[type=submit]').disabled=true">
        @csrf

        <div>
            <x-input-label for="email" :value="__('E-posta')" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Şifre')" />
            <x-text-input id="password" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-amber-500 focus:ring-amber-500" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">Beni hatırla</label>
        </div>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 pt-2">
            <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm">
                @if (Route::has('register'))
                    <a class="text-amber-600 hover:text-amber-500 font-medium" href="{{ route('register') }}">Hesap oluştur</a>
                @endif
                @if (Route::has('password.request'))
                    <a class="text-gray-500 hover:text-gray-700" href="{{ route('password.request') }}">Şifremi unuttum</a>
                @endif
            </div>
            <x-primary-button class="sm:flex-shrink-0">
                Giriş Yap
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
