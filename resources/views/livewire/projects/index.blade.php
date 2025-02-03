<div class="container mx-auto px-6 py-8">
    <div class="text-center">
        <flux:heading class="text-3xl font-bold text-gray-900 dark:text-white">Discover all the projects</flux:heading>
        <flux:subheading class="text-lg mt-2 text-gray-600 dark:text-gray-400">Find all the projects that are laraveled!</flux:subheading>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-6">
        <!-- Category Dropdown -->
        <flux:select wire:model.defer="category" wire:change="$refresh" searchable placeholder="Category" class="max-h-60 overflow-y-auto">
            <flux:option value="">All Categories</flux:option>
            @foreach ($categories as $category)
                <flux:option value="{{ $category->name }}">{{ $category->name }}</flux:option>
            @endforeach
        </flux:select>

        <flux:select wire:model.defer="technology" wire:change="$refresh" searchable placeholder="Technology" class="max-h-60 overflow-y-auto">
            <flux:option value="">All Technologies</flux:option>
            @foreach ($technologies as $technology)
                <flux:option value="{{ $technology->name }}">{{ $technology->name }}</flux:option>
            @endforeach
        </flux:select>

        <flux:select wire:model.defer="user" wire:change="$refresh" searchable placeholder="User" class="max-h-60 overflow-y-auto">
            <flux:option value="">All Users</flux:option>
            @foreach ($users as $user)
                <flux:option value="{{ $user->name }}">{{ $user->name }}</flux:option>
            @endforeach
        </flux:select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
        @forelse ($projects as $project)
                <x-project-card :project="$project" :show-author="true"/>
        @empty
            <p class="col-span-full text-center text-gray-500 dark:text-gray-400">No projects found.</p>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-center">
        {{ $projects->links() }}
    </div>
</div>
