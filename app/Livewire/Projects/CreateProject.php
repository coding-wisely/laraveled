<?php

namespace App\Livewire\Projects;

use App\Livewire\Forms\CreateProjectForm;
use App\Models\Category;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Technology;
use Flux\Flux;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

#[Layout('layouts.app')]
class CreateProject extends Component
{
    use WithFileUploads;

    public CreateProjectForm $form;

    /**
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function submit()
    {
        $this->validate();

        $website = $this->form->website_url;
        if ($website && ! (str_starts_with($website, 'http://') || str_starts_with($website, 'https://'))) {
            $website = 'https://'.$website;
        }

        $github = $this->form->github_url;
        if ($github && ! (str_starts_with($github, 'http://') || str_starts_with($github, 'https://'))) {
            $github = 'https://'.$github;
        }

        $project = Project::create([
            'user_id' => auth()->id(),
            'uuid' => Str::uuid(),
            'title' => $this->form->title,
            'description' => $this->form->description,
            'short_description' => $this->form->short_description ?? '',
            'website_url' => $website ?? '',
            'github_url' => $github ?? '',
        ]);

        // Attach relationships
        $project->technologies()->sync($this->form->technologies);
        $project->categories()->sync($this->form->categories);
        $project->tags()->sync($this->form->tags);

        // Handle file uploads
        $uploadedMedia = [];
        foreach ($this->form->files as $index => $file) {
            $media = $project->addMedia($file->getRealPath())
                ->setName($file->getClientOriginalName())
                ->toMediaCollection('projects');

            $uploadedMedia[] = $media->id;
        }

        if ($this->form->cover_image !== null && isset($uploadedMedia[$this->form->cover_image])) {
            DB::table('media')
                ->where('model_type', Project::class)
                ->where('model_id', $project->id)
                ->update(['is_cover' => false]);
            DB::table('media')
                ->where('id', $uploadedMedia[$this->form->cover_image])
                ->update(['is_cover' => true]);
        }

        Flux::toast(
            heading: 'Project Created',
            text: 'Your project has been created successfully.',
            variant: 'success',
        );

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
