<?php

use App\Livewire\CreateProject;
use App\Livewire\Dashboard;
use App\Livewire\Project;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('home');

// Projects
Route::get('/projects', Project::class)->name('projects.index');

// Authentication routes
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', Dashboard::class)
        ->middleware(['auth'])
        ->name('dashboard');
    Route::get('/projects/create', CreateProject::class)->name('projects.create');

});
Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';
if (app()->isProduction()) {

    Route::get('register', function () {
        return view('landing');
    })->name('register');

    Route::get('login', function () {
        return view('landing');
    })->name('login');
}
