<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laraveled</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=annie-use-your-telescope:400&display=swap" rel="stylesheet" />
    <link href="https://fonts.bunny.net/css?family=grandstander:300,400,500,600,700&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-grandstander flex flex-col min-h-screen">
<!-- Header -->
<header
    id="header"
    class="fixed top-0 w-full bg-white transition-shadow duration-300"
>
    <div class="container mx-auto px-4 py-4">
        <h1 class="text-lg font-bold font-telescope">Sticky Header</h1>
    </div>
</header>

<!-- Sentinel Element -->
<div id="header-sentinel" class="w-full h-1 bg-transparent"></div>

<!-- Main Content -->
<main class="flex-grow mt-[64px]"> <!-- Account for header height -->
    <div class="container mx-auto px-4 py-6">
        Use this for quotes etc: https://fonts.bunny.net/family/annie-use-your-telescope
        <p class="text-gray-700">Welcome to the main content area! Feel free to add any content here.</p>
        <p class="mt-4">Scroll down to see how the header gets a shadow when you've scrolled past this section.</p>
        <!-- Add additional content to allow scrolling -->
        @for ($i = 0; $i < 50; $i++)
            <p class="mt-2 text-gray-700">Content line {{ $i + 1 }}</p>
        @endfor
    </div>
</main>

<!-- Footer -->
<footer class="bg-gray-800 text-white text-center py-4">
    <div class="container mx-auto">
        <p>&copy; 2024 Your Website. All rights reserved.</p>
    </div>
</footer>

<script>
    const header = document.getElementById("header");
    const sentinel = document.getElementById("header-sentinel");

    // Create an IntersectionObserver to watch the sentinel element
    const observer = new IntersectionObserver(
        ([entry]) => {
            if (!entry.isIntersecting) {
                header.classList.add('border-b'); // Add shadow on scroll
            } else {
                header.classList.remove('border-b'); // Remove shadow at the top
            }
        },
        {
            rootMargin: "0px 0px 0px 0px", // No offset margin
            threshold: 0 // Trigger when the sentinel fully leaves/enters the viewport
        }
    );

    // Observe the sentinel element
    observer.observe(sentinel);
</script>
</body>
</html>
