<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-20 lg:hidden hidden" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 w-64 bg-white shadow-sm transition-transform duration-300 transform -translate-x-full lg:translate-x-0 z-30 lg:relative lg:flex lg:flex-col border-r  lg:shadow-none">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20">
                    <span class="ml-2 text-xl font-semibold text-[#FF5722]">HACK<span class="text-[#000000]">&</span>GO</span>
                </div>
            </div>

            <!-- New Trip Button -->
            <div class="px-4 mt-4">
                <button class="w-full bg-[#3B82F6] text-white rounded-lg px-4 py-2.5 font-medium flex items-center justify-center hover:bg-blue-600 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    New trip
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 mt-6 space-y-2 overflow-y-autov border-t ">
                <!-- Home -->
                <a href="/overview" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Home</span>
                </a>

                <!-- All trips -->
                <a href="/trips" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>All trips</span>
                </a>

                <!-- Travels -->
                <a href="/travels" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>Travels</span>
                </a>

                <!-- Rooms -->
                <a href="/rooms" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Rooms</span>
                </a>

                <!-- Transport -->
                <a href="/transport" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                    </svg>
                    <span>Transport</span>
                </a>

                <!-- Attractions -->
                <a href="/attractions" class="flex items-center px-4 py-2.5 text-sm font-medium text-gray-900 rounded-lg hover:bg-gray-100 transition-all duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Attractions</span>
                </a>
            </nav>

            <!-- Profile Section -->
            <div class="border-t border-gray-200 p-4">
                <div class="flex items-center mb-4">
                    <div class="relative flex-shrink-0">
                        @if($user->image)
                            <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-10 h-10 rounded-full border-2 border-white">
                        @else
                            <div class="w-12 h-12 rounded-full bg-gray-700 flex items-center justify-center text-white text-xl font-bold border-2 border-white">
                                {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                            </div>
                        @endif
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</p>
                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Profile and Logout Links -->
                <div class="space-y-1">
                    <a href="{{ route('profile') }}" class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                        <svg class="w-5 h-5 mr-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Profile Settings</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="w-full flex items-center px-3 py-2 text-sm font-medium text-red-600 rounded-lg hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Left side -->
                        <div class="flex items-center space-x-4">
                            <!-- Mobile menu button -->
                            <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-blue-500">
                                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                                </svg>
                            </button>

                            <!-- Search bar -->
                            <div class="hidden sm:block flex-1 max-w-2xl">
                                <div class="relative">
                                    <input type="text"
                                           placeholder="Search"
                                           class="w-full pl-10 pr-4 py-2 rounded-lg border border-gray-200 focus:border-gray-300 focus:ring-0 text-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right side -->
                        <div class="flex items-center space-x-6">
                            <!-- Messages -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                                <div class="absolute top-0 right-0 w-2 h-2 bg-blue-500 rounded-full"></div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                                </svg>
                            </button>

                            <!-- Notifications -->
                            <button class="relative p-2 text-gray-600 hover:text-gray-900 focus:outline-none">
                                <div class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></div>
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                </svg>
                            </button>

                            <!-- Profile -->
                            <div class="flex items-center space-x-3">
                                <div class="relative flex-shrink-0">
                                    @if($user->image)
                                        <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-8 h-8 rounded-full border-2 border-white">
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-white text-xl font-bold border-2 border-white">
                                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <span class="text-sm font-medium text-gray-700">{{ $user->username }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- JavaScript for mobile sidebar toggle -->
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');

            // Prevent body scroll when sidebar is open
            document.body.classList.toggle('overflow-hidden', !overlay.classList.contains('hidden'));
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', (event) => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            const toggleButton = document.querySelector('button[onclick="toggleSidebar()"]');

            if (!sidebar.contains(event.target) &&
                !toggleButton.contains(event.target) &&
                !overlay.classList.contains('hidden') &&
                window.innerWidth < 1024) {
                toggleSidebar();
            }
        });

        // Handle resize events
        window.addEventListener('resize', () => {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>
