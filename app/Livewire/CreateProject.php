<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Technology;
use App\Models\Category;
use App\Models\Tag;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Spatie\LivewireFilepond\WithFilePond;

#[Layout('layouts.app')]
class CreateProject extends Component
{
    use WithFilePond;

    public $file;
    public $user_id;
    public $title;
    public $description;
    public $slug;
    public $website_url;
    public $github_url;
    public $technologies = [];
    public $categories = [];
    public $tags = [];

    // Validation rules
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|text',
        'website_url' => 'nullable|url',
        'github_url' => 'nullable|url',
        'technologies' => 'array',
        'categories' => 'array',
        'tags' => 'array',
        'file' => 'required|mimetypes:image/jpg,image/jpeg,image/png|max:3000',
    ];

    public function submit()
    {
        $this->validate();

        $project = Project::create([
            'user_id' => auth()->id(),
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'website_url' => $this->website_url,
            'github_url' => $this->github_url,
        ]);

        // Attach relationships if applicable
        $project->technologies()->sync($this->technologies);
        $project->categories()->sync($this->categories);
        $project->tags()->sync($this->tags);

        session()->flash('success', 'Project created successfully!');
        return redirect()->route('projects.index');
    }

    public function render()
    {
        return view('livewire.create-project', [
            'allTechnologies' => Technology::all(),
            'allCategories' => Category::all(),
            'allTags' => Tag::all(),
        ]);
    }
}
