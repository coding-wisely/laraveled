<div class="flex flex-col space-y-10">
    <!-- Navigation Arrows Section -->
    @if ($prevProject || $nextProject)
        <div class="flex items-center justify-between">
            @if ($prevProject)
                <flux:link href="{{ route('projects.show', ['project' => $prevProject, 'start' => $startProject]) }}"
                    class="flex items-center text-sm sm:text-base text-red-600 hover:text-red-800">
                    <svg class="h-4 w-4 sm:h-6 sm:w-6 mr-1 sm:mr-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    <span>Previous </span>
                </flux:link>
            @else
                <div></div>
            @endif

            @if ($nextProject)
                <flux:link href="{{ route('projects.show', ['project' => $nextProject, 'start' => $startProject]) }}"
                    class="flex items-center text-sm sm:text-base text-red-600 hover:text-red-800">
                    <span>Next by {{ $user->first_name }}</span>
                    <svg class="h-4 w-4 sm:h-6 sm:w-6 ml-1 sm:ml-2" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </flux:link>
            @else
                <div></div>
            @endif
        </div>
    @else
        <flux:card class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg text-center">
            <p class="text-gray-700 dark:text-gray-300 text-sm">
                Oops! {{ $user->name }} has no more projects to showcase. Checkout more from other creators !
                <flux:link href="{{ route('projects.index') }}" class=" font-medium">
                    Discover Projects
                </flux:link>
            </p>
        </flux:card>
    @endif

    <!-- Breadcrumbs -->
    <flux:breadcrumbs class="flex flex-col sm:flex-row sm:items-center">
        <div class="flex flex-wrap gap-2">
            @auth
                <flux:breadcrumbs.item href="{{ route('projects.my') }}">My Projects</flux:breadcrumbs.item>
            @endauth
            <flux:breadcrumbs.item href="{{ route('projects.index') }}">Projects</flux:breadcrumbs.item>
            <flux:breadcrumbs.item>{{ $project->title }}</flux:breadcrumbs.item>
        </div>
        @if ($project->user_id === Auth::id())
            <div class="mt-4 sm:mt-0 sm:ml-auto">
                <flux:button href="{{ route('projects.edit', $project->id) }}" size="sm">
                    Edit
                </flux:button>
            </div>
        @endif
    </flux:breadcrumbs>



    <!-- Header Section -->
    <div class="flex items-center justify-between">

        <div>
            <flux:heading>{{ $project->title }}</flux:heading>
            <flux:subheading size="lg" class="text-gray-700">{!! $project->short_description !!}</flux:subheading>
        </div>

        @if (Auth::check())
            <livewire:projects.toggle-bookmark :project="$project" key="{{ $project->id }}" />
        @endif
    </div>

    <!-- Gallery Section -->
    <div>
        <flux:card class="overflow-hidden">
            <div class="grid gap-6">
                @php
                    $allPhotos = $project->getMedia('projects');              
                    $coverImage = $project->coverImage();

                    $photos = $coverImage 
                        ? $allPhotos->reject(function($photo) use ($coverImage) {
                            return $photo->id == $coverImage->id;
                        })
                        : $allPhotos;
                    
                    $totalPhotos = ($coverImage ? 1 : 0) + $photos->count();
                @endphp

                @if ($totalPhotos === 1)
                    <x-heading-photo :photo="$coverImage ?? $photos->first()" :project="$project" />
                @elseif ($totalPhotos >= 2 && $totalPhotos <= 3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-heading-photo :photo="$coverImage" :project="$project" />
                        <div class="grid gap-6">
                            @foreach ($photos as $photo)
                                <x-heading-photo :photo="$photo" :project="$project" />
                            @endforeach
                        </div>
                    </div>
                @elseif ($totalPhotos >= 3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-heading-photo :photo="$coverImage" :project="$project" />
                        <div class="grid grid-rows-2 gap-6">
                            @foreach ($photos as $photo)
                                <x-heading-photo :photo="$photo" :project="$project" />
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </flux:card>
    </div>

    <!-- Details Section -->
    <div class="space-y-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Categories -->
            <flux:card>
                <flux:heading level="2" class="mb-2">Categories</flux:heading>
                <div class="flex flex-wrap gap-2">
                    @foreach ($project->categories as $category)
                        <flux:badge class="cursor-pointer" wire:click="applyOrRedirect('category', '{{ $category->name }}')">
                        {{ $category->name }}</flux:badge>
                    @endforeach
                </div>
            </flux:card>

            <!-- Technologies -->
            <flux:card>
                <flux:heading level="2" class="mb-2">Technologies</flux:heading>
                <div class="flex flex-wrap gap-2">
                    @foreach ($project->technologies as $technology)
                        <flux:badge class="cursor-pointer"  wire:click="applyOrRedirect('technology', '{{ $technology->name }}')">{{ $technology->name }}</flux:badge>
                    @endforeach
                </div>
            </flux:card>

            <!-- Links -->
            <flux:card>
                <flux:heading level="2" class="mb-2">Links</flux:heading>
                <div class="flex flex-col space-y-2">
                    <flux:link external="{{ true }}" href="{{ $project->website_url }}"
                        icon-trailing="arrow-right">
                        Visit Website
                    </flux:link>
                    @if ($project->github_url)
                        <flux:link external="{{ true }}" href="{{ $project->github_url }}"
                            icon-trailing="arrow-right">
                            GitHub Repository
                        </flux:link>
                    @endif
                </div>
            </flux:card>
        </div>
        <!-- Description -->
        <flux:card class="text-sm">
            {!! $project->description !!}
        </flux:card>
    </div>

    <!-- Ratings Section -->
    <flux:card class="mt-10">
        <flux:heading level="2" class="mb-4">Ratings</flux:heading>
        <livewire:ratings :project="$project" />
    </flux:card>

    <!-- Comments Section -->
    <flux:card class="mt-10">
        <flux:heading level="2" class="mb-4">Comments</flux:heading>
        <livewire:comment-section :project-id="$project->id" />
    </flux:card>
</div>
