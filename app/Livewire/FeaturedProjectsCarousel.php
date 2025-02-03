<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class FeaturedProjectsCarousel extends Component
{
    public $featuredProjects;

    public function mount()
    {
        $this->featuredProjects = Project::with('tags', 'media')->where('is_featured', true)
            ->get()
            ->map(function ($project) {

                return [
                    'title' => $project->title,
                    'short_description' => $project->short_description,
                    'tags' => $project->tags->pluck('name')->toArray(),
                    'image' => $project->getMedia('projects')->first()->getUrl(),
                ];
            });
    }

    public function render()
    {
        return view('livewire.featured-projects-carousel');
    }
}
