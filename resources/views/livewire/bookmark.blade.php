<div>
    <h2 class="text-xl font-semibold mb-4">Your Bookmarked Projects</h2>
    @if ($bookmarks->isEmpty())
        <p class="text-gray-700">You have no bookmarked projects.</p>
    @else
        <ul class="space-y-4">
            @foreach ($bookmarks as $bookmark)
                <li>
                    <flux:link href="{{ route('projects.show', $bookmark->bookmarkable) }}"
                        class="text-blue-600 hover:underline">
                        {{ $bookmark->bookmarkable->title }}
                    </flux:link>
                </li>
            @endforeach
        </ul>
    @endif
</div>
