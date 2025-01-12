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
        <div>
            <flux:heading size="lg">Log in to your account</flux:heading>
            <flux:subheading>Welcome back!</flux:subheading>
        </div>

        <div class="space-y-6">
            <flux:input wire:model="form.email" label="Email" type="email" placeholder="Your email address"/>

            <flux:field>
                <div class="mb-3 flex justify-between">
                    <flux:label>Password</flux:label>

                    <flux:link href="#" variant="subtle" class="text-sm">Forgot password?</flux:link>
                </div>

                <flux:input wire:model="form.password" type="password" placeholder="Your password"/>
            </flux:field>
        </div>

        <div class="space-y-2">
            <flux:button type="submit" variant="primary" class="w-full">Log in</flux:button>

            <flux:button href="{{ route('register') }}" variant="ghost" class="w-full">Sign up for a new account</flux:button>
        </div>
    </flux:card>
</form>


