@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="flex flex-col lg:flex-row gap-6">
    <div class="flex-1 space-y-6">
        <div class="bg-white rounded-2xl p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ isset($trip) ? 'Edit Trip' : 'Create New Trip' }}</h2>

            <form action="{{ isset($trip) ? route('admin.trips.update', $trip) : route('admin.trips.store') }}" method="POST">
                @csrf
                @if(isset($trip))
                    @method('PUT')
                @endif

                <div class="space-y-6">
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Trip Name</label>
                        <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('name') border-red-500 @enderror"
                            id="name" name="name" value="{{ old('name', $trip->name ?? '') }}">
                        @error('name')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="destination_id" class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('destination_id') border-red-500 @enderror"
                            id="destination_id" name="destination_id">
                            <option value="">Select Destination</option>
                            @foreach($destinations as $destination)
                                <option value="{{ $destination->id }}"
                                    {{ old('destination_id', $trip->destination_id ?? '') == $destination->id ? 'selected' : '' }}
                                    data-city="{{ $destination->city }}">
                                    {{ $destination->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('destination_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="hotel-section" class="hidden">
                        <label for="hotel_id" class="block text-sm font-medium text-gray-700 mb-1">Hotel (Optional)</label>
                        <select class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('hotel_id') border-red-500 @enderror"
                            id="hotel_id" name="hotel_id">
                            <option value="">Select Hotel</option>
                        </select>
                        @error('hotel_id')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="no-hotels-alert" class="hidden bg-blue-50 text-blue-700 p-4 rounded-lg">
                        No hotels are available in this destination's city.
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('description') border-red-500 @enderror"
                            id="description" name="description" rows="4">{{ old('description', $trip->description ?? '') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="datetime-local" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('start_date') border-red-500 @enderror"
                                id="start_date" name="start_date"
                                value="{{ old('start_date', isset($trip) ? $trip->start_date->format('Y-m-d\TH:i') : '') }}">
                            @error('start_date')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="datetime-local" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('end_date') border-red-500 @enderror"
                                id="end_date" name="end_date"
                                value="{{ old('end_date', isset($trip) ? $trip->end_date->format('Y-m-d\TH:i') : '') }}">
                            @error('end_date')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                            <input type="number" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('price') border-red-500 @enderror"
                                id="price" name="price" value="{{ old('price', $trip->price ?? '') }}">
                            @error('price')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                            <input type="number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('capacity') border-red-500 @enderror"
                                id="capacity" name="capacity" value="{{ old('capacity', $trip->capacity ?? '') }}">
                            @error('capacity')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-between items-center pt-4">
                        <a href="{{ route('admin.trips') }}" class="bg-gray-100 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-200 transition">
                            Cancel
                        </a>
                        <button type="submit" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                            {{ isset($trip) ? 'Update' : 'Create' }} Trip
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const destinationSelect = document.getElementById('destination_id');
    const hotelSection = document.getElementById('hotel-section');
    const hotelSelect = document.getElementById('hotel_id');
    const noHotelsAlert = document.getElementById('no-hotels-alert');

    let hotelPromptShown = false;

    function checkAndPromptForHotels(city) {
        if (!city) {
            hotelSection.style.display = 'none';
            noHotelsAlert.style.display = 'none';
            return;
        }

        hotelSelect.innerHTML = '<option value="">Select Hotel</option>';
        hotelSection.style.display = 'none';
        noHotelsAlert.style.display = 'none';

        const existingHotelId = "{{ isset($trip) && $trip->hotel_id ? $trip->hotel_id : '' }}";

        fetch(`/api/hotels?city=${encodeURIComponent(city)}`)
            .then(response => response.json())
            .then(hotels => {
                if (hotels.length > 0) {
                    if (existingHotelId) {
                        populateHotels(hotels, existingHotelId);
                        hotelSection.style.display = 'block';
                        return;
                    }

                    if (!hotelPromptShown) {
                        const addHotel = confirm("Hotels are available in this destination city. Would you like to add a hotel to this trip?");
                        hotelPromptShown = true;

                        if (addHotel) {
                            populateHotels(hotels);
                            hotelSection.style.display = 'block';
                        }
                    }
                } else {
                    noHotelsAlert.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error checking for hotels:', error);
            });
    }

    function populateHotels(hotels, selectedHotelId = null) {
        hotelSelect.innerHTML = '<option value="">Select Hotel</option>';

        hotels.forEach(hotel => {
            const option = document.createElement('option');
            option.value = hotel.id;
            option.textContent = hotel.name;

            if (hotel.id == selectedHotelId || hotel.id == "{{ old('hotel_id') }}") {
                option.selected = true;
            }

            hotelSelect.appendChild(option);
        });
    }

    destinationSelect.addEventListener('change', function() {
        hotelPromptShown = false;

        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.value) {
            const city = selectedOption.getAttribute('data-city');
            checkAndPromptForHotels(city);
        } else {
            hotelSection.style.display = 'none';
            noHotelsAlert.style.display = 'none';
        }
    });

    if (destinationSelect.value) {
        const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
        const city = selectedOption.getAttribute('data-city');
        checkAndPromptForHotels(city);
    }
});
</script>
@endpush

@endsection
