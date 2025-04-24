<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyBookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->with(['trip.destination'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        $calendarEvents = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->trip->name,
                'start' => $booking->trip->start_date->format('Y-m-d'),
                'end' => $booking->trip->end_date->format('Y-m-d'),
                'backgroundColor' => '#3490dc', // Blue color for booked trips
                'borderColor' => '#3490dc',
                'url' => route('client.trips.show', $booking->trip),
            ];
        });

        return view('client.bookings.index', [
            'bookings' => $bookings,
            'calendarEvents' => $calendarEvents
        ]);
    }
}
