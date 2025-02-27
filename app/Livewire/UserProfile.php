<?php

namespace App\Livewire;

use App\Enums\TrackableEnum;
use App\Models\Company;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class UserProfile extends Component
{
    public $user;

    public $projects;

    public $averageRating;

    public $companies;

    public function mount($userId)
    {
        $this->user = User::with(['projects', 'companies'])->findOrFail($userId);
        $this->projects = $this->user->projects()->with('categories', 'technologies', 'tags')->get();
        $this->averageRating = $this->user->projects()->with('ratings')->get()
            ->pluck('ratings')
            ->flatten()
            ->avg('rating');

        $this->companies = $this->user->companies;
    }

    public function logClick($companyId): void
    {
        $company = Company::find($companyId);
        if ($company) {
            $company->logTracks(TrackableEnum::WEBISTE_VISITED);
        }

        $this->projects->loadMissing('categories', 'technologies', 'tags');
    }

    public function render()
    {
        return view('livewire.user-profile');

    }
}
