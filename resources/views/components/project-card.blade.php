@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'showAuthor' => false,
])
<flux:card>
    <div class="flex flex-col lg:flex-row items-start justify-start gap-1 space-y-1">
        <flux:heading><div class="flex items-center justify-between">
                <span>{{ $project->title }} </span> <flux:button size="xs" icon-trailing="eye" href="{{ route('projects.show', $project->uuid) }}">
                </flux:button>
            </div></flux:heading>
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
    <flux:subheading>{{ $project->short_description }}</flux:subheading>
    <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
        <flux:subheading>Views: {{ $project->views }}</flux:subheading>
    <flux:subheading>Comments: {{ $project->comments()->count() }}</flux:subheading>
    </div>
    <div class="flex justify-between items-center mt-4">
        @if($showAuthor)
            <flux:subheading size="sm">
                <span>{{ ($project->created_at)->diffForHumans() }}</span>

                <flux:link>{{ $project->user->name }}</flux:link>
            </flux:subheading>
        @endif
    </div>
</flux:card>
