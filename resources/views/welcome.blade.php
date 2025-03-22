<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HACK&GO</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                /* Tailwind CSS styles */
                /* ... existing styles ... */
            </style>
        @endif
    </head>
    <body class="font-sans antialiased">
        <!-- Main Container -->
        <div class="relative min-h-screen">
            <!-- Navigation Bar - Updated to solid gray background -->
            <header class=" fixed w-full z-10">
                <div class="container mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="#">
                            <svg width="77" height="77" viewBox="0 0 134 134" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <rect width="134" height="134" fill="url(#pattern0_73_277)"/>
                                <defs>
                                <pattern id="pattern0_73_277" patternContentUnits="objectBoundingBox" width="1" height="1">
                                <use xlink:href="#image0_73_277" transform="scale(0.002)"/>
                                </pattern>
                                <image id="image0_73_277" width="500" height="500" preserveAspectRatio="none" xlink:href="data:image/png;base64,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SGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGP3uJfLAAAD2UlEQVQQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBABhR4kSGMQIECAQG4BhZ47f9MTIECAQBCB/wOCuaBPEuQBXQAAAABJRU5ErkJggg=="/>
                                </defs>
                                </svg>
                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <nav class="hidden md:flex space-x-8 ">
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">Moroccan Cities</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">Desert Tours</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">Cuisine</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full">Contact</a>
                            <div class="">
                            <a href="#" class="bg-blue-600  hover:bg-blue-700 text-white px-4 py-2  rounded-md ">Book Morocco Tour</a>
                            </div>
                        </nav>

                        <!-- Mobile Menu Button (hidden on desktop) -->
                        <div class="md:hidden">
                            <button class="text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1469041797191-50ace28483c3?q=80&w=2000&auto=format&fit=crop');">
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="container mx-auto px-6 relative z-1 h-full flex flex-col justify-center items-center text-center">
                    <div class="bg-gray-800/30 backdrop-blur-sm py-2 px-6 rounded-full mb-6">
                        <p class="text-white uppercase tracking-wider text-sm">DISCOVER THE MAGIC OF MOROCCO</p>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Experience Morocco's Most<br>Beautiful Destinations</h1>
                    <p class="text-xl text-white mb-10 max-w-2xl">Curated Moroccan travel experiences tailored to your desires. Immerse yourself in breathtaking landscapes and rich culture.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full text-lg font-medium transition-transform duration-300 hover:scale-105">Plan Your Moroccan Journey</a>
                        <a href="#" class="bg-white/20 backdrop-blur-sm hover:bg-white/50 text-white hover:text-black px-8 py-3 rounded-full text-lg font-medium transition-colors duration-300">Explore Morocco</a>
                    </div>
                </div>
            </div>

            <!-- Down Arrow -->
            <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
            </div>

            <!-- Rest of your content would go here -->
            <div class="container mx-auto px-6 py-16">
                <!-- Your existing content or new content -->
            </div>

            <footer class="py-8 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} HACK&GO. All rights reserved.
            </footer>
        </div>
    </body>
</html>
