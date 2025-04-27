<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'HACK&GO') }} - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#92472B',
                        secondary: '#3A3A3A',
                        light: '#FEFBEA'
                    }
                }
            }
        }
    </script>
    <style>
        .sidebar {
            border-radius: 14px;
            margin: 8px;
            height: calc(100vh - 16px);
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            width: 3.5rem;
        }

        .sidebar:hover {
            width: 12rem;
        }

        .sidebar-container {
            position: relative;
            z-index: 10;
        }

        .sidebar-content {
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar:hover .sidebar-content {
            opacity: 1;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 0.5rem;
            color: #FEFBEA;
            transition: all 0.3s ease;
        }

        .sidebar-link:hover {
            background-color: rgba(254, 251, 234, 0.1);
        }

        .sidebar-link i {
            width: 1.25rem;
            text-align: center;
            font-size: 1rem;
        }

        .sidebar-link span {
            margin-left: 0.75rem;
            white-space: nowrap;
            font-size: 0.875rem;
        }

        body {
            background-color: #FEFBEA;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                width: 12rem;
                transition: all 0.3s ease;
            }

            .sidebar.active {
                left: 0;
            }

            .sidebar-content {
                opacity: 1;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Mobile menu button -->
        <button class="lg:hidden fixed top-4 left-4 z-20 p-2 rounded-md bg-gray-800 text-white" onclick="toggleSidebar()">
            <i class="fas fa-bars"></i>
        </button>

        <!-- Sidebar container with z-index -->
        <div class="sidebar-container">
            <!-- Sidebar -->
            <div class="sidebar bg-gray-800 text-white flex flex-col items-start py-6 ">
                <div class="flex items-center justify-center mb-6">
                    <a href="#" class="transition-transform duration-300 hover:scale-125">
                       {{-- logo --}}
                    </a>
                    <span class="sidebar-content">HACK&GO</span>
                </div>
                <div class="space-y-1 w-full mt-10">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link flex items-center">
                        <i class="fas fa-chart-line ml-2.5"></i>
                        <span class="sidebar-content">Dashboard</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="sidebar-link">
                        <i class="fas fa-users ml-2.5"></i>
                        <span class="sidebar-content">User Management</span>
                    </a>
                    <a href="{{ route('admin.trips') }}" class="sidebar-link">
                        <i class="fas fa-plane ml-2.5"></i>
                        <span class="sidebar-content">Trips</span>
                    </a>
                    <a href="{{ route('admin.reservations') }}" class="sidebar-link">
                        <i class="fas fa-calendar-check ml-2.5"></i>
                        <span class="sidebar-content">Reservations</span>
                    </a>
                    <a href="{{ route('admin.messages.index') }}" class="sidebar-link">
                        <i class="fas fa-comment-dots ml-2.5"></i>
                        <span class="sidebar-content">Messages</span>
                    </a>
                    <a href="" class="sidebar-link">
                        <i class="fas fa-chart-bar ml-2.5"></i>
                        <span class="sidebar-content">Statistics</span>
                    </a>
                    <a href="" class="sidebar-link">
                        <i class="fas fa-cog ml-2.5"></i>
                        <span class="sidebar-content">Settings</span>
                    </a>
                </div>
                <!-- Logout button at bottom of sidebar -->
                <div class="mt-auto pt-4 absolute bottom-6 left-0 right-0 px-2">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="sidebar-link flex items-center hover:bg-[rgba(254,251,234,0.1)] w-full">
                            <i class="fas fa-sign-out-alt ml-3"></i>
                            <span class="sidebar-content">Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-4 lg:p-6 overflow-auto main-content">
            <!-- Header -->
            <div class="flex flex-col lg:flex-row justify-between items-center mb-6">
                <h1 class="text-2xl ml-8 font-bold mb-4 lg:mb-0">Welcome, {{ Auth::user()->name ?? 'Admin' }}</h1>

                <!-- Search bar -->
                <div class="relative w-full max-w-md mb-4 lg:mb-0 mx-4">
                    <input type="text" id="searchInput"
                       placeholder="Search..."
                       class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-md focus:border-primary ">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button onclick="toggleNotifications()" class="p-2 rounded-md relative">
                            <i class="far fa-bell text-black"></i>
                            @if(Auth::user()->adminNotifications()->count() > 0)
                                <span class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ Auth::user()->adminNotifications()->count() }}
                                </span>
                            @endif
                        </button>
                        <div id="notificationsDropdown" class="hidden absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg z-50">
                            <div class="p-4">
                                <h3 class="font-bold mb-2">Notifications</h3>
                                <div class="max-h-96 overflow-y-auto">
                                    @forelse(Auth::user()->notifications()->latest()->take(5)->get() as $notification)
                                        <div class="p-2 border-b {{ $notification->is_read ? 'bg-gray-50' : 'bg-blue-50' }}">
                                            <p class="text-sm">{{ $notification->message }}</p>
                                            <span class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</span>
                                            @if(!$notification->is_read)
                                                <form action="{{ route('notifications.markAsRead', $notification) }}" method="POST" class="inline">
                                                    @csrf
                                                    <button type="submit" class="text-xs text-blue-500 hover:text-blue-700">Mark as read</button>
                                                </form>
                                            @endif
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500">No notifications</p>
                                    @endforelse
                                </div>
                                @if(Auth::user()->notifications()->count() > 5)
                                    <a href="{{ route('notifications.index') }}" class="block text-center text-sm text-blue-500 mt-2">View all notifications</a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button onclick="openProfileModal()" class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden hover:ring-2 hover:ring-gray-600 transition-all duration-200">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ Storage::url(Auth::user()->profile_photo) }}"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @endif
                    </button>
                </div>
            </div>
            @yield('content')
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


        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        function openProfileModal() {
            document.getElementById('profileModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeProfileModal() {
            document.getElementById('profileModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside
        document.getElementById('profileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeProfileModal();
            }
        });

        // Prevent modal close when clicking inside modal content
        document.querySelector('#profileModal > div').addEventListener('click', function(e) {
            e.stopPropagation();
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeProfileModal();
            }
        });
    </script>
</body>
</html>
