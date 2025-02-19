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

    public $perPage = 10;

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

    public function loadMore()
    {
        $this->perPage += 10;
    }

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

    // this is for the project card badge filter
    public function applyFilter($filter, $value)
    {
        $this->$filter = $value;
    }

    /**
     * Fetch filtered results based on search query
     */
    public function getFilteredResults($type)
    {
        if ($type === 'category') {
            $results = Category::whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->searchQuery['category']).'%'])
                ->limit($this->resultLimit['category'])
                ->get();

            // If a category filter is applied and it's not in the results, appending it so it's displayed in the search bar when clicking the badges from the project card.
            if ($this->category && ! $results->contains(function ($item) {
                return strtolower($item->name) === strtolower($this->category);
            })) {
                $selected = Category::whereRaw('LOWER(name) = ?', [strtolower($this->category)])->first();
                if ($selected) {
                    $results->push($selected);
                }
            }

            return $results;
        }

        if ($type === 'technology') {
            $results = Technology::whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->searchQuery['technology']).'%'])
                ->limit($this->resultLimit['technology'])
                ->get();

            if ($this->technology && ! $results->contains(function ($item) {
                return strtolower($item->name) === strtolower($this->technology);
            })) {
                $selected = Technology::whereRaw('LOWER(name) = ?', [strtolower($this->technology)])->first();
                if ($selected) {
                    $results->push($selected);
                }
            }

            return $results;
        }

        if ($type === 'user') {
            return User::whereRaw('LOWER(name) LIKE ?', ['%'.strtolower($this->searchQuery['user']).'%'])
                ->limit($this->resultLimit['user'])
                ->get();
        }

        return collect();
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

        $projects = $query->paginate($this->perPage);

        return view('livewire.projects.index', [
            'projects' => $projects,
            'categories' => $this->getFilteredResults('category'),
            'technologies' => $this->getFilteredResults('technology'),
            'users' => $this->getFilteredResults('user'),
        ]);
    }
}
