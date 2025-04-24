@extends('layout.client.client')

@section('content')

<div class="bg-gray-100 py-4">
    <!-- Lightbox Modal -->
    <div id="lightbox-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-75 flex items-center justify-center p-4">
        <div class="relative w-full max-w-3xl mx-auto">
            <button class="absolute top-2 right-2 text-white hover:text-gray-300" onclick="closeLightbox()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img id="lightbox-image" src="" alt="" class="max-h-[70vh] w-auto mx-auto">
            <p id="lightbox-caption" class="text-white text-center mt-2 text-sm"></p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-3 sm:px-4">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <!-- Left Column - Images -->
                <div class="relative">
                    <div class="aspect-w-4 aspect-h-3">
                        <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}"
                             class="w-full h-full object-cover">
                    </div>

                    @if($trip->hotel)
                    <div class="mt-2 grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-1">
                        <!-- Main Hotel Image -->
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="{{ $trip->hotel->image_url }}"
                                 alt="{{ $trip->hotel->name }}"
                                 class="w-full h-full object-cover rounded hover:opacity-75 transition-opacity cursor-pointer"
                                 onclick="openLightbox('{{ $trip->hotel->image_url }}', '{{ $trip->hotel->name }}')">
                        </div>

                        <!-- Additional Hotel Images -->
                        @foreach($trip->hotel->hotelImages as $image)
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="{{ $image->image_url }}"
                                 alt="{{ $image->caption }}"
                                 class="w-full h-full object-cover rounded hover:opacity-75 transition-opacity cursor-pointer"
                                 onclick="openLightbox('{{ $image->image_url }}', '{{ $image->caption }}')">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Right Column - Details -->
                <div class="p-4">
                    <div class="mb-4">
                        <!-- Back Button -->
                        <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                            <h1 class="text-xl sm:text-2xl font-bold text-gray-900">{{ $trip->name }}</h1>
                            <a href="{{ route('client.dashboard') }}"
                               class="inline-flex items-center space-x-1 text-sm text-gray-600 hover:text-gray-900">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                                </svg>
                                <span>Back to Dashboard</span>
                            </a>
                        </div>

                        <div class="flex items-center gap-2 mb-3">
                            <span class="text-lg sm:text-xl font-bold text-gray-900">{{ number_format($trip->price, 2) }} MAD</span>
                        </div>

                        <p class="text-sm text-gray-600 mb-4">{{ $trip->description }}</p>

                        <!-- Trip Details Grid -->
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-4">
                            <div class="bg-gray-50 p-2 rounded">
                                <div class="text-xs text-gray-500">Start Date</div>
                                <div class="text-sm font-medium">{{ $trip->start_date->format('M d, Y') }}</div>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <div class="text-xs text-gray-500">End Date</div>
                                <div class="text-sm font-medium">{{ $trip->end_date->format('M d, Y') }}</div>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <div class="text-xs text-gray-500">Capacity</div>
                                <div class="text-sm font-medium">
                                    @php
                                        $currentBookings = $trip->bookings->where('status', '!=', 'cancelled')->count();
                                        $availableSpots = max(0, $trip->capacity - $currentBookings);
                                    @endphp
                                    {{ $availableSpots }} spots available
                                </div>
                            </div>
                            <div class="bg-gray-50 p-2 rounded">
                                <div class="text-xs text-gray-500">Duration</div>
                                <div class="text-sm font-medium">{{ $trip->start_date->diffInDays($trip->end_date) + 1 }} days</div>
                            </div>
                        </div>

                        <!-- Book Now Button -->
                        <div class="flex flex-col sm:flex-row gap-2">
                            @php
                                $userHasBooking = $trip->bookings->where('user_id', auth()->id())
                                    ->where('status', '!=', 'cancelled')
                                    ->isNotEmpty();

                                $hasOverlappingBooking = auth()->user()->bookings()
                                    ->where('status', '!=', 'cancelled')
                                    ->whereHas('trip', function ($query) use ($trip) {
                                        $query->where(function ($q) use ($trip) {
                                            $q->whereBetween('start_date', [$trip->start_date, $trip->end_date])
                                                ->orWhereBetween('end_date', [$trip->start_date, $trip->end_date])
                                                ->orWhere(function ($q) use ($trip) {
                                                    $q->where('start_date', '<=', $trip->start_date)
                                                        ->where('end_date', '>=', $trip->end_date);
                                                });
                                        });
                                    })
                                    ->exists();
                            @endphp

                            @if($availableSpots === 0)
                                <button disabled class="flex-1 bg-gray-400 text-white px-3 py-2 rounded text-sm text-center cursor-not-allowed">
                                    Fully Booked
                                </button>
                            @elseif($userHasBooking)
                                <button disabled class="flex-1 bg-gray-400 text-white px-3 py-2 rounded text-sm text-center cursor-not-allowed">
                                    Already Booked
                                </button>
                            @elseif($hasOverlappingBooking)
                                <button disabled class="flex-1 bg-gray-400 text-white px-3 py-2 rounded text-sm text-center cursor-not-allowed">
                                    You have another trip during these dates
                                </button>
                            @else
                                <form action="{{ route('booking.checkout', $trip) }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="number_of_persons" value="1">
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600">Booking for 1 person</p>
                                    </div>
                                    <button type="submit" class="w-full bg-[#9370db] text-white px-3 py-2 rounded text-sm text-center hover:bg-[#8a6acd] transition-all">
                                        Book Now
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if($trip->hotel)
                    <!-- Hotel Information -->
                    <div class="border-t pt-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3">
                            <h3 class="text-base font-semibold">Hotel Information</h3>
                            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-2">
                                <div class="flex items-center space-x-1">
                                    <span class="text-lg font-bold text-gray-900">{{ number_format($trip->hotel->price_mad, 2) }} MAD</span>
                                    <span class="text-xs text-gray-500">per night</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded p-3">
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-2">
                                <div>
                                    <h4 class="text-base font-medium text-gray-900">{{ $trip->hotel->name }}</h4>
                                    <p class="text-xs text-gray-600">{{ $trip->hotel->address }}</p>
                                </div>
                                <div class="flex items-center">
                                    <div class="flex text-yellow-400">
                                        @for($i = 0; $i < floor($trip->hotel->rating); $i++)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endfor
                                    </div>
                                    <span class="ml-1 text-xs text-gray-600">{{ number_format($trip->hotel->rating, 1) }}</span>
                                </div>
                            </div>

                            <p class="text-xs text-gray-600 mb-3">{{ $trip->hotel->description }}</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <h5 class="text-xs font-medium text-gray-900 mb-1">Location</h5>
                                    <p class="text-xs text-gray-600">{{ $trip->hotel->city }}</p>
                                    @if($trip->hotel->latitude && $trip->hotel->longitude)
                                    <div class="mt-1">
                                        <a href="https://www.google.com/maps?q={{ $trip->hotel->latitude }},{{ $trip->hotel->longitude }}"
                                           target="_blank"
                                           class="inline-flex items-center text-xs text-blue-600 hover:text-blue-800">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                            Map
                                        </a>
                                    </div>
                                    @endif
                                </div>

                                @if(isset($trip->hotel->amenities) && is_array($trip->hotel->amenities))
                                <div>
                                    <h5 class="text-xs font-medium text-gray-900 mb-1">Amenities</h5>
                                    <div class="grid grid-cols-1 gap-1">
                                        @foreach($trip->hotel->amenities as $amenity)
                                        <div class="flex items-center space-x-1 text-xs text-gray-600">
                                            <svg class="w-3 h-3 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path d="M5 13l4 4L19 7"/>
                                            </svg>
                                            <span>{{ $amenity }}</span>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    function openLightbox(imageUrl, caption) {
        const modal = document.getElementById('lightbox-modal');
        const image = document.getElementById('lightbox-image');
        const captionEl = document.getElementById('lightbox-caption');

        image.src = imageUrl;
        captionEl.textContent = caption;
        modal.classList.remove('hidden');

        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                closeLightbox();
            }
        });
    }

    function closeLightbox() {
        document.getElementById('lightbox-modal').classList.add('hidden');
    }

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeLightbox();
        }
    });
</script>
@endpush
