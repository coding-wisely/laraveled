<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laraveled!</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico')}}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Laraveled" />
    <link rel="manifest" href="{{ asset('site.webmanifest') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=abel:300,400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])</head>
@fluxStyles
<body
    class="relative text-gray-300 font-sans font-light bg-gradient-to-br from-black via-gray-900 to-black min-h-screen  overflow-hidden flex items-center justify-center">

<!-- Blurred Circles -->
<div class="absolute inset-0 flex items-center justify-center">
    <!-- First Circle -->
    <div class="w-[400px] h-[400px] bg-purple-800 rounded-full opacity-50 blur-3xl"></div>
    <!-- Second Circle -->
    <div class="w-[300px] h-[300px] bg-red-800 rounded-full opacity-40 blur-3xl absolute"></div>
</div>


<!-- Header -->
{{--<header class="fixed top-0 left-0 right-0 z-50 bg-gray-900  flex items-center justify-end px-4 py-2 shadow-md">--}}
{{--    <nav class="flex items-center space-x-4">--}}
{{--        <a href="{{ route('login') }}" wire:navigate class=" hover:text-orange-600 transition">Login</a>--}}
{{--<span>|</span>--}}
{{--        <a href="{{ route('register') }}" wire:navigate class=" hover:text-orange-600 transition">Register</a>--}}
{{--    </nav>--}}

{{--    <flux:dropdown x-data align="end">--}}
{{--        <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">--}}
{{--            <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />--}}
{{--            <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />--}}
{{--            <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />--}}
{{--            <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />--}}
{{--        </flux:button>--}}
{{--        <flux:menu>--}}
{{--            <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>--}}
{{--            <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>--}}
{{--            <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>--}}
{{--        </flux:menu>--}}
{{--    </flux:dropdown>--}}
{{--</header>--}}
    <div class="max-w-7xl px-2 md:px-6 mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
        <!-- Left Side: Title and Description -->
        <div>
            <h2 class="text-5xl font-black mb-6">What is Laraveled and Why Should You Join?</h2>
            <p class="mb-8">
                Hey Artisan! Imagine a place where your hard work gets the spotlight it deserves—a hub dedicated to showcasing projects built with Laravel and its vibrant ecosystem, including Livewire, Inertia.js, Filament, Vue, and more. That’s exactly what Laraveled is all about.
            </p>
            <ul class="space-y-4">
                <li>
                    <strong class="text-orange-500">Recognition in the Community:</strong> Let the Laravel world see what you’ve built. Showcase your creativity and skills to peers, potential collaborators, and even clients.
                </li>
                <li>
                    <strong class="text-orange-500">Inspire and Get Inspired:</strong> Your project could be the spark someone else needs to innovate. Likewise, you’ll find endless inspiration from other developers’ projects to take your next idea further.
                </li>
                <li>
                    <strong class="text-orange-500">Boost Your Credibility:</strong> Adding your project to Laraveled adds a badge of honor to your work. Stand out as a proud member of the Laravel ecosystem.
                </li>
                <li>
                    <strong class="text-orange-500">Networking Opportunities:</strong> Connect with a thriving community of developers, share ideas, and even collaborate on future projects.
                </li>
                <li>
                    <strong class="text-orange-500">Celebrate Your Work:</strong> By joining Laraveled, you’re not just showcasing your project; you’re celebrating the craft of coding.
                </li>
            </ul>
        </div>

        <!-- Right Side: Logo and Form -->
        <div class="relative flex flex-col items-center justify-end">
            <!-- Application Logo -->
            <div class="mb-6">
                <x-application-logo class="w-96 h-96 text-orange-500" />
            </div>

            <!-- Existing Livewire Form -->
            <div class="relative w-full max-w-md">
                <livewire:JoinWaitingList />
            </div>
        </div>
    </div>


<!-- Footer -->
<footer class="fixed bottom-0 left-0 right-0 bg-gray-900 text-gray-500 text-center py-3 text-xs z-20">
    &copy; {{ date('Y') }} Laraveled Showcase. All Rights Reserved.
</footer>
@fluxScripts

</body>
</html>
