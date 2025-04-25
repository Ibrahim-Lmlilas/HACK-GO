@extends('layout.client.client')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="flex flex-col lg:flex-row gap-4">
    <div class="flex-1 space-y-3">
        <div class="flex flex-col md:flex-row gap-5">
            <!-- destination chart-->
            <div class="relative h-64 w-full md:w-1/2 bg-white rounded-2xl p-5">
                @foreach($destinations as $index => $destination)
                <div class="destination-card absolute inset-0 transition-opacity duration-1000 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }}"
                     data-index="{{ $index }}">
                    <div class="relative h-full rounded-lg overflow-hidden shadow-lg">
                        <img src="{{ $destination->image_url }}" alt="{{ $destination->name }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <h4 class="font-bold text-xl mb-1">{{ $destination->name }}</h4>
                            <p class="text-sm mb-1">{{ $destination->city }}</p>
                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                                <span class="ml-1 text-sm">{{ number_format($destination->rating, 1) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1  gap-5 w-full md:w-1/2">
                <div class="h-full w-full rounded-lg overflow-hidden">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10189.2012012012!2d-2.9277072!3d35.1684723!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd7b8d4d6f1f5d%3A0x3b9c9a3b8c9c9c9c!2sNador%2C%20Morocco!5e0!3m2!1sen!2sma!4v1640000000000!5m2!1sen!2sma"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        allowfullscreen=""
                        loading="lazy">
                    </iframe>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="rounded-2xl p-5">
            <style>
                .trip-card {
                    transition: all 0.3s ease;
                }
                .trip-card:hover .hover-content {
                    opacity: 1;
                    transform: translateY(0);
                }
                .hover-content {
                    opacity: 0;
                    transform: translateY(10px);
                    transition: all 0.3s ease;
                }
                .trip-card:hover .card-info {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                .card-info {
                    transition: all 0.3s ease;
                }
            </style>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-2 sm:gap-6">
                @foreach($trips as $trip)
                <div class="bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transition-shadow duration-300">
                    <div class="relative h-[200px]">
                        <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/30 to-transparent"></div>

                        <!-- Trip Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <h5 class="text-white text-lg font-semibold mb-1">{{ $trip->name }}</h5>
                                    <div class="flex items-center text-white/90">
                                        <i class="fas fa-map-marker-alt text-[#FFB800] mr-2"></i>
                                        <span class="text-sm">{{ $trip->destination->name }}</span>
                                    </div>
                                </div>
                                <div class="bg-[#FF9736] text-white px-3 py-1 rounded-full text-sm">
                                    {{ number_format($trip->price, 0) }} MAD
                                </div>
                            </div>

                            <!-- Trip Details -->
                            <div class="grid grid-cols-3 gap-2 mt-3">
                                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-2">
                                    <div class="flex items-center text-white">
                                        <i class="fas fa-calendar-alt text-[#FFB800] mr-2"></i>
                                        <div class="text-xs">
                                            <div class="opacity-70">Date</div>
                                            <div>{{ $trip->start_date->format('M d') }}</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-2">
                                    <div class="flex items-center text-white">
                                        <i class="fas fa-users text-[#FFB800] mr-2"></i>
                                        <div class="text-xs">
                                            <div class="opacity-70">Capacity</div>
                                            <div>{{ $trip->capacity }} people</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        <div class="absolute top-4 right-4">
                            <a href="{{ route('client.trips.show', $trip) }}"
                                class="inline-block bg-white/90  text-gray-800  px-4 py-2 rounded-full text-sm transition-all duration-300 transform hover:scale-105">
                                View Details
                            </a>
                        </div>
                    </div>

                    @if($trip->hotel)
                    <div class="p-4 border-t border-gray-100">
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-lg overflow-hidden mr-3">
                                <img src="{{ $trip->hotel->image_url }}" alt="{{ $trip->hotel->name }}"
                                    class="w-full h-full object-cover">
                            </div>
                            <div>
                                <h6 class="text-sm font-medium text-gray-800">{{ $trip->hotel->name }}</h6>
                                <p class="text-xs text-gray-500">{{ $trip->hotel->location }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-full lg:w-80 space-y-5">
        <!-- Weather -->
        <div class="bg-[#F8F8F8] rounded-2xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-semibold text-gray-800">Weather</h3>

            </div>

            <div class="relative">
                <input type="text"
                    id="city-input"
                    placeholder="Search city..."
                    class="w-full px-4 py-3 bg-white rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#9DC45F] border-none shadow-sm"
                >
                <button id="search-btn" class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </div>

            <div class="weather-info hidden mt-6 bg-white rounded-xl p-4">
                <div class="flex justify-between items-center mb-4">
                    <div>
                        <h4 id="city-name" class="text-lg font-semibold text-gray-800"></h4>
                        <p id="description" class="text-sm text-gray-500 mt-1"></p>
                    </div>
                    <p id="temperature" class="text-3xl font-bold text-gray-800"></p>
                </div>

                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div class="bg-[#F8F8F8] rounded-lg p-3">
                        <p id="humidity" class="text-sm text-gray-600"></p>
                    </div>
                    <div class="bg-[#F8F8F8] rounded-lg p-3">
                        <p id="wind" class="text-sm text-gray-600"></p>
                    </div>
                </div>
            </div>

            <p id="error-message" class="hidden mt-4 text-sm text-red-500 font-medium text-center"></p>
        </div>

        <!-- Calendar -->
            <div class="p-6">
                <x-calendar
                    :month="request('month')"
                    :year="request('year')"
                />
            </div>


    </div>
</div>

<script>
const apiKey = 'c1d1fd315ae3d987ee0cf68509d9f96b';

const searchBtn = document.getElementById('search-btn');
const cityInput = document.getElementById('city-input');
const cityName = document.getElementById('city-name');
const temperature = document.getElementById('temperature');
const description = document.getElementById('description');
const humidity = document.getElementById('humidity');
const wind = document.getElementById('wind');
const weatherInfo = document.querySelector('.weather-info');
const errorMessage = document.getElementById('error-message');

searchBtn.addEventListener('click', () => {
    const city = cityInput.value.trim();
    if (city) {
        getWeather(city);
    } else {
        displayError('Please enter a city name.');
    }
});

function getWeather(city) {
    const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&units=metric`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            if (data.cod === 200) {
                updateWeatherInfo(data);
                clearError();
            } else {
                displayError('City not found. Please try another city.');
            }
        })
        .catch(error => {
            displayError('An error occurred. Please try again later.');
            console.error(error);
        });
}

function updateWeatherInfo(data) {
    cityName.textContent = data.name;
    temperature.textContent = `${data.main.temp.toFixed(1)}°C`;
    description.innerHTML = `${capitalize(data.weather[0].description)}`;
    humidity.innerHTML = `<div class="flex items-center">
        <i class="fas fa-tint text-[#9DC45F] mr-2"></i>
        <div>
            <span class="block text-gray-400 text-xs">Humidity</span>
            <span class="block text-gray-700">${data.main.humidity}%</span>
        </div>
    </div>`;
    wind.innerHTML = `<div class="flex items-center">
        <i class="fas fa-wind text-[#9DC45F] mr-2"></i>
        <div>
            <span class="block text-gray-400 text-xs">Wind Speed</span>
            <span class="block text-gray-700">${data.wind.speed.toFixed(1)} m/s</span>
        </div>
    </div>`;

    weatherInfo.classList.remove('hidden');
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function displayError(message) {
    errorMessage.textContent = message;
    errorMessage.classList.remove('hidden');
    weatherInfo.classList.add('hidden');
}

function clearError() {
    errorMessage.textContent = '';
    errorMessage.classList.add('hidden');
}

function openProfileModal() {
    document.getElementById('profileModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeProfileModal() {
    document.getElementById('profileModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function openEditProfileModal() {
    document.getElementById('editProfileModal').classList.remove('hidden');
    document.getElementById('profileModal').classList.add('hidden');
}

function closeEditProfileModal() {
    document.getElementById('editProfileModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

// Profile photo preview
document.getElementById('profile_photo').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profileImage').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});

// Close modals when clicking outside
document.getElementById('profileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeProfileModal();
    }
});

document.getElementById('editProfileModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditProfileModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProfileModal();
        closeEditProfileModal();
    }
});

// Handle form submission
document.getElementById('editProfileForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch(this.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(err => { throw err; });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Update profile image if a new one was uploaded
            if (data.profile_photo) {
                const profileImage = document.getElementById('profileImage');
                profileImage.src = `/storage/profile-photos/${data.profile_photo}`;
            }

            // Close the modal
            closeEditProfileModal();

            // Show success message
            alert('Profile updated successfully!');

            // Reload the page to show updated data
            window.location.reload();
        } else {
            alert('Error updating profile: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        if (error.errors) {
            alert('Validation errors: ' + Object.values(error.errors).join('\n'));
        } else {
            alert('An error occurred while updating the profile.');
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.destination-card');
    let currentIndex = 0;
    const totalCards = cards.length;

    function rotateCards() {
        // Hide current card
        cards[currentIndex].classList.remove('opacity-100');
        cards[currentIndex].classList.add('opacity-0');

        // Move to next card
        currentIndex = (currentIndex + 1) % totalCards;

        // Show next card
        cards[currentIndex].classList.remove('opacity-0');
        cards[currentIndex].classList.add('opacity-100');
    }

    // Rotate cards every second
    setInterval(rotateCards, 3000);

    // Get current location
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            // Update map iframe with current location
            const mapFrame = document.getElementById('mapFrame');
            mapFrame.src = `https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2000!2d${longitude}!3d${latitude}!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzXCsDA5JzQ2LjUiTiAywrA1NSc0Mi4xIlc!5e0!3m2!1sen!2sma!4v1640000000000!5m2!1sen!2sma`;
        }, function(error) {
            console.error('Error getting location:', error);
        });
    } else {
        console.error('Geolocation is not supported by this browser.');
    }
});
</script>

@endsection
