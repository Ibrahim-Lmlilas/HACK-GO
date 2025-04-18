<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getCalendar(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        if ($request->ajax()) {
            return view('admin.partials.calendar-section', [
                'month' => $month,
                'year' => $year,
                'selectedDates' => [] // Add your selected dates logic here
            ]);
        }

        return redirect()->route('admin.dashboard', [
            'month' => $month,
            'year' => $year
        ]);
    }
}
