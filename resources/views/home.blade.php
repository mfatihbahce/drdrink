@extends('layouts.frontend')

@section('title', 'DrDrink - Kahve ve İçecek Siparişi')

@section('content')
{{-- Hero - Soft & Inviting --}}
<section class="relative py-20 sm:py-28 lg:py-32">
    <div class="absolute inset-0 bg-gradient-to-b from-amber-50/40 via-transparent to-transparent"></div>
    <div class="relative max-w-5xl mx-auto px-6 sm:px-8 lg:px-12">
        <div class="grid lg:grid-cols-2 gap-16 lg:gap-24 items-center">
            <div>
                <p class="text-sm font-medium text-amber-700/70 uppercase tracking-[0.25em] mb-5">Kütahya'dan Türkiye'ye</p>
                <h1 class="font-display text-4xl sm:text-5xl lg:text-6xl font-normal text-[#2d2d2d] leading-[1.15] tracking-tight">
                    Kahveniz<br><span class="text-amber-700/90">kapınıza gelsin</span>
                </h1>
                <p class="mt-6 text-[#5c5c5c] text-lg max-w-md leading-relaxed">
                    Özenle seçilmiş kahveler ve içecekler. İl seçin, sipariş verin — hepsi birkaç tıkla.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('city.select') }}" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl bg-amber-600 text-white text-sm font-medium hover:bg-amber-500 transition-colors shadow-sm">
                        Siparişe Başla
                    </a>
                    <a href="#adimlar" class="inline-flex items-center justify-center gap-2 px-8 py-3.5 rounded-xl border border-amber-200 text-amber-800/90 text-sm font-medium hover:bg-amber-50/50 transition-colors">
                        Nasıl çalışır?
                    </a>
                </div>
            </div>
            <div class="hidden md:flex justify-center">
                <div class="w-72 h-72 rounded-full bg-gradient-to-br from-amber-100/80 to-amber-50/60 flex items-center justify-center">
                    <svg class="w-40 h-40 text-amber-600/30" viewBox="0 0 160 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M35 45h90l5 5v75H30V50l5-5z" fill="rgba(180,83,9,0.08)" stroke="rgba(180,83,9,0.15)" stroke-width="1.2"/>
                        <ellipse cx="80" cy="45" rx="52" ry="5" fill="none" stroke="rgba(180,83,9,0.2)" stroke-width="1.2"/>
                        <path d="M125 55c12 0 20 10 20 22 0 6-3 11-8 14" fill="none" stroke="rgba(180,83,9,0.15)" stroke-width="1.2" stroke-linecap="round"/>
                        <path d="M55 30 Q60 20 65 30 Q70 20 75 30 Q80 20 85 30 Q90 20 95 30" fill="none" stroke="rgba(180,83,9,0.1)" stroke-width="1" stroke-linecap="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Sipariş Adımları --}}
<section id="adimlar" class="py-24 sm:py-32 px-6 sm:px-8 lg:px-12 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="text-center mb-20">
            <h2 class="font-display text-3xl sm:text-4xl font-normal text-[#2d2d2d]">Sipariş vermek çok kolay</h2>
            <p class="mt-4 text-[#6b6b6b] max-w-lg mx-auto">4 basit adımda kahveniz kapınızda.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center sm:text-left">
                <div class="inline-flex w-14 h-14 rounded-2xl bg-amber-50 text-amber-700/80 items-center justify-center text-xl font-medium mb-6">1</div>
                <h3 class="font-medium text-[#2d2d2d] text-lg">İl seçin</h3>
                <p class="mt-3 text-[#6b6b6b] text-sm leading-relaxed">Teslimat yapacağımız ili seçin.</p>
            </div>
            <div class="text-center sm:text-left">
                <div class="inline-flex w-14 h-14 rounded-2xl bg-amber-50 text-amber-700/80 items-center justify-center text-xl font-medium mb-6">2</div>
                <h3 class="font-medium text-[#2d2d2d] text-lg">Ürünleri seçin</h3>
                <p class="mt-3 text-[#6b6b6b] text-sm leading-relaxed">Kahve, çay ve atıştırmalıklardan seçim yapın.</p>
            </div>
            <div class="text-center sm:text-left">
                <div class="inline-flex w-14 h-14 rounded-2xl bg-amber-50 text-amber-700/80 items-center justify-center text-xl font-medium mb-6">3</div>
                <h3 class="font-medium text-[#2d2d2d] text-lg">Ödeme yapın</h3>
                <p class="mt-3 text-[#6b6b6b] text-sm leading-relaxed">Kredi kartı veya kapıda ödeme ile tamamlayın.</p>
            </div>
            <div class="text-center sm:text-left">
                <div class="inline-flex w-14 h-14 rounded-2xl bg-amber-50 text-amber-700/80 items-center justify-center text-xl font-medium mb-6">4</div>
                <h3 class="font-medium text-[#2d2d2d] text-lg">Teslim alın</h3>
                <p class="mt-3 text-[#6b6b6b] text-sm leading-relaxed">Siparişiniz adresinize teslim edilir.</p>
            </div>
        </div>

        <div class="mt-20 text-center">
            <a href="{{ route('city.select') }}" class="inline-flex items-center gap-2 px-10 py-4 rounded-xl bg-amber-600 text-white text-sm font-medium hover:bg-amber-500 transition-colors shadow-sm">
                Hemen sipariş vermeye başla
            </a>
        </div>
    </div>
</section>

{{-- DrDrink - Kısa tanıtım --}}
<section class="py-24 sm:py-32 px-6 sm:px-8 lg:px-12 bg-[#faf8f5]">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="font-display text-2xl sm:text-3xl font-normal text-[#2d2d2d]">DrDrink</h2>
        <p class="mt-6 text-[#6b6b6b] leading-relaxed max-w-2xl mx-auto">
            Kütahya'dan yola çıkan her fincan, evinize sıcaklık getiriyor. Özenle seçilmiş kahveler ve içecekler — online sipariş ile kapınıza kadar.
        </p>
        <div class="mt-10 flex flex-wrap justify-center gap-4">
            <a href="{{ route('city.select') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-amber-600 text-white text-sm font-medium hover:bg-amber-500 transition-colors">
                Sipariş Ver
            </a>
            <a href="{{ route('cart.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl border border-amber-200 text-amber-800/90 text-sm font-medium hover:bg-amber-50/50 transition-colors">
                Sepetim
            </a>
        </div>
    </div>
</section>
@endsection
