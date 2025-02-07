<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class FeaturedProjectsCarousel extends Component
{
    public $featuredProjects;

    public function mount()
    {
        $featured = Project::with('tags', 'media')
            ->where('is_featured', true)
            ->get();

        if ($featured->isEmpty()) {
            $this->featuredProjects = collect([
                [
                    'title' => 'Your Project Could Be Here!',
                    'short_description' => 'Showcase your amazing work and join our community of innovative creators.',
                    'tags' => ['Laravel', 'Livewire', 'Tailwind'],
                    'image' => asset('img_2.png'),
                    'website' => 'https://laraveled.com',
                ],
                [
                    'title' => 'Make Your Mark',
                    'short_description' => 'Be featured among the best projects. Let your creativity shine!',
                    'tags' => ['Innovation', 'Creativity', 'Tech'],
                    'image' => asset('img.png'),
                    'website' => 'https://laraveled.com',
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
                    'short_description' => $project->short_description,
                    'tags' => $project->tags->pluck('name')->toArray(),
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
