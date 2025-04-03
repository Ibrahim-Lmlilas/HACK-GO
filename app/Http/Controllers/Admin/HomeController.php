<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Trip;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get statistics
        $totalUsers = User::count();
        // $totalTrips = Trip::count();
        $totalBookings = Booking::count();
        $totalRevenue = Booking::sum('total_price');

        // Get recent activities (adjust this based on your activity tracking system)
        $recentActivities = DB::table('activities')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('admin.home', compact(
            'user',
            'totalUsers',
            // 'totalTrips',
            'totalBookings',
            'totalRevenue',
            'recentActivities'
        ));
    }
}
