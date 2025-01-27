<?php
namespace App\Livewire\Projects;

use Flux;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Project;

#[Layout('layouts.app')]
class Show extends Component
{
    public $project;


    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        $cacheKey = 'project_' . $this->project->id . '_viewed_' . request()->ip();

        if (!cache()->has($cacheKey)) {
            $this->project->increment('views');
            cache()->put($cacheKey, true, now()->addDay()); // Prevent increments for 1 day
        }

        return view('livewire.projects.show', [
            'project' => $this->project,
        ]);
    }
}
