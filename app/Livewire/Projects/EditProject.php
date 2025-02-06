<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use App\Rules\FileSizeWithName;
use Flux\Flux;
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

        foreach ($this->files as $file) {
            if ($existingCount >= 3) {
                Flux::toast(
                    heading: 'Maximum of 3 images allowed.',
                    text: 'Please remove an image before adding a new one.',
                    variant: 'warning'
                );
                break;
            }

            if ($file instanceof TemporaryUploadedFile) {
                $this->project->addMediaFromDisk($file->getRealPath())
                    ->setName($file->getClientOriginalName())
                    ->toMediaCollection('projects');
                $existingCount++;
            }
        }

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
