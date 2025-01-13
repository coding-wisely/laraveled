<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
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

<form wire:submit="login" class="space-y-4">
    <flux:card class="space-y-6">
        <div class="flex w-full items-center justify-center text-center">
            <x-application-logo class="w-32"/>
        </div>
        <div class="text-center">
            <flux:heading size="lg">Log in to your account</flux:heading>
            <flux:subheading>Welcome back!</flux:subheading>
        </div>

        <div class="space-y-6">
            <flux:input
                wire:model="form.email"
                label="Email"
                type="email"
                badge="Required"
                description-trailing="Please provide a valid email."/>
            <flux:input wire:model="form.password"
                        type="password"
                        label="Password"
                        badge="Required"
                        description-trailing="It was at least 8 characters long, include an uppercase letter, a number, and a special character."
                        viewable/>
            <flux:field>
                <div class="mb-3 flex justify-between">
                    <!-- Remember Me -->
                    <flux:checkbox wire:model="form.remember" id="remember" label="Remember me"/>
                    <flux:link href="{{ route('password.request') }}" variant="subtle" class="text-sm">Forgot password?</flux:link>
                </div>
            </flux:field>
        </div>

        <div class="space-y-2">
            <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>

            <flux:button href="{{ route('register') }}" variant="ghost" class="w-full">Sign up for a new account</flux:button>
        </div>
    </flux:card>
</form>


