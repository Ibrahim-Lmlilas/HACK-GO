@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<style>
.modal-backdrop {
    animation: fadeIn 0.3s ease;
}
.modal-content {
    animation: slideIn 0.3s ease;
}
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}
@keyframes slideIn {
    from { transform: translateY(-20px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}
</style>

<div class="modal-backdrop fixed inset-0 bg-black bg-opacity-95 z-40"></div>



<div class="fixed inset-0 z-50 overflow-y-auto">
    <div class="flex min-h-screen items-center justify-center p-4">
        <div class="modal-content w-full max-w-lg bg-white rounded-2xl shadow-xl">
            <div class="p-4 border-b border-gray-100">
                <div class="flex justify-between items-center">
                    <h2 class="text-xl font-bold text-gray-800">
                        {{ isset($trip) ? 'Edit Trip' : 'Create New Trip' }}
                    </h2>
                    <a href="{{ route('admin.trips') }}" class="text-gray-400 hover:text-gray-500 transition">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="p-4">
                <form action="{{ isset($trip) ? route('admin.trips.update', $trip) : route('admin.trips.store') }}"
                      method="POST" class="space-y-4">
                    @csrf
                    @if(isset($trip))
                        @method('PUT')
                    @endif

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Trip Name</label>
                        <input type="text" name="name" value="{{ old('name', $trip->name ?? '') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                            @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Destination</label>
                        <select name="destination_id" id="destination_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                            @error('destination_id') border-red-500 @enderror">
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
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="hotel-section" class="hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Hotel (Optional)</label>
                        <select name="hotel_id" id="hotel_id"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                            @error('hotel_id') border-red-500 @enderror">
                            <option value="">Select Hotel</option>
                        </select>
                        @error('hotel_id')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                            @error('description') border-red-500 @enderror">{{ old('description', $trip->description ?? '') }}</textarea>
                        @error('description')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                            <input type="datetime-local" name="start_date"
                                value="{{ old('start_date', isset($trip) ? $trip->start_date->format('Y-m-d\TH:i') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                                @error('start_date') border-red-500 @enderror">
                            @error('start_date')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                            <input type="datetime-local" name="end_date"
                                value="{{ old('end_date', isset($trip) ? $trip->end_date->format('Y-m-d\TH:i') : '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                                @error('end_date') border-red-500 @enderror">
                            @error('end_date')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Price (MAD)</label>
                            <input type="number" step="0.01" name="price"
                                value="{{ old('price', $trip->price ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                                @error('price') border-red-500 @enderror">
                            @error('price')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Capacity</label>
                            <input type="number" name="capacity"
                                value="{{ old('capacity', $trip->capacity ?? '') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent
                                @error('capacity') border-red-500 @enderror">
                            @error('capacity')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end space-x-2 pt-4">
                        <a href="{{ route('admin.trips') }}"
                            class="px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">
                            Cancel
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition">
                            {{ isset($trip) ? 'Update' : 'Create' }} Trip
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const destinationSelect = document.getElementById('destination_id');
    const hotelSection = document.getElementById('hotel-section');
    const hotelSelect = document.getElementById('hotel_id');

    destinationSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.value) {
            const city = selectedOption.getAttribute('data-city');
            checkForHotels(city);
        } else {
            hotelSection.classList.add('hidden');
        }
    });

    function checkForHotels(city) {
        fetch(`/api/hotels?city=${encodeURIComponent(city)}`)
            .then(response => response.json())
            .then(hotels => {
                if (hotels.length > 0) {
                    populateHotels(hotels);
                    hotelSection.classList.remove('hidden');
                } else {
                    hotelSection.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error checking for hotels:', error);
                hotelSection.classList.add('hidden');
            });
    }

    function populateHotels(hotels) {
        hotelSelect.innerHTML = '<option value="">Select Hotel</option>';
        hotels.forEach(hotel => {
            const option = document.createElement('option');
            option.value = hotel.id;
            option.textContent = hotel.name;
            if (hotel.id == "{{ old('hotel_id', $trip->hotel_id ?? '') }}") {
                option.selected = true;
            }
            hotelSelect.appendChild(option);
        });
    }

    if (destinationSelect.value) {
        const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
        const city = selectedOption.getAttribute('data-city');
        checkForHotels(city);
    }
});
</script>
@endpush

@endsection
