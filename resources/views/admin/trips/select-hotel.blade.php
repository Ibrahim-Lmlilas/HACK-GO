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
                    <h2 class="text-lg sm:text-xl font-bold text-gray-800">Select Hotel for "{{ $trip->name }}"</h2>
                    <a href="{{ route('admin.trips.show', $trip) }}" class="text-gray-400 hover:text-gray-500 transition">
                        <i class="fas fa-times"></i>
                    </a>
                </div>
            </div>

            <div class="p-4 sm:p-6">
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6 bg-gray-50 p-3 rounded-lg">
                    <h5 class="font-medium text-gray-700 mb-2 text-sm">Trip Details</h5>
                    <div class="space-y-1 text-sm">
                        <p class="text-gray-600"><span class="font-medium">Destination:</span> {{ $destination->name }}</p>
                        <p class="text-gray-600"><span class="font-medium">City:</span> {{ $destination->city }}</p>
                        <p class="text-gray-600"><span class="font-medium">Dates:</span> {{ $trip->start_date->format('M d, Y') }} to {{ $trip->end_date->format('M d, Y') }}</p>
                    </div>
                </div>

                @if(count($hotels) > 0)
                    <form action="{{ route('admin.trips.save-hotel', $trip) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Available Hotels in {{ $destination->city }}</label>
                            <select class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent @error('hotel_id') border-red-500 @enderror"
                                    id="hotel_id"
                                    name="hotel_id">
                                <option value="">-- Select a Hotel (Optional) --</option>
                                @foreach($hotels as $hotel)
                                <option value="{{ $hotel->id }}">
                                    {{ $hotel->name }} / {{ $hotel->price_mad }} MAD /
                                </option>
                                @endforeach
                            </select>
                            @error('hotel_id')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div id="hotel-details" class="hidden">
                            <div class="bg-gray-50 rounded-lg p-4 space-y-3">
                                <h5 id="hotel-name" class="font-medium text-gray-900"></h5>
                                <p id="hotel-address" class="text-sm text-gray-600"></p>
                                <p id="hotel-description" class="text-sm text-gray-600"></p>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-in Date</label>
                                        <input type="date" name="check_in_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" value="{{ $trip->start_date->format('Y-m-d') }}">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Check-out Date</label>
                                        <input type="date" name="check_out_date" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" value="{{ $trip->end_date->format('Y-m-d') }}">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Number of Rooms</label>
                                        <input type="number" name="number_of_rooms" min="1" value="1" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Room Type</label>
                                        <select name="room_type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent">
                                            <option value="standard">Standard Room</option>
                                            <option value="deluxe">Deluxe Room</option>
                                            <option value="suite">Suite</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Special Requests</label>
                                    <textarea name="special_requests" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" placeholder="Any special requests or preferences?"></textarea>
                                </div>

                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Additional Notes</label>
                                    <textarea name="additional_notes" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent" placeholder="Any additional notes for the hotel booking?"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row justify-end space-y-2 sm:space-y-0 sm:space-x-2 pt-4">
                            <a href="{{ route('admin.trips.show', $trip) }}"
                               class="w-full sm:w-auto px-4 py-2 border border-gray-300 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition text-center">
                                Skip Hotel Selection
                            </a>
                            <button type="submit"
                                    class="w-full sm:w-auto px-4 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition">
                                Save Hotel Selection
                            </button>
                        </div>
                    </form>
                @else
                    <div class="bg-blue-50 text-blue-700 p-3 rounded-lg text-sm">
                        No hotels are available in {{ $destination->city }}.
                    </div>
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('admin.trips.show', $trip) }}"
                           class="w-full sm:w-auto px-4 py-2 bg-black text-white text-sm rounded-lg hover:bg-gray-800 transition text-center">
                            Continue to Trip Details
                        </a>
                    </div>
                @endif
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

    const hotels = @json($hotels);

    hotelSelect.addEventListener('change', function() {
        const selectedId = this.value;

        if (selectedId) {
            const hotel = hotels.find(h => h.id == selectedId);

            if (hotel) {
                hotelName.textContent = `${hotel.name} - ${hotel.rating} ★`;
                hotelAddress.textContent = hotel.address;
                hotelDescription.textContent = hotel.description;
                hotelDetails.classList.remove('hidden');
            }
        } else {
            hotelDetails.classList.add('hidden');
        }
    });
});
</script>
@endpush
@endsection
