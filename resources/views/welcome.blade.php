@extends('layout.visitor.visitor')



@section('content')
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
            <a href="/blog" class="bg-white/20 backdrop-blur-sm hover:bg-white/50 text-white hover:text-black px-8 py-3 rounded-full text-lg font-medium transition-colors duration-300">Explore Morocco</a>
        </div>
    </div>
    <!-- Down Arrow -->
    <div class=" sm:block">
        <a href="#destinations" class="absolute bottom-6 md:bottom-10 left-1/2 transform -translate-x-1/2 text-white animate-bounce" onclick="event.preventDefault(); document.querySelector('#destinations').scrollIntoView({behavior: 'smooth'});">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-8 w-8 sm:h-10 sm:w-10 md:h-12 md:w-12 text-white opacity-80">
                <path d="m6 9 6 6 6-6"></path>
            </svg>
        </a>
    </div>

</div>

<!-- Destinations Section -->
<section   id="destinations" class="py-16 bg-white">
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
<section class="py-16 bg-white">
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

<!-- Newsletter Section  -->
<section  class="py-16 bg-[#075985] relative overflow-hidden  ">

<div class="container mx-auto px-6 py-4 relative z-1">
    <div class="max-w-3xl mx-auto bg-[#206A91] backdrop-blur-sm rounded-2xl p-10 shadow-lg border border-[#5395B8]">
        <h2 class="text-3xl md:text-4xl font-bold text-amber-50 mb-4 text-center">Get Inspired for Your Next Adventure</h2>
        <p class="text-lg text-amber-100/90 mb-8 text-center">Subscribe to our newsletter and receive exclusive travel tips, hidden gems, and special offers directly in your inbox.</p>

        <div class="flex flex-col sm:flex-row gap-4 justify-center ">
            <input type="email" placeholder="Your email address" class="px-4 py-3 rounded-lg w-full sm:flex-1 text-gray-800 focus:outline-none focus:ring-2 focus:ring-white border-2 border-transparent focus:border-[#5395B8]">
            <button class="bg-white hover:scale-105 px-6 py-3 rounded-lg font-medium transition duration-300 text-[#206A91]">Subscribe Now</button>
        </div>

        <p class="text-sm mt-4 text-[#5395B8] text-center">We respect your privacy and will never share your information. Unsubscribe anytime.</p>
    </div>
</div>
</section>

@endsection
