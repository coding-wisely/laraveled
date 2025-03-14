<?php

namespace App\Livewire;

use App\Models\Project;
use Livewire\Component;

class SearchPanel extends Component
{
    public $query = '';

    public $projects = [];

    public function searchProject()
    {
        // Load related models to display user, categories, tags, and technologies in the view.
        $this->projects = Project::with('user', 'categories', 'tags', 'technologies')
            ->whereRaw('LOWER(title) LIKE LOWER(?)', ["%{$this->query}%"])
            ->orWhereHas('categories', function ($q) {
                $q->whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$this->query}%"]);
            })
            ->orWhereHas('tags', function ($q) {
                $q->whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$this->query}%"]);
            })
            ->orWhereHas('technologies', function ($q) {
                $q->whereRaw('LOWER(name) LIKE LOWER(?)', ["%{$this->query}%"]);
            })
            ->get();
    }

    public function render()
    {
        return view('livewire.search-panel');
    }
}
