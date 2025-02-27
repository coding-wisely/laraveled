<div x-data="carousel()" x-init="startRotation()" class="relative">
    <div class="overflow-hidden relative max-w-sm md:max-w-5xl mx-auto">
        <div x-ref="slider"
             :class="{ 'transition-transform duration-300 ease-in-out': !noTransition }"
             :style="{ transform: `translateX(-${activeSlide * 100}%)` }"
             @transitionend="handleTransitionEnd"
             class="flex">

            @foreach ($featuredProjects as $project)
                <div class="w-full flex-shrink-0">
                    <flux:card>
                        <a href="{{ route('projects.show', $project['uuid']) }}" wire:navigate>
                            <div class="h-[500px] overflow-hidden">
                                <img src="{{ $project['image'] }}" alt="{{ $project['title'] }}"
                                     class="w-full h-full object-cover">
                            </div>
                        </a>
                        <div class="p-2 space-y-4">
                            <div class="flex items-center justify-between">
                                <flux:link wire:navigate href="{{ route('projects.show', $project['uuid']) }}"
                                           class="text-4xl font-semibold">{{ $project['title'] }}</flux:link>
                                @if (isset($project['website']) && $project['website'])
                                    <flux:link href="{{ $project['website'] }}" target="_blank"
                                               class="text-sm">
                                        Visit Website
                                    </flux:link>
                                @endif
                            </div>
                            <p class="text-sm">{{ $project['short_description'] }}</p>
                            <div class="flex flex-wrap gap-3 mt-3 justify-between">
                                <!-- Categories -->
                                @if (!empty($project['categories']))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($project['categories'] as $category)
                                            <flux:badge
                                                size="sm"
                                                class="cursor-pointer"
                                                wire:click="applyOrRedirect('category', '{{ $category }}')">
                                                {{ $category }}
                                            </flux:badge>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Technologies -->
                                @if (!empty($project['technologies']))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($project['technologies'] as $tech)
                                            <flux:badge
                                                size="sm"
                                                class="cursor-pointer"
                                                wire:click="applyOrRedirect('technology', '{{ $tech }}')">
                                                {{ $tech }}
                                            </flux:badge>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Tags -->
                                @if (!empty($project['tags']))
                                    <div class="flex flex-wrap gap-2">
                                        @foreach ($project['tags'] as $tag)
                                            <flux:badge
                                                size="sm"
                                                class="cursor-pointer"
                                                wire:click="applyOrRedirect('tag', '{{ $tag }}')">
                                                {{ $tag }}
                                            </flux:badge>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </flux:card>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Previous Button -->
    <button @click="prevSlide()"
            class="absolute -left-6 md:-left-12 top-1/2 -translate-y-1/2 h-4 w-4 md:h-8 md:w-8 rounded-full border flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
        </svg>
        <span class="sr-only">Previous slide</span>
    </button>

    <!-- Next Button -->
    <button @click="nextSlide()"
            class="absolute -right-6 md:-right-12 top-1/2 -translate-y-1/2 h-4 w-4  md:h-8 md:w-8 rounded-full border flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
             stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
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

            startRotation() {
                setInterval(() => {
                    this.nextSlide();
                }, 3000);
            },

            nextSlide() {
                this.activeSlide++;
                if (this.activeSlide >= this.total) {
                    this.noTransition = true;
                    this.activeSlide = 0;
                    this.$nextTick(() => {
                        void this.$refs.slider.offsetWidth;
                        this.noTransition = false;
                    });
                }
            },

            prevSlide() {
                if (this.activeSlide === 0) {
                    this.noTransition = true;
                    this.activeSlide = this.total - 1;
                    this.$nextTick(() => {
                        void this.$refs.slider.offsetWidth;
                        this.noTransition = false;
                    });
                } else {
                    this.activeSlide--;
                }
            },

            handleTransitionEnd() {
                this.noTransition = false;
            }
        }
    }
</script>
