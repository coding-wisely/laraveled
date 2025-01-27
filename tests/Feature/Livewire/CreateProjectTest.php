<?php

use App\Livewire\Projects\CreateProject;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateProject::class)
        ->assertStatus(200);
});
