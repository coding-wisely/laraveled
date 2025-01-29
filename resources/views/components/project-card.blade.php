@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'show-author' => false,
])
<div {{ $attributes->class(['bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300']) }}>
    <div>
        <flux:heading>{{ $project->title }}</flux:heading>
        <x-average-rating :average-rating="$project->ratings()->avg('rating') ?? 0"
                          :total-ratings="$project->ratings()->count()"
                          :display-comment="false"
        />
        <flux:separator variant="subtle" class="mt-4"/>
    </div>
    @if($project->getMedia("*")->count() > 0)
        <img src="{{ $project->getMedia("*")[0]->getFullUrl()}}"
             alt="Project Screenshot"
             class="rounded-lg mb-4 w-full h-48 object-cover">
    @endif
    <flux:subheading class="text-gray-700">{{ $project->short_description }}</flux:subheading>
    <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
        <div><span class="font-bold">Views:</span> {{ $project->views }}</div>
        <div><span class="font-bold">Comments:</span> {{ $project->comments()->count() }}</div>
    </div>
    <div class="flex justify-between items-center mt-4">
        @if($showAuthor)
            <flux:subheading size="sm">

                <span>{{ ($project->created_at)->diffForHumans() }}</span>

                <flux:link>{{ $project->user->name }}</flux:link>
            </flux:subheading>
        @endif
        <flux:button size="xs" icon-trailing="eye" href="{{ route('projects.show', $project->uuid) }}">
        </flux:button>
    </div>
</div>
