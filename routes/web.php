<?php

use App\Livewire\AccountSettings;
use App\Livewire\ContactUs;
use App\Livewire\Dashboard;
use App\Livewire\Projects\CreateProject;
use App\Livewire\Projects\Index as PublicProjects;
use App\Livewire\Projects\MyProjects;
use App\Livewire\Projects\Show as ProjectDetails;
use App\Livewire\Projects\Top;
use App\Livewire\Projects\UserProjects;
use App\Livewire\UserProfile;
use Illuminate\Support\Facades\Route;

// Landing page
Route::get('/', function () {
    return view('landing');
})->name('home');
//
// // Publicly accessible routes
Route::get('/projects', PublicProjects::class)->name('projects.index'); // Public: List all projects
Route::get('/projects/{project:uuid}', ProjectDetails::class)->name('projects.show'); // Public: View a specific project
Route::get('/users/{user}/projects', UserProjects::class)->name('user.projects'); // Public: View projects by a specific user
Route::get('/top/{category?}', Top::class)->name('projects.top'); // Public: Top projects

Route::get('/profile/{userId}', UserProfile::class)->name('user.profile'); // public profile

Route::get('/contact-us', ContactUs::class)->name('contact-us'); // Public: Contact Us

// Authenticated routes
Route::middleware(['auth'])->group(function () {
    Route::get('/project/create', CreateProject::class)->name('projects.create'); // Auth: Create a project
    Route::get('/projects/{project}/edit', \App\Livewire\Projects\EditProject::class)
        ->name('projects.edit');

    Route::get('/my-projects', MyProjects::class)->name('projects.my'); // Auth: Manage own projects
    Route::get('dashboard', Dashboard::class)->name('dashboard'); // Auth: Dashboard
    Route::get('account-settings', AccountSettings::class)->name('account-settings'); // Auth: Account settings
    Route::get('bookmarks', \App\Livewire\ListBookmark::class)->name('bookmarks'); // Auth: Bookmarks
    Route::get('notifications', \App\Livewire\ListNotifications::class)->name('notifications'); // Auth: Notifications

});
// Authentication-related overrides for production
// if (app()->isProduction()) {
//    Route::get('register', fn () => view('landing'))->name('register');
//    Route::get('login', fn () => view('landing'))->name('login');
// }

require __DIR__.'/auth.php';
