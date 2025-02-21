<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Rules\FileSizeWithName;
use Flux\Flux;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class EditProject extends Component
{
    use WithFileUploads;

    public Project $project;

    public array $files = [];

    public $existingFiles;

    public $cover_image_id;

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

        $this->cover_image_id = $this->project->coverImage()?->id;

    }

    public function setCoverImage($mediaId)
    {
        DB::transaction(function () use ($mediaId) {
            $this->project->media()->update(['is_cover' => false]);

            $this->project->media()->where('id', $mediaId)->first()->update(['is_cover' => true]);

        });

        $this->project->refresh();
        $this->existingFiles = $this->project->getMedia('projects');

        Flux::toast('Cover image updated successfully!');
    }

    public function removeImage($mediaId)
    {
        $media = $this->project->getMedia('projects')->firstWhere('id', $mediaId);

        if ($media) {
            $media->delete();
            $this->project->refresh();
            $this->existingFiles = $this->project->getMedia('projects');
            Flux::toast('Image removed successfully');
        }
    }

    public function submit()
    {
        $this->validate([
            'form.title' => 'required|string|max:255',
            'form.short_description' => 'required|string|max:255',
            'form.description' => 'required|string',
            'form.website_url' => 'required|string',
            'form.github_url' => 'nullable|string',
            'form.technologies' => 'required|array',
            'form.categories' => 'required|array',
            'form.tags' => 'nullable|array',
            'files' => 'required|array|max:3',
            'files.*' => [new FileSizeWithName(1024 * 3024)],
        ]);

        $existingCount = $this->project->getMedia('projects')->count();
        $newFilesCount = count($this->files);
        $allowedRemaining = 3 - $existingCount;

        if ($newFilesCount > $allowedRemaining) {
            $this->addError('files', "You can only upload {$allowedRemaining} more image".($allowedRemaining === 1 ? '' : 's').'.');

            return;
        }

        $website = $this->form['website_url'];
        if ($website && ! (str_starts_with($website, 'http://') || str_starts_with($website, 'https://'))) {
            $website = 'https://'.$website;
        }

        $github = $this->form['github_url'];
        if ($github && ! (str_starts_with($github, 'http://') || str_starts_with($github, 'https://'))) {
            $github = 'https://'.$github;
        }

        $this->project->update([
            'title' => $this->form['title'],
            'short_description' => $this->form['short_description'],
            'description' => $this->form['description'],
            'website_url' => $website,
            'github_url' => $github,
        ]);

        $this->project->technologies()->sync($this->form['technologies']);
        $this->project->categories()->sync($this->form['categories']);
        $this->project->tags()->sync($this->form['tags']);

        // Handle file uploads
        foreach ($this->files as $index => $file) {
            if ($existingCount >= 3) {
                Flux::toast(
                    heading: 'Maximum of 3 images allowed.',
                    text: 'Please remove an image before adding a new one.',
                    variant: 'warning'
                );
                break;
            }

            if ($file instanceof TemporaryUploadedFile) {
                $media = $this->project->addMedia($file->getRealPath())
                    ->setName($file->getClientOriginalName())
                    ->toMediaCollection('projects');
                $existingCount++;

                // If this was selected as the cover image, set it
                if ($this->cover_image_id === "new-{$index}") {
                    $this->setCoverImage($media->id);
                }
            }
        }

        $this->existingFiles = $this->project->getMedia('projects');
        $this->cover_image_id = $this->project->coverImage()?->id;

        Flux::toast(
            heading: 'Project updated successfully!',
            text: 'Your project details have been updated.',
            variant: 'success'
        );

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
