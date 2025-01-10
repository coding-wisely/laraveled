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
    @fluxStyles()
</head>
<body class="font-sans min-h-screen bg-white dark:bg-zinc-800 antialiased">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
        <flux:brand href="/" wire:navigate logo="{{ asset('laraveled.svg') }}" name="Laraveled.com"
                    class="max-lg:hidden dark:hidden"/>
        <flux:brand href="/" logo="{{ asset('laraveled.svg') }}" name="Laraveled.com"
                    class="max-lg:!hidden hidden dark:flex"/>
        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="{{ route('dashboard') }}" current>Dashboard</flux:navbar.item>
            <flux:separator vertical variant="subtle" class="my-2"/>
        </flux:navbar>
        <flux:spacer/>
        <flux:navbar class="mr-4">
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings"/>
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help"/>
        </flux:navbar>

        <flux:dropdown position="top" align="start">
            <flux:profile avatar="https://fluxui.dev/img/demo/user.png"/>

            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                    <flux:menu.radio>Truly Delta</flux:menu.radio>
                </flux:menu.radio.group>

                <flux:menu.separator/>

                <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
        <flux:spacer/>
        <flux:dropdown x-data align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini" class="text-zinc-500 dark:text-white" />
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
            </flux:button>

            <flux:menu>
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    <flux:sidebar stashable sticky
                  class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>
        <flux:brand href="#" logo="{{ asset('laraveled.svg') }}" name="Laraveled.com" class="px-2 dark:hidden"/>
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
        </flux:navlist>

        <flux:spacer/>

        <flux:navlist variant="outline">
            <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>
    </flux:sidebar>

    <flux:main container>
        {{ $slot }}
    </flux:main>
@fluxScripts()

</body>
</html>
