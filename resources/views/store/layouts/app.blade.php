<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Mağaza') - DrDrink</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|dm-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>[x-cloak]{display:none!important}.font-display{font-family:'Cormorant Garamond',Georgia,serif}.font-sans{font-family:'DM Sans',system-ui,sans-serif}</style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 min-h-screen" x-data="{ sidebarOpen: false }"
    data-order-sound-enabled="{{ \App\Models\Setting::get('order_notification_sound', '0') ? '1' : '0' }}">
    <div class="flex h-screen overflow-hidden">
        @unless(auth()->user()->hasRole('Kasiyer'))
        <aside class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-gray-800 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen }">
            <div class="flex flex-col h-full">
                <div class="shrink-0 p-6 border-b border-gray-700">
                    <a href="{{ route('store.dashboard') }}" class="font-display text-xl font-semibold text-white">DrDrink</a>
                    <p class="text-xs text-gray-400 mt-1">Mağaza Paneli</p>
                    <p class="text-xs text-gray-500 mt-1">{{ $store->name ?? '' }}</p>
                </div>
                <nav class="flex-1 min-h-0 p-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('store.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.dashboard') ? 'bg-amber-600 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('store.pos.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.pos.*') ? 'bg-amber-600 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        Satış Ekranı
                    </a>
                    @if(auth()->user()->managedStore())
                    <a href="{{ route('store.quick-sales.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.quick-sales.*') ? 'bg-amber-600 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                        Hızlı Satışlar
                    </a>
                    @endif
                    <a href="{{ route('store.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.orders.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Paket Sipariş
                    </a>
                    <a href="{{ route('store.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.products.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Ürünler
                    </a>
                    <a href="{{ route('store.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Kategoriler
                    </a>
                    <a href="{{ route('store.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.settings.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 2.31.826.77 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 2.31-2.37.77a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-2.31-.826-.77-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-2.31 2.37-.77.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Ayarlar
                    </a>
                    @if(auth()->user()->managedStore())
                    <a href="{{ route('store.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('store.users.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Kasiyerler
                    </a>
                    @endif
                </nav>
                <div class="shrink-0 p-4 border-t border-gray-700 space-y-1">
                    @if(auth()->user()->hasAnyRole(['Super Admin', 'Yönetici', 'Personel']))
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                        Admin Paneli
                    </a>
                    @endif
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                        Siteye Dön
                    </a>
                    <div class="px-4 py-2 text-sm text-gray-500">{{ auth()->user()->name }}</div>
                    <form method="POST" action="{{ route('logout') }}" onsubmit="this.querySelector('button').disabled=true">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 rounded-lg text-gray-400 hover:bg-red-900/30 hover:text-red-300 transition">
                            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H9a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"/></svg>
                            Çıkış
                        </button>
                    </form>
                </div>
            </div>
        </aside>
        <div x-show="sidebarOpen" x-transition @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 lg:hidden" x-cloak></div>
        <div class="hidden lg:block w-64 shrink-0"></div>
        @endunless
        <div class="flex-1 flex flex-col min-w-0 min-h-0">
            <header class="shrink-0 z-20 bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    @unless(auth()->user()->hasRole('Kasiyer'))
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 rounded-lg text-gray-500 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    @endunless
                    <h1 class="text-lg font-medium text-gray-800 truncate">@yield('header', 'Mağaza')</h1>
                    @if(auth()->user()->hasRole('Kasiyer'))
                    <div class="flex items-center gap-2">
                        <a href="{{ route('store.pos.index') }}" class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-amber-500 text-black text-sm font-medium hover:bg-amber-400 transition {{ request()->routeIs('store.pos.*') ? 'ring-2 ring-amber-600' : '' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            Satış Ekranı
                        </a>
                        <a href="{{ route('store.orders.index') }}" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 bg-white text-sm text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition">Paket Sipariş</a>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-700">{{ $store->name ?? '' }}</span>
                        <span class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 bg-gray-50 text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline" onsubmit="this.querySelector('button').disabled=true">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-gray-300 bg-white text-sm text-gray-600 hover:bg-gray-50 hover:border-gray-400 transition">Çıkış</button>
                        </form>
                    </div>
                    @endif
                </div>
            </header>
            <main class="flex-1 min-h-0 overflow-y-auto p-4 sm:p-6 lg:p-8">
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

    <div id="new-order-toast" class="fixed top-20 right-4 z-40 hidden opacity-0 transition-all duration-300 bg-emerald-600 text-white px-5 py-3.5 rounded-xl shadow-xl font-semibold flex items-center gap-3 border border-emerald-500/30 cursor-pointer" onclick="window.location.href='{{ route('store.orders.index') }}'">
        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <span>Yeni paket sipariş geldi!</span>
    </div>

    @push('scripts')
    <script>
    (function() {
        var pollEl = document.querySelector('[data-orders-poll]');
        if (!pollEl) return;

        var lastId = parseInt(pollEl.dataset.lastOrderId || '0', 10) || 0;
        var lastCheck = pollEl.dataset.lastOrderAt || new Date().toISOString();
        var skipFirst = true;
        var soundEnabled = document.body.dataset.orderSoundEnabled === '1' && localStorage.getItem('drdrink_sound_unlocked') === '1';
        var audio = soundEnabled ? new Audio('{{ asset("sounds/new-order.wav") }}') : null;
        if (audio) audio.preload = 'auto';

        function poll() {
            var url = lastId ? '{{ route("store.api.new-orders") }}?last_id=' + lastId : '{{ route("store.api.new-orders") }}?last_check=' + encodeURIComponent(lastCheck);
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    if (skipFirst) { skipFirst = false; }
                    else if (d.has_new) {
                        if (audio) { audio.currentTime = 0; audio.play().catch(function() {}); }
                        var t = document.getElementById('new-order-toast');
                        if (t) { t.classList.remove('hidden','opacity-0'); t.classList.add('animate-pulse'); setTimeout(function(){ t.classList.remove('animate-pulse'); setTimeout(function(){ t.classList.add('opacity-0'); setTimeout(function(){ t.classList.add('hidden'); }, 300); }, 4000); }, 500); }
                        var banner = document.getElementById('new-order-alert-banner');
                        if (banner) { banner.classList.remove('hidden'); setTimeout(function(){ banner.classList.add('hidden'); }, 10000); }
                        var tb = document.getElementById('orders-tbody');
                        if (tb) fetch('{{ route("store.orders.index") }}' + (window.location.search || ''), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } }).then(function(r){ return r.json(); }).then(function(x){ if(x.tbody) tb.innerHTML = x.tbody; if(x.pagination) { var p = document.getElementById('orders-pagination'); if(p) p.innerHTML = x.pagination; } if(x.last_order_id != null) lastId = x.last_order_id; }).catch(function(){});
                    }
                    if (d.last_id != null) lastId = d.last_id;
                    if (d.last_check) lastCheck = d.last_check;
                })
                .catch(function() {});
        }

        setInterval(poll, 2000);
        setTimeout(poll, 500);
    })();
    </script>
    @endpush

    @stack('scripts')
</body>
</html>
