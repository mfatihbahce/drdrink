<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|dm-sans:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .font-display { font-family: 'Cormorant Garamond', Georgia, serif; }
        .font-sans { font-family: 'DM Sans', system-ui, sans-serif; }
    </style>
</head>
<body class="font-sans antialiased bg-gray-50 text-gray-900 min-h-screen">
    <div class="min-h-screen flex flex-col">
        <header class="py-6 px-6 lg:px-12">
            <a href="{{ route('home') }}" class="font-display text-2xl font-semibold tracking-tight text-gray-900 hover:text-amber-600 transition">
                DrDrink
            </a>
        </header>

        <main class="flex-1 flex items-center justify-center px-4 py-12">
            <div class="w-full max-w-md">
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-8 sm:p-10">
                    {{ $slot }}
                </div>
                <p class="text-center text-sm text-gray-500 mt-6">
                    <a href="{{ route('home') }}" class="hover:text-amber-600 transition">← Ana sayfaya dön</a>
                </p>
            </div>
        </main>
    </div>
</body>
</html>
