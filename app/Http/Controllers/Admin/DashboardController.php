<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use App\Models\User;
use App\Models\Booking;
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
                'value' => 24,
                'change' => 15,
                'icon' => 'M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3h1.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21',
                'color' => 'blue'
            ],
            'activeUsers' => [
                'value' => 156,
                'change' => 8,
                'icon' => 'M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z',
                'color' => 'purple'
            ],
            'totalBookings' => [
                'value' => 89,
                'change' => 12,
                'icon' => 'M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5',
                'color' => 'green'
            ],
            'averagePrice' => [
                'value' => '$1,245',
                'change' => 5,
                'icon' => 'M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                'color' => 'yellow'
            ]
        ];

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

        return view('admin.dashboard', compact('stats', 'popularDestinations', 'averagePrice', 'successRate'));
    }

    private function calculateChange($model)
    {
        $currentMonth = $model::whereMonth('created_at', now()->month)->count();
        $lastMonth = $model::whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth == 0) return 0;
        return round((($currentMonth - $lastMonth) / $lastMonth) * 100, 1);
    }
}
