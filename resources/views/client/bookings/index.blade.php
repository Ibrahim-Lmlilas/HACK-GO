@extends('layout.client.client')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container mx-auto px-3 py-4">
    <h1 class="text-xl font-bold mb-4">My Bookings</h1>

    @if(session('success'))
        <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="flex flex-col lg:flex-row gap-4">
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg shadow p-2 sticky top-4">
                <div id="calendar" class="min-h-[200px]"></div>
            </div>
        </div>

        <div class="lg:w-2/3">
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

            @if($bookings->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
                @foreach($bookings as $booking)
                <div class="trip-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl relative group">
                <div class="relative h-[200px]">
                    <img src="{{ $booking->trip->destination->image_url }}" alt="{{ $booking->trip->name }}"
                    class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                    <div class="absolute top-3 right-3 z-10 block sm:hidden">
                    <a href="{{ route('client.trips.show', $booking->trip) }}"
                        class="inline-block bg-white text-black px-3 py-1.5 text-[10px] rounded-full hover:bg-gray-100 transition shadow-sm">
                        View Details
                    </a>
                    </div>

                    <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                    <div class="card-info">
                        <h5 class="text-base sm:text-lg font-bold mb-1 line-clamp-1">{{ $booking->trip->name }}</h5>
                        <p class="text-xs sm:text-sm opacity-90 mb-1 line-clamp-1">
                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-medium
                            @if($booking->status === 'completed') bg-green-100 text-green-800
                            @elseif($booking->status === 'pending') bg-yellow-100 text-yellow-800
                            @else bg-red-100 text-red-800
                            @endif">
                            {{ ucfirst($booking->status) }}
                        </span>
                        </p>

                        <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                            <span class="text-xs">{{ $booking->trip->start_date->format('M d, Y') }}</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-sm font-bold">{{ number_format($booking->amount, 2) }}</span>
                            <span class="text-xs ml-1">MAD</span>
                        </div>
                        </div>
                    </div>

                    <div class="hidden sm:flex hover-content absolute inset-0 flex-col items-center justify-center text-center p-4">
                        <div class="space-y-2 mb-4">
                            <a href="{{ route('client.trips.show', $booking->trip) }}"
                                class="inline-block bg-white text-black px-4 py-2 rounded-full text-xs hover:bg-gray-100 transition">
                                View Details
                            </a>
                            @php
                                $daysUntilTrip = now()->startOfDay()->diffInDays($booking->trip->start_date->startOfDay(), false);
                                $canCancel = $booking->status !== 'cancelled' && $daysUntilTrip > 2;
                            @endphp
                            @if($canCancel)
                                <form action="{{ route('booking.cancel', $booking) }}" method="POST" class="inline-block mt-2">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        onclick="return confirm('Are you sure you want to cancel this booking? This action cannot be undone.')"
                                        class="bg-red-500 text-white px-4 py-2 rounded-full text-xs hover:bg-red-600 transition">
                                        Cancel Booking
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                <div class="flex items-center justify-center">
                    @if($bookings->hasPages())
                        <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
                            {{-- Previous Page Link --}}
                            @if($bookings->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md">
                                    Previous
                                </span>
                            @else
                                <a href="{{ $bookings->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-md hover:bg-gray-50">
                                    Previous
                                </a>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                                @if($page == $bookings->currentPage())
                                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-[#9370db] border border-[#9370db]">
                                        {{ $page }}
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 hover:bg-gray-50">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach

                            {{-- Next Page Link --}}
                            @if($bookings->hasMorePages())
                                <a href="{{ $bookings->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-md hover:bg-gray-50">
                                    Next
                                </a>
                            @else
                                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md">
                                    Next
                                </span>
                            @endif
                        </nav>
                    @endif
                </div>
            </div>
            @else
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600 text-sm">You don't have any bookings yet.</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('styles')
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.css' rel='stylesheet' />
<link href='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.css' rel='stylesheet' />
<style>
.fc {
    font-size: 0.75rem;
}
.fc .fc-toolbar {
    flex-wrap: wrap;
    gap: 0.5rem;
}
.fc .fc-toolbar-title {
    font-size: 1rem;
}
.fc .fc-button {
    padding: 0.15rem 0.35rem;
    font-size: 0.75rem;
}
.fc .fc-daygrid-day {
    padding: 2px !important;
}
.fc .fc-daygrid-day-number {
    padding: 2px 4px !important;
}
.fc .fc-daygrid-event {
    padding: 2px 4px !important;
    font-size: 0.7rem !important;
    border-radius: 3px !important;
    margin-top: 1px !important;
    margin-bottom: 1px !important;
}
.fc .fc-day-today {
    background: rgba(147, 112, 219, 0.1) !important;
}
.fc .fc-event-title {
    font-weight: normal !important;
}
</style>
@endpush

@push('scripts')
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core/main.js'></script>
<script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid/main.js'></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: @json($calendarEvents),
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'next'
        },
        height: 'auto',
        contentHeight: 200,
        displayEventTime: false,
        eventDidMount: function(info) {
            if (info.event.extendedProps.status === 'cancelled') {
                info.el.style.opacity = '0.5';
                info.el.style.textDecoration = 'line-through';
            }
        }
    });
    calendar.render();
});
</script>
@endpush
