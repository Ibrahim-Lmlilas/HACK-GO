@extends('layout.admin.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-indigo-800">Add New Hotel</h1>
        <a href="{{ route('admin.hotels.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg flex items-center transition duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Hotels
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-indigo-500">
        <form action="{{ route('admin.hotels.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Hotel Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-indigo-700 mb-1">Hotel Name</label>
                    <input type="text" name="name" id="name"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required placeholder="Enter hotel name" value="{{ old('name') }}">
                </div>

                <!-- Location Field -->
                <div>
                    <label for="location" class="block text-sm font-medium text-indigo-700 mb-1">Location</label>
                    <input type="text" name="location" id="location"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required placeholder="City, Country" value="{{ old('location') }}">
                </div>

                <!-- Price Per Night Field -->
                <div>
                    <label for="price_per_night" class="block text-sm font-medium text-indigo-700 mb-1">Price Per Night ($)</label>
                    <input type="number" name="price_per_night" id="price_per_night" step="0.01" min="0"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required placeholder="0.00" value="{{ old('price_per_night') }}">
                </div>



                <!-- Destination Field -->
                <div>
                    <label for="destination_id" class="block text-sm font-medium text-indigo-700 mb-1">Destination (Optional)</label>
                    <select name="destination_id" id="destination_id"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50">
                        <option value="">Select a destination</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ old('destination_id') == $destination->id ? 'selected' : '' }}>
                                {{ $destination->location }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Amenities Field -->
                <div>
                    <label class="block text-sm font-medium text-indigo-700 mb-1">Amenities</label>
                    <div class="grid grid-cols-2 gap-2">
                        @php
                            $amenities = [
                                'Free WiFi', 'Swimming Pool', 'Spa', 'Fitness Center',
                                'Restaurant', 'Room Service', 'Bar', 'Parking',
                                'Airport Shuttle', 'Business Center', 'Laundry', 'Air Conditioning'
                            ];
                        @endphp

                        @foreach($amenities as $amenity)
                            <div class="flex items-center">
                                <input type="checkbox" name="amenities[]" id="amenity-{{ Str::slug($amenity) }}"
                                    value="{{ $amenity }}" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded"
                                    {{ in_array($amenity, old('amenities', [])) ? 'checked' : '' }}>
                                <label for="amenity-{{ Str::slug($amenity) }}" class="ml-2 text-sm text-gray-700">
                                    {{ $amenity }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            

            <!-- Image Upload Field -->
            <div class="mt-6">
                <label for="image" class="block text-sm font-medium text-indigo-700 mb-1">Hotel Image</label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-indigo-300 border-dashed rounded-md hover:border-indigo-500 transition-colors bg-indigo-50">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-indigo-600 justify-center">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 px-2 py-1 shadow-sm">
                                <span>Upload a file</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1 self-center">or drag and drop</p>
                        </div>
                        <p class="text-xs text-indigo-500">PNG, JPG, GIF up to 2MB</p>
                        <p id="selected-file" class="text-sm text-indigo-600 mt-2 hidden"></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.hotels.index') }}" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                    Cancel
                </a>
                <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                    Create Hotel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Rating stars functionality
        const ratingStars = document.querySelectorAll('.rating-star');
        const ratingInput = document.getElementById('ratingInput');

        ratingStars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = parseInt(this.getAttribute('data-rating'));
                ratingInput.value = rating;

                // Update star colors
                ratingStars.forEach((s, index) => {
                    if (index < rating) {
                        s.classList.remove('text-gray-300');
                        s.classList.add('text-yellow-400');
                    } else {
                        s.classList.remove('text-yellow-400');
                        s.classList.add('text-gray-300');
                    }
                });
            });
        });

        // File input functionality
        const imageInput = document.getElementById('image');
        const selectedFileText = document.getElementById('selected-file');

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'No file selected';
                selectedFileText.textContent = 'Selected file: ' + fileName;
                selectedFileText.classList.remove('hidden');
            });
        }
    });
</script>
@endpush
