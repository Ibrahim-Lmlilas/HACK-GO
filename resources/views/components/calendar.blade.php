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

<div class="calendar bg-[#F8F8F8] rounded-2xl p-6" id="calendar-{{ $date->format('Y-m') }}">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">{{ $date->format('F Y') }}</h2>
        <div class="flex items-center space-x-2">
            <button type="button"
                class="text-gray-600 hover:text-[#9DC45F] transition-colors"
                data-month="{{ $date->copy()->subMonth()->format('m') }}"
                data-year="{{ $date->copy()->subMonth()->format('Y') }}"
            >
                <i class="fas fa-chevron-left"></i>
            </button>
            <button type="button"
                class="text-gray-600 hover:text-[#9DC45F] transition-colors"
                data-month="{{ $date->copy()->addMonth()->format('m') }}"
                data-year="{{ $date->copy()->addMonth()->format('Y') }}"
            >
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>
    </div>

    <div class="bg-white rounded-xl p-4 shadow-sm">
        <div class="grid grid-cols-7 gap-1 mb-4">
            <div class="text-center text-xs font-medium text-gray-400">Su</div>
            <div class="text-center text-xs font-medium text-gray-400">Mo</div>
            <div class="text-center text-xs font-medium text-gray-400">Tu</div>
            <div class="text-center text-xs font-medium text-gray-400">We</div>
            <div class="text-center text-xs font-medium text-gray-400">Th</div>
            <div class="text-center text-xs font-medium text-gray-400">Fr</div>
            <div class="text-center text-xs font-medium text-gray-400">Sa</div>
        </div>

        <div class="grid grid-cols-7 gap-1">
            @foreach($weeks as $week)
                @foreach($week as $day)
                    <div class="relative">
                        <button
                            class="w-8 h-8 flex items-center justify-center text-sm rounded-lg transition-colors
                            {{ !$day['current'] ? 'text-gray-400' : 'text-gray-700' }}
                            {{ $day['selected'] ? 'bg-[#9DC45F] text-white' : '' }}
                            {{ $day['today'] ? 'bg-[#9DC45F] text-white' : '' }}
                            {{ !$day['selected'] && !$day['today'] ? 'hover:bg-[#9DC45F] hover:text-white' : '' }}"
                            data-date="{{ $date->copy()->setDay($day['date'])->format('Y-m-d') }}"
                        >
                            {{ $day['date'] }}
                        </button>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>


</div>

<script>
function attachCalendarListeners() {
    const calendar = document.getElementById('calendar-{{ $date->format('Y-m') }}');
    if (!calendar) return;

    // Add click handlers for navigation buttons
    calendar.querySelectorAll('button[data-month]').forEach(button => {
        // Remove existing listeners to prevent duplicates
        button.removeEventListener('click', handleCalendarNavigation);
        // Add new listener
        button.addEventListener('click', handleCalendarNavigation);
    });
}

function handleCalendarNavigation() {
    const month = this.dataset.month;
    const year = this.dataset.year;
    updateCalendar(month, year);
}

function updateCalendar(month, year) {
    const calendar = document.getElementById('calendar-{{ $date->format('Y-m') }}');
    calendar.innerHTML = '<div class="flex justify-center items-center h-64"><div class="animate-spin rounded-full h-8 w-8 border-b-2 border-[#FFB800]"></div></div>';

    fetch(`/calendar/update?month=${month}&year=${year}`, {
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(html => {
        calendar.outerHTML = html;
        // Reattach event listeners after updating the calendar
        setTimeout(attachCalendarListeners, 0);
    })
    .catch(error => {
        console.error('Error:', error);
        window.location.href = `?month=${month}&year=${year}`;
    });
}

// Initial attachment of event listeners
document.addEventListener('DOMContentLoaded', attachCalendarListeners);

// Also attach listeners when the DOM changes
const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.addedNodes.length) {
            attachCalendarListeners();
        }
    });
});

observer.observe(document.body, {
    childList: true,
    subtree: true
});
</script>

