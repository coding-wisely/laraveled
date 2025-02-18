<div x-data="carousel()" class="relative">
    <div class="overflow-hidden relative max-w-sm md:max-w-5xl mx-auto">
        <div x-ref="slider" :class="{ 'transition-transform duration-300 ease-in-out': !noTransition }"
            :style="{ transform: `translateX(-${activeSlide * 100}%)` }" @transitionend="handleTransitionEnd"
            class="flex">
            <!-- First set of slides (original) -->
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

            <!-- Second set of slides (duplicate) -->
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

    <!-- Previous Button -->
    <button @click="prevSlide()"
        class="absolute -left-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="sr-only">Previous slide</span>
    </button>

    <!-- Next Button -->
    <button @click="nextSlide()"
        class="absolute -right-12 top-1/2 -translate-y-1/2 h-8 w-8 rounded-full border flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="sr-only">Next slide</span>
    </button>
</div>

<script>
    function carousel() {
        return {

            activeSlide: 0,
            total: {{ count($featuredProjects) }},
            noTransition: false,

            nextSlide() {
                this.activeSlide++;
            },

            prevSlide() {
                if (this.activeSlide === 0) {
                    this.noTransition = true;
                    this.activeSlide = this.total;
                    this.$nextTick(() => {
                        void this.$refs.slider.offsetWidth;
                        this.noTransition = false;
                        this.activeSlide--;
                    });
                } else {
                    this.activeSlide--;
                }
            },

            handleTransitionEnd() {

                if (this.activeSlide === this.total) {
                    this.noTransition = true;
                    this.activeSlide = 0;
                    this.$nextTick(() => {
                        void this.$refs.slider.offsetWidth;
                        this.noTransition = false;
                    });
                }
            }
        }
    }
</script>
