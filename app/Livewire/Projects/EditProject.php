<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class EditProject extends Component
{
    use WithFileUploads;

    public Project $project;

    public $file;

    public $existingFiles;

    public $form = [
        'title' => '',
        'short_description' => '',
        'description' => '',
        'website_url' => '',
        'github_url' => '',
        'technologies' => [],
        'categories' => [],
        'tags' => [],
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->form = [
            'title' => $project->title,
            'short_description' => $project->short_description,
            'description' => $project->description,
            'website_url' => $project->website_url,
            'github_url' => $project->github_url,
            'technologies' => $project->technologies->pluck('id')->toArray(),
            'categories' => $project->categories->pluck('id')->toArray(),
            'tags' => $project->tags->pluck('id')->toArray(),
        ];

        $this->existingFiles = $project->getMedia('projects');
    }

    public function submit()
    {
        $this->validate([
            'form.title' => 'required|string|max:255',
            'form.short_description' => 'required|string|max:500',
            'form.description' => 'required|string',
            'form.website_url' => 'nullable',
            'form.github_url' => 'nullable',
            'form.technologies' => 'required|array',
            'form.categories' => 'required|array',
            'form.tags' => 'nullable|array',
            'file' => 'nullable|image|max:2048',
        ]);

        $this->project->update([
            'title' => $this->form['title'],
            'short_description' => $this->form['short_description'],
            'description' => $this->form['description'],
            'website_url' => $this->form['website_url'],
            'github_url' => $this->form['github_url'],
        ]);

        $this->project->technologies()->sync($this->form['technologies']);
        $this->project->categories()->sync($this->form['categories']);
        $this->project->tags()->sync($this->form['tags']);

        if ($this->file instanceof TemporaryUploadedFile) {

            $this->project->addMediaFromDisk($this->file->getRealPath())->toMediaCollection('projects');
        }

        return redirect()->route('projects.my');
    }

    public function render()
    {
        return view('livewire.projects.edit-project', [
            'allTechnologies' => \App\Models\Technology::all(),
            'allCategories' => \App\Models\Category::all(),
            'allTags' => \App\Models\Tag::all(),
        ]);
    }
}
