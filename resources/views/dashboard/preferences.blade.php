@extends('layout.dashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div class="relative bg-gray-50/50 p-6">
            @if($user->banner_image)
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('uploads/images/' . $user->banner_image) }}" alt="Banner" class="w-full h-full object-cover opacity-40">
                </div>
            @endif
            <div class="flex items-center space-x-4">
                <div class="relative flex-shrink-0">
                    @if($user->image)
                        <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-16 h-16 rounded-full border-2 border-white">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 text-xl font-bold border-4 border-gray-50">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <h1 class="text-2xl text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-gray-900">{{ '@' . $user->username }}</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-gray-50 text-gray-900 rounded-full text-sm">Member since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="bg-white border-b">
            <div class="px-6">
                <ul class="flex overflow-x-auto -mb-px text-sm font-medium">
                    <li class="mr-6">
                        <a href="{{ route('profile') }}" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Profile</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-[#FF5722] border-b-2 border-[#FF5722]">Travel Preferences</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Bookings</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Preferences Content -->
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white border rounded-lg p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-6">Travel Preferences</h2>
                <p class="text-gray-500 text-sm mb-6">Customize your travel experience by setting your preferences below.</p>

                <form action="{{ route('profile.preferences.update') }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Preferred Destinations -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Preferred Destinations</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                            @php
                                $destinations = [
                                    'Marrakech', 'Casablanca', 'Fes', 'Rabat', 'Tangier',
                                    'Agadir', 'Essaouira', 'Chefchaouen', 'Sahara Desert',
                                    'Ouarzazate', 'Meknes', 'Ifrane', 'Tetouan', 'El Jadida', 'Asilah'
                                ];
                                $selectedDestinations = $preferences->preferred_destinations ?? [];
                            @endphp

                            @foreach($destinations as $destination)
                                <div class="flex items-center">
                                    <input type="checkbox" name="preferred_destinations[]"
                                           id="dest_{{ Str::slug($destination) }}"
                                           value="{{ $destination }}"
                                           class="h-3 w-3 text-[#FF5722] focus:ring-[#000] border-gray-300 rounded"
                                           {{ in_array($destination, $selectedDestinations) ? 'checked' : '' }}>
                                    <label for="dest_{{ Str::slug($destination) }}"
                                           class="ml-1.5 text-sm text-gray-700">{{ $destination }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Budget Range and Travel Style -->
                    <div class="space-y-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Budget Range -->
                            <div>
                                <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">Budget Range</label>
                                <div class="space-y-1">
                                    <input type="range" name="budget_range" id="budget_range"
                                           min="100" max="50000" step="1000"
                                           value="{{ $preferences->budget_range == 'budget' ? 100 : ($preferences->budget_range == 'moderate' ? 20000 : 40000) }}"
                                           class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer transition-all duration-300"
                                           oninput="updateBudgetLabel(this.value)">
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>100 MAD</span>
                                        <span>16,700 MAD</span>
                                        <span>33,400 MAD</span>
                                        <span>50,000 MAD</span>
                                    </div>
                                    <div class="text-center text-[#cb2768] text-sm font-medium" id="budget_display">
                                        {{ $preferences->budget_range == 'budget' ? 'Budget (100 MAD)' :
                                           ($preferences->budget_range == 'moderate' ? 'Moderate (20,000 MAD)' : 'Luxury (40,000 MAD)') }}
                                    </div>
                                </div>
                                <input type="hidden" name="budget_range_category" id="budget_range_category"
                                       value="{{ $preferences->budget_range }}">
                            </div>

                            <!-- Travel Style -->
                            <div class="mt-2">
                                <select name="travel_style" id="travel_style"
                                        class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                    <option value="">Select your travel style</option>
                                    <option value="solo" {{ $preferences->travel_style == 'solo' ? 'selected' : '' }}>Solo Travel</option>
                                    <option value="couple" {{ $preferences->travel_style == 'couple' ? 'selected' : '' }}>Couple</option>
                                    <option value="family" {{ $preferences->travel_style == 'family' ? 'selected' : '' }}>Family</option>
                                    <option value="friends" {{ $preferences->travel_style == 'friends' ? 'selected' : '' }}>With Friends</option>
                                    <option value="group" {{ $preferences->travel_style == 'group' ? 'selected' : '' }}>Group Travel</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Interests -->
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-700">Interests</label>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-2 text-sm">
                            @php
                                $interestOptions = ['Adventure', 'Beach', 'Culture', 'Food & Cuisine',
                                                   'History', 'Nature', 'Nightlife', 'Photography',
                                                   'Relaxation', 'Shopping', 'Sports', 'Wildlife'];
                                $selectedInterests = $preferences->interests ?? [];
                            @endphp

                            @foreach($interestOptions as $interest)
                                <div class="flex items-center">
                                    <input type="checkbox" name="interests[]"
                                           id="int_{{ Str::slug($interest) }}"
                                           value="{{ $interest }}"
                                           class="h-3 w-3 text-[#FF5722] focus:ring-[#FF5722] border-gray-300 rounded"
                                           {{ in_array($interest, $selectedInterests) ? 'checked' : '' }}>
                                    <label for="int_{{ Str::slug($interest) }}"
                                           class="ml-1.5 text-sm text-gray-700">{{ $interest }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button type="submit"
                                class="px-6 py-2.5 bg-[#FF5722] text-white rounded-lg hover:bg-[#F4511E] focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:ring-offset-2 transition-colors">
                            Save Preferences
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    function updateBudgetLabel(val) {
        const value = parseInt(val);
        let category = '';
        let displayText = '';

        if (value <= 10000) {
            category = 'budget';
            displayText = `Budget (${value.toLocaleString()} MAD)`;
        } else if (value <= 30000) {
            category = 'moderate';
            displayText = `Moderate (${value.toLocaleString()} MAD)`;
        } else {
            category = 'luxury';
            displayText = `Luxury (${value.toLocaleString()} MAD)`;
        }

        const display = document.getElementById('budget_display');
        display.textContent = displayText;
        display.classList.add('transition-all', 'duration-300');

        document.getElementById('budget_range_category').value = category;

        // Add visual feedback with smooth transition
        const slider = document.getElementById('budget_range');
        const percent = ((value - slider.min) / (slider.max - slider.min)) * 100;
        slider.style.background = `linear-gradient(to right, #cb2768 ${percent}%, #e5e7eb ${percent}%)`;

        // Add a subtle scale effect when moving
        slider.style.transform = 'scale(1.02)';
        setTimeout(() => {
            slider.style.transform = 'scale(1)';
        }, 100);
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        const slider = document.getElementById('budget_range');
        updateBudgetLabel(slider.value);

        // Add input event listener for smooth updates
        slider.addEventListener('input', function() {
            updateBudgetLabel(this.value);
        });
    });
</script>
