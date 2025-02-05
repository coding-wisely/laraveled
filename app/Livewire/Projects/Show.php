<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Project Details')]
class Show extends Component
{
    public $project;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function render(): Factory|Application|View
    {
        $cacheKey = 'project_'.$this->project->id.'_viewed_'.request()->ip();
        if (! cache()->has($cacheKey)) {
            $this->project->increment('views');
            cache()->put($cacheKey, true, now()->addDay());
        }

        $startProjectId = request('start', $this->project->id);

        $userProjects = $this->project->user->projects()->orderBy('id')->get();

        $startIndex = $userProjects->search(function ($p) use ($startProjectId) {
            return $p->id == $startProjectId;
        });
        if ($startIndex === false) {
            $startIndex = 0;
        }

        $rotatedProjects = $userProjects->slice($startIndex)
            ->merge($userProjects->take($startIndex))
            ->values();

        $currentIndex = $rotatedProjects->search(function ($p) {
            return $p->id == $this->project->id;
        });

        $prevProject = $currentIndex > 0 ? $rotatedProjects[$currentIndex - 1] : null;
        $nextProject = $currentIndex < $rotatedProjects->count() - 1 ? $rotatedProjects[$currentIndex + 1] : null;

        return view('livewire.projects.show', [
            'project' => $this->project,
            'prevProject' => $prevProject,
            'nextProject' => $nextProject,
            'startProject' => $startProjectId,
        ]);
    }
}
