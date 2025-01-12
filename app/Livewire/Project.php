<?php

namespace App\Livewire;

use CodingWisely\SlugGenerator\SlugGenerator;
use Livewire\Component;

class Project extends Component
{
    use SlugGenerator;

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
