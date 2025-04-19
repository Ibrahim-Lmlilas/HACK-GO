@extends('layout.admin.admin')

@section('content')
<!-- Add Modal -->
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">Profile Information</h3>
                <button onclick="closeProfileModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6">
                <div class="flex items-center justify-center mb-6">
                    <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                             alt="Profile"
                             class="w-full h-full object-cover">
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Username</label>
                        <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">First Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->first_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Last Name</label>
                        <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->last_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <p class="mt-1 text-sm text-gray-900">{{ ucfirst(Auth::user()->role) }}</p>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-4 border-t gap-3">
                <button onclick="openEditProfileModal()" class="px-4 py-2 bg-[#9370db] text-white rounded-md hover:bg-purple-700">
                    Edit Profile
                </button>
                <button onclick="closeProfileModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-xl font-semibold text-gray-900">Edit Profile</h3>
                <button onclick="closeEditProfileModal()" class="text-gray-400 hover:text-gray-500">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-6">
                <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-center mb-6">
                        <div class="relative">
                            <div class="w-24 h-24 rounded-full bg-gray-200 overflow-hidden">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                                     alt="Profile"
                                     class="w-full h-full object-cover"
                                     id="profileImage">
                            </div>
                            <label for="profile_photo" class="absolute bottom-0 right-0 bg-[#9370db] text-white p-2 rounded-full cursor-pointer hover:bg-purple-700">
                                <i class="fas fa-camera"></i>
                                <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div>
                            <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                            <input type="text" name="username" id="username" value="{{ Auth::user()->name }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#9370db] focus:ring-[#9370db]">
                        </div>
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
                            <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#9370db] focus:ring-[#9370db]">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#9370db] focus:ring-[#9370db]">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#9370db] focus:ring-[#9370db]">
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end p-4 border-t gap-3 mt-6">
                        <button type="submit" class="px-4 py-2 bg-[#9370db] text-white rounded-md hover:bg-purple-700">
                            Save Changes
                        </button>
                        <button type="button" onclick="closeEditProfileModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-md hover:bg-gray-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="flex gap-6 h-full">
    <div class="flex-1 space-y-6">
        <!-- First row of cards -->
        <div class="grid grid-cols-4 gap-5">
            <div class="bg-white rounded-2xl p-5 flex flex-col">
                <div class="flex justify-between mb-3">
                    <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-plane text-gray-600"></i></div>
                    <button class="text-gray-400"><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <h2 class="text-2xl font-bold">24</h2>
                <p class="text-sm text-gray-600 mt-1">Total Trips</p>
            </div>

            <div class="bg-white rounded-2xl p-5 flex flex-col">
                <div class="flex justify-between mb-3">
                    <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-users text-gray-600"></i></div>
                    <button class="text-gray-400"><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <h2 class="text-2xl font-bold">156</h2>
                <p class="text-sm text-gray-600 mt-1">Active Users</p>
            </div>

            <div class="bg-white rounded-2xl p-5 flex flex-col">
                <div class="flex justify-between mb-3">
                    <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-calendar-check text-gray-600"></i></div>
                    <button class="text-gray-400"><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <h2 class="text-2xl font-bold">89</h2>
                <p class="text-sm text-gray-600 mt-1">Total Bookings</p>
            </div>

            <div class="bg-white rounded-2xl p-5 flex flex-col">
                <div class="flex justify-between mb-3">
                    <div class="bg-gray-100 rounded-md p-2"><i class="fas fa-dollar-sign text-gray-600"></i></div>
                    <button class="text-gray-400"><i class="fas fa-ellipsis-h"></i></button>
                </div>
                <h2 class="text-2xl font-bold">$1,245</h2>
                <p class="text-sm text-gray-600 mt-1">Average Trip Price</p>
            </div>
        </div>

        <!-- Second row of cards -->
        <div class="grid grid-cols-2 gap-5">
            <div class="bg-white rounded-2xl p-5">
                <h3 class="text-gray-700 mb-2">Upcoming Trips</h3>
                <div class="flex items-end">
                    <span class="text-5xl font-bold mr-3">12</span>
                    <span class="text-green-500 text-sm bg-green-50 px-2 py-1 rounded-md mb-1">+ 15%</span>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-5">
                <h3 class="text-gray-700 mb-2">Pending Bookings</h3>
                <div class="flex items-end">
                    <span class="text-5xl font-bold mr-3">8</span>
                    <span class="text-red-500 text-sm bg-red-50 px-2 py-1 rounded-md mb-1">+ 5%</span>
                </div>
            </div>
        </div>

        <!-- Revenue Chart -->
        <div class="bg-white rounded-2xl p-5">
            <div class="flex justify-between mb-4">
                <h3 class="text-gray-700">Revenue</h3>
                <span class="text-sm text-gray-600">Last 7 days VS prior week</span>
            </div>
            <div class="h-40 w-full border-b border-gray-200">
                <!-- Placeholder for chart -->
                <div class="relative h-full w-full">
                    <div class="absolute bottom-0 left-0 right-0 h-24 bg-gray-50 rounded-lg overflow-hidden">
                        <div class="w-full h-full relative">
                            <div class="absolute bottom-0 w-full h-12 bg-blue-50"></div>
                            <div class="absolute bottom-8 left-1/4 h-1 w-3/4 bg-blue-400 rounded-full"></div>
                            <div class="absolute bottom-12 left-1/4 h-1 w-3/4 bg-gray-300 rounded-full"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-2 text-xs text-gray-500">
                <span>Feb 14</span>
                <span>Feb 15</span>
                <span>Feb 16</span>
                <span>Feb 17</span>
                <span>Feb 18</span>
                <span>Feb 19</span>
                <span>Feb 20</span>
            </div>
        </div>


    </div>

    <!-- Right sidebar -->
    <div class="w-80 space-y-5">

        <!-- weather -->

    <div class="bg-white rounded-2xl p-5 mb-5">
        <h3 class="text-gray-700 mb-4">Weather Watcher <i class="fas fa-cloud-sun text-[#9370db]"></i></h3>
        <div class="flex items-center space-x-2 mb-4">
            <input type="text" id="city-input" placeholder="Enter city name" class="flex-1 p-2 border border-gray-200 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button id="search-btn" class="text-black p-2 rounded-lg transition" : ><i class="fas fa-search"></i></button>
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

        <!-- Popular Destinations -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8" id="calendar-section">
            <div class="p-6">
                <x-calendar
                    :month="request('month')"
                    :year="request('year')"
                />
            </div>
        </div>




    </div>
</div>

<script >

const apiKey = 'c1d1fd315ae3d987ee0cf68509d9f96b';

const apiKey1 = 'your_openweathermap_api_key';
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
console.log(data)
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

</script>

@endsection
