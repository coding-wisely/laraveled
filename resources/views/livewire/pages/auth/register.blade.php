<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<form wire:submit="register" class="w-full max-w-md">
    <div class="mb-6">
        <flux:heading class="text-inherit">Create an account</flux:heading>
        <flux:subheading class="text-inherit">We're excited to have you on board.</flux:subheading>
    </div>

    <flux:input icon="envelope" wire:model="email" type="email" autocomplete="new-email" required placeholder="Type your email address" autofocus class="mb-6" />

    <div class="mb-6 flex flex-col gap-4 space-y-2">
        <flux:input
                    wire:model="password"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Type your password"
                    viewable/>
        <flux:input
                    wire:model="password_confirmation"
                    type="password"
                    placeholder="Confirm password"
                    autocomplete="new-password"
                    viewable/>
    </div>
    <div class="flex justify-between">
        <flux:button href="{{ route('login') }}" wire:navigate>Already have account?</flux:button>
        <flux:button type="submit" >Create account</flux:button>
    </div>
    <div class="flex items-end justify-center mt-4">
        <x-application-logo class="w-44" />
    </div>
</form>

