<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Laraveled.') }}</title>

    <meta name="description"
        content="Laraveled is a free platform where developers showcase and explore Laravel projects. Browse by industry, Laravel version, and tech stack.">
    <meta name="keywords" content="laravel, showcase, projects, discover, tech stack, industry, version">
    <meta name="author" content="Laraveled.com">
    <meta name="robots" content="index, follow">

    <meta property="og:title" content="{{$title ?? config('app.name', 'Laraveled – Showcase & Discover Laravel Projects')}}">
    <meta property="og:description" content="Laraveled is a free platform where developers showcase and explore Laravel projects. Browse by industry, Laravel version, and tech stack.">
    <meta property="og:url" content="{{ $url ?? route('home') }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="Laraveled.com">

    <meta property="og:image" content="{{ $image ?? asset('laraveled-og.webp')}}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" ccontent="{{ $title ?? config('app.name', 'Laraveled is a free platform where developers showcase and explore Laravel projects.')}}">
    <meta name="twitter:description" content="{{ $title ?? 'Laraveled is a free platform where developers showcase and explore Laravel projects.'}}">
        <meta name="twitter:image" content="{{ $image ?? asset('laraveled-og.webp') }}">
    <meta name="twitter:site" content="@CodingWisely">
    <meta name="twitter:creator" content="@CodingWisely">
    <meta name="twitter:card" content="summary_large_image">


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:300,400,500,600,700&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=abel:300,400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @fluxStyles
    @livewireStyles
    <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
    <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css"
        rel="stylesheet" />

</head>

<body class="animated-gradient min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />
        <x-application-logo class="hidden lg:flex" />
        <flux:navbar class="-mb-px max-lg:hidden ml-12">
            <flux:navbar.item href="{{ route('projects.index') }}">
                <flux:tooltip content="Discover Projects">
                    <flux:icon.globe variant="outline" class="text-gray-500 dark:text-gray-300" />
                </flux:tooltip>
            </flux:navbar.item>

            <flux:spacer />
            <flux:navbar.item href="{{ route('projects.top') }}">
                <flux:tooltip content="Top 6">
                    <flux:icon.crown class="text-yellow-500 dark:text-yellow-300" />
                </flux:tooltip>
            </flux:navbar.item>

            <flux:spacer />

            <flux:separator vertical variant="subtle" class="my-2" />
        </flux:navbar>
        <flux:spacer />
        @auth()
            <flux:navbar class=" !w-screen !flex-1">
                <flux:navbar.item href="{{ route('dashboard') }}">
                    <flux:tooltip content="Dashboard">
                        <flux:icon.home-modern variant="solid" class="text-orange-600 dark:text-amber-300" />
                    </flux:tooltip>
                </flux:navbar.item>
                <flux:navbar.item href="{{ route('projects.create') }}">
                    <flux:tooltip content="Add New Project">
                        <flux:icon.folder-plus variant="solid" class="text-green-500 dark:text-green-300" />
                    </flux:tooltip>
                </flux:navbar.item>
                <flux:navbar.item href="{{ route('bookmarks') }}" class="hidden lg:flex">
                    <flux:tooltip content="Bookmarks">
                        <flux:icon.bookmark variant="solid" class="text-red-500 dark:text-red-300" />
                    </flux:tooltip>
                </flux:navbar.item>
            </flux:navbar>

            <livewire:search-panel />

            <livewire:notifications-panel />

            <flux:dropdown position="bottom" align="end" class="max-lg:hidden">
                <flux:profile avatar="{{ auth()->user()->getAvatarUrl() }}" />
                <flux:navmenu>
                    <flux:navmenu.item class="max-lg:hidden" icon="cog-6-tooth" href="{{ route('account-settings') }}">
                        Profile</flux:navmenu.item>
                    <flux:navmenu.item class="max-lg:hidden" icon="folder-open" href="{{ route('projects.my') }}">My
                        Projects</flux:navmenu.item>
                    <flux:navmenu.item class="max-lg:hidden" icon="inbox" href="{{ route('contact-us') }}">Contact Us
                    </flux:navmenu.item>
                    <livewire:logout-button />
                </flux:navmenu>

            </flux:dropdown>

            <flux:navbar class="mr-0 lg:mr-4">
                <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle"
                    aria-label="Toggle dark mode" />
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
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        <div class="flex gap-2 items-center">
            <x-application-logo />

            <div>
                Laraveled
            </div>
        </div>
        <flux:navlist variant="outline">
            <flux:navlist.item href="{{ route('projects.index') }}">
            </flux:navlist.item>
            <flux:navlist.item icon="globe" href="{{ route('projects.index') }}">Discover Projects
            </flux:navlist.item>
            <flux:navlist.item icon="crown" href="{{ route('projects.top') }}">Top 6</flux:navlist.item>
            <flux:navlist.item icon="bookmark" href="{{ route('bookmarks') }}">Bookmarks</flux:navlist.item>
            <flux:navlist.item icon="puzzle-piece" badge="{{ auth()->user()?->projects->count() }}"
                href="{{ route('projects.my') }}">My Projects</flux:navlist.item>
        </flux:navlist>
        <flux:spacer />
        @auth()
            <flux:navlist variant="outline">
                <flux:navlist.item  icon="cog-6-tooth" href="{{ route('account-settings') }}">
                    Profile
                </flux:navlist.item>
                <flux:navlist.item  icon="inbox" href="{{ route('contact-us') }}">
                    Contact Us
                </flux:navlist.item>
                <livewire:logout-button />
            </flux:navlist>
        @endauth
    </flux:sidebar>

    <flux:main container>
        {{ $slot }}
    </flux:main>
    @fluxScripts
    @livewireScripts
    @guest
        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-95N854CX0N"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-95N854CX0N');
        </script>
    @endguest
    @persist('toast')
        <flux:toast position="top right" class="pt-20" />
    @endpersist
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
</body>

</html>
