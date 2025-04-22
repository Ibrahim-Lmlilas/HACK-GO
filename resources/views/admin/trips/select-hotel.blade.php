@extends('layout.admin.admin')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2>Select Hotel for "{{ $trip->name }}"</h2>
                    
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="mb-4">
                        <h5>Trip Details:</h5>
                        <p><strong>Destination:</strong> {{ $destination->name }}</p>
                        <p><strong>City:</strong> {{ $destination->city }}</p>
                        <p><strong>Dates:</strong> {{ $trip->start_date->format('M d, Y') }} to {{ $trip->end_date->format('M d, Y') }}</p>
                    </div>

                    @if(count($hotels) > 0)
                        <form action="{{ route('admin.trips.save-hotel', $trip) }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="hotel_id" class="form-label">Available Hotels in {{ $destination->city }}</label>
                                <select class="form-control @error('hotel_id') is-invalid @enderror" id="hotel_id" name="hotel_id">
                                    <option value="">-- Select a Hotel (Optional) --</option>
                                    @foreach($hotels as $hotel)
                                    <option value="{{ $hotel->id }}">{{ $hotel->name }} - {{ $hotel->price_mad }} MAD/night - {{ $hotel->rating }} ★</option>
                                    @endforeach
                                </select>
                                @error('hotel_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-12" id="hotel-details" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 id="hotel-name"></h5>
                                            <p id="hotel-address"></p>
                                            <p id="hotel-description"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.trips.show', $trip) }}" class="btn btn-secondary">Skip Hotel Selection</a>
                                <button type="submit" class="btn btn-primary">Save Hotel Selection</button>
                            </div>
                        </form>
                    @else
                        <div class="alert alert-info">
                            No hotels are available in {{ $destination->city }}. 
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.trips.show', $trip) }}" class="btn btn-primary">Continue to Trip Details</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const hotelSelect = document.getElementById('hotel_id');
    const hotelDetails = document.getElementById('hotel-details');
    const hotelName = document.getElementById('hotel-name');
    const hotelAddress = document.getElementById('hotel-address');
    const hotelDescription = document.getElementById('hotel-description');
    
    // Hotel data (from the server)
    const hotels = @json($hotels);
    
    hotelSelect.addEventListener('change', function() {
        const selectedId = this.value;
        
        if (selectedId) {
            // Find the selected hotel from our data
            const hotel = hotels.find(h => h.id == selectedId);
            
            if (hotel) {
                hotelName.textContent = hotel.name + ' - ' + hotel.rating + ' ★';
                hotelAddress.textContent = hotel.address;
                hotelDescription.textContent = hotel.description;
                hotelDetails.style.display = 'block';
            }
        } else {
            hotelDetails.style.display = 'none';
        }
    });
});
</script>
@endpush
@endsection