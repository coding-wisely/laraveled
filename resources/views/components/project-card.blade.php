@props([
    /** @var \Illuminate\Database\Eloquent\Model */
    'project',
    'showAuthor' => false,
])
<flux:card>
    <div class="flex flex-col h-full">
        <div class="flex flex-col items-start justify-start gap-1 space-y-1">
            <flux:heading>
                <flux:link wire:navigate.hover href="{{ route('projects.show', $project->uuid) }}">
                    {{ $project->title }}
                </flux:link>
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

        <!-- description -->
        <div class="flex-1">
            <flux:subheading size="sm">
                {{ $project->short_description }}
            </flux:subheading>
        </div>

        <div
            class="mt-2 grid gap-4 
        {{ $project->categories->count() === 1 || $project->tags->count() === 1 || $project->technologies->count() === 1 ? 'grid-cols-2' : 'grid-cols-1' }}">

            <!--Categories -->
            @if ($project->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2 items-start justify-start">
                    @foreach ($project->categories as $category)
                        <flux:badge size="sm" class="bg-blue-500 text-white px-2 py-1 rounded">
                            {{ $category->name }}
                        </flux:badge>
                    @endforeach
                </div>
            @endif


            <!-- Tags -->
            @if ($project->tags->isNotEmpty())
                <div class="flex flex-wrap gap-2 items-start justify-end">
                    @foreach ($project->tags as $tag)
                        <flux:badge size="sm" class="bg-green-500 text-white px-2 py-1 rounded">
                            {{ $tag->name }}
                        </flux:badge>
                    @endforeach
                </div>
            @endif

            <!-- Technologies -->
            @if ($project->technologies->isNotEmpty())
                <div class="flex flex-wrap gap-2 items-start justify-end }}">
                    @foreach ($project->technologies as $tech)
                        <flux:badge size="sm" class="bg-purple-500 text-white px-2 py-1 rounded">
                            {{ $tech->name }}
                        </flux:badge>
                    @endforeach
                </div>
            @endif

        </div>


        <div class="flex justify-between items-center mt-4">
            <flux:subheading class="flex items-center gap-1 text-sm">
                <flux:icon name="eye" class="w-4 h-4" />
                <span class="text-xs">{{ $project->views }}</span>
            </flux:subheading>

            <flux:subheading>
                <div class="relative">
                    <flux:icon name="chat-bubble-left" />
                    <span class="absolute -top-0.5 right-2 items-center justify-center"><span
                            class="text-[8px]">{{ $project->comments()->count() }}</span> </span>
                </div>
            </flux:subheading>
        </div>

        <div class="flex justify-between items-center mt-4">
            @if ($showAuthor)
                <flux:subheading size="sm">
                    <span>{{ $project->created_at->diffForHumans() }}</span>
                    <flux:link href="{{ route('user.profile', $project->user->id) }}">
                        {{ $project->user->name }}
                    </flux:link>
                </flux:subheading>
            @endif
        </div>

        @if ($project->user_id === Auth::id() && Route::currentRouteName() === 'projects.my')
            <flux:button href="{{ route('projects.edit', $project->id) }}" size="sm" class="mt-2">
                Edit
            </flux:button>
        @endif

    </div>

</flux:card>
