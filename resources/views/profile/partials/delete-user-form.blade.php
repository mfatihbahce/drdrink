<section>
    <div class="rounded-lg border border-red-200 bg-red-50/30 p-3">
        <p class="text-sm text-gray-700 mb-4">
            Hesabınız silindiğinde tüm verileriniz (siparişler, adresler vb.) kalıcı olarak silinecektir. Bu işlem geri alınamaz. Silmeden önce saklamak istediğiniz bilgileri indirin.
        </p>

        <x-danger-button
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
            class="inline-flex items-center gap-2"
        >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
            Hesabı Sil
        </x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-semibold text-gray-900">Hesabınızı silmek istediğinize emin misiniz?</h2>
            <p class="mt-2 text-sm text-gray-600">Hesap silindiğinde tüm verileriniz kalıcı olarak silinecektir. Bu işlem geri alınamaz. Onaylamak için şifrenizi girin.</p>

            <div class="mt-6">
                <x-input-label for="password" value="Şifreniz" />
                <x-text-input id="password" name="password" type="password" placeholder="Şifrenizi girin" class="mt-2" />
                <x-input-error :messages="$errors->userDeletion->get('password')" />
            </div>

            <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">
                <x-secondary-button type="button" x-on:click="$dispatch('close-modal', 'confirm-user-deletion')">İptal</x-secondary-button>
                <x-danger-button>Hesabı Kalıcı Olarak Sil</x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
