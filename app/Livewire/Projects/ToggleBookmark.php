<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Flux\Flux;
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

            Flux::toast(
                heading: 'Bookmark Removed',
                text: 'Project has been removed from your bookmarks',
                variant: 'warning'
            );
        } else {
            $this->project->bookmark();
            $this->bookmarked = true;

            Flux::toast(
                heading: 'Bookmark Added',
                text: 'Project has been added to your bookmarks',
                variant: 'success'
            );
        }
    }

    public function render()
    {
        return view('livewire.projects.toggle-bookmark');
    }
}
