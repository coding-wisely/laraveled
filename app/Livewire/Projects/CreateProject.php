<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\CreateProjectForm;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Technology;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Str;
use Illuminate\View\View;
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
        $project = Project::create([
            'user_id' => auth()->id(),
            'uuid' => Str::uuid(),
            'title' => $this->form->title,
            'description' => $this->form->description,
            'short_description' => $this->form->short_description ?? '',
            'website_url' => $this->form->website_url ?? '',
            'github_url' => $this->form->github_url ?? '',
        ]);

        // Attach relationships if applicable
        $project->technologies()->sync($this->form->technologies);
        $project->categories()->sync($this->form->categories);
        $project->tags()->sync($this->form->tags);
        foreach ($this->form->files as $file) {
            $project->addMediaFromDisk($file->getRealPath(), 'minio')
                ->setName($file->getClientOriginalName());

        }
        //        $project
        //            ->addMediaFromDisk($this->form->file->getRealPath(), 'minio')
        //            ->setName($this->form->file->getClientOriginalName())
        //            ->toMediaCollection('collection', 'minio');

        session()->flash('success', 'Project created successfully!');

        return redirect()->route('projects.index');
    }

    public function render(): Factory|Application|\Illuminate\Contracts\View\View|View
    {
        return view('livewire.projects.create-project', [
            'allTechnologies' => Technology::all(),
            'allCategories' => Category::all(),
            'allTags' => Tag::all(),
        ]);
    }
}
