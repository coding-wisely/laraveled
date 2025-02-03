@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'showAuthor' => false,
])
<flux:card>
    <div class="flex flex-col h-full">
        <div class="flex flex-col items-start justify-start gap-1 space-y-1">
            <flux:heading>
                <flux:link
                    wire:navigate.hover
                    href="{{ route('projects.show', $project->uuid) }}">
                    {{ $project->title }}
                </flux:link>
            </flux:heading>
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
            <flux:subheading size="sm">
                {{  $project->short_description }}</flux:subheading>
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
                    <flux:link href="{{ route('user.profile', $project->user->id) }}">
                        {{ $project->user->name }}
                    </flux:link>
                </flux:subheading>
            @endif
        </div>

        @if($project->user_id === Auth::id() && Route::currentRouteName() === 'projects.my')
            <flux:button href="{{ route('projects.edit', $project->id) }}" size="sm" class="mt-2">
                Edit
            </flux:button>
        @endif

    </div>
</flux:card>
