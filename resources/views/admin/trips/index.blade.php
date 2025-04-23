@extends('layout.admin.admin')

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

<div class="flex flex-col lg:flex-row gap-6">
    <div class="flex-1 space-y-6">
        <div class="flex flex-col md:flex-row gap-5">
            <div class="w-full">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-800">Available Trips</h2>
                    <a href="{{ route('admin.trips.create') }}" class="bg-black text-white px-4 py-2 rounded-3xl hover:bg-gray-800 transition">
                        Add New Trip
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
                    @foreach($trips as $trip)
                    <div class="trip-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl relative group">
                        <!-- Main Image and Gradient -->
                        <div class="relative h-[280px]">
                            <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                            <!-- Always Visible Content -->
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <!-- Card Info (hides on hover) -->
                                <div class="card-info">
                                    <h5 class="text-lg font-bold mb-1 line-clamp-1">{{ $trip->name }}</h5>
                                    <p class="text-sm opacity-90 mb-1 line-clamp-1">{{ $trip->destination->name }}</p>

                                    @if($trip->hotel)
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-hotel mr-2 text-xs"></i>
                                        <span class="text-xs line-clamp-1">{{ $trip->hotel->name }}</span>
                                    </div>
                                    @endif

                                    <!-- Basic Info Row -->
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                            <span class="text-xs">{{ $trip->start_date->format('M d') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <span class="text-sm font-bold">{{ number_format($trip->price, 2) }}</span>
                                            <span class="text-xs ml-1">MAD</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Hover Content -->
                                <div class="hover-content absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                                    <div class="space-y-2 mb-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            <i class="fas fa-users text-xs"></i>
                                            <span class="text-xs">{{ $trip->capacity }} persons</span>
                                        </div>
                                    </div>

                                    <a href="{{ route('admin.trips.show', $trip) }}"
                                        class="inline-block bg-white text-black px-6 py-2 rounded-full text-xs hover:bg-gray-100 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
