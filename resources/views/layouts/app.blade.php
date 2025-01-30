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
    <x-application-logo class="hidden lg:flex"/>
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
        <flux:navbar class=" !w-screen !flex-1">
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
                class="hidden"
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
            <flux:navbar.item href="{{ route('projects.create') }}" class="hidden lg:flex">
                <flux:tooltip content="Bookmarks">
                    <flux:icon.bookmark
                        variant="solid"
                        class="text-red-500 dark:text-red-300"/>
                </flux:tooltip>

            </flux:navbar.item>
        </flux:navbar>
        <flux:navbar.item icon="magnifying-glass" href="#" label="Search"/>

        <flux:dropdown position="bottom" align="end" class="max-lg:hidden" >
                <flux:profile avatar="{{ auth()->user()->getAvatarUrl() }}"/>
                <flux:navmenu>
                    <flux:navmenu.item
                        class="max-lg:hidden"
                        icon="cog-6-tooth"
                        href="{{ route('account-settings') }}"
                        >Profile</flux:navmenu.item>
                    <livewire:logout-button/> 
                     <flux:navmenu.item href="#" icon="trash" variant="danger">Delete</flux:navmenu.item>
                </flux:navmenu>

        </flux:dropdown>
        <flux:navbar class="mr-0 lg:mr-4">
            <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
                         aria-label="Toggle dark mode"/>
        </flux:navbar>
    @else
        <div class="gap-2">
            <flux:button href="{{ route('login') }}" size="sm">Login</flux:button>
            <flux:button href="{{ route('register') }}" size="sm">Register</flux:button>
        </div>
    @endauth
</flux:header>
<!-- Responsive menu -->
<flux:sidebar stashable sticky
              class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
    <flux:sidebar.toggle class="lg:hidden" icon="x-mark"/>
    <div class="flex gap-2 items-center">
        <x-application-logo/>

        <div>
            Laraveled
        </div>
    </div>
    <flux:navlist variant="outline">
        <flux:navlist.item href="{{ route('projects.index') }}">
        </flux:navlist.item>
        <flux:navlist.item icon="globe" href="{{ route('projects.index') }}">Discover Projects</flux:navlist.item>
        <flux:navlist.item icon="crown" href="#">Top 5</flux:navlist.item>
    </flux:navlist>
    <flux:navlist variant="outline">
        <flux:navlist.item icon="bookmark" href="#">Bookmarks</flux:navlist.item>
        <flux:navlist.item icon="puzzle-piece" badge="{{ auth()->user()?->projects->count() }}" href="{{ route('projects.my') }}">My Projects</flux:navlist.item>
    </flux:navlist>
    <flux:spacer/>
    @auth()
        <flux:navlist variant="outline">
            <flux:navlist.item icon="puzzle-piece" href="{{ route('projects.my') }}">My projects</flux:navlist.item>
            <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
        </flux:navlist>
    @endauth
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
