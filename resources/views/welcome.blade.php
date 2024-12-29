<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laraveled!</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=abel:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>
<body
    class="relative text-gray-300 font-sans font-light bg-gradient-to-br from-black via-gray-900 to-black min-h-screen  overflow-hidden flex items-center justify-center">

<!-- Blurred Circles -->
<div class="absolute inset-0 flex items-center justify-center">
    <!-- First Circle -->
    <div class="w-[400px] h-[400px] bg-purple-800 rounded-full opacity-50 blur-3xl"></div>
    <!-- Second Circle -->
    <div class="w-[300px] h-[300px] bg-blue-700 rounded-full opacity-40 blur-3xl absolute"></div>
</div>


<!-- Header -->
<header class="fixed top-0 left-0 right-0 bg-gray-900  flex items-center justify-end px-4 py-2 shadow-md z-20">
    <nav class="flex items-center space-x-4">
        <a href="{{ route('login') }}" wire:navigate class=" hover:text-orange-600 transition">Login</a>
<span>|</span>
        <a href="{{ route('register') }}" wire:navigate class=" hover:text-orange-600 transition">Register</a>
    </nav>
</header>
<!-- Content -->
<div class="relative z-10 text-center">
    <!-- Logo -->
    <div class="mb-8 flex justify-center">
            <x-application-logo class="w-64 h-64 text-[#f05441]"/>
    </div>
    <h1 class="text-5xl font-black mb-6">Showcase Your Laravel Creations to the World</h1>
    <p class="text-lg text-gray-300 mb-8">Join the community of passionate developers sharing innovative projects, all
        built with Laravel.</p>
    <a href="{{ route('register') }}" wire:navigate
       class="px-8 py-3 bg-[#f05441] hover:bg-orange-700 text-white font-semibold rounded-lg shadow-lg transition duration-300">
        Get Laraveled!
    </a>
</div>
<livewire:JoinWaitingList />
<!-- Footer -->
<footer class="fixed bottom-0 left-0 right-0 bg-gray-900 text-gray-500 text-center py-3 text-sm z-20">
    &copy; {{ date('Y') }} Laraveled Showcase. All Rights Reserved.
</footer>
</body>
</html>
