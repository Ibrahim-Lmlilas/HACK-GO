<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>HACK&GO - Morocco Travel</title>

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
        <div class="relative min-h-screen bg-gray-200">
            <!-- Navigation Bar -->
            <header class="bg-white/80 backdrop-blur-sm fixed w-full z-10">
                <div class="container mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Logo -->
                        <div class="text-2xl font-bold text-gray-800">
                            HACK&GO
                        </div>

                        <!-- Navigation Links -->
                        <nav class="hidden md:flex space-x-8">
                            <a href="#" class="text-gray-700 hover:text-gray-900">Moroccan Cities</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">Desert Tours</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">Cuisine</a>
                            <a href="#" class="text-gray-700 hover:text-gray-900">Contact</a>
                        </nav>

                        <!-- CTA Button -->
                        <div>
                            <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">Book Morocco Tour</a>
                        </div>

                        <!-- Mobile Menu Button (hidden on desktop) -->
                        <div class="md:hidden">
                            <button class="text-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Hero Section -->
            <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1539020140153-e8c8d11194dd?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1740&q=80');">
                <div class="absolute inset-0 bg-black/50"></div>
                <div class="container mx-auto px-6 relative z-1 h-full flex flex-col justify-center items-center text-center">
                    <div class="bg-gray-800/30 backdrop-blur-sm py-2 px-6 rounded-full mb-6">
                        <p class="text-white uppercase tracking-wider text-sm">DISCOVER THE MAGIC OF MOROCCO</p>
                    </div>
                    <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Experience Morocco's Most<br>Beautiful Destinations</h1>
                    <p class="text-xl text-white mb-10 max-w-2xl">Curated Moroccan travel experiences tailored to your desires. Immerse yourself in breathtaking landscapes and rich culture.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full text-lg font-medium">Plan Your Moroccan Journey</a>
                        <a href="#" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-8 py-3 rounded-full text-lg font-medium">Explore Morocco</a>
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