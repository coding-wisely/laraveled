<?php

namespace App\Livewire\Projects;

use App\Concerns\HandlesFilters;
use App\Concerns\HandlesShares;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class MyProjects extends Component
{
    use HandlesFilters, HandlesShares;

    public function render()
    {
        $projects = Auth::user()
            ->projects()
            ->with(['categories', 'tags', 'technologies'])
            ->get();

        return view('livewire.projects.my-projects', [
            'projects' => $projects,
        ]);
    }
}
