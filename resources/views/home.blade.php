@extends('layouts.frontend')

@section('title', 'DrDrink - Kahve ve İçecek Siparişi')

@section('content')
{{-- Hero - Modern Split Layout --}}
<section class="relative min-h-[90vh] flex flex-col justify-center overflow-hidden">
    {{-- Gradient mesh background --}}
    <div class="absolute inset-0 bg-[#0a0a0a]"></div>
    <div class="absolute inset-0 opacity-40" style="background: radial-gradient(ellipse 80% 50% at 70% 40%, rgba(217,119,6,0.25) 0%, transparent 50%), radial-gradient(ellipse 60% 40% at 20% 80%, rgba(120,53,15,0.2) 0%, transparent 50%);"></div>
    <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f1f1f_1px,transparent_1px),linear-gradient(to_bottom,#1f1f1f_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_60%_50%_at_50%_0%,#000_70%,transparent_110%)]"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 w-full">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
            {{-- Left: Content --}}
            <div class="order-2 lg:order-1">
                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-amber-500/10 border border-amber-500/20 text-amber-400 text-sm font-medium mb-8">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    Kütahya'dan Türkiye'ye
                </span>
                <h1 class="font-display text-5xl sm:text-6xl md:text-7xl lg:text-8xl font-bold tracking-tight text-white leading-[1.05]">
                    Evinize<br>
                    <span class="bg-gradient-to-r from-amber-400 via-amber-300 to-yellow-400 bg-clip-text text-transparent">Kahve Keyfi</span>
                </h1>
                <p class="mt-8 text-lg sm:text-xl text-zinc-400 max-w-lg leading-relaxed">
                    Özenle seçilmiş kahveler ve içecekler. İl seçin, sipariş verin, kapınıza gelsin.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('city.select') }}" class="group inline-flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-amber-500 text-black font-semibold text-lg hover:bg-amber-400 transition-all duration-300 shadow-[0_0_40px_-10px_rgba(245,158,11,0.5)] hover:shadow-[0_0_60px_-10px_rgba(245,158,11,0.6)] hover:scale-[1.02]">
                        <svg class="w-5 h-5 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Sipariş Ver
                    </a>
                    <a href="#nasil-calisir" class="inline-flex items-center justify-center gap-2 px-8 py-4 rounded-2xl border-2 border-zinc-600 text-zinc-300 font-medium hover:border-amber-500/50 hover:text-amber-400 hover:bg-amber-500/5 transition-all duration-300">
                        Nasıl Çalışır?
                    </a>
                </div>
            </div>

            {{-- Right: Visual --}}
            <div class="order-1 lg:order-2 relative">
                <div class="relative aspect-square max-w-md mx-auto lg:max-w-none">
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-amber-500/20 to-amber-900/20 blur-3xl"></div>
                    <div class="relative rounded-3xl border border-zinc-700/50 bg-zinc-900/50 backdrop-blur-xl p-12 flex items-center justify-center overflow-hidden">
                        <div class="absolute inset-0 opacity-20" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23f59e0b\' fill-opacity=\'0.4\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                        <div class="relative text-center">
                            <span class="text-[8rem] sm:text-[10rem] leading-none block">☕</span>
                            <p class="mt-4 font-display text-2xl font-semibold text-amber-400/90">DrDrink</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-zinc-500">
        <span class="text-xs uppercase tracking-widest">Keşfet</span>
        <div class="w-6 h-10 rounded-full border-2 border-zinc-600 flex justify-center pt-2">
            <div class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-bounce"></div>
        </div>
    </div>
</section>

{{-- Bento Grid - Neden DrDrink --}}
<section class="reveal py-24 sm:py-32 px-4 sm:px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16 sm:mb-20">
            <h2 class="font-display text-4xl sm:text-5xl font-bold text-zinc-900">Neden DrDrink?</h2>
            <p class="mt-4 text-lg text-zinc-500 max-w-2xl mx-auto">Kütahya'dan yola çıkan her fincan, evinize sıcaklık getiriyor.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
            <div class="group p-8 rounded-3xl bg-zinc-50 hover:bg-amber-50/50 border border-zinc-100 hover:border-amber-200 transition-all duration-500 hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-amber-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-900 text-xl">Kolay Sipariş</h3>
                <p class="mt-3 text-zinc-500 leading-relaxed">İl seçin, ürünleri ekleyin, ödeme yapın. Hepsi birkaç tıkla.</p>
            </div>
            <div class="group p-8 rounded-3xl bg-zinc-50 hover:bg-amber-50/50 border border-zinc-100 hover:border-amber-200 transition-all duration-500 hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-amber-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-900 text-xl">Hızlı Teslimat</h3>
                <p class="mt-3 text-zinc-500 leading-relaxed">Siparişiniz en kısa sürede kapınıza ulaşır.</p>
            </div>
            <div class="group p-8 rounded-3xl bg-zinc-50 hover:bg-amber-50/50 border border-zinc-100 hover:border-amber-200 transition-all duration-500 hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-amber-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-900 text-xl">Taze Kahve</h3>
                <p class="mt-3 text-zinc-500 leading-relaxed">Özenle seçilmiş çekirdekler, en taze haliyle.</p>
            </div>
            <div class="group p-8 rounded-3xl bg-zinc-50 hover:bg-amber-50/50 border border-zinc-100 hover:border-amber-200 transition-all duration-500 hover:shadow-xl hover:shadow-amber-500/5 hover:-translate-y-1">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-amber-400 to-amber-600 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300 shadow-lg shadow-amber-500/20">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                </div>
                <h3 class="font-semibold text-zinc-900 text-xl">Güvenli Ödeme</h3>
                <p class="mt-3 text-zinc-500 leading-relaxed">Kredi kartı ile güvenli ödeme, kapıda nakit seçeneği.</p>
            </div>
        </div>
    </div>
