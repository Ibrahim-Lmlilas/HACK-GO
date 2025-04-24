<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Get hotels by city
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getByCity(Request $request)
    {
        $city = $request->query('city');

        if (!$city) {
            return response()->json([]);
        }

        $hotels = Hotel::where('city', $city)->get();

        return response()->json($hotels);
    }
}
