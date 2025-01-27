<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">All Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <div class="border rounded-lg shadow p-4">
                <h2 class="text-xl font-semibold">
                    <a href="{{ route('projects.show', $project->uuid) }}">{{ $project->title }}</a>
                </h2>
                <p class="text-sm">{{ $project->description }}</p>
            </div>
        @endforeach
    </div>
</div>
