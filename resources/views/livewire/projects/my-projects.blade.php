<div>
    <flux:heading size="xl" level="1">Good afternoon, {{ auth()->user()->name }}</flux:heading>

    <flux:subheading size="lg" class="mb-6">Look what you make!</flux:subheading>

    <flux:separator variant="subtle" />
    <div class="grid  lg:grid-cols-2 gap-4">
        @foreach ($projects as $project)
            <x-project-card :project="$project" />
        @endforeach
    </div>
</div>
