@extends('layout.admin.admin')

@section('content')
<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="flex flex-col lg:flex-row gap-6 ">
    <div class="flex-1 space-y-6">
        <div class="flex flex-col md:flex-row gap-5">
            <!-- destination chart-->
            <div class="relative h-64 w-full md:w-1/2 bg-white rounded-2xl p-5">
                @foreach($destinations as $index => $destination)
                <div class="destination-card absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                     data-index="{{ $index }}">
                    <div class="relative h-full rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h4 class="font-bold text-xl mb-1">{{ $destination->name }}</h4>
                            <p class="text-sm mb-1">{{ $destination->city }}</p>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm">{{ number_format($destination->rating, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 w-full md:w-1/2">
                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-hotel text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">{{ count($hotels) }}</h2>
                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Hotels</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-map-marker-alt text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">{{ $stats['totalDestinations']['value'] }}</h2>
                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Destinations</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-user text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">{{ $stats['totalUsers']['value'] }}</h2>
                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Users</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-users text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">156</h2>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Active Users</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl p-4">
            <div class="overflow-x-auto">
            <table class="min-w-full table-auto text-sm">
                <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hotel</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Details</th>
<th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Map</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($hotels as $hotel)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-12 w-12">
                        <img class="h-12 w-12 rounded-lg object-cover" src="{{ $hotel->image_url }}" alt="{{ $hotel->name }}">
                        </div>
                        <div class="ml-3">
                        <div class="text-xs font-medium text-gray-900">{{ $hotel->name }}</div>
                        </div>
                    </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                    <div class="text-xs text-gray-900">{{ $hotel->city }}</div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                    <div class="flex items-center space-x-3">
                        <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-1 text-xs text-gray-600">{{ number_format($hotel->rating, 1) }}</span>
                        </div>
                        <span class="text-xs text-gray-600 font-medium">{{ number_format($hotel->price_mad, 2) }} MAD</span>
                    </div>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap mx-auto">
                        @if($hotel->latitude && $hotel->longitude)
                            <div id="map-{{ $hotel->id }}" style="height: 65px; width: 120px;"></div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var map = L.map('map-{{ $hotel->id }}', {
                                        center: [{{ $hotel->latitude }}, {{ $hotel->longitude }}],
                                        zoom: 13,
                                        zoomControl: false,
                                        attributionControl: false,
                                        dragging: true,
                                        scrollWheelZoom: true,
                                        doubleClickZoom: false,
                                        boxZoom: true,
                                        keyboard: false,
                                        tap: false,
                                    });
                                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                        maxZoom: 19,
                                    }).addTo(map);

                                    var redIcon = L.divIcon({
                                        html: '<i class="fas fa-map-marker-alt text-red-600" style="font-size: 20px;"></i>',
                                        className: 'custom-div-icon',
                                        iconSize: [20, 20],
                                        iconAnchor: [10, 10]
                                    });

                                    L.marker([{{ $hotel->latitude }}, {{ $hotel->longitude }}], {icon: redIcon}).addTo(map)
                                        .bindPopup('{{ $hotel->name }}');
                                });
                            </script>
                        @else
                            <span class="text-xs text-gray-400">No location</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-full lg:w-80 space-y-5">
        <!-- Weather -->
        <div class="bg-white rounded-2xl p-3">
            <h3 class="text-gray-700 mb-4">Weather Watcher <i class="fas fa-cloud-sun text-black"></i></h3>
            <div class="flex items-center space-x-2 mb-3">
                <input type="text" id="city-input" placeholder="Enter city name" class="flex-1 p-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-black">
                <button id="search-btn" class="text-black p-2 rounded-lg transition"><i class="fas fa-search"></i></button>
            </div>
            <div class="weather-info hidden">
                <div class="flex justify-between items-center mb-3">
                    <h4 id="city-name" class="text-lg font-medium"></h4>
                    <p id="temperature" class="text-2xl font-bold"></p>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <p id="description" class="py-1"></p>
                    <p id="humidity" class="py-1"></p>
                    <p id="wind" class="py-1"></p>
                </div>
            </div>
            <p id="error-message" class="hidden mt-2 text-sm text-red-500 font-medium"></p>
        </div>

        <!-- Calendar -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <x-calendar
                    :month="request('month')"
                    :year="request('year')"
                />
            </div>
        </div>
    </div>
</div>

<!-- Destination Details Modal -->
<div id="destinationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-gray-800" id="modalDestinationName"></h3>
                    <button onclick="closeDestinationModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="relative h-64 mb-4 rounded-lg overflow-hidden">
                    <img id="modalDestinationImage" src="" alt="" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-2 text-gray-700" id="modalDestinationRating"></span>
                    </div>
                    <div class="text-gray-600" id="modalDestinationDescription"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
