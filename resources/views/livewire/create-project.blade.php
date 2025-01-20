<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-700 shadow rounded">
    <form wire:submit.prevent="submit" class="space-y-5">
        <!-- Files -->
        <x-filepond wire:model="form.files" multiple/>
        <!-- Display Validation Errors -->
        @error('form.files') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
        @foreach ($errors->get('form.files.*') as $fileErrors)
            @foreach ($fileErrors as $error)
                <p class="text-red-500 text-sm">{{ $error }}</p>
            @endforeach
        @endforeach
        <!-- Title -->
        <flux:input
            wire:model="form.title"
            placeholder="Enter the project title"
        />

        <!-- Description -->
        <flux:editor
            wire:model="form.description"
            placeholder="Tell us about your wonderful project"/>
        <div>
            @error('form.title') <span class="error">{{ $message }}</span> @enderror
        </div>
        <!-- Website URL -->
        <flux:input
            wire:model="form.website_url"
            placeholder="Enter the project website URL"
        />
        <!-- GitHub URL -->
        <flux:input
            wire:model="form.github_url"
            placeholder="Enter the GitHub repository URL"
        />

        <!-- Technologies -->
        <flux:select
            wire:model="form.technologies"
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

        <!-- Categories -->
        <flux:select
            wire:model="form.categories"
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

        <!-- Tags -->
        <flux:select
            wire:model="form.tags"
            label="Tags"
            multiple
            variant="listbox"
            placeholder="Choose tags..."
        >
            @foreach($allTags as $tag)
                <flux:option value="{{ $tag->id }}">
                    {{ $tag->name }}
                </flux:option>
            @endforeach
        </flux:select>

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
