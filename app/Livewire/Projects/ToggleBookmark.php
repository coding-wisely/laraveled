<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;

class ToggleBookmark extends Component
{
    public Project $project;

    public bool $bookmarked;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->bookmarked = $project->isBookmarked();
    }

    public function toggleBookmark()
    {
        if ($this->bookmarked) {
            $this->project->unmark();
            $this->bookmarked = false;
        } else {
            $this->project->bookmark();
            $this->bookmarked = true;
        }
    }

    public function render()
    {
        return view('livewire.projects.toggle-bookmark');
    }
}
