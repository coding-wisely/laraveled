<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserProfile extends Component
{
    public $user;

    public $projects;

    public $averageRating;

    public function mount($userId)
    {
        $this->user = User::with(['projects'])->findOrFail($userId);
        $this->projects = $this->user->projects;
        $this->averageRating = $this->user->projects()->with('ratings')->get()
            ->pluck('ratings')
            ->flatten()
            ->avg('rating');
    }

    public function render()
    {
        return view('livewire.user-profile');

    }
}
