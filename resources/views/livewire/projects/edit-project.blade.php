
<div>
    <flux:breadcrumbs>
        @auth
            <flux:breadcrumbs.item href="{{ route('projects.my') }}">My Projects</flux:breadcrumbs.item>
        @endauth
        <flux:breadcrumbs.item>{{ $project->title }}</flux:breadcrumbs.item>
    </flux:breadcrumbs>

    <form wire:submit.prevent="submit" class="space-y-5 mt-2">
        <flux:card>
            <flux:label>Project Image</flux:label>

            @if ($existingFiles && $existingFiles->isNotEmpty())
                <div class="grid grid-cols-3 ">
                    @foreach($existingFiles as $media)
                        <div>
                            <img src="{{ $media->getUrl() }}" alt="Project Image" class="w-32 h-32 object-contain ">
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 dark:text-gray-400">No images available.</p>
            @endif

            <x-filepond wire:model="file" accept="image/*"/>

            @error('file')
                <p class="mt-2 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror
        </flux:card>

        <flux:card>
            <!-- Title -->
            <flux:input
                badge="Required"
                label="Project Title"
                wire:model="form.title"
                description="Your project title. This will be visible on all the pages with listing projects publicly."
                placeholder="Enter the project title"
            />
        </flux:card>

        <flux:card>
            <flux:textarea
                badge="Required"
                label="Short Description"
                wire:model="form.short_description"
                description="A short description of your project. This will be visible on all the pages with listing projects publicly."
                placeholder="Tell us about your project in a few words"
                rows="auto"
            />
        </flux:card>

        <flux:card>
            <!-- Description -->
            <flux:editor
                badge="Required"
                label="Description"
                wire:model="form.description"
                description="This will be shown on your project page view."
                placeholder="Tell us about your wonderful project"/>
        </flux:card>

        <flux:card class="grid md:grid-cols-2 gap-6">
            <!-- Website URL -->
            <flux:card>
                <flux:input
                    badge="Required"
                    label="Website URL"
                    wire:model="form.website_url"
                    description="The URL of your project website."
                    placeholder="Enter the project website URL"
                    class="h-full"
                />
            </flux:card>

            <!-- GitHub URL -->
            <flux:card>
                <flux:input
                    label="GitHub URL"
                    wire:model="form.github_url"
                    description="Good for open source projects."
                    placeholder="Enter the GitHub repository URL"
                    class="h-full"
                />
            </flux:card>
        </flux:card>

        <flux:card class="grid md:grid-cols-2 gap-6">
            <!-- Technologies -->
            <flux:card>
                <flux:select
                    badge="Required"
                    wire:model="form.technologies"
                    description="The technologies used in your project."
                    label="Technologies"
                    variant="listbox"
                    :multiple="true"
                    :filter="false"
                    placeholder="Choose technologies...">
                    @foreach($allTechnologies as $technology)
                        <flux:option value="{{ $technology->id }}">
                            {{ $technology->name }}
                        </flux:option>
                    @endforeach
                </flux:select>
            </flux:card>
            
            <!-- Categories -->
            <flux:card>
                <flux:select
                    badge="Required"
                    wire:model="form.categories"
                    description="The categories your project belongs to."
                    label="Categories"
                    multiple
                    variant="listbox"
                    placeholder="Choose categories..."
                >
                    @foreach($allCategories as $category)
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
