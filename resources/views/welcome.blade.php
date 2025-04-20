@extends('layout.visitor.visitor')



@section('content')
 <!-- Hero Section -->
 <div class="relative h-screen bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1469041797191-50ace28483c3?q=80&w=2000&auto=format&fit=crop');">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="container mx-auto px-6 relative z-1 h-full flex flex-col justify-center items-center text-center">
        <div class="bg-[#3A3A3A]/30 backdrop-blur-sm py-2 px-6 rounded-full mb-6">
            <p class="text-white uppercase tracking-wider text-sm">DISCOVER THE MAGIC OF MOROCCO</p>
        </div>
        <h1 class="text-4xl md:text-6xl font-bold text-white mb-6">Experience Morocco's Most<br>Beautiful Destinations</h1>
        <p class="text-xl text-white mb-10 max-w-2xl">Curated Moroccan travel experiences tailored to your desires. Immerse yourself in breathtaking landscapes and rich culture.</p>
        <div class="flex flex-col sm:flex-row gap-4">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="/admin/dashboard" class="bg-[#92472B] hover:bg-[#9e3c2e] text-white px-8 py-3 rounded-full text-lg font-medium transition-transform duration-300 hover:scale-105">Plan Your Moroccan Journey</a>
                @else
                    <a href="/dashboard" class="bg-[#92472B] hover:bg-[#9e3c2e] text-white px-8 py-3 rounded-full text-lg font-medium transition-transform duration-300 hover:scale-105">Plan Your Moroccan Journey</a>
                @endif
            @else
                <a href="/login" class="bg-[#92472B] hover:bg-[#9e3c2e] text-white px-8 py-3 rounded-full text-lg font-medium transition-transform duration-300 hover:scale-105">Plan Your Moroccan Journey</a>
            @endauth
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
<section id="destinations" class="py-16 bg-white">
    <div class="container mx-auto px-8 md:px-16 lg:px-24">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">Explore Magical Morocco</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">From ancient medinas to sweeping deserts, discover the most captivating destinations in the Kingdom of Morocco.</p>
        </div>

        <!-- Destinations Grid with Navigation -->
        <div class="relative">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 mb-16" id="destinationsGrid">
                @foreach($destinations as $destination)
                <div class="destination-card bg-gradient-to-t from-black/60 to-transparent rounded-lg overflow-hidden shadow-lg transition-transform duration-300 hover:shadow-xl">
                    <div class="relative h-64">
                        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="bg-gradient-to-t from-black/60 to-transparent absolute bottom-0 left-0 right-0 p-6 text-white">
                            <p class="text-sm font-medium mb-1">{{ $destination->city }}</p>
                            <h3 class="text-2xl font-bold">{{ $destination->name }}</h3>
                            <div class="flex items-center mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm">{{ number_format($destination->rating, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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

<!-- Newsletter Section  -->
<section class="py-16 bg-[#3A3A3A] relative overflow-hidden">
    <div class="container mx-auto px-6 py-4 relative z-1">
        <div class="max-w-3xl mx-auto bg-[#92472B] backdrop-blur-sm rounded-2xl p-10 shadow-lg border border-[#a06e5a]">
            <h2 class="text-3xl md:text-4xl font-bold text-[#FEFBEA] mb-4 text-center">Get Inspired for Your Next Adventure</h2>
            <p class="text-lg text-[#FEFBEA]/90 mb-8 text-center">Subscribe to our newsletter and receive exclusive travel tips, hidden gems, and special offers directly in your inbox.</p>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <input type="email" placeholder="Your email address" class="px-4 py-3 rounded-lg w-full sm:flex-1 text-gray-800 focus:outline-none focus:ring-2 focus:ring-[#3A3A3A] border-2 border-transparent focus:border-[#3A3A3A]">
                <button class="bg-[#FEFBEA] text-[#92472B] hover:bg-[#f5f1dc] px-6 py-3 rounded-lg font-medium">Subscribe</button>
            </div>
            <p class="text-sm mt-4 text-[#FEFBEA]/80 text-center">We respect your privacy and will never share your information. Unsubscribe anytime.</p>
        </div>
    </div>
</section>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const grid = document.getElementById('destinationsGrid');
    const cards = Array.from(grid.getElementsByClassName('destination-card'));
    const totalCards = cards.length;
    const cardsPerPage = 8;
    let currentPage = 0;

    // Hide all cards initially except first 8
    cards.forEach((card, index) => {
        card.style.display = index < cardsPerPage ? 'block' : 'none';
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        if ((currentPage + 1) * cardsPerPage < totalCards) {
            currentPage++;
            updateDisplay();
        }
    });

    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPage > 0) {
            currentPage--;
            updateDisplay();
        }
    });

    function updateDisplay() {
        const startIndex = currentPage * cardsPerPage;
        cards.forEach((card, index) => {
            card.style.display = (index >= startIndex && index < startIndex + cardsPerPage) ? 'block' : 'none';
        });

        // Update button states
        document.getElementById('prevBtn').style.opacity = currentPage === 0 ? '0.5' : '1';
        document.getElementById('nextBtn').style.opacity = (currentPage + 1) * cardsPerPage >= totalCards ? '0.5' : '1';
    }

    // Initial button states
    updateDisplay();
});
</script>
@endpush

@endsection
