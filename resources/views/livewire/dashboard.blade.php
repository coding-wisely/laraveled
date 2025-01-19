<div>
    <div class="flex">

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Page Content -->
            <main class="px-6 py-10">
                <header class="text-center">
                    <h1 class="text-5xl font-extrabold text-laravel-500 dark:text-laravel-600">Welcome Back,
                        Artisan!</h1>
                    <p class="text-xl text-gray-700 dark:text-gray-300 mt-4">Your creative journey starts here.</p>
                </header>

                <!-- Statistics and Notifications -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
                    <!-- Global Projects -->
                    <div
                        class="bg-gradient-to-br from-gray-300 to-gray-500 dark:from-gray-700 dark:to-gray-900 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Global Projects</h3>
                        <p class="text-5xl font-extrabold text-laravel-500 dark:text-laravel-600 mt-4">1,234</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Total projects showcased on the platform.</p>
                    </div>

                    <!-- User Stats: Projects Submitted -->
                    <div
                        class="bg-gradient-to-br from-blue-300 to-blue-500 dark:from-blue-600 dark:to-purple-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Projects Submitted</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">12</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Your total submitted projects.</p>
                    </div>

                    <!-- User Stats: Average Rating -->
                    <div
                        class="bg-gradient-to-br from-yellow-300 to-yellow-500 dark:from-yellow-600 dark:to-orange-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Average Rating</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">8.5</p>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">Across all your projects.</p>
                    </div>

                    <!-- Trending Tech -->
                    <div
                        class="bg-gradient-to-br from-green-300 to-green-500 dark:from-green-600 dark:to-teal-600 p-6 rounded-xl shadow-lg text-center hover:scale-105 transition-transform duration-300">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Trending Tech</h3>
                        <p class="text-5xl font-extrabold text-white mt-4">Laravel</p>
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
                        <button
                            class="mt-6 bg-laravel-500 text-white font-bold py-2 px-4 rounded-lg hover:bg-laravel-600 transition-colors">
                            Submit Now
                        </button>
                    </div>
                </div>

                <div class="px-6 py-10" x-data="{ selectedProject: 1 }">
                    <!-- Section Header -->
                    <header class="text-center mb-10">
                        <h2 class="text-4xl font-extrabold text-laravel-500 dark:text-laravel-600">Your Showcases</h2>
                        <p class="text-lg text-gray-700 dark:text-gray-300 mt-2">Browse your projects and see how
                            they're performing.</p>
                    </header>

                    <!-- Showcases Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <!-- Showcase Item -->
                        <div
                            class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300"
                            :class="selectedProject === 1 ? 'scale-105 shadow-xl' : ''"
                            @click="selectedProject = selectedProject === 1 ? null : 1"
                        >
                            <img src="{{ asset('img.png') }}" alt="Project Screenshot" class="rounded-lg mb-4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">Taskavel</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Missing task manager!</p>
                            <!-- Stats -->
                            <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
                                <div>
                                    <span class="font-bold">Views:</span> 123
                                </div>
                                <div>
                                    <span class="font-bold">Comments:</span> 8
                                </div>
                                <div>
                                    <span class="font-bold">Rating:</span> 8.5
                                </div>
                            </div>
                            <!-- User Ratings -->
                            <div class="mt-4">
                                <p class="text-sm font-bold mb-2">Rate this project:</p>
                                <div class="flex">
                                    <!-- Star Ratings -->
                                    <button class="text-yellow-400 text-lg">&#9733;</button>
                                    <button class="text-yellow-400 text-lg">&#9733;</button>
                                    <button class="text-yellow-400 text-lg">&#9733;</button>
                                    <button class="text-yellow-400 text-lg">&#9733;</button>
                                    <button class="text-gray-400 text-lg">&#9733;</button>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Showcase Items -->
                        <div
                            class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300"
                            :class="selectedProject === 2 ? 'scale-105' : ''"
                            @click="selectedProject = selectedProject === 2 ? null : 2"
                        >
                            <img src="{{ asset('img_1.png') }}" alt="Project Screenshot" class="rounded-lg mb-4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">MyApp</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">Best app for collaboration!</p>
                            <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
                                <div><span class="font-bold">Views:</span> 321</div>
                                <div><span class="font-bold">Comments:</span> 15</div>
                                <div><span class="font-bold">Rating:</span> 9.2</div>
                            </div>
                        </div>

                        <div
                            class="bg-gray-100 dark:bg-gray-800 p-6 rounded-xl shadow-lg transition-transform duration-300"
                            :class="selectedProject === 3 ? 'scale-105' : ''"
                            @click="selectedProject = selectedProject === 3 ? null : 3"
                        >
                            <img src="{{ asset('img_2.png') }}" alt="Project Screenshot" class="rounded-lg mb-4">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white">E-Shop</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-2">The future of e-commerce!</p>
                            <div class="mt-4 flex justify-between items-center text-gray-700 dark:text-gray-300">
                                <div><span class="font-bold">Views:</span> 456</div>
                                <div><span class="font-bold">Comments:</span> 20</div>
                                <div><span class="font-bold">Rating:</span> 9.8</div>
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="mt-10" x-show="selectedProject !== null">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Comments & Replies</h3>
                        <div class="space-y-4">
                            <template x-if="selectedProject === 1">
                                <!-- Comments for Project 1 -->
                                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <p class="font-bold text-gray-900 dark:text-white">John Doe</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">2 hours ago</p>
                                    </div>
                                    <p class="mt-2 text-gray-700 dark:text-gray-300">This is an amazing project! Great
                                        work!</p>
                                </div>
                            </template>
                            <template x-if="selectedProject === 2">
                                <!-- Comments for Project 2 -->
                                <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">
                                    <div class="flex justify-between items-center">
                                        <p class="font-bold text-gray-900 dark:text-white">Jane Smith</p>
                                        <p class="text-sm text-gray-600 dark:text-gray-400">1 day ago</p>
                                    </div>
                                    <p class="mt-2 text-gray-700 dark:text-gray-300">Absolutely love this app!</p>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>
