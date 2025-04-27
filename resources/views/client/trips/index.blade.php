@extends('layout.client.client')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<style>
.trip-card {
    transition: all 0.3s ease;
}
.trip-card:hover .hover-content {
    opacity: 1;
    transform: translateY(0);
}
.hover-content {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}
.trip-card:hover .card-info {
    opacity: 0;
    transform: translateY(-10px);
}
.card-info {
    transition: all 0.3s ease;
}
</style>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex flex-col lg:flex-row gap-6">
        <div class="flex-1 space-y-6">
            <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Available Trips</h2>
                    <p class="text-sm text-gray-600">Discover amazing destinations around the world</p>
                </div>

               </div>



            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 sm:gap-6">
                @foreach($trips as $trip)
                <div class="trip-card trip-item bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl relative group border border-emerald-100">
                    <div class="relative h-[200px] sm:h-[280px]">
                        <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-emerald-900/80 via-black/30 to-transparent"></div>

                        <div class="absolute top-3 right-3 z-10 block sm:hidden">
                            <a href="{{ route('client.trips.show', $trip) }}"
                                class="inline-block bg-emerald-500 text-white px-3 py-1.5 sm:px-4 sm:py-2 text-[10px] sm:text-xs rounded-full hover:bg-emerald-600 transition shadow-sm">
                                View Details
                            </a>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <!-- Card Info (hides on hover) -->
                            <div class="card-info">
                                <h5 class="text-base sm:text-lg font-bold mb-1 line-clamp-1 text-emerald-50">{{ $trip->name }}</h5>
                                <p class="text-xs sm:text-sm opacity-90 mb-1 line-clamp-1 text-emerald-100">{{ $trip->destination->name }}</p>

                                @if($trip->hotel)
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-hotel mr-2 text-xs text-emerald-200"></i>
                                    <span class="text-xs line-clamp-1">{{ $trip->hotel->name }}</span>
                                </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-xs text-emerald-200"></i>
                                        <span class="text-xs">{{ $trip->start_date->format('M d') }}</span>
                                    </div>
                                    <div class="flex items-center bg-emerald-600 px-2 py-1 rounded-full">
                                        <span class="text-sm font-bold">{{ number_format($trip->price, 2) }}</span>
                                        <span class="text-xs ml-1">MAD</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile: Always visible, Desktop: Only visible on hover -->
                            <div class="hidden sm:flex hover-content opacity-0 transform translate-y-10 absolute inset-0 flex-col items-center justify-center text-center p-4">
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <i class="fas fa-users text-xs text-emerald-200"></i>
                                        <span class="text-xs">{{ $trip->capacity }} persons</span>
                                    </div>
                                </div>
                                <div class="space-y-2 mb-4">
                                    <a href="{{ route('client.trips.show', $trip) }}"
                                        class="inline-block bg-emerald-500 text-white px-4 sm:px-6 py-2 rounded-full text-xs hover:bg-emerald-600 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $trips->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const trips = document.querySelectorAll('.trip-item');

        trips.forEach(trip => {
            const tripName = trip.querySelector('h5').textContent.toLowerCase();
            const destination = trip.querySelector('p').textContent.toLowerCase();
            const hotel = trip.querySelector('.fa-hotel')?.nextElementSibling?.textContent.toLowerCase() || '';
            const price = trip.querySelector('.bg-emerald-600 span').textContent.toLowerCase();

            if (tripName.includes(searchValue) ||
                destination.includes(searchValue) ||
                hotel.includes(searchValue) ||
                price.includes(searchValue)) {
                trip.style.display = '';
            } else {
                trip.style.display = 'none';
            }
        });
    });
</script>
@endsection
