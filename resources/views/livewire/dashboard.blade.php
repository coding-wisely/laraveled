<div>
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Page Content -->
            <main class="px-0 lg:px-6 py-10">
                <header class="text-center">
                    <h1 class="text-5xl font-extrabold text-laravel-500 dark:text-laravel-600">Welcome Back,
                        {{$this->user->name}}</h1>
                    <p class="text-xl text-gray-700 dark:text-gray-300 mt-4">Your creative journey starts here.</p>
                </header>

                <!-- Statistics and Notifications -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 px-2 py-10 lg:p-6">
                    <!-- Global Projects -->
                    <div
                        class="bg-gradient-to-br from-gray-300 to-gray-500 dark:from-gray-700 dark:to-gray-900 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Global Projects</h3>
                        <p class="text-5xl font-extrabold text-laravel-500 dark:text-laravel-600 mt-4">{{$this->totalProjects}}</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Total projects showcased on the platform.</p>
                    </div>

                    <!-- User Stats: Projects Submitted -->
                    <div
                        class="bg-gradient-to-br from-blue-300 to-blue-500 dark:from-blue-600 dark:to-purple-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Projects Submitted</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">{{$this->user->projects->count() }}</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Your total submitted projects.</p>
                    </div>

                    <!-- User Stats: Average Rating -->
                    <div
                        class="bg-gradient-to-br from-yellow-300 to-yellow-500 dark:from-yellow-600 dark:to-orange-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Average Rating</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">{{$this->avgRating}}</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Across all your projects.</p>
                    </div>

                    <!-- Trending Tech -->
                    <div
                        class="bg-gradient-to-br from-green-300 to-green-500 dark:from-green-600 dark:to-teal-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Trending Tech</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">{{ $trendingTech }}</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Most used technology globally.</p>
                    </div>

                    <!-- Notifications -->
                    <div
                        class="bg-gradient-to-br from-red-300 to-red-500 dark:from-red-600 dark:to-pink-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Notifications</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">5</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">New comments, ratings, or interactions.</p>
                    </div>

                    <!-- Call to Action -->
                    <div
                        class="bg-gradient-to-br from-purple-300 to-purple-500 dark:from-purple-600 dark:to-indigo-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Submit Your Next Project</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-4">Showcase your amazing work to the
                            community.</p>
                        <flux:button
                            href="{{ route('projects.create') }}"
                            class="mt-6 bg-laravel-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-laravel-600 transition-colors"
                            wire:navigate="true">
                            Submit Now
                        </flux:button>
                    </div>
                </div>
                <div class="px-2 lg:px-6 py-10" x-data="{ selectedProject: 1 }">
                    <!-- Section Header -->
                    <header class="text-center mb-10">
                        <h2 class="text-4xl font-extrabold text-laravel-500 dark:text-laravel-600">Your Showcases</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mt-2">Browse your projects and see how
                            they're performing.</p>
                    </header>

                    <!-- Showcases Grid -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-4 hover:cursor-pointer ">
                            @forelse($this->userProjects as $project)
                                <x-project-card :project="$project" />
                            @empty
                                <p class="text-gray-600 dark:text-gray-400">No projects submitted yet.</p>
                            @endforelse
                        </div>

                    <!-- Comments Section -->
                    @if($comments->isNotEmpty())
                        <div class="mt-10">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Latest Comments</h3>

                            <div class="space-y-4">
                                @foreach($comments as $comment)
                                    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">
                                        <div class="flex justify-between items-center">
                                            <p class="font-semibold text-gray-900 dark:text-white">{{ $comment->user->name }}</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">On: <span class="font-semibold">{{ $comment->project->title }}</span></p>
                                        <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </main>
        </div>
    </div>
</div>
