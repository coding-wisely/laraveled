<?php

namespace App\Livewire;

use App\Concerns\HandlesFilters;
use App\Enums\TrackableEnum;
use App\Models\Project;
use Livewire\Component;

class FeaturedProjectsCarousel extends Component
{
    use HandlesFilters;

    public $featuredProjects;

    public function logClick($uuid): void
    {
        $project = Project::where('uuid', $uuid)->first();

        if ($project) {
            $project->logTracks(TrackableEnum::WEBISTE_VISITED);
        }
    }

    public function mount()
    {
        $featured = Project::with('tags', 'media')
            ->where('is_featured', true)
            ->get();

        if ($featured->isEmpty()) {
            $this->featuredProjects = collect([
                [
                    'title' => 'Taskavel.com',
                    'short_description' => 'Intuitive and simple Task Management system. Built on Laravel.',
                    'tags' => ['Project Management', 'Task management', 'Laravel Agile Board', 'Kanban'],
                    'technologies' => ['Laravel', 'Inertia', 'TailwindCSS', 'Vue'],
                    'image' => asset('img.png'),
                    'website' => 'https://taskavel.com',
                ],
                [
                    'title' => 'Invoice client with ease',
                    'short_description' => 'Invoicing.to is a simple and intuitive invoicing system. Keep your invoicing simple and professional.',
                    'tags' => ['Invoicing', 'Creativity', 'Tech'],
                    'technologies' => ['Laravel', 'Inertia', 'TailwindCSS', 'Vue'],
                    'image' => asset('img_2.png'),
                    'website' => 'https://invoicing.to',
                ],

            ]);
        } else {
            // Map the featured projects to the desired array format
            $this->featuredProjects = $featured->map(function ($project) {
                $media = $project->coverImage() ?? $project->getMedia('projects')->first();
                $imageUrl = $media ? $media->getUrl() : asset('img.png');

                $websiteUrl = $project->website_url;
                if (! preg_match('/^https?:\/\//', $websiteUrl)) {
                    $websiteUrl = 'https://'.$websiteUrl;
                }

                return [
                    'title' => $project->title,
                    'uuid' => $project->uuid,
                    'short_description' => $project->short_description,
                    'tags' => $project->tags()->pluck('name')->toArray(),
                    'technologies' => $project->technologies()->pluck('name')->toArray(),
                    'categories' => $project->categories()->pluck('name')->toArray(),
                    'image' => $imageUrl,
                    'website' => $websiteUrl,
                ];
            });
        }
    }

    public function render()
    {
        return view('livewire.featured-projects-carousel');
    }
}
