@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project'
])

<div {{ $attributes->class(['bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300']) }}
    xmlns:flux="http://www.w3.org/1999/html">
    <div>
        <flux:heading>{{ $project->title }}</flux:heading>
        <flux:separator variant="subtle" class="mt-4"/>
    </div>
@if($project->getMedia("*")->count() > 0)
        <img src="{{ $project->getMedia("*")[0]->getFullUrl()}}" alt="Project Screenshot"
             class="rounded-lg mb-4 w-full h-48 object-cover">
    @endif
    <flux:subheading size="lg" class="text-gray-700">{{ $project->short_description }}</flux:subheading>

    <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
        <div><span class="font-bold">Views:</span> {{ $project->views }}</div>
        <div><span class="font-bold">Comments:</span> {{ $project->comments }}</div>
        <div><span class="font-bold">Rating:</span> {{ $project->rating }}</div>
    </div>
    <div>
        <flux:button icon-trailing="eye" href="{{ route('projects.show', $project->uuid) }}">
        </flux:button>
    </div>
</div>
