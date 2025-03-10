@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'showAuthor' => false,
])

<flux:card>
    <div class="flex flex-col h-full">
        <div class="flex flex-col items-start justify-start gap-1 space-y-1">
            <flux:heading class="flex justify-between items-center w-full">
                <flux:link wire:navigate.hover href="{{ route('projects.show', $project->uuid) }}">
                    {{ $project->title }}
                </flux:link>

                @if ($project->bookmarks()->where('user_id', Auth::id())->exists())
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 5v14l7-5 7 5V5a2 2 0 00-2-2H7a2 2 0 00-2 2z" />
                    </svg>
                @endif
            </flux:heading>

            <x-average-rating :average-rating="$project->ratings()->avg('rating') ?? 0" :total-ratings="$project->ratings()->count()" :display-comment="false" />
            <flux:separator variant="subtle" class="mt-4" />
        </div>

        <!-- Photos -->
        <div class="pt-4">
            <a wire:navigate.hover href="{{ route('projects.show', $project->uuid) }}">
                @if ($project->coverImage())
                    <img src="{{ $project->coverImage()->getFullUrl() }}" alt="Project Cover Image"
                        class="rounded-lg mb-4 w-full h-48 object-cover">
                @else
                    @if ($project->getMedia('projects')->count() > 0)
                        <img src="{{ $project->getMedia('projects')[0]->getFullUrl() }}" alt="Project Screenshot"
                            class="rounded-lg mb-4 w-full h-48 object-cover">
                    @endif
                @endif
            </a>
        </div>

        <!-- Description -->
        <div class="flex-1">
            <flux:subheading size="sm">
                {{ $project->short_description }}
            </flux:subheading>
        </div>

        <div class="mt-2 flex flex-wrap gap-1 justify-between">
            @foreach ($project->categories as $category)
                <flux:badge 
                    size="sm" 
                    class="cursor-pointer"
                    wire:click="applyOrRedirect('category', '{{ $category->name }}')">
                    {{ $category->name }}
                </flux:badge>
            @endforeach

            @foreach ($project->tags as $tag)
                <flux:badge 
                    size="sm" 
                    class="cursor-pointer rounded"
                    wire:click="applyOrRedirect('tag', '{{ $tag->name }}')">
                    {{ $tag->name }}
                </flux:badge>
            @endforeach

            @foreach ($project->technologies as $technology)
                <flux:badge 
                    size="sm" 
                    class="cursor-pointer"
                    wire:click="applyOrRedirect('technology', '{{ $technology->name }}')">
                    {{ $technology->name }}
                </flux:badge>
            @endforeach
        </div>

        <div class="flex justify-between items-center mt-4">
            <flux:subheading class="flex items-center gap-1 text-sm">
                <flux:icon name="eye" class="w-4 h-4" />
                <span class="text-xs">{{ $project->views }}</span>
            </flux:subheading>

            <flux:subheading>
                <div class="relative">
                    <flux:icon name="chat-bubble-left" />
                    <a wire:navigate.hover href="{{ route('projects.show', $project->uuid) }}">
                        <span class="absolute -top-0.5 right-2 items-center justify-center">
                            <span class="text-[8px]"> {{ $project->comments()->whereNull('parent_id')->count() }}</span>
                        </span>
                    </a>
                </div>
            </flux:subheading>
        </div>

        <!-- Author & Social Share -->
        @if ($showAuthor)
            <div class="flex justify-between items-center mt-4">
                <flux:subheading size="sm" class="flex items-center space-x-2">
                    <span>{{ $project->created_at->diffForHumans() }}</span>
                    <flux:link href="{{ route('user.profile', $project->user->id) }}">
                        {{ $project->user->name }}
                    </flux:link>
                </flux:subheading>

            <x-social-share url="{{ $project->project_url }}" />
            </div>
        @endif

        @if ($project->user_id === Auth::id() && Route::currentRouteName() === 'projects.my')
            <flux:button href="{{ route('projects.edit', $project->id) }}" size="sm" class="mt-2">
                Edit
            </flux:button>
        @endif

    </div>
</flux:card>
