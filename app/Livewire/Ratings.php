<?php

namespace App\Livewire;

use App\Models\Project;
use App\Models\Rating;
use Filament\Notifications\Notification;
use Flux\Flux;
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

    public $ratingToSubmit = null;

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

    public function confirmSubmitRating($rating)
    {

        $this->ratingToSubmit = $rating;
    }

    public function cancelSubmitRating()
    {
        Flux::modals()->close();
    }

    public function submitRatingConfirmed()
    {
        if ($this->ratingToSubmit) {
            $this->submitRating($this->ratingToSubmit);
        }

        Flux::modals()->close();
    }

    public function submitRating($rating)
    {
        if ($this->sessionRated) {
            Flux::toast(
                heading: 'Already rated',
                text: 'You have already rated this project.',
                variant: 'warning',
            );

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

        Flux::toast(
            heading: 'Thank you',
            text: 'Thank you for rating this project.',
            variant: 'success',
        );

        if ($ratingRecord->project->user->id !== $ratingRecord->user->id) {

            Notification::make()
                ->title('New rating posted')
                ->body("{$ratingRecord->user->name} has given {$ratingRecord->rating} stars to {$ratingRecord->project->title}")
                ->send()->sendToDatabase($ratingRecord->project->user);
        }

    }

    public function render()
    {
        return view('livewire.ratings');
    }
}
