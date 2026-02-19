@extends('admin.layouts.app')

@section('title', 'Genel Ayarlar')
@section('header', 'Genel Ayarlar')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Genel Ayarlar</h1>
    <p class="text-gray-500 mt-1">Site genelindeki temel ayarları yönetin.</p>
</div>

<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <form action="{{ route('admin.settings.update') }}" method="POST" class="p-6">
        @csrf

        <div class="space-y-6">
            <div>
                <label for="site_name" class="block text-sm font-medium text-gray-700 mb-1">Site Adı</label>
                <input type="text" name="site_name" id="site_name" value="{{ old('site_name', $settings['site_name']) }}" required
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('site_name') border-red-500 @enderror">
                @error('site_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="site_description" class="block text-sm font-medium text-gray-700 mb-1">Site Açıklaması</label>
                <textarea name="site_description" id="site_description" rows="2"
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('site_description') border-red-500 @enderror">{{ old('site_description', $settings['site_description']) }}</textarea>
                @error('site_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-1">İletişim E-posta</label>
                    <input type="email" name="contact_email" id="contact_email" value="{{ old('contact_email', $settings['contact_email']) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('contact_email') border-red-500 @enderror">
                    @error('contact_email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-1">İletişim Telefon</label>
                    <input type="text" name="contact_phone" id="contact_phone" value="{{ old('contact_phone', $settings['contact_phone']) }}"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('contact_phone') border-red-500 @enderror">
                    @error('contact_phone')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="p-4 rounded-xl border border-gray-200 bg-gray-50/50">
                <label class="flex items-center gap-3 cursor-pointer mb-3">
                    <input type="checkbox" name="order_notification_sound" value="1" {{ old('order_notification_sound', $settings['order_notification_sound']) ? 'checked' : '' }}
                        class="rounded border-gray-300 text-amber-600 focus:ring-amber-500">
                    <span class="font-medium text-gray-700">Sipariş bildirim sesi</span>
                </label>
                <p class="text-sm text-gray-500 mb-3">Yeni sipariş geldiğinde sesli bildirim çalar. Tarayıcı güvenliği için ilk kez etkinleştirirken aşağıdaki butona tıklayın.</p>
                <button type="button" id="order-sound-test-btn" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-100 text-amber-800 rounded-lg text-sm font-medium hover:bg-amber-200 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z"/></svg>
                    Sesi Test Et
                </button>
            </div>

            <div>
                <label for="currency" class="block text-sm font-medium text-gray-700 mb-1">Para Birimi</label>
                <select name="currency" id="currency"
                    class="w-full max-w-xs border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 @error('currency') border-red-500 @enderror">
                    <option value="TRY" {{ $settings['currency'] === 'TRY' ? 'selected' : '' }}>TRY (₺)</option>
                    <option value="USD" {{ $settings['currency'] === 'USD' ? 'selected' : '' }}>USD ($)</option>
                    <option value="EUR" {{ $settings['currency'] === 'EUR' ? 'selected' : '' }}>EUR (€)</option>
                </select>
                @error('currency')
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
@push('scripts')
<script>
(function() {
    var btn = document.getElementById('order-sound-test-btn');
    if (!btn) return;
    var soundUrl = '{{ asset("sounds/new-order.wav") }}';
    btn.addEventListener('click', function() {
        try {
            var audio = new Audio(soundUrl);
            audio.volume = 0.9;
            audio.play().then(function() {
                try { localStorage.setItem('drdrink_sound_unlocked', '1'); } catch(e) {}
            }).catch(function() {});
        } catch (e) {}
    });
})();
</script>
@endpush
@endsection
