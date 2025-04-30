<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $destinations = Destination::select('name', 'city', 'rating', 'image_url')
            ->orderBy('rating', 'desc')
            ->take(20)
            ->get();

        $trips = Trip::with(['destination', 'hotel'])
            ->orderBy('start_date', 'desc')
            ->take(3)
            ->get();

        $data = [
            'destinations' => $destinations,
            'trips' => $trips,
            
        ];

        return view('client.dashboard', $data);
    }
}
