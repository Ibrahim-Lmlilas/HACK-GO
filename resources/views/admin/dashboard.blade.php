@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="flex flex-col lg:flex-row gap-6 ">
    <div class="flex-1 space-y-6">
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
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 w-full md:w-1/2">
                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-calendar-check text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">89</h2>
                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Bookings</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-map-marker-alt text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">{{ $stats['totalDestinations']['value'] }}</h2>
                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Destinations</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-plane text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">24</h2>                    </div>

                    <p class="text-sm text-gray-600 mt-1">Total Trips</p>
                </div>

                <div class="bg-white rounded-2xl p-5 flex flex-col">
                    <div class="flex justify-between mb-3">
                        <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-users text-gray-600"></i></div>
                        <h2 class="text-2xl font-bold">156</h2>
                    </div>
                    <p class="text-sm text-gray-600 mt-1">Active Users</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-full lg:w-80 space-y-5">
        <!-- Weather -->
        <div class="bg-white rounded-2xl p-3">
            <h3 class="text-gray-700 mb-4">Weather Watcher <i class="fas fa-cloud-sun text-black"></i></h3>
            <div class="flex items-center space-x-2 mb-3">
                <input type="text" id="city-input" placeholder="Enter city name" class="flex-1 p-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-black">
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

<!-- Destination Details Modal -->
<div id="destinationModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-2xl w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-2xl font-bold text-gray-800" id="modalDestinationName"></h3>
                    <button onclick="closeDestinationModal()" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <div class="relative h-64 mb-4 rounded-lg overflow-hidden">
                    <img id="modalDestinationImage" src="" alt="" class="w-full h-full object-cover">
                </div>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="ml-2 text-gray-700" id="modalDestinationRating"></span>
                    </div>
                    <div class="text-gray-600" id="modalDestinationDescription"></div>
                </div>
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

function showDestinationDetails(destinationId) {
    // Fetch destination details
    fetch(`/api/destinations/${destinationId}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalDestinationName').textContent = data.name;
            document.getElementById('modalDestinationImage').src = data.image_url;
            document.getElementById('modalDestinationRating').textContent = `Rating: ${data.rating}`;
            document.getElementById('modalDestinationDescription').textContent = data.description || 'No description available';
            document.getElementById('destinationModal').classList.remove('hidden');
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function closeDestinationModal() {
    document.getElementById('destinationModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('destinationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDestinationModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDestinationModal();
    }
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
});
</script>

@endsection
