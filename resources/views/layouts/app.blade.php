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
    <livewire:join-waiting-list/>
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
