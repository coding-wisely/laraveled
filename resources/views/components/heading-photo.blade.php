@props([
    'photo',
    'project'
])

<div {{ $attributes->class(['hover:cursor-pointer']) }}>
    <flux:modal.trigger :name="$photo->getFullUrl()">
        <img src="{{ $photo->getFullUrl() }}"
             alt="{{ $project->title }}"
             class="rounded-lg object-cover w-full h-full">
    </flux:modal.trigger>
    <flux:modal class="max-w-5xl space-y-6" :name="$photo->getFullUrl()">
        <div>
            <flux:heading size="lg">{{ $project->title }}</flux:heading>
            <flux:subheading>{{ $project->short_description }}</flux:subheading>
        </div>
        <div class="max-h-[800px]">
            <img src="{{ $photo->getFullUrl() }}"
                 alt="{{ $project->title }}"
                 class="rounded-lg object-cover w-full h-full">
        </div>
    </flux:modal>
</div>
