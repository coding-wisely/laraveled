<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return false;
    }

    public function view(User $user, Project $project): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
    }

    public function update(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }

    public function delete(User $user, Project $project): bool
    {
    }

    public function restore(User $user, Project $project): bool
    {
    }

    public function forceDelete(User $user, Project $project): bool
    {
    }

    public function viewStats(User $user, Project $project): bool
    {
        return $user->id === $project->user_id;
    }
}
