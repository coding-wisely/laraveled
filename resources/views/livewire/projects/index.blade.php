<div class="container mx-auto p-4">
    <flux:heading>Discover all the projects</flux:heading>
    <flux:subheading>Here you can find all the projects all the projects that are laraveled!</flux:subheading>
    <flux:spacer />
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
        @foreach ($projects as $project)
            <x-project-card :project="$project" :show-author="true"/>
        @endforeach
    </div>
</div>
