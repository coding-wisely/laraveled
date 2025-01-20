<?php

namespace App\Livewire;

use App\Livewire\Forms\CreateProjectForm;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class CreateProject extends Component
{
    use WithFileUploads;

    public CreateProjectForm $form;


    public function submit()
    {
        $this->validate();
        //$slug = $this->generateSlugManually();
        $project = Project::create([
            'user_id' => auth()->id(),
            'uuid' => Str::uuid(),
            'title' => $this->title,
            'description' => $this->description,
            'website_url' => $this->website_url,
            'github_url' => $this->github_url,
            // 'slug' => $slug,
        ]);

        // Attach relationships if applicable
        $project->technologies()->sync($this->technologies);
        $project->categories()->sync($this->categories);
        $project->tags()->sync($this->tags);
        $project
            ->addMediaFromDisk($this->file->getRealPath(), 'minio')
            ->setName($this->file->getClientOriginalName())
            ->toMediaCollection('collection', 'minio');

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
