<?php

namespace App\Livewire\Projects;

use App\Concerns\HandlesFilters;
use App\Concerns\HandlesShares;
use App\Models\Project;
use App\Services\SearchService;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    use HandlesFilters, HandlesShares;

    public $category = '';

    public $technology = '';

    public $user = '';

    public $tag = '';

    public $perPage = 10;

    public $searchQuery = [
        'category' => '',
        'technology' => '',
        'user' => '',
        'tag' => '',
    ];

    public $resultLimit = [
        'category' => 4,
        'technology' => 4,
        'user' => 4,
        'tag' => 4,
    ];

    protected SearchService $searchService;

    public function __construct()
    {
        $this->searchService = app(SearchService::class);
    }

    public function loadMore()
    {
        $this->perPage += 10;
    }

    protected $queryString = ['category', 'technology', 'user', 'tag'];

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
    public function getFilteredResults(string $type)
    {
        $query = $this->searchQuery[$type] ?? '';
        $limit = $this->resultLimit[$type] ?? 10;
        $selectedItem = $this->{$type} ?? null;

        return $this->searchService->search($type, $query, $limit, $selectedItem);
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

        if ($this->tag) {
            $query->whereHas('tags', fn ($q) => $q->where('tags.name', $this->tag));
        }

        if ($this->user) {
            $query->whereHas('user', fn ($q) => $q->where('users.name', $this->user));
        }

        $projects = $query->paginate($this->perPage);

        return view('livewire.projects.index', [
            'projects' => $projects,
            'categories' => $this->getFilteredResults('category'),
            'technologies' => $this->getFilteredResults('technology'),
            'users' => $this->getFilteredResults('user'),
            'tags' => $this->getFilteredResults('tag'),
        ]);
    }
}
