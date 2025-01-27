<?php
namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\Project;

class Index extends Component
{
    public function render()
    {
        $projects = Project::with(['categories', 'tags', 'technologies'])->get();

        return view('livewire.projects.index', [
            'projects' => $projects,
        ]);
    }
}
