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

        <style>
            .navbar-scrolled {
                background-color: rgba(255, 255, 255, 0.808); /* Semi-transparent white */
                backdrop-filter: blur(5px); /* Glassmorphism effect */
                -webkit-backdrop-filter: blur(8px); /* For Safari */
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            }

            .navbar-scrolled .nav-link {
                color: #1f2937 !important; /* text-gray-800 */
            }

            .navbar-scrolled .nav-link:hover {
                color: #2563eb !important; /* text-blue-600 */
            }

            .navbar-scrolled .book-btn {
                background-color: #2563eb;
                color: white;
            }

            .navbar-scrolled .logo-filter {
                filter: invert(1);
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <!-- Main Container -->
        <div class="relative min-h-screen">
            <!-- Navigation Bar - Updated with scroll effect -->
            <header class="fixed w-full z-10 transition-all duration-300"  id="navbar">
                <div class="container mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        <!-- Logo -->
                        <div class="flex items-center">
                            <a href="#" class="transition-transform duration-300 hover:scale-125">
                                <svg width="60" height="60" viewBox="0 0 110 110" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <rect width="110" height="110" fill="url(#pattern0_86_1599)"/>
                                    <defs>
                                    <pattern id="pattern0_86_1599" patternContentUnits="objectBoundingBox" width="1" height="1">
                                    <use xlink:href="#image0_86_1599" transform="scale(0.002)"/>
                                    </pattern>
                                    <image id="image0_86_1599" width="500" height="500" preserveAspectRatio="none" xlink:href="data:image/png;base64,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"/>
                                    </defs>
                                    </svg>


                            </a>
                        </div>

                        <!-- Navigation Links -->
                        <nav class="hidden md:flex space-x-8">
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full nav-link">Moroccan Cities</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full nav-link">Desert Tours</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full nav-link">Cuisine</a>
                            <a href="#" class="text-white hover:text-gray-200 relative pb-1 after:absolute after:left-0 after:bottom-0 after:w-0 after:h-0.5 after:bg-blue-600 after:transition-all after:duration-300 hover:after:w-full nav-link">Contact</a>
                            <div>
                                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md transition-transform duration-300 hover:scale-105 book-btn">Book Morocco Tour</a>
                            </div>
                        </nav>

                        <!-- Mobile Menu Button (hidden on desktop) -->
                        <div class="md:hidden">
                            <button class="text-black mobile-menu-button">
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
                <!-- Down Arrow -->
                <div class=" sm:block">
                    <a href="#about" class="absolute bottom-6 md:bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 text-white opacity-80">
                            <path d="m6 9 6 6 6-6"></path>
                        </svg>
                    </a>
                </div>

            </div>

            <!-- Destinations Section -->
            <section id="about" class="py-16 bg-white">
                <div class="container mx-auto px-8 md:px-16 lg:px-24">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Explore Magical Morocco</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">From ancient medinas to sweeping deserts, discover the most captivating destinations in the Kingdom of Morocco.</p>
                    </div>

                    <!-- Destinations Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                        <!-- Destination Card 1 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://media.audleytravel.com/-/media/images/home/north-africa-and-the-middle-east/morocco/places/istock_41519458_morocco_djemaa_el_fna_marrakesh_1500x1500.webp?q=60&w=828&h=828" alt="Marrakech" class="w-full h-64 object-cover">

                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Marrakech</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Explore the vibrant markets and ornate palaces of Morocco's Red City.</p>

                            </div>
                        </div>

                        <!-- Destination Card 2 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1469041797191-50ace28483c3?q=80&w=2000&auto=format&fit=crop" alt="Sahara Desert" class="w-full h-64 object-cover">
                                <div class="absolute top-4 left-4">
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Sahara Desert</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Experience the magic of the dunes and camp under the stars in the world's largest hot desert.</p>

                            </div>
                        </div>

                        <!-- Destination Card 3 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://aml.ma/sites/default/files/2022-05/chefchaouen-destinations-au-maroc-bateau-ferry-espagne-maroc-ferry-bateau-maroc-espagne-aml.jpg" alt="Chefchaouen" class="w-full h-64 object-cover">

                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Chefchaouen</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Wander through the stunning blue streets of Morocco's famous Blue Pearl in the Rif Mountains.</p>

                            </div>
                        </div>

                        <!-- Destination Card 4 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://www.specialholidaysmorocco.com/uploads/images/blog/352575_le-haut-atlas-1.jpg" alt="Atlas Mountains" class="w-full h-64 object-cover">

                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Atlas Mountains</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Hike through breathtaking landscapes and traditional Berber villages in North Africa's highest mountain range.</p>

                            </div>
                        </div>

                        <!-- Destination Card 5 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://st.depositphotos.com/1004221/2533/i/450/depositphotos_25335607-stock-photo-essaouira-fortress-morocco-africa.jpg" alt="Essaouira" class="w-full h-64 object-cover">

                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Essaouira</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Relax in this charming coastal town known for its fortified medina and refreshing ocean breezes.</p>

                            </div>
                        </div>

                        <!-- Destination Card 6 -->
                        <div class="bg-white rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl hover:-translate-y-2">
                            <div class="relative">
                                <img src="https://www.bonplanvoyage.net/wordpress2012/wp-content/uploads/que-faire-a-fes-e1691347398442.jpg" alt="Fes" class="w-full h-64 object-cover">

                            </div>
                            <div class="p-6">
                                <div class="flex items-center mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Fes</h3>
                                </div>
                                <p class="text-gray-600 mb-4">Step back in time in the world's largest car-free urban area with its ancient medina and traditional tanneries.</p>

                            </div>
                        </div>
                    </div>


                </div>
            </section>

            <!-- Features Section -->
            <section class=" bg-white">
                <div class="container mx-auto px-8 md:px-16 lg:px-24">
                    <div class="text-center mb-16">
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Why Travel With Us</h2>
                        <p class="text-gray-600 max-w-2xl mx-auto">Experience Morocco like never before with our carefully crafted tours and authentic local experiences.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <!-- Feature 1 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Best Support</h3>
                            <p class="text-gray-600">Our dedicated team is available 24/7 to assist you every step of the way, ensuring a worry-free experience.</p>
                        </div>

                        <!-- Feature 2 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Flexible Itineraries</h3>
                            <p class="text-gray-600">Customize your journey to match your interests, whether it's cultural immersion, adventure, or relaxation.</p>
                        </div>

                        <!-- Feature 3 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Authentic Accommodations</h3>
                            <p class="text-gray-600">Stay in carefully selected riads, desert camps, and boutique hotels that reflect Morocco's rich cultural heritage.</p>
                        </div>

                        <!-- Feature 4 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Transparent Pricing</h3>
                            <p class="text-gray-600">No hidden fees or surprise costs. Our pricing is clear and includes all accommodations, guides, and listed activities.</p>
                        </div>

                        <!-- Feature 5 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Small Group Tours</h3>
                            <p class="text-gray-600">Travel with like-minded explorers in small groups to ensure personalized attention and authentic experiences.</p>
                        </div>

                        <!-- Feature 6 -->
                        <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                            <div class="w-14 h-14 bg-blue-100 rounded-full flex items-center justify-center mb-6">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800 mb-3">Connect with Fellow Travelers</h3>
                            <p class="text-gray-600">Connect and chat with other travelers heading to the same destinations, share experiences and tips, and even plan meetups during your trip.</p>
                        </div>
                    </div>
                </div>
            </section>

            <footer class="py-8 text-center text-sm text-gray-600">
                &copy; {{ date('Y') }} HACK&GO. All rights reserved.
            </footer>
        </div>
    </body>
</html>

<script>
    //  scroll navigation
    document.addEventListener('DOMContentLoaded', function() {
        const navbar = document.getElementById('navbar');
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('navbar-scrolled');
            } else {
                navbar.classList.remove('navbar-scrolled');
            }
        });
        if (window.scrollY > 50) {
            navbar.classList.add('navbar-scrolled');
        }
    });
</script>
