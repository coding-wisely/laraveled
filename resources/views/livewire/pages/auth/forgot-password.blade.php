<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>
<form wire:submit="sendPasswordResetLink">
    <flux:card class="space-y-6 h-screen md:h-full">
        <flux:heading>{{ __('Forgot your password?') }}</flux:heading>
        <flux:subheading>{{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</flux:subheading>
        <div class="space-y-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')"/>
        </div>

        <div class="space-y-6">
            <flux:input
                wire:model="email"
                label="Email"
                type="email"
                badge="Required"
                description-trailing="{{  __('We will send you email reset link to this address.')}}"/>
        </div>

        <!-- Submit Button -->
        <div class="flex flex-col gap-2 justify-between">
            <flux:button type="button" href="{{ route('login') }}" wire:navigate
                         icon-trailing="face-smile">{{ __('Oh, actually i remember it now!') }}</flux:button>
            <flux:button type="submit">{{ __('Email Password Reset Link') }}</flux:button>
        </div>
    </flux:card>
</form>
