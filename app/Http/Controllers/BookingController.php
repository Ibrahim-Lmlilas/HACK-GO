<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Booking;
use App\Models\Notification;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function checkout(Trip $trip, Request $request)
    {
        // Validate number of persons
        $request->validate([
            'number_of_persons' => 'required|integer|min:1'
        ]);

        $numberOfPersons = $request->number_of_persons;

        // Check if trip is already fully booked
        $currentBookings = Booking::where('trip_id', $trip->id)
            ->where('status', '!=', 'cancelled')
            ->sum('number_of_persons');

        $availableSpots = $trip->capacity - $currentBookings;

        if ($availableSpots < $numberOfPersons) {
            return back()->with('error', "Sorry, only {$availableSpots} spots available for this trip.");
        }

        // Check if user already has a booking for this trip
        $existingBooking = Booking::where('user_id', Auth::id())
            ->where('trip_id', $trip->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You already have a booking for this trip.');
        }

        // Check if user has any overlapping trips
        $hasOverlappingBooking = Booking::where('user_id', Auth::id())
            ->where('status', '!=', 'cancelled')
            ->whereHas('trip', function ($query) use ($trip) {
                $query->where(function ($q) use ($trip) {
                    $q->whereBetween('start_date', [$trip->start_date, $trip->end_date])
                        ->orWhereBetween('end_date', [$trip->start_date, $trip->end_date])
                        ->orWhere(function ($q) use ($trip) {
                            $q->where('start_date', '<=', $trip->start_date)
                                ->where('end_date', '>=', $trip->end_date);
                        });
                });
            })
            ->exists();

        if ($hasOverlappingBooking) {
            return back()->with('error', 'You already have a booking that overlaps with these dates.');
        }

        // Set your Stripe secret key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // Calculate total amount
            $totalAmount = $trip->price * $numberOfPersons;

            $booking = Booking::create([
                'user_id' => Auth::id(),
                'trip_id' => $trip->id,
                'amount' => $totalAmount,
                'status' => 'pending',
                'number_of_persons' => $numberOfPersons,
            ]);

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mad',
                        'unit_amount' => $trip->price * 100,
                        'product_data' => [
                            'name' => $trip->name,
                            'description' => $trip->description,
                            'images' => [$trip->destination->image_url],
                        ],
                    ],
                    'quantity' => $numberOfPersons,
                ]],
                'mode' => 'payment',
                'success_url' => route('booking.success', ['booking' => $booking->id]),
                'cancel_url' => route('booking.cancel', ['booking' => $booking->id]),
                'metadata' => [
                    'booking_id' => $booking->id
                ]
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function success(Booking $booking)
    {
        $booking->update([
            'status' => 'completed'
        ]);

        // Add user to the trip's channel
        $booking->trip->channel->users()->attach(Auth::id());

        // Create notification for the user
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking',
            'trip_id' => $booking->trip_id,
            'message' => "You have successfully booked a trip to {$booking->trip->name}",
            'is_for_admin' => false
        ]);

        // Create notification for admin
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking',
            'trip_id' => $booking->trip_id,
            'message' => "New booking by " . Auth::user()->name . " for trip {$booking->trip->name}",
            'is_for_admin' => true
        ]);

        return redirect()->route('client.dashboard')
            ->with('success', 'Your booking has been confirmed!');
    }

    public function cancel(Booking $booking)
    {
        // Check if user owns this booking
        if ($booking->user_id !== Auth::id()) {
            return back()->with('error', 'You are not authorized to cancel this booking.');
        }

        // Check if booking is already cancelled
        if ($booking->status === 'cancelled') {
            return back()->with('error', 'This booking is already cancelled.');
        }

        // Check if trip starts in more than 2 days
        $daysUntilTrip = now()->startOfDay()->diffInDays($booking->trip->start_date->startOfDay(), false);
        if ($daysUntilTrip <= 2) {
            return back()->with('error', 'Bookings can only be cancelled at least 2 days before the trip starts.');
        }

        // Remove user from the trip's channel
        $booking->trip->channel->users()->detach(Auth::id());

        // Cancel the booking
        $booking->update([
            'status' => 'cancelled'
        ]);

        // Create notification for admin about the cancellation
        Notification::create([
            'user_id' => Auth::id(),
            'type' => 'booking_cancelled',
            'trip_id' => $booking->trip_id,
            'message' => Auth::user()->name . " has cancelled their booking for trip {$booking->trip->name}",
            'is_for_admin' => true
        ]);

        return back()->with('success', 'Your booking has been cancelled successfully.');
    }
}
