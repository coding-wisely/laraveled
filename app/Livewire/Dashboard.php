<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Dashboard extends Component
{
    public $projectCount = 10;

    public $publicProjectCount = 5;

    public $showForm = false;

    public $name;

    public $description;

    public $categories = [];

    public $availableCategories = [];

    public $user;

    public $totalProjects;

    public $avgRating;

    public $userProjects;

    public $dummyReports = [
        ['name' => 'Project Alpha', 'category' => 'Web Development', 'status' => 'Completed'],
        ['name' => 'Project Beta', 'category' => 'Mobile App', 'status' => 'In Progress'],
        ['name' => 'Project Gamma', 'category' => 'Data Analysis', 'status' => 'Completed'],
    ];

    public function mount()
    {
        $this->availableCategories = Category::all();
        $this->user = Auth::user();
        $this->totalProjects = Project::count();
        $this->userProjects = $this->user->projects()->withCount(['comments', 'ratings'])->get();

        $this->avgRating = $this->user->projects()->with('ratings')->get()
            ->pluck('ratings')
            ->flatten()
            ->avg('rating');

    }

    public function toggleForm()
    {
        $this->showForm = ! $this->showForm;
    }

    public function submit()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'categories' => 'required|array',
        ]);

        // Create a new project
        $project = Project::create([
            'title' => $this->name,
            'description' => $this->description,
            'user_id' => Auth::id(),
        ]);

        $project->categories()->sync($this->categories);

        $this->projectCount++;

        $this->reset(['name', 'description', 'categories']);
        $this->showForm = false;

        session()->flash('message', 'Project added successfully!');
    }

    public function render()
    {
        return view('livewire.dashboard', [
            'availableCategories' => $this->availableCategories,
        ]);
    }
}
