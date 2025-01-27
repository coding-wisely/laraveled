<?php
namespace App\Livewire\Projects;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;



#[Layout('layouts.app')]
class MyProjects extends Component
{
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
