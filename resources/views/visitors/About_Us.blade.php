@extends('layout.visitor.visitor')

@section('content')
<div class="relative h-screen bg-cover bg-center flex items-center" style="background-image: url(&quot;https://moroccomwtours.com/wp-content/uploads/2024/10/Morocco-Group-Tours-9-Days-morocco-9-12-day-small-group-tours-2025-9-day-Morocco-itinerary-Morocco-desert-tours-Imperial-cities-of-Morocco-tour-e1728310048645.png&quot;); visibility: visible; animation-delay: 0.4s; animation-name: fadeIn;">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="container mx-auto px-4 text-center relative ">
        <h1 class="text-5xl md:text-6xl font-bold text-gray-200 mb-6"> HACK&GO</h1>
                <p class="text-xl text-gray-200 max-w-3xl mx-auto mb-8">
            Discover the story behind Morocco's premier travel experience curator, connecting travelers with authentic Moroccan adventures.
        </p>

    </div>
    <!-- Down Arrow -->
    <div class="mb-12 sm:block">
        <a href="#destinations" class="absolute bottom-6 md:bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce" onclick="event.preventDefault(); document.querySelector('#more').scrollIntoView({behavior: 'smooth'});">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 text-white opacity-80">
                <path d="m6 9 6 6 6-6"></path>
            </svg>
        </a>
    </div>

</div>

<section id="more" class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold mb-6 text-gray-800">Our Story</h2>
                    <p class="text-gray-600 mb-6">The idea for HACK&GO came to me in August 2024 when I personally encountered difficulties while planning my travels. I realized how challenging it could be to find authentic experiences and reliable information about destinations in Morocco.</p>
                    <p class="text-gray-600">J'ai créé cette plateforme pour simplifier la planification de voyage pour tout le monde, en fournissant des ressources complètes et des liens vers des expériences locales. Ce qui rend ce site spécial, ce sont des fonctionnalités uniques comme le système de chat intégré, qui permet aux voyageurs de communiquer directement entre eux et d'obtenir des conseils en temps réel..</p>
                </div>
                <div class="rounded-lg overflow-hidden shadow-xl">
                    <img src="https://www.explore.co.uk/medialibraries/explore/blog-images/2020%2005%20may/img_0071.jpg?ext=.jpg&width=620&format=webp&quality=80&v=202005151416" alt="Morocco landscape" class="w-full h-auto">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-8 md:px-16 lg:px-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Why Travel With Us</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Experience Morocco like never before with our carefully crafted tours and authentic local experiences.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#92472B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Local Expertise</h3>
                <p class="text-gray-600">Our guides are born and raised in Morocco, offering insider knowledge and authentic cultural insights.</p>
            </div>

            <!-- Feature 2 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#9e3c2e]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Safety First</h3>
                <p class="text-gray-600">Your safety is our priority. We follow strict protocols and work only with trusted partners throughout Morocco.</p>
            </div>

            <!-- Feature 3 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#92472B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Authentic Accommodations</h3>
                <p class="text-gray-600">Stay in carefully selected riads, desert camps, and boutique hotels that reflect Morocco's rich cultural heritage.</p>
            </div>

            <!-- Feature 4 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#92472B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Transparent Pricing</h3>
                <p class="text-gray-600">No hidden fees or surprise costs. Our pricing is clear and includes all accommodations, guides, and listed activities.</p>
            </div>

            <!-- Feature 5 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#92472B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Small Group Tours</h3>
                <p class="text-gray-600">Travel with like-minded explorers in small groups to ensure personalized attention and authentic experiences.</p>
            </div>

            <!-- Feature 6 -->
            <div class="bg-white p-8 rounded-lg shadow-md transition-transform duration-300 hover:-translate-y-2">
                <div class="w-14 h-14 bg-purple-100 rounded-full flex items-center justify-center mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-[#92472B]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Connect with Fellow Travelers</h3>
                <p class="text-gray-600">Connect and chat with other travelers heading to the same destinations, share experiences and tips, and even plan meetups during your trip.</p>
            </div>
        </div>
    </div>
</section>

@endsection
