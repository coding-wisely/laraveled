<?php
namespace App\Livewire\Projects;

use Livewire\Component;
use App\Models\User;

class UserProjects extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $projects = $this->user
            ->projects()
            ->with(['categories', 'tags', 'technologies'])
            ->get();

        return view('livewire.projects.user-projects', [
            'projects' => $projects,
            'user' => $this->user,
        ]);
    }
}
