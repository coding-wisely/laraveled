<div class="flex flex-col space-y-10">
    <!-- Breadcrumbs -->
    <flux:breadcrumbs>
        @auth
            <flux:breadcrumbs.item href="{{ route('projects.my') }}">My Projects</flux:breadcrumbs.item>
        @endauth
        <flux:breadcrumbs.item href="{{ route('projects.index') }}">Projects</flux:breadcrumbs.item>
        <flux:breadcrumbs.item>{{ $project->title }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <!-- Header Section -->
    <div>
        <flux:heading>{{ $project->title }}</flux:heading>
        <flux:subheading size="lg" class="text-gray-700">{!!  $project->short_description  !!}</flux:subheading>
        <flux:separator variant="subtle" class="mt-4"/>
    </div>

    <!-- Gallery Section -->
    <div>
        <flux:card class="overflow-hidden">
            <div class="grid gap-6">
                @php
                    $photos = $project->getMedia('projects'); // Your collection name
                    $photoCount = $photos->count();
                @endphp
                @if ($photoCount === 1)
                    <x-heading-photo :photo="$photos[0]" :project="$project"/>
                @elseif ($photoCount === 2)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-heading-photo :photo="$photos[0]" :project="$project"/>
                        <div class="grid  gap-6">
                            @foreach ($photos->skip(1) as $photo)
                                <x-heading-photo :photo="$photo" :project="$project"/>
                            @endforeach
                        </div>
                    </div>
                @elseif ($photoCount >= 3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <x-heading-photo :photo="$photos[0]" :project="$project"/>
                        <div class="grid grid-rows-2 gap-6">
                            @foreach ($photos->skip(1)->take(2) as $photo)
                                <x-heading-photo :photo="$photo" :project="$project"/>
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
                        <flux:badge>{{ $category->name }}</flux:badge>
                    @endforeach
                </div>
            </flux:card>


            <!-- Technologies -->
            <flux:card>
                <flux:heading level="2" class="mb-2">Technologies</flux:heading>
                <div class="flex flex-wrap gap-2">
                    @foreach ($project->technologies as $technology)
                        <flux:badge>{{ $technology->name }}</flux:badge>
                    @endforeach
                </div>
            </flux:card>

            <!-- Links -->
            <flux:card>
                <flux:heading level="2" class="mb-2">Links</flux:heading>
                <div class="flex flex-col space-y-2">
                    <flux:link external="{{ true }}" href="{{ $project->website_url }}" icon-trailing="arrow-right">
                        Visit Website
                    </flux:link>
                    @if ($project->github_url)
                        <flux:link external="{{ true }}" href="{{ $project->github_url }}" icon-trailing="arrow-right">
                            GitHub Repository
                        </flux:link>
                    @endif
                </div>
            </flux:card>
        </div>
        <!-- Description -->
        <flux:card>
            <flux:heading level="2" class="mb-2">Description</flux:heading>
            <p class="text-gray-700 leading-relaxed prose dark:prose-invert">
                {!! $project->description !!}
            </p>
        </flux:card>
    </div>

    <flux:card class="mt-10">
        <flux:heading level="2" class="mb-4">Ratings</flux:heading>
        <livewire:ratings :project="$project" />
    </flux:card>

    <flux:card class="mt-10">
        <flux:heading level="2" class="mb-4">Comments</flux:heading>
            <livewire:comment-section :project-id="$project->id" />

    </flux:card>


</div>
