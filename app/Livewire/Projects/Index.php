<?php

namespace App\Livewire\Projects;

use App\Models\Category;
use App\Models\Project;
use App\Models\Technology;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $category = '';

    public $technology = '';

    public $user = '';

    public $searchQuery = [
        'category' => '',
        'technology' => '',
        'user' => '',
    ];

    public $resultLimit = [
        'category' => 4,
        'technology' => 4,
        'user' => 4,
    ];

    protected $queryString = ['category', 'technology', 'user'];

    /**
     * Custom function to update search query and load more results dynamically
     */
    public function loadMoreResults($type, $value)
    {
        if (isset($this->searchQuery[$type])) {
            $this->searchQuery[$type] = $value;

            if (empty($value)) {
                $this->resultLimit[$type] = 4;
            } else {
                $this->resultLimit[$type] += 5;
            }
        }
    }

    /**
     * Fetch filtered results based on search query
     */
    public function getFilteredResults($type)
    {
        switch ($type) {
            case 'category':
                return Category::where('name', 'ilike', '%'.$this->searchQuery['category'].'%')
                    ->limit($this->resultLimit['category'])
                    ->get();
            case 'technology':
                return Technology::where('name', 'ilike', '%'.$this->searchQuery['technology'].'%')
                    ->limit($this->resultLimit['technology'])
                    ->get();
            case 'user':
                return User::where('name', 'ilike', '%'.$this->searchQuery['user'].'%')
                    ->limit($this->resultLimit['user'])
                    ->get();
            default:
                return collect();
        }
    }

    public function render(): Factory|Application|View
    {
        $query = Project::with(['user', 'categories', 'tags', 'technologies', 'ratings']);

        if ($this->category) {
            $query->whereHas('categories', fn ($q) => $q->where('categories.name', $this->category));
        }

        if ($this->technology) {
            $query->whereHas('technologies', fn ($q) => $q->where('technologies.name', $this->technology));
        }

        if ($this->user) {
            $query->whereHas('user', fn ($q) => $q->where('users.name', $this->user));
        }

        $projects = $query->paginate(10);

        return view('livewire.projects.index', [
            'projects' => $projects,
            'categories' => $this->getFilteredResults('category'),
            'technologies' => $this->getFilteredResults('technology'),
            'users' => $this->getFilteredResults('user'),
        ]);
    }
}
