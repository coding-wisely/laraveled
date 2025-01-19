<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400&display=swap" rel="stylesheet"/>
    <link href="https://fonts.bunny.net/css?family=abel:300,400,500,600,700&display=swap" rel="stylesheet"/>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
    @livewireStyles
</head>
<body
    class="antialiased font-sans min-h-screen">
<div class="min-h-screen">
    @if(app()->isProduction())
    <livewire:join-waiting-list/>
    @endif
    @auth
        <!-- Sidebar (Desktop Only) -->
        <aside class="hidden md:flex flex-col w-64 bg-gray-100 dark:bg-gray-800 py-8 px-6 space-y-6">
            <h2 class="text-3xl font-extrabold text-laravel-500 dark:text-laravel-600 mb-8">Laraveled</h2>
            <nav class="space-y-4">
                <a href="#" class="block text-lg font-bold hover:text-laravel-800 dark:hover:text-laravel-500">Dashboard</a>
                <a href="#" class="block text-lg font-bold hover:text-laravel-800 dark:hover:text-laravel-500">My Projects</a>
                <a href="#" class="block text-lg font-bold hover:text-laravel-800 dark:hover:text-laravel-500">Favorites</a>
                <a href="#" class="block text-lg font-bold hover:text-laravel-800 dark:hover:text-laravel-500">Settings</a>
                <a href="#" class="block text-lg font-bold hover:text-laravel-700">Logout</a>
            </nav>
        </aside>
        @endauth
    <livewire:layout.header/>

    <livewire:layout.mobile-slide-in-navigation/>

    <flux:main container>
        {{ $slot }}
    </flux:main>
</div>
@fluxScripts
@livewireScripts
@persist('toast')
<flux:toast position="top right" class="pt-20"/>
@endpersist
</body>
</html>
