<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
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
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        // Hash the password
        $validated['password'] = Hash::make($validated['password']);

        // Create the user and fire the Registered event
        event(new Registered($user = User::create($validated)));

        // Log the user in
        Auth::login($user);

        // Redirect to the dashboard
        $this->redirect(route('home', absolute: false), navigate: true);
    }
};
?>
<div class="w-full max-w-md bg-gray-800 shadow-md rounded-lg px-8 py-6 space-y-6">
    <!-- Heading -->
    <div class="text-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Create an Account</h1>
        <p class="text-sm text-gray-600 dark:text-gray-400">We're excited to have you on board!</p>
    </div>

    <!-- Registration Form -->
    <form wire:submit.prevent="register" class="space-y-4">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <flux:input 
                wire:model.defer="name"
                id="name"
                type="text"
                placeholder="Enter your name"
                required
                class="block w-full mt-1"
            />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <flux:input 
                wire:model.defer="email"
                id="email"
                type="email"
                placeholder="Enter your email address"
                required
                class="block w-full mt-1"
            />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />
            <flux:input 
                wire:model.defer="password"
                id="password"
                type="password"
                placeholder="Enter your password"
                required
                class="block w-full mt-1"
                viewable
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <flux:input 
                wire:model.defer="password_confirmation"
                id="password_confirmation"
                type="password"
                placeholder="Confirm your password"
                required
                class="block w-full mt-1"
                viewable
            />
            @if ($password !== $password_confirmation)
                <p class="text-sm text-red-500 mt-2">Passwords do not match.</p>
            @endif
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <div class="flex justify-between items-center">
            <a href="{{ route('login') }}" class="text-sm text-red-500 hover:underline">Already have an account?</a>
            <flux:button type="submit" class="ml-3">Create Account</flux:button>
        </div>
    </form>
</div>


