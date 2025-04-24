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
