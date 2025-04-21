<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get destinations from database
        $destinations = Destination::select('name', 'city', 'rating', 'image_url')
            ->orderBy('rating', 'desc')
            ->take(20)
            ->get();

        // You can add more data here as needed
        $data = [
            'destinations' => $destinations,
            'upcomingTrips' => 5, // Example data
            'totalBookings' => 12, // Example data
            'averageRating' => 4.8, // Example data
            'recentActivity' => [
                [
                    'type' => 'booking',
                    'message' => 'Booking confirmed for Paris Adventure',
                    'time' => '2 hours ago'
                ],
                [
                    'type' => 'rating',
                    'message' => 'You rated your last trip 5 stars',
                    'time' => '1 day ago'
                ]
            ]
        ];

        return view('client.dashboard', $data);
    }
}
