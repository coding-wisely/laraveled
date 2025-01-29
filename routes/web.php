<?php
use App\Livewire\Projects\CreateProject;
use App\Livewire\Projects\Index as PublicProjects;
use App\Livewire\Projects\Show as ProjectDetails;
use App\Livewire\Projects\MyProjects;
use App\Livewire\Dashboard;
use App\Livewire\Projects\UserProjects;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('home');
//
//// Publicly accessible routes
Route::get('/projects', PublicProjects::class)->name('projects.index'); // Public: List all projects
Route::get('/projects/{project:uuid}', ProjectDetails::class)->name('projects.show'); // Public: View a specific project
Route::get('/users/{user}/projects', UserProjects::class)->name('user.projects'); // Public: View projects by a specific user

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/project/create', CreateProject::class)->name('projects.create'); // Auth: Create a project
    Route::get('/my-projects', MyProjects::class)->name('projects.my'); // Auth: Manage own projects
    Route::get('dashboard', Dashboard::class)->name('dashboard'); // Auth: Dashboard
    Route::view('profile', 'profile')->name('profile'); // Auth: Profile page
});
// Authentication-related overrides for production
if (app()->isProduction()) {
    Route::get('register', fn() => view('landing'))->name('register');
    Route::get('login', fn() => view('landing'))->name('login');
}

require __DIR__ . '/auth.php';
