<!DOCTYPE html>
<html lang="tr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=plus-jakarta-sans:400,500,600,700|playfair-display:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
        .font-display { font-family: 'Playfair Display', Georgia, serif; }
        .font-sans { font-family: 'Plus Jakarta Sans', system-ui, sans-serif; }
        /* Header menü görünürlüğü - Tailwind fallback */
        @media (max-width: 1023px) {
            .nav-desktop { display: none !important; }
            .nav-mobile { display: flex !important; }
        }
        @media (min-width: 1024px) {
            .nav-desktop { display: flex !important; }
            .nav-mobile { display: none !important; }
        }
    </style>
</head>
<body class="font-sans antialiased flex flex-col min-h-screen {{ request()->routeIs('home') ? 'bg-[#faf8f5] text-[#3d3d3d]' : 'bg-gray-50 text-gray-900' }}" x-data="{ mobileMenuOpen: false }" :class="{ 'overflow-hidden': mobileMenuOpen }">
    @php $cartCount = app(\App\Services\CartService::class)->count(); @endphp
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 py-4 px-4 sm:px-6 lg:px-12 bg-white/95 backdrop-blur-sm border-b border-gray-100">
        <div class="max-w-6xl mx-auto flex justify-between items-center gap-4">
            <a href="{{ route('home') }}" class="font-display text-2xl font-normal tracking-tight text-gray-900">DrDrink</a>

            {{-- Desktop nav --}}
            <div class="nav-desktop hidden lg:flex items-center gap-1 xl:gap-2">
                <a href="{{ route('cart.index') }}" class="relative p-3 -m-1 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition min-w-[44px] min-h-[44px] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute top-1 right-1 bg-amber-500 text-black text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $cartCount }}</span>
                    @endif
                </a>
                <span class="w-px h-5 bg-gray-200 mx-1" aria-hidden="true"></span>
                <a href="{{ route('city.select') }}" class="bg-amber-500 text-black px-4 py-2.5 text-sm font-medium tracking-wide hover:bg-amber-400 active:bg-amber-600 transition rounded-xl min-h-[44px] flex items-center">
                    Sipariş Ver
                </a>
                @auth
                    <span class="w-px h-5 bg-gray-200 mx-1" aria-hidden="true"></span>
                    <a href="{{ route('orders.index') }}" class="px-4 py-2.5 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition min-h-[44px] flex items-center">Siparişlerim</a>
                    <span class="w-px h-5 bg-gray-200 mx-1" aria-hidden="true"></span>
                    <a href="{{ route('profile.edit') }}" class="px-4 py-2.5 text-sm text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition min-h-[44px] flex items-center">{{ auth()->user()->name }}</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline" onsubmit="this.querySelector('button').disabled=true">
                        @csrf
                        <button type="submit" class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-900 hover:bg-gray-100 rounded-xl transition min-h-[44px] flex items-center">Çıkış</button>
                    </form>
                @else
                    <span class="w-px h-5 bg-gray-200 mx-1" aria-hidden="true"></span>
                    <a href="{{ route('login') }}" class="bg-amber-500 text-black px-4 py-2.5 text-sm font-medium tracking-wide hover:bg-amber-400 active:bg-amber-600 transition rounded-xl min-h-[44px] flex items-center">
                        Giriş
                    </a>
                @endauth
            </div>

            {{-- Mobile: cart + hamburger --}}
            <div class="nav-mobile flex lg:hidden items-center gap-1">
                <a href="{{ route('cart.index') }}" class="relative p-3 -m-1 text-gray-600 hover:text-gray-900 active:bg-gray-100 rounded-xl transition min-w-[48px] min-h-[48px] flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    @if($cartCount > 0)
                        <span class="absolute top-1 right-1 bg-amber-500 text-black text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $cartCount }}</span>
                    @endif
                </a>
                <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="p-3 -m-1 text-gray-600 hover:text-gray-900 active:bg-gray-100 rounded-xl transition min-w-[48px] min-h-[48px] flex items-center justify-center" aria-label="Menüyü aç">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen" x-cloak>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        {{-- Mobile menu overlay --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 top-[57px] sm:top-[65px] bg-black/20 z-40 lg:hidden" @click="mobileMenuOpen = false"></div>

        {{-- Mobile menu panel --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="absolute top-full left-0 right-0 z-50 lg:hidden bg-white border-b border-gray-200 shadow-xl">
            <div class="px-4 py-4 space-y-1 max-h-[60vh] overflow-y-auto">
                <a href="{{ route('city.select') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-amber-500 text-black font-medium hover:bg-amber-400 transition" @click="mobileMenuOpen = false">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Sipariş Ver
                </a>
                <div class="border-t border-gray-100 my-2"></div>
                @auth
                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-gray-100 transition" @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Siparişlerim
                    </a>
                    <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl text-gray-700 hover:bg-gray-100 transition" @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        {{ auth()->user()->name }}
                    </a>
                    <div class="border-t border-gray-100 my-2"></div>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="this.querySelector('button').disabled=true">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3.5 rounded-xl text-gray-500 hover:bg-gray-100 transition text-left">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/></svg>
                            Çıkış
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-xl bg-amber-500 text-black font-medium hover:bg-amber-400 transition" @click="mobileMenuOpen = false">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m5 5v1a2 2 0 01-2 2h-1a1 2 0 01-2-2v-2z"/></svg>
                        Giriş
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @if(session('success'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-emerald-500/90 text-white px-6 py-3 rounded text-sm backdrop-blur">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-red-500/90 text-white px-6 py-3 rounded text-sm backdrop-blur">
            {{ session('error') }}
        </div>
    @endif

    <main class="flex-1 pt-[60px] sm:pt-[68px]">
        @yield('content')
    </main>

    {{-- Back to top --}}
    <a href="#" onclick="window.scrollTo({top:0,behavior:'smooth'}); return false" class="fixed bottom-8 right-8 z-40 w-10 h-10 rounded-lg {{ request()->routeIs('home') ? 'bg-white/90 text-amber-800 shadow-md hover:bg-white' : 'bg-zinc-800 text-zinc-400 hover:bg-zinc-700 hover:text-white' }} flex items-center justify-center transition-colors opacity-0 pointer-events-none border {{ request()->routeIs('home') ? 'border-amber-100' : 'border-transparent' }}" id="back-to-top" aria-label="Yukarı çık">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
    </a>

    <footer class="mt-auto {{ request()->routeIs('home') ? 'bg-white border-t border-amber-100/50' : 'bg-white border-t border-gray-100' }}">
        {{-- CTA (sadece ana sayfa dışında) --}}
        @if(!request()->routeIs('home'))
        <div class="border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 py-12 flex flex-col sm:flex-row items-center justify-between gap-6">
                <p class="text-gray-600 text-sm">Kahve keyfiniz bir tık uzağınızda.</p>
                <a href="{{ route('city.select') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-amber-600 text-white text-sm font-medium hover:bg-amber-500 transition-colors">
                    Sipariş Ver
                </a>
            </div>
        </div>
        @endif

        {{-- Güven rozetleri --}}
        <div class="{{ request()->routeIs('home') ? 'bg-amber-50/30 border-amber-100/50' : 'bg-gray-50 border-gray-100' }} border-b">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="flex items-center gap-4 p-4 rounded-2xl transition-colors group {{ request()->routeIs('home') ? 'bg-white/60 hover:bg-amber-50/50' : 'bg-gray-50 hover:bg-amber-50' }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors {{ request()->routeIs('home') ? 'bg-amber-100 group-hover:bg-amber-200' : 'bg-amber-100 group-hover:bg-amber-200' }}">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Hızlı Teslimat</p>
                            <p class="text-xs text-gray-500">Kapınıza kadar</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-2xl transition-colors group {{ request()->routeIs('home') ? 'bg-white/60 hover:bg-amber-50/50' : 'bg-gray-50 hover:bg-amber-50' }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors bg-amber-100 group-hover:bg-amber-200">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Güvenli Ödeme</p>
                            <p class="text-xs text-gray-500">256-bit SSL</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-2xl transition-colors group {{ request()->routeIs('home') ? 'bg-white/60 hover:bg-amber-50/50' : 'bg-gray-50 hover:bg-amber-50' }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors bg-amber-100 group-hover:bg-amber-200">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Taze Kahve</p>
                            <p class="text-xs text-gray-500">Özenle seçilmiş</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 p-4 rounded-2xl transition-colors group {{ request()->routeIs('home') ? 'bg-white/60 hover:bg-amber-50/50' : 'bg-gray-50 hover:bg-amber-50' }}">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-colors bg-amber-100 group-hover:bg-amber-200">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">7/24 Destek</p>
                            <p class="text-xs text-gray-500">Yanınızdayız</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Ana footer içeriği --}}
        <div class="bg-white text-gray-600">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 py-16">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-12">
                    <div class="lg:col-span-2">
                        <a href="{{ route('home') }}" class="font-display text-2xl font-normal text-gray-900">DrDrink</a>
                        <p class="mt-4 text-sm text-gray-500 max-w-sm leading-relaxed">
                            Kütahya'nın sıcaklığını evinize taşıyoruz. Özenle seçilmiş kahveler, kapınıza kadar.
                        </p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-4">Hızlı Erişim</p>
                        <ul class="space-y-3">
                            <li><a href="{{ route('home') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Ana Sayfa</a></li>
                            <li><a href="{{ route('city.select') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Sipariş Ver</a></li>
                            <li><a href="{{ route('cart.index') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Sepetim</a></li>
                            @auth
                                <li><a href="{{ route('orders.index') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Siparişlerim</a></li>
                            @endauth
                        </ul>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-4">Hesap</p>
                        <ul class="space-y-3">
                            @auth
                                <li><a href="{{ route('profile.edit') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Profil</a></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="inline" onsubmit="this.querySelector('button').disabled=true">
                                        @csrf
                                        <button type="submit" class="text-sm text-gray-500 hover:text-amber-700 transition-colors text-left">Çıkış</button>
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-amber-700 transition-colors">Giriş</a></li>
                            @endauth
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alt bar --}}
        <div class="border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-12 py-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-gray-400">© {{ date('Y') }} DrDrink. Tüm hakları saklıdır.</p>
                    <p class="text-xs text-gray-400">Kütahya'dan Türkiye'ye</p>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('scroll', function() {
            var btn = document.getElementById('back-to-top');
            if (btn) {
                btn.style.transition = 'opacity 0.2s';
                if (window.scrollY > 400) {
                    btn.classList.remove('opacity-0', 'pointer-events-none');
                } else {
                    btn.classList.add('opacity-0', 'pointer-events-none');
                }
            }
        });
    </script>
</body>
</html>
