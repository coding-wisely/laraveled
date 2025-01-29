<?php
namespace App\Livewire\Projects;

use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Project;

#[Layout('layouts.app')]
class Index extends Component
{
    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        $projects = Project::with(['user','categories', 'tags', 'technologies', 'ratings'])->get();

        return view('livewire.projects.index', [
            'projects' => $projects,
        ]);
    }
}
