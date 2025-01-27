<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class UserProjects extends Component
{
    public function render()
    {
        $user = Auth::user();

        // Retrieve the user's projects with their associated relationships
        $projects = $user->projects()->with(['categories', 'tags', 'technologies'])->get();

        return view('livewire.user-projects', [
            'projects' => $projects,
        ]);
    }
}
