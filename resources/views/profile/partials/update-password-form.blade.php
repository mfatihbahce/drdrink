<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Mevcut Şifre')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password" class="mt-1.5 py-2" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" />
        </div>

        <div class="space-y-4">
            <div>
                <x-input-label for="update_password_password" :value="__('Yeni Şifre')" />
                <x-text-input id="update_password_password" name="password" type="password" autocomplete="new-password" class="mt-1.5 py-2" />
                <x-input-error :messages="$errors->updatePassword->get('password')" />
                <p class="mt-1 text-xs text-gray-500">En az 8 karakter, büyük/küçük harf ve rakam içermelidir.</p>
            </div>

            <div>
                <x-input-label for="update_password_password_confirmation" :value="__('Şifre Tekrar')" />
                <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="mt-1.5 py-2" />
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" />
            </div>
        </div>

        <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center">
            <x-primary-button>Şifreyi Güncelle</x-primary-button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="flex items-center gap-2 text-sm text-emerald-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Şifre güncellendi
                </p>
            @endif
        </div>
    </form>
</section>
