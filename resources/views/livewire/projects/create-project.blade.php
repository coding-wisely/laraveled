<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-700 shadow rounded">
    <form wire:submit.prevent="submit" class="space-y-5">
        <flux:card>
            <!-- Files Upload -->
            <x-filepond wire:model="form.files" multiple/>
            @error('form.files')
            <p class="mt-3 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p>
            @enderror

            @if (!empty($form->files))
                <div class="mt-4 grid grid-cols-3 gap-4">
                    @foreach ($form->files as $index => $file)
                        <div
                            class="relative bg-gray-100 dark:bg-gray-800 p-2 rounded shadow flex flex-col items-center">
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
        @foreach ($errors->get('form.files.*') as $fileErrors)
            @foreach ($fileErrors as $error)
                <p class="text-red-500 text-sm">{{ $error }}</p>
            @endforeach
        @endforeach
        <flux:card>
            <!-- Title -->
            <flux:input badge="Required" label="Project Title" wire:model="form.title"
                        description="Your project title. This will be visible on all the pages with listing projects publicly."
                        placeholder="Enter the project title"/>
        </flux:card>
        <flux:card>
            <flux:textarea badge="Required" label="Short Description" wire:model="form.short_description"
                           description="A short description of your project. This will be visible on all the pages with listing projects publicly."
                           placeholder="Tell us about your project in a few words" rows="auto"/>
        </flux:card>
        <flux:card>
            <!-- Description -->
            <flux:editor badge="Required" label="Description" wire:model="form.description"
                         description="This will be shown on your project page view."
                         placeholder="Tell us about your wonderful project"/>
        </flux:card>


        <flux:card class="grid md:grid-cols-2 gap-6">
            <!-- Website URL -->
            <flux:card>

                <flux:field>
                    <flux:label badge="Required">Website</flux:label>

                    <flux:input.group>
                        <flux:input.group.prefix>https://</flux:input.group.prefix>

                        <flux:input wire:model="form.website_url" placeholder="The URL of your project website."/>
                    </flux:input.group>

                    <flux:error name="form.website_url"/>
                </flux:field>

            </flux:card>

            <!-- GitHub URL -->
            <flux:card>
                <flux:field>
                    <flux:label>GitHub URL</flux:label>

                    <flux:input.group>
                        <flux:input.group.prefix>https://</flux:input.group.prefix>
                        <flux:input wire:model="form.github_url" placeholder="Enter the GitHub repository URL"/>
                    </flux:input.group>

                    <flux:error name="form.github_url"/>
                </flux:field>

            </flux:card>
        </flux:card>

        <flux:card class="grid md:grid-cols-3 gap-6">
            <!-- Technologies -->
            <flux:select badge="Required" wire:model="form.technologies" searchable
                         description="The technologies used in your project." label="Technologies" variant="listbox"
                         :multiple="true" :filter="false" placeholder="Choose technologies...">
                @foreach ($allTechnologies as $technology)
                    <flux:option value="{{ $technology->id }}">
                        {{ $technology->name }}
                    </flux:option>
                @endforeach
            </flux:select>

            <!-- Categories -->
            <flux:select badge="Required" wire:model="form.categories" searchable
                         description="The categories your project belongs to." label="Categories" multiple
                         variant="listbox"
                         placeholder="Choose categories...">
                @foreach ($allCategories as $category)
                    <flux:option value="{{ $category->id }}">
                        <div class="flex flex-col">
                            <span class="font-bold">{{ $category->name }}</span>
                            <span class="text-gray-500 text-xs">{{ $category->description }}</span>
                        </div>
                    </flux:option>
                @endforeach
            </flux:select>

            <!-- Tags -->
            <flux:select badge="Required" wire:model="form.tags" searchable
                         description="The tags your project belongs to." label="Tags" multiple variant="listbox"
                         placeholder="Choose tags...">
                @foreach ($allTags as $tag)
                    <flux:option value="{{ $tag->id }}">
                        {{ $tag->name }}
                    </flux:option>
                @endforeach
            </flux:select>
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
