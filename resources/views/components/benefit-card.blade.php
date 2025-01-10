@props([
    'icon',
    'title',
    'description'
])
<div class="rounded-lg border bg-card p-6 bg-gray-800 shadow-sm hover:shadow-lg transition-shadow">
    <div class="space-y-4 text-center">
        <div class="mx-auto w-fit">
            <x-dynamic-icon :name="$icon" class="h-12 w-12 text-primary" />
        </div>
        <h3 class="text-xl font-semibold">{{ $title }}</h3>
        <p class="text-muted-foreground">{{ $description }}</p>
    </div>
</div>
