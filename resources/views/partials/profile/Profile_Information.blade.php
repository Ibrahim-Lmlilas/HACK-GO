<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm">
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Profile Information</h3>
                <button onclick="closeProfileModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="p-5">
                <div class="flex items-center justify-center mb-5">
                    <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ Storage::url(Auth::user()->profile_photo) }}"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=f3f4f6&color=374151"
                                 alt="Profile"
                                 class="w-full h-full object-cover">
                        @endif
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Username</label>
                            <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Role</label>
                            <p class="mt-1 text-sm text-gray-900">{{ ucfirst(Auth::user()->role) }}</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-600">First Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->first_name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-600">Last Name</label>
                            <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->last_name }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-600">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ Auth::user()->email }}</p>
                    </div>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="flex items-center justify-end p-4 border-t gap-2">
                <button onclick="openEditProfileModal()" class="px-3 py-1.5 bg-black text-white text-sm rounded hover:bg-gray-800">
                    Edit Profile
                </button>
                <button onclick="closeProfileModal()" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded hover:bg-gray-200">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
