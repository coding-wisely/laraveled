<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};
?>
<flux:header container="true" class="bg-white dark:bg-zinc-950 border-b border-zinc-200 dark:border-zinc-700 uppercase">
    <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
    <x-application-logo class="h-14 stroke-2 fill-current"/>
    <flux:navbar class="-mb-px max-lg:hidden flex w-full">
        @if (auth()->user())
            <flux:navbar.item
                icon="home"
                href="/dashboard"
                :current="request()->is('dashboard')"
            >
                Dashboard
            </flux:navbar.item>
            <flux:navbar.item
                icon="inbox"
                badge="12"
                href="#"
                :current="request()->is('inbox')"
            >
                Inbox
            </flux:navbar.item>
            <flux:navbar.item
                icon="document-text"
                href="#"
                :current="request()->is('documents')"
            >
                Documents
            </flux:navbar.item>
            <flux:navbar.item
                icon="calendar"
                href="#"
                :current="request()->is('calendar')"
            >
                Calendar
            </flux:navbar.item>
            <flux:spacer/>
            <flux:dropdown position="bottom" align="end" class="max-lg:hidden">
                <flux:profile avatar="/img/demo/user.png" name="{{ auth()->user()->name }}"/>
                @if (request()->routeIs('dashboard'))
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
                        <flux:navmenu.item wire:click="logout()" icon="arrow-right-start-on-rectangle" class="!uppercase">
                            Logout
                        </flux:navmenu.item>
                        <flux:navmenu.item href="#" icon="trash" variant="danger">
                            Delete
                        </flux:navmenu.item>
                    </flux:navmenu>
                @elseif (!request()->routeIs('dashboard'))
                    <flux:menu>
                        <flux:menu.radio.group>
                            <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                            <flux:menu.radio>Truly Delta</flux:menu.radio>
                        </flux:menu.radio.group>
                        <flux:menu.separator/>
                        <flux:menu.item wire:click="logout()" icon="arrow-right-start-on-rectangle">Logout
                        </flux:menu.item>
                    </flux:menu>
                @endif
            </flux:dropdown>
        @else
            <flux:spacer/>
            <flux:navbar.item align="end">
                <flux:button href="{{ route('login') }}" size="sm">Login</flux:button>
                <flux:button href="{{ route('register') }}" size="sm">Register</flux:button>
            </flux:navbar.item>
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

