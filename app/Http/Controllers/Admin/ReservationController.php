<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    /**
     * Display a listing of all reservations/bookings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservations = Booking::with(['user', 'trip.destination'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.reservations.index', [
            'reservations' => $reservations
        ]);
    }

    /**
     * Display the specified reservation.
     *
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        return view('admin.reservations.show', [
            'reservation' => $booking->load(['user', 'trip.destination'])
        ]);
    }

    /**
     * Update the status of a reservation.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,completed,cancelled'
        ]);

        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.reservations.show', $booking)
            ->with('success', 'Reservation status updated successfully.');
    }
}
