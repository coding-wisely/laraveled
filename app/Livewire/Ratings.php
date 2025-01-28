<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Ratings extends Component
{
    public $project;

    public $averageRating;

    public $totalRatings;

    public $userRating;

    public $sessionRating;

    public $sessionRated;

    public $userRated;

    public function mount(Project $project)
    {
        $this->project = $project;

        $this->averageRating = $this->project->ratings()->avg('rating') ?? 0;
        $this->totalRatings = $this->project->ratings()->count();

        if (Auth::check()) {
            $this->userRating = $this->project->ratings()
                ->where('user_id', Auth::id())
                ->value('rating');
        }

        $this->sessionRating = $this->project->ratings()
            ->where('session_id', session()->getId())
            ->where('user_id', Auth::id())
            ->value('rating');

        $this->userRated = ! is_null($this->userRating);
        $this->sessionRated = ! is_null($this->sessionRating);
    }

    public function submitRating($rating)
    {
        if ($this->sessionRated) {
            session()->flash('error', 'You have already rated this project in this session.');

            return;
        }

        $ratingRecord = Rating::updateOrCreate(
            [
                'project_id' => $this->project->id,
                'user_id' => Auth::id(),
            ],
            [
                'session_id' => session()->getId(),
                'rating' => $rating,
            ]
        );

        $this->averageRating = $this->project->ratings()->avg('rating') ?? 0;
        $this->totalRatings = $this->project->ratings()->count();
        $this->userRating = $ratingRecord->rating;
        $this->userRated = true;
        $this->sessionRated = true;

        session()->flash('success', 'Thank you for your feedback!');
    }

    public function render()
    {
        return view('livewire.ratings');
    }
}
