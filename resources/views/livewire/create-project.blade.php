<div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-700 shadow rounded">
    <form wire:submit.prevent="submit" class="space-y-5">

        <!-- Title -->
        <flux:input
            wire:model="title"
            placeholder="Enter the project title"
        />

        <!-- Description -->
        <flux:editor wire:model="description" placeholder="Describe your wonderful project"/>

        <!-- Website URL -->
        <flux:input.group label="Enter the project website URL">
            <flux:input.group.prefix>https://</flux:input.group.prefix>
            <flux:input
                wire:model="website_url"
                placeholder="Enter the project website URL"
            />
        </flux:input.group>
        <!-- GitHub URL -->
        <flux:input.group label="Enter the GitHub repository URL">
            <flux:input.group.prefix>https://</flux:input.group.prefix>
        <flux:input
            wire:model="github_url"
            placeholder="Enter the GitHub repository URL"
            type="url"
        />
        </flux:input.group>

        <!-- Technologies -->
        <flux:select
            wire:model="technologies"
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
            wire:model="categories"
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
            wire:model="tags"
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
