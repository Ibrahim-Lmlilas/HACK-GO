<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Trip extends Model
{
    protected $fillable = [
        'title',
        'destination',
        'country',
        'start_date',
        'end_date',
        'status',
        'price'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'price' => 'decimal:2'
    ];

    public static function getPopularDestinations($limit = 5)
    {
        return self::select('destination', 'country', DB::raw('count(*) as total'))
            ->groupBy('destination', 'country')
            ->orderByDesc('total')
            ->limit($limit)
            ->get();
    }

    public static function getAveragePrice()
    {
        return self::avg('price');
    }

    public static function getAveragePriceChange()
    {
        $currentMonth = now()->startOfMonth();
        $lastMonth = now()->subMonth()->startOfMonth();

        $currentAvg = self::whereMonth('created_at', $currentMonth->month)
            ->whereYear('created_at', $currentMonth->year)
            ->avg('price') ?? 0;

        $lastAvg = self::whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->avg('price') ?? 0;

        if ($lastAvg == 0) {
            return 0;
        }

        return round((($currentAvg - $lastAvg) / $lastAvg) * 100, 1);
    }

    public static function getSuccessRate()
    {
        $total = self::count();
        if ($total === 0) return 0;

        $completed = self::where('status', 'completed')->count();
        return round(($completed / $total) * 100, 1);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public static function getTotalTrips()
    {
        return self::count();
    }

    public static function getTotalTripsChange()
    {
        $currentMonth = self::whereMonth('created_at', now()->month)->count();
        $lastMonth = self::whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth == 0) return 0;
        return round(($currentMonth - $lastMonth) / $lastMonth * 100, 1);
    }

    public static function getTotalRevenue()
    {
        return self::where('status', 'completed')->sum('price');
    }

    public static function getRevenueChange()
    {
        $currentMonth = self::whereMonth('created_at', now()->month)
            ->where('status', 'completed')
            ->sum('price');

        $lastMonth = self::whereMonth('created_at', now()->subMonth()->month)
            ->where('status', 'completed')
            ->sum('price');

        if ($lastMonth == 0) return 0;
        return round(($currentMonth - $lastMonth) / $lastMonth * 100, 1);
    }

    public static function getActiveUsers()
    {
        return DB::table('users')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
    }

    public static function getActiveUsersChange()
    {
        $currentMonth = DB::table('users')
            ->where('created_at', '>=', now()->subDays(30))
            ->count();

        $lastMonth = DB::table('users')
            ->where('created_at', '>=', now()->subDays(60))
            ->where('created_at', '<', now()->subDays(30))
            ->count();

        if ($lastMonth == 0) return 0;
        return round(($currentMonth - $lastMonth) / $lastMonth * 100, 1);
    }

    public static function getTotalBookings()
    {
        return Booking::count();
    }

    public static function getBookingsChange()
    {
        $currentMonth = Booking::whereMonth('created_at', now()->month)->count();
        $lastMonth = Booking::whereMonth('created_at', now()->subMonth()->month)->count();

        if ($lastMonth == 0) return 0;
        return round(($currentMonth - $lastMonth) / $lastMonth * 100, 1);
    }
}
