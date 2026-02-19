<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div class="space-y-4">
            <div>
                <x-input-label for="name" :value="__('Ad Soyad')" />
                <x-text-input id="name" name="name" type="text" :value="old('name', $user->name)" required autofocus autocomplete="name" class="mt-1.5 py-2" />
                <x-input-error :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="phone" :value="__('Telefon')" />
                <x-text-input id="phone" name="phone" type="tel" :value="old('phone', $user->phone)" required placeholder="05XX XXX XX XX" autocomplete="tel" class="mt-2" />
                <x-input-error :messages="$errors->get('phone')" />
            </div>

            <div>
                <x-input-label for="email" :value="__('E-posta')" />
                <x-text-input id="email" name="email" type="email" :value="old('email', $user->email)" required autocomplete="username" class="mt-1.5 py-2" />
                <x-input-error :messages="$errors->get('email')" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <p class="text-sm text-gray-600">
                            E-posta adresiniz doğrulanmamış.
                            <button form="send-verification" class="text-amber-600 hover:text-amber-500 font-medium underline">Doğrulama e-postasını tekrar gönder</button>
                        </p>
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-sm text-emerald-600">Yeni doğrulama bağlantısı e-posta adresinize gönderildi.</p>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="flex flex-col gap-3 pt-1 sm:flex-row sm:items-center">
            <x-primary-button>Değişiklikleri Kaydet</x-primary-button>
            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="flex items-center gap-2 text-sm text-emerald-600">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    Kaydedildi
                </p>
            @endif
        </div>
    </form>
</section>
