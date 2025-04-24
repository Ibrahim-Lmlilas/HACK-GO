<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class MyBookingsController extends Controller
{
    public function index()
    {
        $bookings = Booking::where('user_id', auth()->id())
            ->with(['trip'])
            ->orderBy('created_at', 'desc')
            ->get();

        $calendarEvents = $bookings->map(function ($booking) {
            return [
                'id' => $booking->id,
                'title' => $booking->trip->name,
                'start' => $booking->trip->start_date,
                'end' => $booking->trip->end_date,
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
