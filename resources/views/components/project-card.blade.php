@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'showAuthor' => false,
])
<flux:card>
    <div class="flex flex-col h-full">
        <div class="flex flex-col items-start justify-start gap-1 space-y-1">
            <flux:heading>{{ $project->title }}</flux:heading>
            <x-average-rating
                :average-rating="$project->ratings()->avg('rating') ?? 0"
                :total-ratings="$project->ratings()->count()"
                :display-comment="false"
            />
            <flux:separator variant="subtle" class="mt-4"/>
        </div>
        <!-- photos -->
        <div class="pt-4">
            @if($project->getMedia("*")->count() > 0)
                <img src="{{ $project->getMedia("*")[0]->getFullUrl()}}"
                     alt="Project Screenshot"
                     class="rounded-lg mb-4 w-full h-48 object-cover">
            @endif
        </div>
        <!-- description -->
        <div class="flex-1">
            <flux:subheading
                size="sm">{!!  $project->short_description??Str::limit($project->description, 250) !!}</flux:subheading>
        </div>
        @can('view-stats', $project)
            <div class="flex justify-between items-center mt-4">
                <flux:subheading>Views: {{ $project->views }}</flux:subheading>
                <flux:subheading>
                    <div class="relative">
                        <flux:icon name="chat-bubble-left"/>
                        <span class="absolute -top-0.5 right-1.5"><span
                                class="text-[10px]">{{ $project->comments()->count() }}</span>  </span>
                    </div>
                </flux:subheading>
            </div>
        @endcan

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
</flux:card>
