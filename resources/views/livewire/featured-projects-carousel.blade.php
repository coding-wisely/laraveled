<div x-data="{ activeSlide: 0, total: {{ count($featuredProjects) }} }" class="relative">
    <div class="overflow-hidden relative max-w-sm md:max-w-5xl mx-auto">
        <div class="flex transition-transform duration-300 ease-in-out"
            :style="{ transform: `translateX(-${activeSlide * 100}%)` }">
            @foreach ($featuredProjects as $project)
                <div class="w-full flex-shrink-0">
                    <div class="rounded-lg border overflow-hidden">
                        <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                            class="w-full object-cover h-auto max-h-[500px]">
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

    <!-- Left Button (positioned on the left) always goes to the next slide -->
    <button @click="activeSlide = (activeSlide + 1) % total"
        class="absolute -left-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border bg-white hover:bg-gray-200 flex items-center justify-center">
        <!-- Left arrow icon (you can style as desired) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <!-- This icon is optional—you can choose whichever icon fits your design -->
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="sr-only">Next slide</span>
    </button>

    <!-- Right Button (positioned on the right) also always goes to the next slide -->
    <button @click="activeSlide = (activeSlide + 1) % total"
        class="absolute -right-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border bg-white hover:bg-gray-200 flex items-center justify-center">
        <!-- Right arrow icon -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="sr-only">Next slide</span>
    </button>
</div>
