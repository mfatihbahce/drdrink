<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - DrDrink</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|dm-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak]{display:none!important}
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-sans { font-family: 'DM Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100 text-gray-900 min-h-screen" x-data="{ sidebarOpen: false }"
    data-order-sound-enabled="{{ \App\Models\Setting::get('order_notification_sound', '0') ? '1' : '0' }}">
    <div class="flex h-screen overflow-hidden">
        {{-- Admin Sidebar (sabit) --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 h-screen bg-gray-800 flex flex-col transform -translate-x-full lg:translate-x-0 transition-transform duration-200 ease-in-out"
            :class="{ 'translate-x-0': sidebarOpen }">
            <div class="flex flex-col h-full">
                <div class="shrink-0 p-6 border-b border-gray-700">
                    <a href="{{ route('admin.dashboard') }}" class="font-display text-xl font-semibold text-white">DrDrink</a>
                    <p class="text-xs text-gray-400 mt-1">{{ auth()->user()->hasRole('Kasiyer') ? 'Kasiyer Paneli' : 'Yönetim Paneli' }}</p>
                </div>
                <nav class="flex-1 min-h-0 p-4 space-y-1 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.dashboard') ? 'bg-amber-600 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                        Dashboard
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.orders.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                        Siparişler
                        @php $newOrdersCount = \App\Models\Order::where('status', 'pending')->where('created_at', '>=', now()->subMinutes(5))->count(); @endphp
                        @if($newOrdersCount > 0)
                            <span class="ml-auto bg-amber-500 text-black text-xs font-bold rounded-full px-2 py-0.5">{{ $newOrdersCount }}</span>
                        @endif
                    </a>
                    @unless(auth()->user()->hasRole('Kasiyer'))
                    <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.products.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                        Ürünler
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.categories.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                        Kategoriler
                    </a>
                    <a href="{{ route('admin.cities.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.cities.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        İller
                    </a>
                    <a href="{{ route('admin.stores.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.stores.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Mağazalar
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.users.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Kullanıcılar
                    </a>
                    @can('roles.view')
                    <a href="{{ route('admin.roles.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.roles.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                        Roller
                    </a>
                    @endcan
                    <a href="{{ route('admin.integrations.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.integrations.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z"/></svg>
                        Entegrasyonlar
                    </a>
                    <a href="{{ route('admin.settings.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.settings.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 2.31.826.77 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 2.31-2.37.77a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-2.31-.826-.77-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-2.31 2.37-.77.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        Genel Ayarlar
                    </a>
                    @endunless
                    @can('activity_log.view')
                    <a href="{{ route('admin.activity-log.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-300 hover:bg-gray-700 hover:text-white transition {{ request()->routeIs('admin.activity-log.*') ? 'bg-gray-700 text-white' : '' }}">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Activity Log
                    </a>
                    @endcan
                </nav>
                <div class="shrink-0 p-4 border-t border-gray-700 space-y-1">
                    @if(auth()->user()->hasStoreAccess())
                    <a href="{{ route('store.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-400 hover:bg-gray-700 hover:text-white transition">
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        Mağaza Paneli
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

        {{-- Overlay mobile --}}
        <div x-show="sidebarOpen" x-transition @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-30 lg:hidden" x-cloak></div>

        {{-- Sidebar spacer (desktop) - fixed sidebar için yer tutucu --}}
        <div class="hidden lg:block w-64 shrink-0"></div>

        {{-- Main content --}}
        <div class="flex-1 flex flex-col min-w-0 min-h-0">
            <header class="shrink-0 z-20 bg-white border-b border-gray-200 px-4 sm:px-6 lg:px-8">
                <div class="flex items-center justify-between h-16">
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 -ml-2 rounded-lg text-gray-500 hover:bg-gray-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <h1 class="text-lg font-medium text-gray-800 truncate">@yield('header', 'Admin')</h1>
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

    {{-- Yeni sipariş bildirimi (tüm admin sayfalarında) --}}
    <div id="new-order-toast" class="fixed top-20 right-4 z-40 hidden opacity-0 transition-all duration-300 bg-emerald-600 text-white px-5 py-3.5 rounded-xl shadow-xl font-semibold flex items-center gap-3 border border-emerald-500/30 cursor-pointer" onclick="window.location.href='{{ route('admin.orders.index') }}'">
        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <span>Yeni sipariş geldi!</span>
    </div>

    @push('scripts')
    <script>
    (function() {
        if (document.body.dataset.orderSoundEnabled !== '1') return;
        if (localStorage.getItem('drdrink_sound_unlocked') !== '1') return;

        var pollEl = document.querySelector('[data-orders-poll]');
        var lastId = parseInt(pollEl?.dataset.lastOrderId || '0', 10) || 0;
        var lastCheck = pollEl?.dataset.lastOrderAt || new Date().toISOString();
        var skipFirst = !pollEl;
        var audio = new Audio('{{ asset("sounds/new-order.wav") }}');
        audio.preload = 'auto';

        function poll() {
            var url = lastId ? '{{ route("admin.api.new-orders") }}?last_id=' + lastId : '{{ route("admin.api.new-orders") }}?last_check=' + encodeURIComponent(lastCheck);
            fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
                .then(function(r) { return r.json(); })
                .then(function(d) {
                    if (skipFirst) { skipFirst = false; }
                    else if (d.has_new) {
                        audio.currentTime = 0;
                        audio.play().catch(function() {});
                        var t = document.getElementById('new-order-toast');
                        if (t) { t.classList.remove('hidden','opacity-0'); t.classList.add('animate-pulse'); setTimeout(function(){ t.classList.remove('animate-pulse'); setTimeout(function(){ t.classList.add('opacity-0'); setTimeout(function(){ t.classList.add('hidden'); }, 300); }, 4000); }, 500); }
                        var tb = document.getElementById('orders-tbody');
                        if (tb) fetch('{{ route("admin.orders.index") }}' + (window.location.search || ''), { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } }).then(function(r){ return r.json(); }).then(function(x){ if(x.tbody) tb.innerHTML = x.tbody; if(x.pagination) { var p = document.getElementById('orders-pagination'); if(p) p.innerHTML = x.pagination; } if(x.last_order_id != null) lastId = x.last_order_id; }).catch(function(){});
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
