<?php

namespace App\Livewire;

use Flux\Flux;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class AccountSettings extends Component
{
    use WithFileUploads;

    public $name;

    public $email;

    public $bio;

    public $newPassword;

    public $confirmPassword;

    public $avatar;

    public $currentAvatar;

    public $previewAvatarUrl;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->bio = $user->bio;
        $this->currentAvatar = $user->getFirstMediaUrl('users') ?? asset('images/default-user.png');
    }

    public function updatedAvatar()
    {
        if ($this->avatar instanceof TemporaryUploadedFile) {
            $this->previewAvatarUrl = $this->avatar->temporaryUrl();
        }
    }

    public function updateProfileInformation()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable', 'string', 'max:500'],
        ]);

        if ($this->avatar instanceof TemporaryUploadedFile) {

            $user->addMedia($this->avatar->getRealPath())->toMediaCollection('users');

            $this->currentAvatar = $user->getFirstMediaUrl('users');
            $this->previewAvatarUrl = null;
        }

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
