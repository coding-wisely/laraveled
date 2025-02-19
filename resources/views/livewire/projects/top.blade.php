<div class="container mx-auto px-6 py-8">
    <div class="text-center">
        <flux:heading class="text-3xl font-bold text-gray-900 dark:text-white">Top 6!</flux:heading>
        <flux:subheading class="text-lg mt-2 text-gray-600 dark:text-gray-400">These are Top 6 project rated by
            community!</flux:subheading>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 my-6">

        <flux:select wire:model.defer="category" wire:change="$refresh" searchable variant="listbox" clearable
            class="max-h-60 overflow-y-auto">

            <x-slot name="search">
                <flux:select.search wire:model.lazy="searchQuery.category"
                    wire:keyup.debounce.100ms="loadMoreResults('category', $event.target.value)" class="px-4"
                    placeholder="Search categories..." />
            </x-slot>

            <flux:option value="">All Categories</flux:option>
            @foreach ($categories as $category)
                <flux:option value="{{ $category->name }}">{{ $category->name }}</flux:option>
            @endforeach
        </flux:select>

        <flux:select wire:model.defer="technology" wire:change="$refresh" searchable variant="listbox" clearable
            class="max-h-60 overflow-y-auto">

            <x-slot name="search">
                <flux:select.search wire:model.lazy="searchQuery.technology"
                    wire:keyup.debounce.100ms="loadMoreResults('technology', $event.target.value)" class="px-4"
                    placeholder="Search technologies..." />
            </x-slot>

            <flux:option value="">All Technologies</flux:option>
            @foreach ($technologies as $technology)
                <flux:option value="{{ $technology->name }}">{{ $technology->name }}</flux:option>
            @endforeach
        </flux:select>

        <flux:select wire:model.defer="user" wire:change="$refresh" searchable variant="listbox" clearable
            class="max-h-60 overflow-y-auto">

            <x-slot name="search">
                <flux:select.search wire:model.lazy="searchQuery.user"
                    wire:keyup.debounce.100ms="loadMoreResults('user', $event.target.value)" class="px-4"
                    placeholder="Search users..." />
            </x-slot>

            <flux:option value="">All Users</flux:option>
            @foreach ($users as $user)
                <flux:option value="{{ $user->name }}">{{ $user->name }}</flux:option>
            @endforeach
        </flux:select>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-4 mt-6">
        @forelse ($projects as $project)
            <x-project-card :project="$project" :show-author="true" :enable-filters="true"/>
        @empty
            <div class="col-span-full text-center text-gray-500 dark:text-gray-400">
                <p class='text-xl'>No projects found for applied filters. Do you want to create one?</p>

                <flux:button href="{{ route('projects.create') }}" variant="primary" class="mt-4" target="_blank">
                    Create a Project
                </flux:button>
            </div>
        @endforelse
    </div>

</div>
