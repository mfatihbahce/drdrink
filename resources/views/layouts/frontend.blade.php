<!DOCTYPE html>
<html lang="tr" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name'))</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|plus-jakarta-sans:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }
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
<body class="font-sans antialiased bg-gray-50 text-gray-900" x-data="{ mobileMenuOpen: false }" :class="{ 'overflow-hidden': mobileMenuOpen }">
    @php $cartCount = app(\App\Services\CartService::class)->count(); @endphp
    <nav id="main-nav" class="fixed top-0 left-0 right-0 z-50 py-3 sm:py-4 px-4 sm:px-6 lg:px-12 bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto flex justify-between items-center gap-4">
            <a href="{{ route('home') }}" class="font-display text-xl sm:text-2xl font-semibold tracking-tight text-gray-900">DrDrink</a>

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

    <main class="pt-[60px] sm:pt-[68px] min-h-screen">
        @yield('content')
    </main>

    <footer class="border-t border-gray-200 bg-gray-50 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-12 py-12 sm:py-16">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                <div class="sm:col-span-2 lg:col-span-1">
                    <a href="{{ route('home') }}" class="font-display text-2xl font-semibold text-gray-900">DrDrink</a>
                    <p class="mt-3 text-sm text-gray-500">Kütahya'dan evinize kahve keyfi.</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Hızlı Erişim</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Ana Sayfa</a></li>
                        <li><a href="{{ route('city.select') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Sipariş Ver</a></li>
                        <li><a href="{{ route('cart.index') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Sepetim</a></li>
                        @auth
                            <li><a href="{{ route('orders.index') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Siparişlerim</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-900 uppercase tracking-wider mb-4">Hesap</h3>
                    <ul class="space-y-3">
                        @auth
                            <li><a href="{{ route('profile.edit') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Profil</a></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="inline" onsubmit="this.querySelector('button').disabled=true">
                                    @csrf
                                    <button type="submit" class="text-gray-500 hover:text-amber-600 transition text-sm text-left">Çıkış</button>
                                </form>
                            </li>
                        @else
                            <li><a href="{{ route('login') }}" class="text-gray-500 hover:text-amber-600 transition text-sm">Giriş</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
            <div class="mt-10 pt-8 border-t border-gray-100 flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="text-xs text-gray-400">© {{ date('Y') }} DrDrink. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>
</body>
</html>
