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

            <div class="grid grid-cols-1 md:grid-cols-3  gap-2 sm:gap-6 ">
                @foreach($trips as $trip)
                <div class="trip-card bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl relative group w-full">
                    <div class="relative h-[200px] sm:h-[280px]">
                        <img src="{{ $trip->destination->image_url }}" alt="{{ $trip->name }}"
                            class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

                        <div class="absolute top-3 right-3 z-10 block sm:hidden">
                            <a href="{{ route('client.trips.show', $trip) }}"
                                class="inline-block bg-white text-black px-3 py-1.5 sm:px-4 sm:py-2 text-[10px] sm:text-xs rounded-full hover:bg-gray-100 transition shadow-sm">
                                View Details
                            </a>
                        </div>

                        <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                            <!-- Card Info (hides on hover) -->
                            <div class="card-info">
                                <h5 class="text-base sm:text-lg font-bold mb-1 line-clamp-1">{{ $trip->name }}</h5>
                                <p class="text-xs sm:text-sm opacity-90 mb-1 line-clamp-1">{{ $trip->destination->name }}</p>

                                @if($trip->hotel)
                                <div class="flex items-center mb-2">
                                    <i class="fas fa-hotel mr-2 text-xs"></i>
                                    <span class="text-xs line-clamp-1">{{ $trip->hotel->name }}</span>
                                </div>
                                @endif

                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-2 text-xs"></i>
                                        <span class="text-xs">{{ $trip->start_date->format('M d') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm font-bold">{{ number_format($trip->price, 2) }}</span>
                                        <span class="text-xs ml-1">MAD</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Mobile: Always visible, Desktop: Only visible on hover -->
                            <div class="hidden sm:flex hover-content opacity-0 transform translate-y-10 absolute inset-0 flex-col items-center justify-center text-center p-4">
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center justify-center space-x-2">
                                        <i class="fas fa-users text-xs"></i>
                                        <span class="text-xs">{{ $trip->capacity }} persons</span>
                                    </div>
                                </div>
                                <div class="space-y-2 mb-4">
                                    <a href="{{ route('client.trips.show', $trip) }}"
                                        class="inline-block bg-white text-black px-4 sm:px-6 py-2 rounded-full text-xs hover:bg-gray-100 transition">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-full lg:w-80 space-y-5">
        <!-- Weather -->
        <div class="bg-white rounded-2xl p-3">
            <h3 class="text-gray-700 mb-4">Weather Watcher <i class="fas fa-cloud-sun text-[#9370db]"></i></h3>
            <div class="flex items-center space-x-2 mb-3">
                <input type="text" id="city-input" placeholder="Enter city name" class="flex-1 p-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
                <button id="search-btn" class="text-black p-2 rounded-lg transition"><i class="fas fa-search"></i></button>
            </div>
            <div class="weather-info hidden">
                <div class="flex justify-between items-center mb-3">
                    <h4 id="city-name" class="text-lg font-medium"></h4>
                    <p id="temperature" class="text-2xl font-bold"></p>
                </div>
                <div class="space-y-2 text-sm text-gray-600">
                    <p id="description" class="py-1"></p>
                    <p id="humidity" class="py-1"></p>
                    <p id="wind" class="py-1"></p>
                </div>
            </div>
            <p id="error-message" class="hidden mt-2 text-sm text-red-500 font-medium"></p>
        </div>

        <!-- Calendar -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="p-6">
                <x-calendar
                    :month="request('month')"
                    :year="request('year')"
                />
            </div>
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
    description.innerHTML = `<i class="fas fa-cloud-sun text-[#9370db] mr-2"></i> ${capitalize(data.weather[0].description)}`;
    humidity.innerHTML = `<i class="fas fa-tint text-[#9370db] mr-2"></i> Humidity: ${data.main.humidity}%`;
    wind.innerHTML = `<i class="fas fa-wind text-[#9370db] mr-2"></i> Wind Speed: ${data.wind.speed.toFixed(1)} m/s`;

    weatherInfo.style.display = 'block';
}

function capitalize(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

function displayError(message) {
    errorMessage.textContent = message;
    errorMessage.style.display = 'block';
    weatherInfo.style.display = 'none';
}

function clearError() {
    errorMessage.textContent = '';
    errorMessage.style.display = 'none';
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