</section>

{{-- Nasıl Çalışır - Modern Steps --}}
<section id="nasil-calisir" class="reveal reveal-delay-1 py-24 sm:py-32 px-4 sm:px-6 lg:px-12 bg-zinc-50">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16 sm:mb-20">
            <h2 class="font-display text-4xl sm:text-5xl font-bold text-zinc-900">Online Sipariş Nasıl Verilir?</h2>
            <p class="mt-4 text-lg text-zinc-500">4 basit adımda siparişiniz kapınızda.</p>
        </div>

        <div class="relative">
            {{-- Connection line (desktop) --}}
            <div class="hidden lg:block absolute top-16 left-0 right-0 h-0.5 bg-gradient-to-r from-transparent via-amber-200 to-transparent"></div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-6">
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-2xl font-bold text-white shadow-xl shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300 z-10">1</div>
                        <h3 class="mt-6 font-semibold text-zinc-900 text-lg">İl Seçin</h3>
                        <p class="mt-2 text-zinc-500 text-sm">Teslimat yapacağımız ili seçin.</p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-2xl font-bold text-white shadow-xl shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300 z-10">2</div>
                        <h3 class="mt-6 font-semibold text-zinc-900 text-lg">Ürün Seçin</h3>
                        <p class="mt-2 text-zinc-500 text-sm">Kahve ve içeceklerden seçim yapın.</p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-2xl font-bold text-white shadow-xl shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300 z-10">3</div>
                        <h3 class="mt-6 font-semibold text-zinc-900 text-lg">Ödeme Yapın</h3>
                        <p class="mt-2 text-zinc-500 text-sm">Güvenli ödeme ile siparişi tamamlayın.</p>
                    </div>
                </div>
                <div class="relative group">
                    <div class="flex flex-col items-center text-center">
                        <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-amber-500 to-amber-700 flex items-center justify-center text-2xl font-bold text-white shadow-xl shadow-amber-500/30 group-hover:scale-110 transition-transform duration-300 z-10">4</div>
                        <h3 class="mt-6 font-semibold text-zinc-900 text-lg">Teslim Alın</h3>
                        <p class="mt-2 text-zinc-500 text-sm">Siparişiniz kapınıza gelsin.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA Banner - Glassmorphism --}}
<section class="reveal reveal-delay-2 py-24 sm:py-32 px-4 sm:px-6 lg:px-12">
    <div class="max-w-5xl mx-auto">
        <div class="relative rounded-[2rem] overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500 via-amber-600 to-amber-800"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'0.08\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')] opacity-50"></div>
            <div class="relative z-10 p-12 sm:p-16 lg:p-20 text-center">
                <h2 class="font-display text-3xl sm:text-4xl lg:text-5xl font-bold text-white">Hemen Sipariş Verin</h2>
                <p class="mt-6 text-amber-100/90 text-lg max-w-xl mx-auto leading-relaxed">Kütahya'dan Türkiye'nin dört bir yanına. Kahve ve içecek siparişinizi online verin, kapınıza gelsin.</p>
                <a href="{{ route('city.select') }}" class="inline-flex items-center gap-3 mt-10 px-10 py-4 rounded-2xl bg-white text-amber-800 font-semibold text-lg hover:bg-amber-50 transition-all duration-300 shadow-2xl hover:shadow-amber-900/20 hover:scale-105">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Siparişe Başla
                </a>
            </div>
        </div>
    </div>
</section>

{{-- Hikaye - Split Section --}}
<section class="reveal reveal-delay-3 py-24 sm:py-32 px-4 sm:px-6 lg:px-12 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            <div>
                <span class="inline-block px-4 py-2 rounded-full bg-amber-100 text-amber-700 font-medium text-sm uppercase tracking-wider">Hikayemiz</span>
                <h2 class="font-display text-4xl sm:text-5xl font-bold text-zinc-900 mt-6">Kütahya'dan Evinize Kahve Keyfi</h2>
                <p class="mt-8 text-zinc-500 leading-relaxed text-lg">
                    DrDrink olarak Kütahya'nın zengin kahve kültürünü Türkiye'nin dört bir yanına taşıyoruz. Özenle seçilmiş çekirdekler, uzman baristalarımızın elinden geçiyor; her fincan evinize sıcaklık ve keyif getiriyor.
                </p>
                <p class="mt-6 text-zinc-500 leading-relaxed text-lg">
                    Online sipariş sistemimizle, istediğiniz ilde adresinize teslimat yapıyoruz. Kahve, çay, soğuk içecekler ve atıştırmalıklar — hepsi bir tık uzağınızda.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('city.select') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl bg-amber-500 text-black font-semibold hover:bg-amber-400 transition-all duration-300 shadow-lg shadow-amber-500/20 hover:shadow-amber-500/30">
                        Sipariş Ver
                    </a>
                    <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-8 py-4 rounded-2xl border-2 border-zinc-200 text-zinc-700 font-medium hover:border-zinc-300 hover:bg-zinc-50 transition-all duration-300">
                        Sepetim
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="aspect-[4/3] rounded-3xl overflow-hidden bg-gradient-to-br from-zinc-100 to-amber-100 flex items-center justify-center border border-zinc-200/50 shadow-2xl shadow-zinc-200/50">
                    <div class="text-center p-12">
                        <span class="text-[10rem] sm:text-[12rem] leading-none block">☕</span>
                        <p class="mt-6 font-display text-3xl font-semibold text-amber-700/80">DrDrink</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
