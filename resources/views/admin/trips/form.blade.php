@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2>{{ isset($trip) ? 'Edit Trip' : 'Create New Trip' }}</h2>

                    <form action="{{ isset($trip) ? route('admin.trips.update', $trip) : route('admin.trips.store') }}" method="POST">
                        @csrf
                        @if(isset($trip))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Trip Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $trip->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="destination_id" class="form-label">Destination</label>
                            <select class="form-control @error('destination_id') is-invalid @enderror" id="destination_id" name="destination_id">
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
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hotel selection dropdown, will be shown/hidden dynamically -->
                        <div class="mb-3" id="hotel-section" style="display: none;">
                            <label for="hotel_id" class="form-label">Hotel (Optional)</label>
                            <select class="form-control @error('hotel_id') is-invalid @enderror" id="hotel_id" name="hotel_id">
                                <option value="">Select Hotel</option>
                            </select>
                            @error('hotel_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Alert for no hotels -->
                        <div class="alert alert-info mb-3" id="no-hotels-alert" style="display: none;">
                            No hotels are available in this destination's city.
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="4">{{ old('description', $trip->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date"
                                    value="{{ old('start_date', isset($trip) ? $trip->start_date->format('Y-m-d\TH:i') : '') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date"
                                    value="{{ old('end_date', isset($trip) ? $trip->end_date->format('Y-m-d\TH:i') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" value="{{ old('price', $trip->price ?? '') }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                    id="capacity" name="capacity" value="{{ old('capacity', $trip->capacity ?? '') }}">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.trips') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($trip) ? 'Update' : 'Create' }} Trip</button>
                        </div>
                    </form>
                </div>
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
    
    // Track if user has already been asked about adding hotels
    let hotelPromptShown = false;
    
    // Function to check for hotels in the destination city
    function checkAndPromptForHotels(city) {
        if (!city) {
            hotelSection.style.display = 'none';
            return;
        }
        
        // Reset the hotel selection when destination changes
        hotelSelect.innerHTML = '<option value="">Select Hotel</option>';
        hotelSection.style.display = 'none';
        
        // Skip prompt if editing a trip that already has a hotel selected
        const existingHotelId = "{{ isset($trip) && $trip->hotel_id ? $trip->hotel_id : '' }}";
        
        // Check if there are hotels in this city
        fetch(`/api/hotels?city=${encodeURIComponent(city)}`)
            .then(response => response.json())
            .then(hotels => {
                if (hotels.length > 0) {
                    // We have hotels in this city
                    
                    // If editing a trip with an existing hotel, just show the hotels without prompting
                    if (existingHotelId) {
                        populateHotels(hotels, existingHotelId);
                        hotelSection.style.display = 'block';
                        return;
                    }
                    
                    // For new trips or when changing destination, show the prompt
                    if (!hotelPromptShown) {
                        const addHotel = confirm("Hotels are available in this destination city. Would you like to add a hotel to this trip?");
                        hotelPromptShown = true;
                        
                        if (addHotel) {
                            // User wants to add a hotel
                            populateHotels(hotels);
                            hotelSection.style.display = 'block';
                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error checking for hotels:', error);
            });
    }
    
    // Function to populate the hotel dropdown
    function populateHotels(hotels, selectedHotelId = null) {
        // Clear existing options first
        hotelSelect.innerHTML = '<option value="">Select Hotel</option>';
        
        // Add each hotel to the dropdown
        hotels.forEach(hotel => {
            const option = document.createElement('option');
            option.value = hotel.id;
            option.textContent = hotel.name;
            
            // Set as selected if it matches the selectedHotelId or previous form submission
            if (hotel.id == selectedHotelId || hotel.id == "{{ old('hotel_id') }}") {
                option.selected = true;
            }
            
            hotelSelect.appendChild(option);
        });
    }
    
    // When destination changes, check for hotels
    destinationSelect.addEventListener('change', function() {
        // Reset the prompt status when destination changes
        hotelPromptShown = false;
        
        // Get the city from the selected destination
        const selectedOption = this.options[this.selectedIndex];
        if (selectedOption && selectedOption.value) {
            const city = selectedOption.getAttribute('data-city');
            checkAndPromptForHotels(city);
        } else {
            // If no destination selected, hide hotel section
            hotelSection.style.display = 'none';
        }
    });
    
    // On page load, if a destination is already selected, check for hotels
    if (destinationSelect.value) {
        const selectedOption = destinationSelect.options[destinationSelect.selectedIndex];
        const city = selectedOption.getAttribute('data-city');
        checkAndPromptForHotels(city);
    }
});
</script>
@endpush

@endsection
