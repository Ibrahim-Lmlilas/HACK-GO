@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="flex flex-col lg:flex-row gap-6">
    <div class="flex-1 space-y-6">
        <div class="bg-white rounded-2xl p-6">
            <div class="flex justify-between items-start mb-6">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">{{ $trip->name }}</h2>
                    <h5 class="text-gray-600 mt-1">{{ $trip->destination->name }}</h5>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.trips.edit', $trip) }}" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                        Edit Trip
                    </a>
                    <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 transition" onclick="return confirm('Are you sure?')">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <div class="relative h-64 mb-6 rounded-lg overflow-hidden">
                <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
            </div>

            <div class="space-y-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700">{{ $trip->description }}</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h6 class="text-sm font-medium text-gray-600 mb-2">Start Date</h6>
                        <p class="text-gray-800">{{ $trip->start_date->format('M d, Y') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h6 class="text-sm font-medium text-gray-600 mb-2">End Date</h6>
                        <p class="text-gray-800">{{ $trip->end_date->format('M d, Y') }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h6 class="text-sm font-medium text-gray-600 mb-2">Price</h6>
                        <p class="text-gray-800">${{ number_format($trip->price, 2) }}</p>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h6 class="text-sm font-medium text-gray-600 mb-2">Capacity</h6>
                        <p class="text-gray-800">{{ $trip->capacity }} persons</p>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('admin.trips') }}" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                    Back to Trips
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
