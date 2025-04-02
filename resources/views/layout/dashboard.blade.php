<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="flex h-screen bg-gray-50">
        <!-- Sidebar -->
        <div class="fixed inset-y-0 left-0 w-64 bg-white shadow-sm transition-transform duration-300 transform md:translate-x-0 md:relative md:flex md:flex-col">
            <!-- Logo -->
            <div class="flex items-center h-16 px-6">
                <div class="flex items-center">
                    <img src="images/logo.png" alt="Logo" class="h-20">
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
            <nav class="flex-1 px-4 mt-6 space-y-2">
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

            <!-- Weather Widget -->
            <div class="p-4 mt-auto">
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"/>
                        </svg>
                        <div class="ml-3">
                            <div class="text-2xl font-semibold">30°</div>
                            <div class="text-sm text-gray-500">Sunny</div>
                        </div>
                    </div>
                    <div class="mt-3 flex justify-between text-xs text-gray-500">
                        <span>Mon</span>
                        <span>Tue</span>
                        <span>Wed</span>
                        <span>Thu</span>
                        <span>Fri</span>
                    </div>
                </div>
            </div>

            
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16 items-center">
                        <h2 class="text-2xl font-semibold text-gray-800">Dashboard</h2>

                        <!-- Profile Dropdown -->
                        <div class="relative">
                            <button class="flex items-center space-x-4 focus:outline-none">
                                <img class="h-8 w-8 rounded-full object-cover" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="Profile">
                                <span class="text-gray-700">John Doe</span>
                            </button>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-50">
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Mobile Menu Button -->
    <div class="fixed md:hidden bottom-4 right-4">
        <button id="mobile-menu-button" class="p-2 rounded-full bg-blue-800 text-white shadow-lg hover:bg-blue-700 transition-colors duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>

    <script>
        // Mobile menu functionality
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const sidebar = document.querySelector('.fixed');

        mobileMenuButton.addEventListener('click', () => {
            sidebar.classList.toggle('-translate-x-full');
        });

        // Close sidebar when clicking outside
        document.addEventListener('click', (event) => {
            if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });
    </script>
</body>
</html>
