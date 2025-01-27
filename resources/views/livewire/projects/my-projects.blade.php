<div class="container mx-auto p-4">

    <flux:heading size="xl" level="1">Good afternoon, {{ auth()->user()->name }}</flux:heading>

    <flux:subheading size="lg" class="mb-6">Look what you make!</flux:subheading>

    <flux:separator variant="subtle"/>
    <div class="grid grid-cols-2 gap-4">
        @foreach($projects = auth()->user()->projects()->with(['media', ])->get() as $project)
            <div class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300">
                @if($project->getMedia("*")->count() > 0)
                    <img src="{{ $project->getMedia("*")[0]->getFullUrl()}}" alt="Project Screenshot"
                         class="rounded-lg mb-4 w-full h-48 object-cover">
                @endif
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white">{{ $project->name }}</h3>
                <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">{!! $project->description !!}</p>
                <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
                    <div><span class="font-bold">Views:</span> {{ $project->views }}</div>
                    <div><span class="font-bold">Comments:</span> {{ $project->comments }}</div>
                    <div><span class="font-bold">Rating:</span> {{ $project->rating }}</div>
                </div>
                <div>
                    <flux:button icon-trailing="eye" href="{{ route('projects.show', $project->uuid) }}">
                    </flux:button>
                </div>
            </div>
        @endforeach
    </div>



</div>
