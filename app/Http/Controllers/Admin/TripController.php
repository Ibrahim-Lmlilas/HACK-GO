<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\Destination;
use Illuminate\Http\Request;

class TripController extends Controller
{
    public function index()
    {
        $trips = Trip::with('destination')->get();
        return view('admin.trips.index', compact('trips'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('admin.trips.form', compact('destinations'));
    }

    public function show(Trip $trip)
    {
        $trip->load(['destination', 'hotel.hotelImages']);
        return view('admin.trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $destinations = Destination::all();
        return view('admin.trips.form', compact('trip', 'destinations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'destination_id' => 'required|exists:destinations,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'capacity' => 'required|integer|min:1'
        ]);

        $trip = Trip::create($validated);

        // Redirect to hotel selection page instead of trip details
        return redirect()->route('admin.trips.select-hotel', $trip)
            ->with('success', 'Trip created successfully. Now you can select a hotel if needed.');
    }

    public function update(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'price' => 'sometimes|numeric|min:0',
            'destination_id' => 'sometimes|exists:destinations,id',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|after:start_date',
            'capacity' => 'sometimes|integer|min:1'
        ]);

        // Check if destination has changed
        if (isset($validated['destination_id']) && $validated['destination_id'] != $trip->destination_id) {
            // Reset hotel selection
            $validated['hotel_id'] = null;

            // Update the trip first
            $trip->update($validated);

            // Redirect to hotel selection page
            return redirect()->route('admin.trips.select-hotel', $trip)
                ->with('success', 'Destination changed. Please select a new hotel for the new destination.');
        }

        $trip->update($validated);
        return redirect()->route('admin.trips.show', $trip)
            ->with('success', 'Trip updated successfully');
    }

    public function destroy(Trip $trip)
    {
        $trip->delete();
        return redirect()->route('admin.trips')
            ->with('success', 'Trip deleted successfully');
    }

    /**
     * Show hotel selection form for a trip
     */
    public function selectHotel(Trip $trip)
    {
        // Get the destination city
        $destination = Destination::find($trip->destination_id);

        // Find hotels in the same city as the destination
        $hotels = \App\Models\Hotel::where('city', $destination->city)->get();

        return view('admin.trips.select-hotel', compact('trip', 'hotels', 'destination'));
    }

    /**
     * Update trip with selected hotel
     */
    public function saveHotel(Request $request, Trip $trip)
    {
        $validated = $request->validate([
            'hotel_id' => 'nullable|exists:hotels,id',
        ]);

        $trip->update($validated);

        return redirect()->route('admin.trips.show', $trip)
            ->with('success', 'Trip updated with hotel selection.');
    }
}
