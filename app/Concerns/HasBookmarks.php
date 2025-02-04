<?php

namespace App\Concerns;

use App\Models\Bookmark;
use Illuminate\Database\Eloquent\Relations\morphMany;
use Illuminate\Support\Facades\Auth;

trait HasBookmarks
{
    /**
     * Get all of the resource's likes.
     */
    public function bookmarks(): morphMany
    {
        return $this->morphMany(Bookmark::class, 'bookmarkable');
    }

    /**
     * Create a bookmark if it does not exist yet.
     */
    public function bookmark()
    {
        $this->unmark();

        $this->bookmarks()->create([
            'user_id' => Auth::id(),
            'created_at' => now(),
        ]);
    }

    /**
     * Check if the resource is bookmarked by the current user
     */
    public function isBookmarked(): bool
    {
        return $this->bookmarks->where('user_id', Auth::id())->isNotEmpty();
    }

    /**
     * Delete bookmark for a resource.
     */
    public function unmark(): void
    {
        $this->bookmarks()->where('user_id', Auth::id())->delete();
    }
}
