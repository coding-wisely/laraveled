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
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
    <link
        href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet"
    />

</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
@if(app()->isProduction())
    <livewire:join-waiting-list/>
@endif
<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <x-application-logo/>
    <flux:navbar class="-mb-px max-lg:hidden ml-12">
        <flux:navbar.item
            href="{{ route('projects.index') }}"
        >
            <flux:tooltip content="Discover Projects">
                <flux:icon.globe
                    variant="outline"
                    class="text-gray-500 dark:text-gray-300"/>
            </flux:tooltip>
        </flux:navbar.item>

        <flux:spacer/>
        <flux:navbar.item
            href="{{ route('projects.index') }}"
        >
            <flux:tooltip content="Top 5">
                <flux:icon.crown
                    class="text-yellow-500 dark:text-yellow-300"/>
            </flux:tooltip>
        </flux:navbar.item>

        <flux:spacer/>

        <flux:separator vertical variant="subtle" class="my-2"/>
    </flux:navbar>
    <flux:spacer/>
    @auth()
        <flux:navbar>
            <flux:navbar.item
                href="{{ route('dashboard') }}"
            >
                <flux:tooltip content="Dashboard">
                    <flux:icon.home-modern
                        variant="solid"
                        class="text-orange-600 dark:text-amber-300"
                    />
                </flux:tooltip>
            </flux:navbar.item>
            <flux:navbar.item
                badge="{{ auth()->user()->projects->count() }}"
                href="{{ route('projects.my') }}"
            >
                <flux:tooltip content="My Projects">
                    <flux:icon.puzzle-piece
                        variant="solid"
                        class="text-blue-500 dark:text-blue-300"
                    />
                </flux:tooltip>
            </flux:navbar.item>
            <flux:navbar.item
                href="{{ route('projects.create') }}"
            >
                <flux:tooltip content="Add New Project">
                    <flux:icon.folder-plus
                        variant="solid"
                        class="text-green-500 dark:text-green-300"/>
                </flux:tooltip>

            </flux:navbar.item>
            <flux:navbar.item
                href="{{ route('projects.create') }}"
            >
                <flux:tooltip content="Bookmarks">
                    <flux:icon.bookmark
                        variant="solid"
                        class="text-red-500 dark:text-red-300"/>
                </flux:tooltip>

            </flux:navbar.item>
        </flux:navbar>

        <flux:dropdown position="top" align="end" class="ml-6">
            <flux:profile avatar="{{ auth()->user()->getAvatarUrl() }}"/>
            <flux:menu>
                <flux:menu.radio.group>
                    <flux:menu.item>Olivia Martin</flux:menu.item>
                    <flux:menu.item>Truly Delta</flux:menu.item>
                </flux:menu.radio.group>
                <flux:menu.separator/>
                <livewire:logout-button/>
            </flux:menu>
        </flux:dropdown>
        <flux:navbar class="mr-4">
            <flux:navbar.item icon="magnifying-glass" href="#" label="Search"/>
            <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
                         aria-label="Toggle dark mode"/>
        </flux:navbar>
    @else
        <flux:button href="{{ route('login') }}" size="sm">Login</flux:button>
        <flux:button href="{{ route('register') }}" size="sm">Register</flux:button>
    @endauth
</flux:header>

<flux:sidebar stashable sticky
              class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>

    <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden"/>
    <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc."
                class="px-2 hidden dark:flex"/>

    <flux:navlist variant="outline">
        <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
        <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>
        <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>
        <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>

        <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
            <flux:navlist.item href="#">Marketing site</flux:navlist.item>
            <flux:navlist.item href="#">Android app</flux:navlist.item>
            <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
        </flux:navlist.group>
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
@fluxScripts
@livewireScripts
@persist('toast')
<flux:toast position="top right" class="pt-20"/>
@endpersist
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond/dist/filepond.js"></script>
</body>
</html>
