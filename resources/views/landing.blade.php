<x-guest-layout>
{{-- Hero Section --}}
<section class="relative overflow-hidden">
    <div class="absolute inset-0  z-0"></div>
    <div class="container mx-auto px-4 py-24 relative z-10">
        <div class="max-w-3xl mx-auto text-center space-y-8">
            <h1 class="text-5xl md:text-6xl font-bold tracking-tight bg-gradient-to-b from-gray-100 via-white to-gray-600 bg-clip-text text-transparent">
                Showcase Your Laravel Projects
            </h1>
            <p class="text-xl text-muted-foreground">
                Join the community of Laravel developers sharing their work, getting feedback,
                and finding inspiration.
            </p>
            <div class="flex gap-4 justify-center">
                <a href="{{ route('projects.create') }}" class="text-white inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-bold uppercase tracking-wide bg-gray-600 border rounded-md hover:bg-accent hover:text-accent-foreground ">
                    Submit Your Project
                    <x-dynamic-icon name="arrow-right" />
                </a>
                <a href="{{ route('projects.index') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-bold uppercase tracking-wide bg-gray-600 border border-input bg-background hover:bg-accent hover:text-accent-foreground rounded-md">
                    Explore Projects
                </a>
            </div>
        </div>
    </div>
</section>
{{-- Featured Projects --}}
<section class="py-24 bg-background/50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Projects</h2>
        <div class="max-w-5xl mx-auto">
            <livewire:featured-projects-carousel />
        </div>
    </div>
</section>
{{-- Benefits Section --}}
<section class="py-24 bg-muted/50">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-12">Why Choose Laraveled?</h2>
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <x-benefit-card
                icon="code-2"
                title="Showcase Your Work"
                description="Share your Laravel projects with the community and get feedback"
            />
            <x-benefit-card
                icon="users"
                title="Connect with Peers"
                description="Network with other Laravel developers and find collaborators"
            />
            <x-benefit-card
                icon="star"
                title="Gain Recognition"
                description="Get your project's noticed by the Laravel community"
            />
            <x-benefit-card
                icon="activity"
                title="Track Performance"
                description="Monitor your project's engagement and growth"
            />
        </div>
    </div>
</section>
{{-- CTA Section --}}
<section class="py-24 bg-primary/5">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-6">Ready to Share Your Work?</h2>
        <p class="text-xl text-muted-foreground mb-8 max-w-2xl mx-auto">
            Join hundreds of Laravel developers who are already showcasing their projects
            and connecting with the community.
        </p>
        <a href="{{ route('register') }}" wire:navigate class="inline-flex items-center justify-center gap-2 px-4 py-2 text-sm font-medium text-white bg-primary hover:bg-primary/90 rounded-md">
            Get Started Now
            <x-dynamic-icon name="arrow-right" />
        </a>
    </div>
</section>
</x-guest-layout>
