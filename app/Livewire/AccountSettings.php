<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class AccountSettings extends Component
{
    public $name;

    public $email;

    public $bio;

    public $newPassword;

    public $confirmPassword;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        $user->update($validated);

        Flux::toast(
            heading: 'Profile updated',
            text: 'Your profile information has been updated.',
            variant: 'success',
        );

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function updatePassword()
    {
        $this->validate([
            'newPassword' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->newPassword),
        ]);

        $this->reset(['newPassword', 'confirmPassword']);

        Flux::toast(
            heading: 'Password updated',
            text: 'Your password has been updated.',
            variant: 'success',
        );
    }

    public function render()
    {
        return view('livewire.account-settings');
    }
}
