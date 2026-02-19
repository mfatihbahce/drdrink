<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hesabım') - DrDrink</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|dm-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-sans { font-family: 'DM Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex min-h-screen">
        {{-- Sidebar --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-white border-r border-gray-200 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen }">
            {{-- Logo üstte + mobil kapat butonu --}}
            <div class="shrink-0 p-6 border-b border-gray-100 flex items-start justify-between gap-4">
                <div>
                    <a href="{{ route('home') }}" @click="sidebarOpen = false" class="font-display text-2xl font-semibold tracking-tight">DrDrink</a>
                    <p class="text-xs text-gray-500 mt-1">Hesabım</p>
                </div>
                <button type="button" @click="sidebarOpen = false" class="lg:hidden p-2 -m-2 rounded-lg text-gray-500 hover:bg-gray-100" aria-label="Menüyü kapat">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            {{-- Ortada kaydırılabilir menü - mobilde link tıklanınca menü kapanır --}}
            <nav class="flex-1 min-h-0 overflow-y-auto p-4 space-y-1">
                <a href="{{ route('orders.index') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('orders.*') ? 'bg-amber-50 text-amber-700 font-medium' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                    Siparişlerim
                </a>
                <a href="{{ route('profile.edit') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('profile.*') ? 'bg-amber-50 text-amber-700 font-medium' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profil
                </a>
                <a href="{{ route('addresses.index') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition {{ request()->routeIs('addresses.*') ? 'bg-amber-50 text-amber-700 font-medium' : '' }}">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Adresler
                </a>
                <a href="{{ route('city.select') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Sipariş Ver
                </a>
                <a href="{{ route('home') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-600 hover:bg-amber-50 hover:text-amber-700 transition">
                    <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Ana Sayfa
                </a>
            </nav>

            {{-- User + Çıkış altta sabit --}}
            <div class="shrink-0 p-4 border-t border-gray-100 mt-auto">
                <div class="px-4 py-2 text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                <form method="POST" action="{{ route('logout') }}" onsubmit="this.querySelector('button').disabled=true">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-gray-600 hover:bg-red-50 hover:text-red-600 transition">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/></svg>
                        Çıkış
                    </button>
                </form>
            </div>
        </aside>

        {{-- Overlay mobile --}}
        <div x-show="sidebarOpen" x-transition @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 lg:hidden" x-cloak></div>

        {{-- Sidebar spacer (desktop) - fixed sidebar akıştan çıktığı için yer tutucu --}}
        <div class="hidden lg:block w-64 shrink-0"></div>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="shrink-0 z-20 bg-white/95 backdrop-blur border-b border-gray-200 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 rounded-lg text-gray-500 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <a href="{{ route('cart.index') }}" class="flex items-center gap-2 ml-auto p-2 -m-2 rounded-lg text-gray-600 hover:bg-gray-100">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        @if(($cartCount = app(\App\Services\CartService::class)->count()) > 0)
                            <span class="bg-amber-500 text-black text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">{{ $cartCount }}</span>
                        @endif
                    </a>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8">
                @if(session('success'))
                    <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg text-sm">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg text-sm">{{ session('error') }}</div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
