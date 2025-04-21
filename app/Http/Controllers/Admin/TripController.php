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
        return view('trips.index', compact('trips'));
    }

    public function create()
    {
        $destinations = Destination::all();
        return view('trips.form', compact('destinations'));
    }

    public function show(Trip $trip)
    {
        return view('trips.show', compact('trip'));
    }

    public function edit(Trip $trip)
    {
        $destinations = Destination::all();
        return view('trips.form', compact('trip', 'destinations'));
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
        return redirect()->route('admin.trips.show', $trip)
            ->with('success', 'Trip created successfully');
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
}
