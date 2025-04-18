@extends('layout.admin.admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Dashboard Header -->
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
        <div class="flex space-x-3">
            <button class="bg-[#8a2be2] hover:bg-[#7a1bd2] text-white px-4 py-2 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                New Trip
            </button>
            <button class="bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 px-4 py-2 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                </svg>
                Export
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <x-stats-card
            title="Total Trips"
            :value="$stats['totalTrips']['value']"
            :change="$stats['totalTrips']['change']"
            :icon="$stats['totalTrips']['icon']"
            :color="$stats['totalTrips']['color']"
        />

        <x-stats-card
            title="Active Users"
            :value="$stats['activeUsers']['value']"
            :change="$stats['activeUsers']['change']"
            :icon="$stats['activeUsers']['icon']"
            :color="$stats['activeUsers']['color']"
        />

        <x-stats-card
            title="Bookings"
            :value="$stats['totalBookings']['value']"
            :change="$stats['totalBookings']['change']"
            :icon="$stats['totalBookings']['icon']"
            :color="$stats['totalBookings']['color']"
        />
         <x-stats-card
            title="Average Trip Price"
            :value="$stats['averagePrice']['value']"
            :change="$stats['averagePrice']['change']"
            :icon="$stats['averagePrice']['icon']"
            :color="$stats['averagePrice']['color']"
        />

    </div>

    <!-- Additional Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">



        <!-- Popular Destinations -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Popular Destinations</h3>
            <div class="space-y-4">
                @foreach($popularDestinations as $destination)
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-gray-800">{{ $destination->destination }}</span>
                            <span class="text-sm text-gray-500 ml-2">{{ $destination->country }}</span>
                        </div>
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            {{ $destination->total }} trips
                        </span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Column - Latest Trip -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
                <div class="p-6 bg-gradient-to-r from-amber-500 to-amber-600 relative">
                    <div class="flex justify-between items-start">
                        <div>
                            <span class="text-white text-sm font-medium">Newest trip</span>
                            <h2 class="text-4xl font-bold text-white mt-1">Marrakech</h2>
                        </div>
                        <div class="flex space-x-2">
                            <button class="p-2 bg-white/20 rounded-full text-white hover:bg-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                            </button>
                            <button class="p-2 bg-white/20 rounded-full text-white hover:bg-white/30">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <img src="https://images.unsplash.com/photo-1597212720158-c40832933cec?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Marrakech" class="absolute top-0 right-0 h-full w-1/2 object-cover opacity-30">
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <div class="flex space-x-4">
                            <button class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Travel dates
                            </button>
                            <button class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                People
                            </button>
                            <button class="px-3 py-1 bg-gray-100 rounded-full text-sm font-medium text-gray-700 flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Destination
                            </button>
                        </div>
                        <button class="text-gray-400 hover:text-gray-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                            </svg>
                        </button>
                    </div>

                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">5 days</h3>
                            <div class="flex items-center text-sm text-gray-600">
                                <span>01.09.2023</span>
                                <span class="mx-2">—</span>
                                <span>05.09.2023</span>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">2 travelers</h3>
                            <div class="flex -space-x-2">
                                <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/women/12.jpg" alt="User">
                                <img class="w-8 h-8 rounded-full border-2 border-white" src="https://randomuser.me/api/portraits/men/32.jpg" alt="User">
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">Marrakech</h3>
                            <div class="flex items-center text-sm text-gray-600">
                                <img src="https://flagcdn.com/w20/ma.png" alt="Morocco" class="mr-2 h-4">
                                <span>Morocco</span>
                                <span class="ml-2 text-xs text-gray-500">2h 15m flight</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- To Do's -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-bold text-gray-800">To do's</h2>
                        <div class="flex items-center">
                            <span class="text-sm text-gray-500 mr-3">Sort</span>
                            <button class="text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="divide-y">
                    <div class="p-4 hover:bg-gray-50 flex items-center">
                        <div class="w-8 text-center text-gray-500 mr-4">1</div>
                        <div class="flex-grow">
                            <p class="text-gray-800">Book hotel for Marrakech trip</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800 mr-3">
                                Artur
                            </div>
                            <div class="bg-orange-100 rounded-full px-3 py-1 text-xs font-medium text-orange-800">
                                Medium
                            </div>
                        </div>
                        <div class="ml-4 text-sm text-gray-500">8:00</div>
                    </div>
                    <div class="p-4 hover:bg-gray-50 flex items-center">
                        <div class="w-8 text-center text-gray-500 mr-4">2</div>
                        <div class="flex-grow">
                            <p class="text-gray-800">Arrange transportation from airport</p>
                        </div>
                        <div class="flex items-center">
                            <img class="w-6 h-6 rounded-full mr-3" src="https://randomuser.me/api/portraits/women/12.jpg" alt="User">
                            <div class="bg-orange-100 rounded-full px-3 py-1 text-xs font-medium text-orange-800">
                                Medium
                            </div>
                        </div>
                        <div class="ml-4 text-sm text-gray-500">8:30</div>
                    </div>
                    <div class="p-4 hover:bg-gray-50 flex items-center">
                        <div class="w-8 text-center text-gray-500 mr-4">3</div>
                        <div class="flex-grow">
                            <p class="text-gray-800">Schedule guided tour of Medina</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800 mr-3">
                                Artur
                            </div>
                            <div class="bg-orange-100 rounded-full px-3 py-1 text-xs font-medium text-orange-800">
                                Medium
                            </div>
                        </div>
                        <div class="ml-4 text-sm text-gray-500">9:30</div>
                    </div>
                    <div class="p-4 hover:bg-gray-50 flex items-center">
                        <div class="w-8 text-center text-gray-500 mr-4">4</div>
                        <div class="flex-grow">
                            <p class="text-gray-800">Confirm dinner reservations</p>
                        </div>
                        <div class="flex items-center">
                            <div class="bg-gray-100 rounded-full px-3 py-1 text-xs font-medium text-gray-800 mr-3">
                                Maria
                            </div>
                            <div class="bg-red-100 rounded-full px-3 py-1 text-xs font-medium text-red-800">
                                High
                            </div>
                        </div>
                        <div class="ml-4 text-sm text-gray-500">10:00</div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <button class="w-full py-2 border border-dashed border-gray-300 rounded-lg text-gray-500 hover:text-gray-700 hover:border-gray-400 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add new task
                    </button>
                </div>
            </div>
        </div>

        <!-- Right Column - Calendar -->
        <div>
            <div class="bg-white rounded-lg shadow overflow-hidden mb-8" id="calendar-section">
                <div class="p-6">
                    <x-calendar
                        :month="request('month')"
                        :year="request('year')"
                        :selected-dates="['2023-09-18', '2023-09-19', '2023-09-20', '2023-09-21', '2023-09-22']"
                    />
                </div>
            </div>

            <!-- Upcoming Trips -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b">
                    <h2 class="text-xl font-bold text-gray-800">Upcoming Trips</h2>
                </div>
                <div class="divide-y">
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Casablanca → Marrakech</h3>
                                <p class="text-sm text-gray-500">Sep 18 - Sep 22</p>
                            </div>
                            <button class="ml-auto text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="bg-purple-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Fes → Chefchaouen</h3>
                                <p class="text-sm text-gray-500">Oct 5 - Oct 9</p>
                            </div>
                            <button class="ml-auto text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 hover:bg-gray-50">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-3 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-medium text-gray-800">Tangier → Essaouira</h3>
                                <p class="text-sm text-gray-500">Nov 12 - Nov 18</p>
                            </div>
                            <button class="ml-auto text-gray-400 hover:text-gray-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="p-4 border-t">
                    <button class="w-full py-2 border border-dashed border-gray-300 rounded-lg text-gray-500 hover:text-gray-700 hover:border-gray-400 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Add new trip
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
