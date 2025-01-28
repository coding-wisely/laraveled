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
        <flux:subheading size="lg" class="text-gray-700">{{ $project->short_description }}</flux:subheading>
        <flux:separator variant="subtle" class="mt-4"/>
    </div>

    <!-- Gallery Section -->
    <div>
        <flux:card class="overflow-hidden">
            <div class="grid gap-6">
                @php
                    $photos = $project->getMedia($project->title); // Your collection name
                    $photoCount = $photos->count();
                @endphp

                @if ($photoCount === 1)
                    <img src="{{ $photos[0]->getFullUrl() }}"
                         alt="{{ $project->title }}"
                         class="rounded-lg object-cover w-full h-auto">
                @elseif ($photoCount === 2)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($photos as $photo)
                            <img src="{{ $photo->getFullUrl() }}" alt="{{ $project->title }}"
                                 class="rounded-lg object-cover w-full h-full">
                        @endforeach
                    </div>
                @elseif ($photoCount === 3)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $photos[0]->getFullUrl() }}" alt="{{ $project->title }}"
                                 class="rounded-lg object-cover w-full h-full">
                        </div>
                        <div class="grid grid-rows-2 gap-6">
                            @foreach ($photos->skip(1) as $photo)
                                <img src="{{ $photo->getFullUrl() }}" alt="{{ $project->title }}"
                                     class="rounded-lg object-cover w-full h-full">
                            @endforeach
                        </div>
                    </div>
                @elseif ($photoCount === 4)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <img src="{{ $photos[0]->getFullUrl() }}" alt="{{ $project->title }}"
                                 class="rounded-lg object-cover w-full h-full">
                        </div>
                        <div class="grid grid-rows-2 gap-6">
                            <div class="grid grid-cols-2 gap-6">
                                <img src="{{ $photos[1]->getFullUrl() }}" alt="{{ $project->title }}"
                                     class="rounded-lg object-cover w-full h-full">
                                <img src="{{ $photos[2]->getFullUrl() }}" alt="{{ $project->title }}"
                                     class="rounded-lg object-cover w-full h-full">
                            </div>
                            <div>
                                <img src="{{ $photos[3]->getFullUrl() }}" alt="{{ $project->title }}"
                                     class="rounded-lg object-cover w-full h-full">
                            </div>
                        </div>
                    </div>
                @elseif ($photoCount === 5)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="hover:cursor-pointer">
                            <flux:modal.trigger :name="$photos[0]->getFullUrl()">
                                <img src="{{ $photos[0]->getFullUrl() }}"
                                     alt="{{ $project->title }}"
                                     class="rounded-lg object-cover w-full h-full">
                            </flux:modal.trigger>
                            <flux:modal class="max-w-5xl space-y-6" :name="$photos[0]->getFullUrl()">
                                <div>
                                    <flux:heading size="lg">Update profile</flux:heading>
                                    <flux:subheading>Make changes to your personal details.</flux:subheading>
                                </div>
                                <div class="max-h-[800px]">
                                    <img src="{{ $photos[0]->getFullUrl() }}"
                                         alt="{{ $project->title }}"
                                         class="rounded-lg object-cover w-full h-full">
                                </div>

                            </flux:modal>
                        </div>
                        <div class="grid grid-rows-2 gap-6">
                            <div class="grid grid-cols-2 gap-6">
                                @foreach ($photos->skip(1)->take(2) as $photo)
                                    <div>
                                        <flux:modal.trigger :name="$photo->getFullUrl()">
                                            <img src="{{ $photo->getFullUrl() }}"
                                                 alt="{{ $project->title }}"
                                                 class="rounded-lg object-cover w-full h-full">
                                        </flux:modal.trigger>
                                        <flux:modal :name="$photo->getFullUrl()">
                                            <flux:heading>{{ $project->title }}</flux:heading>
                                            <img src="{{ $photo->getFullUrl() }}"
                                                 alt="{{ $project->title }}"
                                                 class="rounded-lg object-cover w-full h-full">
                                        </flux:modal>
                                    </div>
                                @endforeach
                            </div>
                            <div class="grid grid-cols-2 gap-6">
                                @foreach ($photos->skip(3) as $photo)
                                    <div>
                                        <flux:modal.trigger :name="$photo->id">
                                            <img src="{{ $photo->getFullUrl() }}"
                                                 alt="{{ $project->title }}"
                                                 class="rounded-lg object-cover w-full h-full">
                                        </flux:modal.trigger>
                                        <flux:modal :name="$photo->id">
                                            <img src="{{ $photo->getFullUrl() }}"
                                                 alt="{{ $project->title }}"
                                                 class="rounded-lg object-cover w-full h-full">
                                        </flux:modal>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </flux:card>
    </div>

    <!-- Details Section -->
    <div class="space-y-6">
        <div class="grid grid-cols-3 gap-6">
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
            <p class="text-gray-700 leading-relaxed">
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
