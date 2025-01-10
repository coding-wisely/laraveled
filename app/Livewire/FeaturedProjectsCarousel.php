<?php
namespace App\Livewire;
use Livewire\Component;
class FeaturedProjectsCarousel extends Component
{
    public $featuredProjects = [
        [
            'title' => 'E-commerce Platform',
            'description' => 'A full-featured online store built with Laravel and Livewire',
            'tags' => ['Laravel', 'Livewire', 'Alpine.js', 'MySQL'],
            'image' => 'https://picsum.photos/800/600',
        ],
        [
            'title' => 'Task Management',
            'description' => 'Collaborative project management tool with real-time updates',
            'tags' => ['Laravel', 'Vue.js', 'Tailwind', 'Redis'],
            'image' => 'https://picsum.photos/800/600',
        ],
        [
            'title' => 'Learning Platform',
            'description' => 'Online course platform with video streaming capabilities',
            'tags' => ['Laravel', 'React', 'PostgreSQL', 'AWS'],
            'image' => 'https://picsum.photos/800/600',
        ],
    ];
    public function render()
    {
        return view('livewire.featured-projects-carousel');
    }
}
