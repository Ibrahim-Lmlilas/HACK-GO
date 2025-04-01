@extends('layout.dashboard')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Profile Header -->
        <div class="relative bg-gradient-to-r from-blue-600 to-blue-800 p-6">
            @if($user->banner_image)
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('uploads/images/' . $user->banner_image) }}" alt="Banner" class="w-full h-full object-cover opacity-50">
                </div>
            @endif
            <div class="flex flex-col md:flex-row items-center relative z-10">
                <div class="relative">
                    @if($user->image)
                        <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-24 h-24 rounded-full border-4 border-white">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gray-700 flex items-center justify-center text-white text-2xl font-bold border-4 border-white">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="md:ml-6 mt-4 md:mt-0 text-center md:text-left">
                    <h1 class="text-2xl font-bold text-white">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-blue-200">{{ '@' . $user->username }}</p>
                    <div class="mt-2 flex flex-wrap justify-center md:justify-start gap-2">
                        <span class="px-3 py-1 bg-blue-700 rounded-full text-xs text-white">{{ ucfirst($user->role) }}</span>
                        <span class="px-3 py-1 bg-blue-700 rounded-full text-xs text-white">Member since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

       
        <!-- Profile Navigation -->
        <div class="bg-gray-900 text-white">
            <div class="container mx-auto">
                <ul class="flex overflow-x-auto">
                    <li class="px-6 py-3 font-medium text-gray-400 hover:text-white"><a href="{{ route('profile') }}">Profile</a></li>
                    <li class="px-6 py-3 font-medium border-b-2 border-blue-500">Travel Preferences</li>
                    <li class="px-6 py-3 font-medium text-gray-400 hover:text-white">Bookings</li>
                    <li class="px-6 py-3 font-medium text-gray-400 hover:text-white">Reviews</li>
                    <li class="px-6 py-3 font-medium text-gray-400 hover:text-white">Messages</li>
                </ul>
            </div>
        </div>

        <!-- Preferences Content -->
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-gray-700 rounded-lg p-6">
                <h2 class="text-xl font-semibold text-white mb-4">Travel Preferences</h2>
                <p class="text-gray-300 mb-6">Customize your travel experience by setting your preferences below. This helps us recommend destinations and activities that match your interests.</p>

                <form action="{{ route('profile.preferences.update') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Preferred Destinations -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Preferred Destinations</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @php
                                // Only Moroccan destinations
                                $destinations = [
                                    'Marrakech',
                                    'Casablanca',
                                    'Fes',
                                    'Rabat',
                                    'Tangier',
                                    'Agadir',
                                    'Essaouira',
                                    'Chefchaouen',
                                    'Sahara Desert',
                                    'Ouarzazate',
                                    'Meknes',
                                    'Ifrane',
                                    'Tetouan',
                                    'El Jadida',
                                    'Asilah'
                                ];

                                $selectedDestinations = $preferences->preferred_destinations ?? [];
                            @endphp

                            @foreach($destinations as $destination)
                                <div class="flex items-center">
                                    <input type="checkbox" name="preferred_destinations[]" id="dest_{{ Str::slug($destination) }}" value="{{ $destination }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-500 rounded" {{ in_array($destination, $selectedDestinations) ? 'checked' : '' }}>
                                    <label for="dest_{{ Str::slug($destination) }}" class="ml-2 text-sm text-gray-300">{{ $destination }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Budget Range -->
                    <div class="mb-6">
                        <label for="budget_range" class="block text-sm font-medium text-gray-300 mb-2">Budget Range</label>
                        <div class="space-y-2">
                            <input type="range" name="budget_range" id="budget_range" min="100" max="50000" step="1000"
                                value="{{ $preferences->budget_range == 'budget' ? 100 : ($preferences->budget_range == 'moderate' ? 20000 : 40000) }}"
                                class="w-full h-2 bg-gray-600 rounded-lg appearance-none cursor-pointer"
                                oninput="updateBudgetLabel(this.value)">
                            <div class="flex justify-between text-xs text-gray-400">
                                <span>100 MAD</span>
                                <span>16,700 MAD</span>
                                <span>33,400 MAD</span>
                                <span>50,000 MAD</span>
                            </div>
                            <div class="text-center text-white font-medium" id="budget_display">{{ $preferences->budget_range == 'budget' ? 'Budget (100 MAD)' : ($preferences->budget_range == 'moderate' ? 'Moderate (20,000 MAD)' : 'Luxury (40,000 MAD)') }}</div>
                        </div>
                        <input type="hidden" name="budget_range_category" id="budget_range_category" value="{{ $preferences->budget_range }}">
                    </div>

                    <script>
                        function updateBudgetLabel(val) {
                            const value = parseInt(val);
                            let category = '';
                            let displayText = '';

                            if (value <= 10000) {
                                category = 'budget';
                                displayText = 'Budget (' + value.toLocaleString() + ' MAD)';
                            } else if (value <= 30000) {
                                category = 'moderate';
                                displayText = 'Moderate (' + value.toLocaleString() + ' MAD)';
                            } else {
                                category = 'luxury';
                                displayText = 'Luxury (' + value.toLocaleString() + ' MAD)';
                            }

                            document.getElementById('budget_display').textContent = displayText;
                            document.getElementById('budget_range_category').value = category;
                        }

                        // Initialize on page load
                        document.addEventListener('DOMContentLoaded', function() {
                            updateBudgetLabel(document.getElementById('budget_range').value);
                        });
                    </script>

                    <!-- Travel Style -->
                    <div class="mb-6">
                        <label for="travel_style" class="block text-sm font-medium text-gray-300 mb-2">Travel Style</label>
                        <select name="travel_style" id="travel_style" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Select your travel style</option>
                            <option value="solo" {{ $preferences->travel_style == 'solo' ? 'selected' : '' }}>Solo Travel</option>
                            <option value="couple" {{ $preferences->travel_style == 'couple' ? 'selected' : '' }}>Couple</option>
                            <option value="family" {{ $preferences->travel_style == 'family' ? 'selected' : '' }}>Family</option>
                            <option value="friends" {{ $preferences->travel_style == 'friends' ? 'selected' : '' }}>With Friends</option>
                            <option value="group" {{ $preferences->travel_style == 'group' ? 'selected' : '' }}>Group Travel</option>
                        </select>
                    </div>

                    <!-- Interests -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-300 mb-2">Interests</label>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                            @php
                                $interestOptions = ['Adventure', 'Beach', 'Culture', 'Food & Cuisine', 'History', 'Nature', 'Nightlife', 'Photography', 'Relaxation', 'Shopping', 'Sports', 'Wildlife'];
                                $selectedInterests = $preferences->interests ?? [];
                            @endphp

                            @foreach($interestOptions as $interest)
                                <div class="flex items-center">
                                    <input type="checkbox" name="interests[]" id="int_{{ Str::slug($interest) }}" value="{{ $interest }}" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-500 rounded" {{ in_array($interest, $selectedInterests) ? 'checked' : '' }}>
                                    <label for="int_{{ Str::slug($interest) }}" class="ml-2 text-sm text-gray-300">{{ $interest }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Save Preferences
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
