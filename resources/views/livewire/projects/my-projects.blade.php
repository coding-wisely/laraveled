<div class="container mx-auto p-4">

    <flux:heading size="xl" level="1">Good afternoon, {{ auth()->user()->name }}</flux:heading>

    <flux:subheading size="lg" class="mb-6">Look what you make!</flux:subheading>

    <flux:separator variant="subtle"/>
    <div class="grid grid-cols-2 gap-4">
        @foreach($projects = auth()->user()->projects()->with(['media', ])->get() as $project)
            <x-project-card :project="$project"/>
        @endforeach
    </div>



</div>
