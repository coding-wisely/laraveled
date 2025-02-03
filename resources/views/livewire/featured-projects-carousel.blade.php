<div x-data="{ activeSlide: 0 }" class="relative">
    <div class="overflow-hidden relative max-w-sm md:max-w-5xl mx-auto">
        <div class="flex transition-transform duration-300 ease-in-out"
            :style="{ transform: `translateX(-${activeSlide * 100}%)` }">
            @foreach ($featuredProjects as $project)
                <div class="w-full flex-shrink-0">
                    <div class="rounded-lg border overflow-hidden">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}" class="w-full h-64 object-cover">
                        <div class="p-6 space-y-4">
                            <div class="flex items-center justify-between">
                                <h3 class="text-2xl font-semibold">{{ $project['title'] }}</h3>
                                @if (isset($project['website']) && $project['website'])
                                    <flux:link href="{{ $project['website'] }}" target="_blank"
                                        class="text-red-500 hover:underline text-sm">
                                        Visit Website
                                    </flux:link>
                                @endif
                            </div>
                            <p class="text-muted-foreground">{{ $project['short_description'] }}</p>
                            <div class="flex gap-2 flex-wrap">
                                @foreach ($project['tags'] as $tag)
                                    <span
                                        class="px-2.5 py-0.5 rounded-full text-xs font-medium bg-secondary text-secondary-foreground">
                                        {{ $tag }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <button @click="activeSlide = activeSlide === 0 ? {{ count($featuredProjects) - 1 }} : activeSlide - 1"
        class="absolute -left-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border border-input bg-background hover:bg-accent hover:text-accent-foreground"
        :disabled="activeSlide === 0">
        <x-dynamic-icon name="arrow-left" class="h-4 w-4" />
        <span class="sr-only">Previous slide</span>
    </button>

    <button @click="activeSlide = activeSlide === {{ count($featuredProjects) - 1 }} ? 0 : activeSlide + 1"
        class="absolute -right-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border border-input bg-background hover:bg-accent hover:text-accent-foreground"
        :disabled="activeSlide === {{ count($featuredProjects) - 1 }}">
        <x-dynamic-icon name="arrow-right" class="h-4 w-4" />
        <span class="sr-only">Next slide</span>
    </button>
</div>
