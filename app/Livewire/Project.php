<?php

namespace App\Livewire;

use Livewire\Component;

class Project extends Component
{

    public ?Project $project = null;

    public function create()
    {
        return view('livewire.project-create');
    }
    public function render()
    {
        return view('livewire.project');
    }
}
