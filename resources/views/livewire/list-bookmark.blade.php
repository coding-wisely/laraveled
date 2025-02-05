<div>
    <h2 class="text-xl font-semibold mb-4">Your Bookmarked Projects</h2>
    @if ($bookmarks->isEmpty())
        <p class="text-gray-700">You have no bookmarked projects.</p>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($bookmarks as $bookmark)
                <x-project-card :project="$bookmark->bookmarkable" />
            @endforeach
        </div>
    @endif
</div>
