<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')]
class extends Component {
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        // Validate the form
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            // Must be at least 8 characters long, include an uppercase letter, a number, and a special character
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults(), Password::min(8)
                ->mixedCase() // Requires both uppercase and lowercase characters
                ->numbers()   // Requires at least one number
                ->symbols(),],
        ]);

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Create the user and fire the Registered event
        event(new Registered($user = User::create($validated)));

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
};
?>

    <!-- Registration Form -->
<form wire:submit="register">
    <flux:card class="space-y-6 h-screen md:h-full">
        <div class="flex w-full items-center justify-center text-center">
            <x-application-logo class="w-32"/>
        </div>
        <!-- Heading -->
        <div class="text-center">
            <flux:heading size="lg" level="4">Create an Account</flux:heading>
            <flux:subheading>We're excited to have you on board!</flux:subheading>
        </div>

        <!-- Name -->
        <flux:input
            wire:model="name"
            type="name"
            label="Name"
            badge="Required"
            description-trailing="This will be your public name, visible to all visitors."
        />

        <!-- Email -->
        <flux:input
            wire:model="email"
            type="email"
            label="Email"
            badge="Required"
            description-trailing="Please provide a valid email. We will sent you verification email to that address."
        />

        <!-- Password -->

        <flux:input
            wire:model="password"
            type="password"
            label="Password"
            badge="Required"
            description-trailing="Must be at least 8 characters long, include an uppercase letter, a number, and a special character."
            viewable
        />


        <!-- Confirm Password -->

        <flux:input
            wire:model="password_confirmation"
            type="password"
            label="Confirm your password"
            badge="Required"
            description-trailing="Please confirm your password."
            viewable
        />

        <!-- Submit Button -->
        <div class="flex justify-between items-center">
            <a wire:navigate.hover href="{{ route('login') }}" class="text-sm text-red-500 hover:underline">
                Already have an account?
            </a>
            <flux:button type="submit" class="ml-3">Create Account</flux:button>
        </div>
    </flux:card>
</form>
