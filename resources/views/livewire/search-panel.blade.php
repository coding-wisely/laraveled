<div>
<flux:modal.trigger id="flux-search-modal-trigger" name="search-project">
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." />
</flux:modal.trigger>


    <flux:modal name="search-project" class="w-full max-w-lg space-y-6">
        <flux:input 
            wire:model.debounce.100ms="query" 
            wire:input="searchProject" 
            placeholder="Type to search..." 
            class="max-w-sm"
        />

        <div class="overflow-auto h-64 max-h-64">
            @if($query === '')
                <div class="p-4 text-center text-gray-500">
                    Please type something to search...
                </div>
            @else
                <div class="grid grid-cols-1 gap-4">
                    @forelse($this->projects as $project)
                        <flux:card class="hover:bg-gray-500 hover:bg-opacity-10 !p-2">
                            <a href="{{ route('projects.show', $project->uuid) }}">
                                <h3 class="text-lg font-light">{{ $project->title }}</h3>
                                <p class="text-xs text-gray-500">By {{ $project->user->name }}</p>
                                
                                <div class="mt-2 flex flex-wrap gap-1">
                                    @foreach(collect($project->tags)->take(2) as $tag)
                                        <flux:badge>{{ $tag->name }}</flux:badge>
                                    @endforeach
                                    @foreach(collect($project->technologies)->take(2) as $tech)
                                        <flux:badge>{{ $tech->name }}</flux:badge>
                                    @endforeach
                                    @foreach(collect($project->categories)->take(2) as $cat)
                                        <flux:badge>{{ $cat->name }}</flux:badge>
                                    @endforeach
                                </div>
                            </a>
                        </flux:card>
                    @empty
                        <div class="p-4 text-center">No projects found.</div>
                    @endforelse
                </div>
            @endif
        </div>
    </flux:modal>
    <script>
    document.addEventListener('keydown', function(e) {
        if ((e.metaKey || e.ctrlKey) && e.key.toLowerCase() === 'k') {
            e.preventDefault();
            var trigger = document.getElementById('flux-search-modal-trigger');
            if (trigger) {
                trigger.click();
            } else {
                console.warn('Modal trigger element not found.');
            }
        }
    });
</script>

</div>
