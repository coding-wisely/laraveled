<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-700 shadow rounded">
    <form wire:submit.prevent="submit" class="space-y-5">
        <!-- Files -->
        <x-filepond wire:model="form.files" multiple/>
        <!-- Display Validation Errors -->
        @error('form.files') <p class="mt-3 text-sm font-medium text-red-500 dark:text-red-400">{{ $message }}</p> @enderror
        @foreach ($errors->get('form.files.*') as $fileErrors)
            @foreach ($fileErrors as $error)
                <p class="text-red-500 text-sm">{{ $error }}</p>
            @endforeach
        @endforeach
        <!-- Title -->
        <flux:input
            badge="Required"
            label="Project Title"
            wire:model="form.title"
            placeholder="Enter the project title"
        />
        <!-- Description -->
        <flux:editor
            badge="Required"
            label="Description"
            wire:model="form.description"
            placeholder="Tell us about your wonderful project"/>

        <!-- Website URL -->
        <flux:input
            badge="Required"
            label="Website URL"
            wire:model="form.website_url"
            placeholder="Enter the project website URL"
        />


        <!-- GitHub URL -->
        <flux:input
            label="GitHub URL"
            wire:model="form.github_url"
            placeholder="Enter the GitHub repository URL"
        />

        <!-- Technologies -->
        <flux:select
            badge="Required"
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
            badge="Required"
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
