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
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Top extends Component
{

    use WithPagination;

    public $category = '';

    public $technology = '';

    public $user = '';

    public $perPage = 10;

    protected $queryString = ['category', 'technology', 'user'];

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function updated($field)
    {
        $this->resetPage();
    }

    public function render(): Factory|Application|View
    {
        $query = Project::with(['user', 'categories', 'tags', 'technologies', 'ratings']);

        if ($this->category) {
            $query->whereHas('categories', function ($q) {
                $q->where('categories.name', $this->category);
            });
        }

        if ($this->technology) {
            $query->whereHas('technologies', function ($q) {
                $q->where('technologies.name', $this->technology);
            });
        }

        if ($this->user) {
            $query->whereHas('user', function ($q) {
                $q->where('users.name', $this->user);
            });
        }

        $projects = $query->paginate($this->perPage);

        return view('livewire.projects.top', [
            'projects' => $projects,
            'categories' => Category::all(),
            'technologies' => Technology::all(),
            'users' => User::all(),
        ]);
    }
}
