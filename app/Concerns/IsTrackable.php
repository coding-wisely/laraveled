<?php

namespace App\Concerns;

use App\Models\Track;
use Illuminate\Support\Facades\Auth;

trait IsTrackable
{
    /**
     * Define a polymorphic relationship for tracking activities.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function tracks()
    {
        return $this->morphMany(Track::class, 'trackable');
    }

    /**
     * Log a trackable action.
     *
     * @return void
     */
    public function logTracks($action)
    {
        $this->tracks()->create([
            'action' => $action,
            'user_id' => Auth::id(),
        ]);

    }
}
