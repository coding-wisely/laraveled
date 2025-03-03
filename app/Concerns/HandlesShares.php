<?php

namespace App\Concerns;

use App\Enums\TrackableEnum;
use App\Models\Project;
use Flux\Flux;

trait HandlesShares
{
    /**
     * Share a project on social media using its ID.
     *
     * @param  int  $projectId
     * @return void
     */
    public function share($projectId)
    {
        $project = Project::find($projectId);

        // Log the share event
        $project->logTracks(TrackableEnum::PROJECT_SHARED);

        // Dispatch a job to post the project to social media

        Flux::toast(
            heading: 'Project Shared',
            text: 'The project has been shared on social media.',
            variant: 'success'
        );
    }
}
