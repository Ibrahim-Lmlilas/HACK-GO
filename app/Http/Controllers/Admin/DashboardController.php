<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Destination;
use App\Models\Hotel;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $stats = [
            'totalTrips' => [
                'value' => Trip::count(),
                'change' => $this->calculateChange(Trip::class),
                'icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
                'color' => 'blue'
            ],

            'totalUsers' => [
                'value' => User::count(),
                'change' => $this->calculateChange(User::class),
                'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5',
                'color' => 'green'
            ],
            'totalDestinations' => [
                'value' => Destination::count(),
                'change' => $this->calculateChange(Destination::class),
                'icon' => 'M9 6.75V15m6-6v8.25m.503 3.498 4.875-2.437c.381-.19.622-.58.622-1.006V4.82c0-.836-.88-1.38-1.628-1.006l-3.869 1.934c-.317.159-.69.159-1.006 0L9.503 3.252a1.125 1.125 0 0 0-1.006 0L3.622 5.689C3.24 5.88 3 6.27 3 6.695V19.18c0 .836.88 1.38 1.628 1.006l3.869-1.934c.317-.159.69-.159 1.006 0l4.994 2.497c.317.158.69.158 1.006 0Z',
                'color' => 'yellow'
            ],
            'totalHotels' => [
                'value' => Hotel::count(),
                'change' => $this->calculateChange(Hotel::class),
                'icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
                'color' => 'indigo'
            ]
        ];

        $destinations = Destination::select('name', 'city', 'rating', 'image_url')
            ->orderBy('rating', 'desc')
            ->take(23)
            ->get();

            $hotels = Hotel::select('id', 'name', 'city', 'rating', 'price_mad', 'image_url', 'address', 'description', 'latitude', 'longitude')
            ->orderBy('rating', 'desc')
            ->take(3)
            ->get();

        $popularDestinations = [
            (object)[
                'destination' => 'Marrakech',
                'country' => 'Morocco',
                'total' => 15
            ],
            (object)[
                'destination' => 'Fes',
                'country' => 'Morocco',
                'total' => 12
            ],
            (object)[
                'destination' => 'Chefchaouen',
                'country' => 'Morocco',
                'total' => 8
            ]
        ];

        $averagePrice = 1245;
        $successRate = 85;

        return view('admin.dashboard', compact('stats', 'destinations', 'popularDestinations', 'averagePrice', 'successRate', 'hotels'));
    }

    private function calculateChange($model)
    {
        $currentMonth = $model::whereMonth('created_at', now()->month)->count();
        $lastMonth = $model::whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth == 0) return 0;
        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
    }
}
