@props([
    'title',
    'value',
    'change',
    'icon',
    'color'
])

<div class="bg-white rounded-lg shadow p-6">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-gray-500 text-sm">{{ $title }}</p>
            <h3 class="text-3xl font-bold text-gray-800 mt-1">{{ $value }}</h3>
        </div>
        <div class="p-3 bg-{{ $color }}-100 rounded-full">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-{{ $color }}-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
            </svg>
        </div>
    </div>
    <div class="flex items-center mt-4">
        @if($change > 0)
            <span class="text-green-500 flex items-center text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
                </svg>
                {{ $change }}%
            </span>
        @else
            <span class="text-red-500 flex items-center text-sm font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
                </svg>
                {{ abs($change) }}%
            </span>
        @endif
        <span class="text-gray-500 text-sm ml-2">from last month</span>
    </div>
</div>
