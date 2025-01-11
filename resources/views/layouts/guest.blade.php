<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxStyles()
        @livewireStyles
    </head>
    <body class="font-sans min-h-screen antialiased">
        <div class="flex-col min-h-screen mx-auto flex sm:justify-center items-center bg-gray-700 dark:bg-gray-900 antialiased text-gray-300 font-sans font-light dark:bg-gradient-to-l from-black via-gray-800 to-black overflow-auto">
                {{ $slot }}
        </div>
    @fluxScripts()
    @livewireScripts
    
    </body>
</html>
