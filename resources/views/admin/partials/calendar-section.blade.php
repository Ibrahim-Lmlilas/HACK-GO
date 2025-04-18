<div class="bg-white rounded-lg shadow overflow-hidden mb-8" id="calendar-section">
    <div class="p-6">
        <x-calendar
            :month="$month"
            :year="$year"
            :selected-dates="$selectedDates"
        />
    </div>
</div>

<!-- Upcoming Trips -->
<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="p-6 border-b">
        <h2 class="text-xl font-bold text-gray-800">Upcoming Trips</h2>
    </div>
    <div class="divide-y">
        <div class="p-4 hover:bg-gray-50">
            <div class="flex items-center">
                <div class="bg-blue-100 p-3 rounded-lg mr-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-800">Casablanca → Marrakech</h3>
                    <p class="text-sm text-gray-500">Sep 18 - Sep 22</p>
                </div>
                <button class="ml-auto text-gray-400 hover:text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div class="p-4 border-t">
        <button class="w-full py-2 border border-dashed border-gray-300 rounded-lg text-gray-500 hover:text-gray-700 hover:border-gray-400 flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add new trip
        </button>
    </div>
</div>
