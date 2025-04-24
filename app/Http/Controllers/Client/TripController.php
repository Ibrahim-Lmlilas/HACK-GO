<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with(['destination', 'hotel.hotelImages'])
            ->orderBy('start_date', 'desc')
            ->paginate(10);

        return view('client.trips.index', compact('trips'));
    }

    public function show(Trip $trip)
    {
        $trip->load(['destination', 'hotel.hotelImages']);
        return view('client.trips.show', compact('trip'));
    }

    public function book(Trip $trip)
    {
        return redirect()->back()->with('success', 'Booking functionality coming soon!');
    }
}
