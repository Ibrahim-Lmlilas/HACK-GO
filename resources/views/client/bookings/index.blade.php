@extends('layout.client.client')

@section('content')
<div class="container mx-auto px-3 py-4">
    <h1 class="text-xl font-bold mb-4">My Bookings</h1>

    <div class="flex flex-col lg:flex-row gap-4">
        <div class="lg:w-1/3">
            <div class="bg-white rounded-lg shadow p-2 sticky top-4">
                <div id="calendar" class="min-h-[200px]"></div>
            </div>
        </div>

        <div class="lg:w-2/3">
            @if(count($bookings) > 0)
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

                                <div class="hidden sm:flex hover-content opacity-0 transform translate-y-10 absolute inset-0 flex-col items-center justify-center text-center p-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                                    <div class="space-y-2 mb-4">
                                        <a href="{{ route('client.trips.show', $booking->trip) }}"
                                            class="inline-block bg-white text-black px-4 py-2 rounded-full text-xs hover:bg-gray-100 transition">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
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
    padding: 1px 3px !important;
    font-size: 0.7rem !important;
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
        contentHeight: 300,
        dayMaxEvents: 1,
        displayEventTime: false
    });
    calendar.render();
});
</script>
@endpush
