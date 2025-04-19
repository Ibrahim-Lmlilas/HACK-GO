@extends('layout.admin.admin')

@section('content')
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

        <!-- Recent Bookings -->
        <div class="bg-white rounded-2xl p-5">
            <h3 class="text-gray-700 mb-4">Recent Bookings</h3>
            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 overflow-hidden mr-3">
                            <img src="https://ui-avatars.com/api/?name=John+Doe" alt="John Doe" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-medium">John Doe</h4>
                            <p class="text-sm text-gray-600">Marrakech, Morocco</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-600">Mar 15, 2024</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 overflow-hidden mr-3">
                            <img src="https://ui-avatars.com/api/?name=Jane+Smith" alt="Jane Smith" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-medium">Jane Smith</h4>
                            <p class="text-sm text-gray-600">Fes, Morocco</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-600">Mar 14, 2024</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="w-10 h-10 rounded-full bg-blue-100 overflow-hidden mr-3">
                            <img src="https://ui-avatars.com/api/?name=Mike+Johnson" alt="Mike Johnson" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <h4 class="font-medium">Mike Johnson</h4>
                            <p class="text-sm text-gray-600">Chefchaouen, Morocco</p>
                        </div>
                    </div>
                    <span class="text-sm text-gray-600">Mar 13, 2024</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Right sidebar -->
    <div class="w-80 space-y-5">
        <!-- Popular Destinations -->
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8" id="calendar-section">
            <div class="p-6">
                <x-calendar
                    :month="request('month')"
                    :year="request('year')"
                />
            </div>
        </div>

        <!-- To-Do list -->
        <div class="bg-white rounded-2xl p-5">
            <h3 class="font-medium mb-4">Your to-Do list</h3>
            <div class="space-y-3">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-plane"></i>
                    </div>
                    <div>
                        <h4 class="font-medium">Plan Marrakech trip</h4>
                        <p class="text-xs text-gray-500">Mar 20 at 10:00 AM</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <div>
                        <h4 class="font-medium">Book hotel rooms</h4>
                        <p class="text-xs text-gray-500">Mar 21 at 2:00 PM</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-black text-white rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-car"></i>
                    </div>
                    <div>
                        <h4 class="font-medium">Arrange transportation</h4>
                        <p class="text-xs text-gray-500">Mar 22 at 9:00 AM</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Upcoming Trip -->
        <div class="bg-black text-white rounded-2xl p-5">
            <h3 class="font-medium mb-2">Next Trip</h3>
            <div class="flex items-center mb-3">
                <div class="w-2 h-2 rounded-full bg-green-500 mr-2"></div>
                <p class="text-sm">Mar 25 at 8:00 AM</p>
            </div>
            <p class="text-sm text-gray-300">Marrakech, Morocco</p>
        </div>
    </div>
</div>
@endsection
