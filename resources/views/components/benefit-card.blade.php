@props([
    'icon',
    'title',
    'description'
])
<flux:card>
    <div class="space-y-4 text-center">
        <div class="mx-auto w-fit">
            <x-dynamic-icon :name="$icon" class="h-12 w-12 text-primary" />
        </div>
        <flux:heading size="lg" class="!font-semibold uppercase"> {{ $title  }}</flux:heading>
        <flux:subheading>{{ $description }}</flux:subheading>
    </div>
</flux:card>
