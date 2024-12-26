<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white">

    <!-- Header -->
    <header class="p-6 flex items-center justify-between">
        <div class="flex items-center">
            <img src="https://via.placeholder.com/40" alt="Laraveled Logo" class="mr-3">
            <h1 class="text-xl font-bold">Laraveled.com</h1>
        </div>
        <div>
            <a href="#" class="px-4 py-2 bg-purple-600 rounded hover:bg-purple-700">Login</a>
            <a href="#" class="px-4 py-2 bg-green-600 rounded hover:bg-green-700 ml-2">Register</a>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="text-center py-20 bg-gradient-to-br from-purple-700 via-purple-800 to-purple-900">
        <h1 class="text-5xl font-extrabold mb-4">Discover & Celebrate Laravel Creations</h1>
        <p class="text-xl text-gray-300 mb-6">Showcasing the best projects built with Laravel. Share yours and celebrate your creativity!</p>
        <a href="#" class="px-8 py-3 bg-yellow-500 text-black font-bold rounded-lg hover:bg-yellow-600">Submit Your Project</a>
    </section>

    <!-- Featured Projects Section -->
    <section class="py-16">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-8">Featured Projects</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Placeholder for Projects -->
                <div class="bg-gray-800 rounded-lg p-4">
                    <img src="https://via.placeholder.com/300x200" alt="Project Thumbnail" class="rounded mb-4">
                    <h3 class="text-xl font-bold">Project Title</h3>
                    <p class="text-gray-400">Short description of the project.</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-4">
                    <img src="https://via.placeholder.com/300x200" alt="Project Thumbnail" class="rounded mb-4">
                    <h3 class="text-xl font-bold">Project Title</h3>
                    <p class="text-gray-400">Short description of the project.</p>
                </div>
                <div class="bg-gray-800 rounded-lg p-4">
                    <img src="https://via.placeholder.com/300x200" alt="Project Thumbnail" class="rounded mb-4">
                    <h3 class="text-xl font-bold">Project Title</h3>
                    <p class="text-gray-400">Short description of the project.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="text-center py-16 bg-gradient-to-br from-blue-700 via-blue-800 to-blue-900">
        <h2 class="text-4xl font-bold mb-6">Get Laraveled Today!</h2>
        <p class="text-gray-300 text-lg mb-8">Submit your project and join the community of Laravel creators.</p>
        <a href="#" class="px-8 py-3 bg-red-500 text-black font-bold rounded-lg hover:bg-red-600">Submit Now</a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 py-10">
        <div class="container mx-auto text-center">
            <p class="text-gray-400">© 2024 Laraveled.com. All rights reserved.</p>
            <div class="flex justify-center space-x-4 mt-4">
                <a href="#"><img src="https://via.placeholder.com/30" alt="Twitter Logo"></a>
                <a href="#"><img src="https://via.placeholder.com/30" alt="Facebook Logo"></a>
                <a href="#"><img src="https://via.placeholder.com/30" alt="GitHub Logo"></a>
            </div>
        </div>
    </footer>

    </body></html>
