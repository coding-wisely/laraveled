<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-700 shadow rounded">
    <form wire:submit.prevent="submit" class="space-y-5">
        <flux:card>
            <!-- Files Upload -->
            <x-filepond wire:model="form.files" multiple />
            @error('form.files')
                <p class="mt-3 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror

            @if (!empty($form->files))
                <div class="mt-4 grid grid-cols-3 gap-4">
                    @foreach ($form->files as $index => $file)
                        <div class="relative bg-gray-100 dark:bg-gray-800 p-2 rounded shadow flex flex-col items-center">
                            <img src="{{ $file->temporaryUrl() }}" class="w-full h-32 object-cover rounded">

                            <div class="flex items-center mt-2">
                                <input type="radio" id="cover_{{ $index }}" wire:model="form.cover_image"
                                    value="{{ $index }}" class="mr-2">
                                <label for="cover_{{ $index }}" class="text-sm">Set as Cover</label>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </flux:card>


        <!-- Display Validation Errors -->
        @error('form.files')
            <p class="mt-3 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
        @enderror
        @foreach ($errors->get('form.files.*') as $fileErrors)
            @foreach ($fileErrors as $error)
                <p class="text-red-500 text-sm">{{ $error }}</p>
            @endforeach
        @endforeach
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
            <flux:card>
                <!-- Categories -->
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
        <!-- Submit Button -->
        <div class="flex justify-end">
            <flux:button type="submit" variant="primary">
                Create Project
            </flux:button>
        </div>
    </form>

    <!-- Success Message -->
    @if (session()->has('success'))
        <flux:toast type="success" class="mt-4">
            {{ session('success') }}
        </flux:toast>
    @endif

</div>
