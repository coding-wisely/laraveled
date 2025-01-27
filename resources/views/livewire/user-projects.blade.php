<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Your Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <div class="border rounded-lg shadow p-4">
                <h2 class="text-xl font-semibold">{{ $project->title }}</h2>
                <p class="text-sm mb-2">{{ $project->description }}</p>

                <div class="text-sm mb-2">
                    <span class="font-bold">Categories:</span>
                    @foreach ($project->categories as $category)
                        <span>{{ $category->name }}</span>@if (!$loop->last), @endif
                    @endforeach
                </div>

                <div class="text-sm mb-2">
                    <span class="font-bold">Tags:</span>
                    @foreach ($project->tags as $tag)
                        <span>{{ $tag->name }}</span>@if (!$loop->last), @endif
                    @endforeach
                </div>

                <div class="text-sm mb-2">
                    <span class="font-bold">Technologies:</span>
                    @foreach ($project->technologies as $technology)
                        <span>{{ $technology->name }}</span>@if (!$loop->last), @endif
                    @endforeach
                </div>

                <div class="text-sm">
                    <a href="{{ $project->website_url }}" target="_blank" class="underline">Visit Website</a> |
                    <a href="{{ $project->github_url }}" target="_blank" class="underline">GitHub</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
