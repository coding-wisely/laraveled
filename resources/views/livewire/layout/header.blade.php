<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};
?>
<flux:header container class="bg-zinc-50 relative dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">

    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <x-application-logo class="h-10 stroke-2 fill-current"/>
    <flux:spacer />
    <flux:navbar class="ml-3 -mb-px max-lg:hidden flex w-full">
        @if (auth()->user())
            <flux:navbar.item
                icon="home"
                href="{{ route('dashboard') }}"
            >
                Dashboard
            </flux:navbar.item>
            <flux:navbar.item
                icon="puzzle-piece"
                badge="{{ auth()->user()->projects->count() }}"
                href="{{ route('projects.my') }}"
            >
                My Projects
            </flux:navbar.item>

            <flux:spacer/>
            <flux:dropdown position="bottom" align="end" class="max-lg:hidden">
                <flux:profile avatar="/img/demo/user.png" name="{{ auth()->user()->name }}"/>
                <flux:navmenu>
                    <flux:navmenu.item href="#" icon="user">
                        Account
                    </flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="building-storefront">
                        Profile
                    </flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="credit-card">
                        Billing
                    </flux:navmenu.item>
                    <flux:navmenu.item wire:click="logout()"
                                       icon="arrow-right-start-on-rectangle">
                        Logout
                    </flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="trash" variant="danger">
                        Delete
                    </flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        @else
            <flux:spacer/>

            <flux:button href="{{ route('login') }}" size="sm">Login</flux:button>
            <flux:button href="{{ route('register') }}" size="sm">Register</flux:button>
        @endif
        <flux:dropdown x-data align="end">
            <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini"
                               class="text-zinc-500 dark:text-white"/>
                <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini"
                                class="text-zinc-500 dark:text-white"/>
                <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini"/>
                <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini"/>
            </flux:button>
            <flux:menu>
                <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System</flux:menu.item>
            </flux:menu>
        </flux:dropdown>
    </flux:navbar>
</flux:header>

