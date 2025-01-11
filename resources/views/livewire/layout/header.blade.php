<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};
?>
<flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left"/>
        <flux:brand href="#" logo="{{ asset('laraveled.svg') }}" name="Laraveled.com"
                    class="max-lg:hidden dark:hidden"/>
        <flux:brand href="#" logo="{{ asset('laraveled.svg') }}" name="Laraveled.com"
                    class="max-lg:!hidden hidden dark:flex"/>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" href="#" current>Dashboard</flux:navbar.item>
            <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
            <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
            <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

            <flux:separator vertical variant="subtle" class="my-2"/>

            <flux:dropdown class="max-lg:hidden">
                <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>

                <flux:navmenu>
                    <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                    <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                    <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
                </flux:navmenu>
            </flux:dropdown>
        </flux:navbar>

        <flux:spacer/>

        <flux:navbar class="mr-4">
            <flux:navbar.item icon="magnifying-glass" href="#" label="Search"/>
            <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings"/>
            <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help"/>
        </flux:navbar>

        @if (auth()->user())
        <flux:dropdown position="bottom" align="end" class="max-lg:hidden" >
            <flux:profile avatar="/img/demo/user.png" name="{{ auth()->user()->name }}" />

            @if (request()->routeIs('dashboard'))
                <flux:navmenu>
                    <flux:navmenu.item href="#" icon="user">Account</flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="building-storefront">Profile</flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="credit-card">Billing</flux:navmenu.item>
                    <flux:navmenu.item wire:click="logout()" icon="arrow-right-start-on-rectangle">Logout</flux:navmenu.item>
                    <flux:navmenu.item href="#" icon="trash" variant="danger">Delete</flux:navmenu.item>
                </flux:navmenu>
            @elseif (!request()->routeIs('dashboard'))
                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>{{ auth()->user()->name }}</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />
                    <flux:menu.item wire:click="logout()" icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            @endif
        </flux:dropdown>
    @else
        <flux:navbar class="mr-2">
            <flux:button href="{{ route('login') }}" size="sm">Login</flux:button>
            <flux:button href="{{ route('register') }}" size="sm">Register</flux:button>
        </flux:navbar>
    @endif
        <flux:spacer/>
    </flux:header>
