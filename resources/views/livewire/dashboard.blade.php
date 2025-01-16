<div>
    <div class="flex">
        <!-- Sidebar (Desktop Only) -->
        <aside class="hidden md:flex flex-col w-64 bg-gray-100 dark:bg-gray-800 py-8 px-6 space-y-6">
            <h2 class="text-3xl font-extrabold text-orange-500 mb-8">Laraveled</h2>
            <nav class="space-y-4">
                <a href="#" class="block text-lg font-bold hover:text-orange-500">Dashboard</a>
                <a href="#" class="block text-lg font-bold hover:text-orange-500">My Projects</a>
                <a href="#" class="block text-lg font-bold hover:text-orange-500">Favorites</a>
                <a href="#" class="block text-lg font-bold hover:text-orange-500">Settings</a>
                <a href="#" class="block text-lg font-bold hover:text-red-500">Logout</a>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Mobile Header -->
            <header class="bg-gray-100 dark:bg-gray-800 px-6 py-4 flex justify-between items-center md:hidden">
                <h1 class="text-2xl font-bold text-orange-500">Laraveled</h1>
                <button id="mobile-menu-toggle" class="text-2xl">
                    &#9776; <!-- Hamburger Icon -->
                </button>
            </header>

            <!-- Mobile Menu -->
            <nav id="mobile-menu" class="hidden bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white px-6 py-4 md:hidden space-y-4">
                <a href="#" class="block py-2 font-bold hover:text-orange-500">Dashboard</a>
                <a href="#" class="block py-2 font-bold hover:text-orange-500">My Projects</a>
                <a href="#" class="block py-2 font-bold hover:text-orange-500">Favorites</a>
                <a href="#" class="block py-2 font-bold hover:text-orange-500">Settings</a>
                <a href="#" class="block py-2 font-bold hover:text-red-500">Logout</a>
            </nav>

            <!-- Page Content -->
            <main class="px-6 py-10">
                <header class="text-center">
                    <h1 class="text-5xl font-extrabold text-orange-500">Welcome Back, Artisan!</h1>
                    <p class="text-xl text-gray-700 dark:text-gray-300 mt-4">Your creative journey starts here.</p>
                </header>

                <!-- Statistics and Notifications -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-10">
                    <!-- Projects Submitted -->
                    <div class="bg-gradient-to-br from-orange-300 to-orange-500 dark:from-orange-600 dark:to-red-600 p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-transform duration-300">
                        <h3 class="text-3xl font-bold">Projects Submitted</h3>
                        <p class="text-6xl font-extrabold mt-4">12</p>
                        <p class="text-gray-700 dark:text-gray-300 mt-4">Showcase your amazing work to the community!</p>
                    </div>

                    <!-- Favorites -->
                    <div class="bg-gradient-to-br from-blue-300 to-blue-500 dark:from-blue-600 dark:to-purple-600 p-8 rounded-2xl shadow-lg text-center transform hover:scale-105 transition-transform duration-300">
                        <h3 class="text-3xl font-bold">Favorites</h3>
                        <p class="text-6xl font-extrabold mt-4">5</p>
                        <p class="text-gray-700 dark:text-gray-300 mt-4">Your projects are inspiring others!</p>
                    </div>

                    <!-- Notifications -->
                    <div class="bg-gradient-to-br from-green-300 to-green-500 dark:from-green-600 dark:to-teal-600 p-8 rounded-2xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                        <h3 class="text-3xl font-bold text-center">Notifications</h3>
                        <p class="text-6xl font-extrabold mt-4 text-center">8</p>
                        <ul class="mt-6 text-left space-y-4">
                            <li class="text-lg text-gray-800 dark:text-gray-100">
                                <span class="font-bold text-orange-400 dark:text-orange-300">New:</span> Your project <em>Laravel CMS</em> was favorited by 5 users.
                            </li>
                            <li class="text-lg text-gray-800 dark:text-gray-100">
                                <span class="font-bold text-orange-400 dark:text-orange-300">Update:</span> A comment was added to <em>Awesome App</em>.
                            </li>
                            <li class="text-lg text-gray-800 dark:text-gray-100">
                                <span class="font-bold text-orange-400 dark:text-orange-300">Milestone:</span> <em>E-Commerce Starter</em> reached 1,000 views.
                            </li>
                            <li class="text-lg text-gray-800 dark:text-gray-100">
                                <span class="font-bold text-orange-400 dark:text-orange-300">Reminder:</span> Don’t miss submitting your next project!
                            </li>
                        </ul>
                    </div>
                </div>
            </main>
        </div>
    </div>
{{--    <!-- Full-Width Header -->--}}
{{--    <div class="bg-white dark:bg-gray-800 shadow-md">--}}
{{--        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">--}}
{{--            <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">Dashboard</h1>--}}
{{--            <button--}}
{{--                wire:click="toggleForm"--}}
{{--                class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">--}}
{{--                Add New Project--}}
{{--            </button>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <!-- Main Content -->--}}
{{--    <div class="max-w-7xl mx-auto p-6 space-y-8">--}}
{{--        <!-- Statistics Section -->--}}
{{--        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">--}}
{{--            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg text-center">--}}
{{--                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Projects</h2>--}}
{{--                <p class="text-4xl font-bold text-gray-600 dark:text-gray-400">{{ $projectCount }}</p>--}}
{{--            </div>--}}
{{--            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg text-center">--}}
{{--                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">In Progress</h2>--}}
{{--                <p class="text-4xl font-bold text-gray-600 dark:text-gray-400">5</p>--}}
{{--            </div>--}}
{{--            <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg text-center">--}}
{{--                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Completed</h2>--}}
{{--                <p class="text-4xl font-bold text-gray-600 dark:text-gray-400">3</p>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Project Reports Section -->--}}
{{--        <div>--}}
{{--            <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200 mb-4">Recent Projects</h2>--}}
{{--            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">--}}
{{--                @foreach ($dummyReports as $report)--}}
{{--                    <div class="p-4 bg-white dark:bg-gray-800 shadow-md rounded-lg">--}}
{{--                        <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">{{ $report['name'] }}</h3>--}}
{{--                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $report['category'] }}</p>--}}
{{--                        <span class="inline-block mt-2 px-3 py-1 rounded-full text-xs font-medium {{ $report['status'] === 'Completed' ? 'bg-green-500 text-white' : 'bg-yellow-500 text-white' }}">--}}
{{--                            {{ $report['status'] }}--}}
{{--                        </span>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <!-- Add Project Form (Hidden by Default) -->--}}
{{--        @if ($showForm)--}}
{{--            <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">--}}
{{--                <div class="max-w-3xl w-full p-6 bg-white dark:bg-gray-800 shadow-md rounded-lg">--}}
{{--                    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-4">Add New Project</h1>--}}

{{--                    <!-- Success Message -->--}}
{{--                    @if (session()->has('message'))--}}
{{--                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-800">--}}
{{--                            {{ session('message') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    <!-- Project Form -->--}}
{{--                    <form wire:submit.prevent="submit" class="space-y-4">--}}
{{--                        <!-- Project Name -->--}}
{{--                        <div>--}}
{{--                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Project Name</label>--}}
{{--                            <input type="text" wire:model="name" id="name" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:ring-orange-500 focus:border-orange-500" required>--}}
{{--                            @error('name') <span class="text-sm text-red-600">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}

{{--                        <!-- Description -->--}}
{{--                        <div>--}}
{{--                            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>--}}
{{--                            <textarea wire:model="description" id="description" rows="4" class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:ring-orange-500 focus:border-orange-500" required></textarea>--}}
{{--                            @error('description') <span class="text-sm text-red-600">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}

{{--                        <!-- Categories -->--}}
{{--                        <div>--}}
{{--                            <label for="categories" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Categories</label>--}}
{{--                            <select wire:model="categories" id="categories" multiple class="block w-full mt-1 rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-200 focus:ring-orange-500 focus:border-orange-500">--}}
{{--                                @foreach ($availableCategories as $category)--}}
{{--                                    <option value="{{ $category->id }}">{{ $category->name }}</option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                            @error('categories') <span class="text-sm text-red-600">{{ $message }}</span> @enderror--}}
{{--                        </div>--}}

{{--                        <!-- Submit Button -->--}}
{{--                        <div class="flex justify-between items-center">--}}
{{--                            <button type="button" wire:click="toggleForm" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">Cancel</button>--}}
{{--                            <button type="submit" class="px-4 py-2 bg-orange-500 text-white rounded-md hover:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500">Submit</button>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    </div>--}}
</div>
