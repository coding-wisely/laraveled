<?php

namespace App\Livewire\Forms;

use App\Rules\FileSizeWithName;
use Livewire\Form;

class CreateProjectForm extends Form
{
    public array $files = [];

    public string $title;

    public string $short_description;

    public string $description;

    public string $website_url;

    public string $github_url;

    public array $technologies = [];

    public array $categories = [];

    public array $tags = [];

    public $cover_image = null;

    public function rules(): array
    {
        return [
            'files' => 'required|array|max:3',
            'files.*' => [new FileSizeWithName(1024 * 3024)],
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'website_url' => 'required',
            'technologies' => 'required|array',
            'categories' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'files' => 'Oops! It looks like we’re missing something. Please share some screenshots of your beautiful app so we can proceed—your work deserves to shine! 🌟',
            'files.max' => 'You can only upload a maximum of 3 files.',
        ];
    }
}
