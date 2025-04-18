@props(['month' => null, 'year' => null, 'selectedDates' => []])

@php
    $month = $month ?? now()->month;
    $year = $year ?? now()->year;
    $today = now();

    $date = Carbon\Carbon::createFromDate($year, $month, 1);
    $daysInMonth = $date->daysInMonth;
    $firstDayOfWeek = $date->copy()->firstOfMonth()->dayOfWeek;
    $lastDayOfWeek = $date->copy()->lastOfMonth()->dayOfWeek;

    $weeks = [];
    $week = [];

    // Add empty days for the first week
    for ($i = 0; $i < $firstDayOfWeek; $i++) {
        $prevDate = $date->copy()->subMonth()->endOfMonth()->subDays($firstDayOfWeek - $i - 1);
        $week[] = [
            'date' => $prevDate->day,
            'current' => false,
            'selected' => in_array($prevDate->format('Y-m-d'), $selectedDates ?? []),
            'today' => false
        ];
    }

    // Add days of the current month
    for ($day = 1; $day <= $daysInMonth; $day++) {
        $currentDate = $date->copy()->setDay($day);
        if (count($week) === 7) {
            $weeks[] = $week;
            $week = [];
        }

        $week[] = [
            'date' => $day,
            'current' => true,
            'selected' => in_array($currentDate->format('Y-m-d'), $selectedDates ?? []),
            'today' => $currentDate->isSameDay($today)
        ];
    }

    // Add empty days for the last week
    for ($i = $lastDayOfWeek + 1; $i < 7; $i++) {
        $nextDate = $date->copy()->addMonth()->setDay($i - $lastDayOfWeek);
        $week[] = [
            'date' => $nextDate->day,
            'current' => false,
            'selected' => in_array($nextDate->format('Y-m-d'), $selectedDates ?? []),
            'today' => false
        ];
    }

    // Add the last week if it's not empty
    if (!empty($week)) {
        $weeks[] = $week;
    }
@endphp

<div class="calendar" id="calendar-{{ $date->format('Y-m') }}">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-800">{{ $date->format('F Y') }}</h2>
        <div class="flex space-x-1">
            <button
                class="p-1 rounded hover:bg-gray-100"
                onclick="updateCalendar('{{ $date->copy()->subMonth()->format('m') }}', '{{ $date->copy()->subMonth()->format('Y') }}')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button
                class="p-1 rounded hover:bg-gray-100"
                onclick="updateCalendar('{{ $date->copy()->addMonth()->format('m') }}', '{{ $date->copy()->addMonth()->format('Y') }}')"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </div>

    <div class="grid grid-cols-7 gap-2 text-center text-xs text-gray-500 mb-2">
        <div>Su</div>
        <div>Mo</div>
        <div>Tu</div>
        <div>We</div>
        <div>Th</div>
        <div>Fr</div>
        <div>Sa</div>
    </div>

    <div class="grid grid-cols-7 gap-2 text-center">
        @foreach($weeks as $week)
            @foreach($week as $day)
                <div
                    class="py-2 {{ !$day['current'] ? 'text-gray-400' : '' }}
                           {{ $day['selected'] ? 'bg-[#8a2be2] text-white rounded-full' : '' }}
                           {{ $day['today'] ? 'bg-blue-100 text-blue-600 rounded-full' : '' }}"
                    data-date="{{ $date->copy()->setDay($day['date'])->format('Y-m-d') }}"
                >
                    {{ $day['date'] }}
                </div>
            @endforeach
        @endforeach
    </div>
</div>

<script>
function updateCalendar(month, year) {
    // Show loading state
    const calendarSection = document.getElementById('calendar-section');
    calendarSection.innerHTML = '<div class="flex justify-center items-center h-64"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#8a2be2]"></div></div>';

    // Make AJAX request
    fetch(`/admin/calendar?month=${month}&year=${year}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.text())
    .then(html => {
        calendarSection.outerHTML = html;
    })
    .catch(error => {
        console.error('Error:', error);
        // Reload page as fallback
        window.location.href = `?month=${month}&year=${year}`;
    });
}
</script>
