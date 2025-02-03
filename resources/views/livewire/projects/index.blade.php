<div class="container mx-auto p-4">
    <flux:heading>Discover all the projects</flux:heading>
    <flux:subheading>Here you can find all the projects that are laraveled!</flux:subheading>
    <flux:spacer />

    <!-- Filters -->
    <div class="flex flex-wrap gap-4 mb-6">
        <select wire:model.defer="category" wire:change="$refresh" class="border p-2 rounded">
            <option value="">All Categories</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <select wire:model.defer="technology" wire:change="$refresh" class="border p-2 rounded">
            <option value="">All Technologies</option>
            @foreach ($technologies as $technology)
                <option value="{{ $technology->name }}">{{ $technology->name }}</option>
            @endforeach
        </select>

        <select wire:model.defer="user" wire:change="$refresh" class="border p-2 rounded">
            <option value="">All Users</option>
            @foreach ($users as $user)
                <option value="{{ $user->name }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @forelse ($projects as $project)
            <x-project-card :project="$project" :show-author="true"/>
        @empty
            <p class="col-span-full text-center text-gray-500">No projects found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>
</div>
