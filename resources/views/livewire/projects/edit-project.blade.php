<div>
    <flux:breadcrumbs>
        @auth
            <flux:breadcrumbs.item href="{{ route('projects.my') }}">My Projects</flux:breadcrumbs.item>
        @endauth
        <flux:breadcrumbs.item>{{ $project->title }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form wire:submit.prevent="submit" class="space-y-5 mt-2">
        <flux:card>
            <flux:label>Project Images</flux:label>

            @if ($existingFiles && $existingFiles->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mt-2 mb-2">
                    @foreach ($existingFiles as $media)
                        <div class="relative w-48 h-48">
                            <img src="{{ $media->getUrl() }}" alt="Project Image"
                                class="w-full h-full object-cover rounded">
                            <button wire:click="removeImage({{ $media->id }})" type="button"
                                class="absolute top-1 right-1 z-10 bg-red-600 text-white rounded-full p-1 hover:bg-red-700 focus:outline-none"
                                title="Remove Image">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400 mt-2">No images available.</p>
            @endif

            @if ($existingFiles->count() < 3)
                <x-filepond wire:model="files" multiple />

                @php
                    $existingCount = $existingFiles ? $existingFiles->count() : 0;
                    $remaining = 3 - $existingCount;
                @endphp
                <p class="text-sm text-red-700 mt-1">
                    You can upload {{ $remaining }} more image{{ $remaining > 1 ? 's' : '' }}.
                </p>
            @else
                <p class="text-sm text-red-500 mt-2">Maximum of 3 images reached. Please remove an image to upload a new
                    one.</p>
            @endif

            @error('files')
                <p class="mt-2 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror

            @foreach ($errors->get('files.*') as $fileErrors)
                @foreach ($fileErrors as $error)
                    <p class="text-red-500 text-sm">{{ $error }}</p>
                @endforeach
            @endforeach
        </flux:card>

        <flux:card>
            <!-- Title -->
            <flux:input badge="Required" label="Project Title" wire:model="form.title"
                description="Your project title. This will be visible on all the pages with listing projects publicly."
                placeholder="Enter the project title" />
        </flux:card>

        <flux:card>
            <flux:textarea badge="Required" label="Short Description" wire:model="form.short_description"
                description="A short description of your project. This will be visible on all the pages with listing projects publicly."
                placeholder="Tell us about your project in a few words" rows="auto" />
        </flux:card>

        <flux:card>
            <!-- Description -->
            <flux:editor badge="Required" label="Description" wire:model="form.description"
                description="This will be shown on your project page view."
                placeholder="Tell us about your wonderful project" />
        </flux:card>

        <flux:card class="grid md:grid-cols-2 gap-6">
            <!-- Website URL -->
            <flux:card>
                <flux:input badge="Required" label="Website URL" wire:model="form.website_url"
                    description="The URL of your project website." placeholder="Enter the project website URL"
                    class="h-full" />
            </flux:card>

            <!-- GitHub URL -->
            <flux:card>
                <flux:input label="GitHub URL" wire:model="form.github_url" description="Good for open source projects."
                    placeholder="Enter the GitHub repository URL" class="h-full" />
            </flux:card>
        </flux:card>

        <flux:card class="grid md:grid-cols-2 gap-6">
            <!-- Technologies -->
            <flux:card>
                <flux:select badge="Required" wire:model="form.technologies"
                    description="The technologies used in your project." label="Technologies" variant="listbox"
                    :multiple="true" :filter="false" placeholder="Choose technologies...">
                    @foreach ($allTechnologies as $technology)
                        <flux:option value="{{ $technology->id }}">
                            {{ $technology->name }}
                        </flux:option>
                    @endforeach
                </flux:select>
            </flux:card>

            <!-- Categories -->
            <flux:card>
                <flux:select badge="Required" wire:model="form.categories"
                    description="The categories your project belongs to." label="Categories" multiple variant="listbox"
                    placeholder="Choose categories...">
                    @foreach ($allCategories as $category)
                        <flux:option value="{{ $category->id }}">
                            {{ $category->name }}
                        </flux:option>
                    @endforeach
                </flux:select>
            </flux:card>
        </flux:card>

        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                Save Changes
            </flux:button>
        </div>
    </form>

    @if (session()->has('success'))
        <flux:toast type="success" class="mt-4">
            {{ session('success') }}
        </flux:toast>
    @endif
</div>
