<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">All Projects</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($projects as $project)
            <x-project-card :project="$project"/>
        @endforeach
    </div>
</div>
