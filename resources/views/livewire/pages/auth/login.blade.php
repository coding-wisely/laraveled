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

        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }
}; ?>

<div class="w-full max-w-md bg-gray-800 shadow-md rounded-lg px-8 py-6 space-y-6">
    <!-- Application Logo -->
    <div class="flex justify-center mb-4">
        <x-application-logo class="w-20 h-20" />
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form wire:submit.prevent="login" class="space-y-4">
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input 
                wire:model.defer="form.email"
                id="email" 
                class="block w-full mt-1 text-black"
                type="email" 
                name="email"
                placeholder="Enter your email" 
                required 
                autofocus 
            />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <div class="relative">
                <flux:input 
                    type="password" 
                    wire:model.defer="form.password" 
                    id="password" 
                    class="block w-full mt-1"
                    placeholder="Enter your password"
                    autocomplete="current-password"
                    viewable
                >
                </flux:input>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input 
                wire:model="form.remember" 
                id="remember" 
                type="checkbox" 
                class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-red-600 !focus:ring-none"
            />
            <label for="remember" class="ml-2 text-sm hover:cursor-pointer hover:text-gray-700 dark:hover:text-gray-200">
                {{ __('Remember me') }}
            </label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a 
                    href="{{ route('password.request') }}" 
                    class="text-sm text-red-500 font-medium"
                >
                    {{ __('Forgot your password?') }}
                </a>
            @endif
            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>

    <!-- Register Link -->
    <div class="text-center mt-4">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            {{ __('Don\'t have an account?') }}
            <a href="{{ route('register') }}" class="text-red-500 font-medium">
                {{ __('Register') }}
            </a>
        </p>
    </div>
</div>


