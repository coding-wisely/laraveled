<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Rules\FileSizeWithName;

class CreateProjectForm extends Form
{
    public array $files = [];
    public string $title;
    public string $description;
    public string $website_url;
    public string $github_url;
    public array $technologies = [];
    public array $categories = [];
    public array $tags = [];

    public function rules(): array
    {
        return [
            'files' => 'required|array',
            'files.*' => [new FileSizeWithName(1024 * 1024)],
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'website_url' => 'required|url',
            'github_url' => 'required|url',
            'technologies' => 'required|array',
            'categories' => 'required|array',
            'tags' => 'required|array',
        ];
    }

    public function messages(): array
    {
        return [
            'files' => 'Oops! It looks like we’re missing something. Please share some screenshots of your beautiful app so we can proceed—your work deserves to shine! 🌟',
        ];
    }

}
