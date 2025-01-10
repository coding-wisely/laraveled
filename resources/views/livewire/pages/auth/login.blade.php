<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full max-w-md">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form wire:submit="login">
        <!-- Email Address -->
        <div>
            <flux:input icon="envelope" type="email" autocomplete="off"  required placeholder="Type your email address" wire:model="form.email" autofocus/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <flux:input type="password" value="password" autocomplete="current-password" wire:model="form.password">
                <x-slot name="iconTrailing">
                    <flux:button size="sm" variant="subtle" icon="eye" class="-mr-1" />
                </x-slot>
            </flux:input>
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember" class="inline-flex items-center">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-orange-600 shadow-sm focus:ring-orange-500 dark:focus:ring-orange-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm hover:cursor-pointer hover:text-gray-200 dark:hover:text-gray-100">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm  hover:text-gray-200 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="flex justify-end items-center mt-4">
            <span class="text-sm hover:cursor-pointer hover:text-gray-200 dark:hover:text-gray-100">{{ __('Don\'t have an account?') }}</span>
            <a href="{{ route('register') }}"
               class="ms-2 text-sm hover:cursor-pointer text-orange-500 hover:text-orange-600 dark:hover:text-orange-400">Register</a>
        </div>
    </form>
    <div class="flex items-end justify-center mt-4">
        <x-application-logo class="w-44" />
    </div>
</div>
