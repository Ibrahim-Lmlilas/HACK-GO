<?php

namespace App\Http\Controllers;

use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class BookingController extends Controller
{
    public function checkout(Trip $trip, Request $request)
    {
        // Check if trip is already fully booked
        $currentBookings = Booking::where('trip_id', $trip->id)
            ->where('status', '!=', 'cancelled')
            ->count();

        if ($currentBookings >= $trip->capacity) {
            return back()->with('error', 'Sorry, this trip is fully booked.');
        }

        // Check if user already has a booking for this trip
        $existingBooking = Booking::where('user_id', auth()->id())
            ->where('trip_id', $trip->id)
            ->where('status', '!=', 'cancelled')
            ->first();

        if ($existingBooking) {
            return back()->with('error', 'You already have a booking for this trip.');
        }

        // Check if user has any overlapping trips
        $hasOverlappingBooking = Booking::where('user_id', auth()->id())
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
            // Create a new booking record
            $booking = Booking::create([
                'user_id' => auth()->id(),
                'trip_id' => $trip->id,
                'amount' => $trip->price,
                'status' => 'pending',
                'number_of_persons' => 1, // You can make this dynamic if needed
            ]);

            // Create Stripe Checkout Session
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'mad',
                        'unit_amount' => $trip->price * 100, // Stripe expects amounts in cents
                        'product_data' => [
                            'name' => $trip->name,
                            'description' => $trip->description,
                            'images' => [$trip->destination->image_url],
                        ],
                    ],
                    'quantity' => 1,
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

        return redirect()->route('client.dashboard')
            ->with('success', 'Your booking has been confirmed!');
    }

    public function cancel(Booking $booking)
    {
        $booking->update([
            'status' => 'cancelled'
        ]);

        return redirect()->route('client.trips.show', $booking->trip)
            ->with('error', 'The booking was cancelled.');
    }
}
