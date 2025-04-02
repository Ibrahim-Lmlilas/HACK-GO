<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Trip;
use App\Models\Booking;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller{
    public function index()
    {
        $user = Auth::user();

        // Get statistics
        $totalUsers = User::count();
        // $totalTrips = Trip::count();
        $totalBookings = Booking::count();

        // Get recent activities
        $recentActivities = Activity::latest()
            ->take(5)
            ->get();

        return view('admin.home', compact(
            'user',

        ));
    }
}
