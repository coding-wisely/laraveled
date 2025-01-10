<?php

use App\Livewire\CreateProject;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateProject::class)
        ->assertStatus(200);
});
