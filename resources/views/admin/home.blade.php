@extends('layout.admin.admin')

@section('content')
<div class="space-y-6">
    <!-- Welcome Section -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-900">Welcome back, {{ $user->first_name }}!</h1>
        <p class="mt-2 text-gray-600">Here's what's happening with your platform today.</p>
    </div>

    <!-- Statistics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Users</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalUsers ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Trips -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Trips</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTrips ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Bookings -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100">
                    <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Bookings</h2>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalBookings ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Revenue -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="ml-4">
                    <h2 class="text-sm font-medium text-gray-600">Total Revenue</h2>
                    <p class="text-2xl font-semibold text-gray-900">${{ number_format($totalRevenue ?? 0, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <!-- Statistics Grid with Real-time API Data and Map -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Real-time API Data -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">Real-time Statistics</h2>
                <p class="text-sm text-gray-500">Live data from our API</p>
            </div>
            <div class="p-6">
                <div id="real-time-stats" class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-gray-600">Active Users</span>
                        <span id="active-users-count" class="text-lg font-semibold text-blue-600">Loading...</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div id="active-users-bar" class="bg-blue-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm font-medium text-gray-600">Server Response Time</span>
                        <span id="server-response" class="text-lg font-semibold text-green-600">Loading...</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div id="server-response-bar" class="bg-green-600 h-2.5 rounded-full" style="width: 0%"></div>
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        <span class="text-sm font-medium text-gray-600">API Requests (24h)</span>
                        <span id="api-requests" class="text-lg font-semibold text-purple-600">Loading...</span>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-sm font-medium text-gray-600 mb-3">Traffic Trend (Last 24h)</h3>
                        <div id="traffic-chart" class="h-40 bg-gray-50 rounded flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span class="text-gray-500">Loading chart data...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Map View -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-medium text-gray-900">User Locations</h2>
                <p class="text-sm text-gray-500">Live user distribution</p>
            </div>
            <div class="p-6">
                <div id="map-container" class="h-64 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="text-gray-500">Loading map data...</span>
                </div>
                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <h3 class="text-xs font-medium text-gray-500">TOP LOCATION</h3>
                        <p id="top-location" class="text-lg font-semibold text-gray-900">Loading...</p>
                    </div>
                    <div class="bg-gray-50 p-3 rounded-lg">
                        <h3 class="text-xs font-medium text-gray-500">ACTIVE REGIONS</h3>
                        <p id="active-regions" class="text-lg font-semibold text-gray-900">Loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
