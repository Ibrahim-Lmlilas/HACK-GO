<div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-40 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-sm">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-4 border-b">
                <h3 class="text-lg font-medium text-gray-900">Edit Profile</h3>
                <button onclick="closeEditProfileModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <!-- Modal Body -->
            <div class="p-5">
                <form id="editProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="flex items-center justify-center mb-5">
                        <div class="relative">
                            <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden">
                                @if(Auth::user()->profile_photo)
                                    <img src="{{ Storage::url(Auth::user()->profile_photo) }}"
                                         alt="Profile"
                                         class="w-full h-full object-cover"
                                         id="profileImage">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'Admin') }}&background=f3f4f6&color=374151"
                                         alt="Profile"
                                         class="w-full h-full object-cover"
                                         id="profileImage">
                                @endif
                            </div>
                            <label for="profile_photo" class="absolute bottom-0 right-0 bg-black text-white p-1.5 rounded-full cursor-pointer hover:bg-gray-800">
                                <i class="fas fa-camera text-xs"></i>
                                <input type="file" name="profile_photo" id="profile_photo" class="hidden" accept="image/*">
                            </label>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="username" class="block text-sm font-medium text-gray-600">Username</label>
                                <input type="text" name="username" id="username" value="{{ Auth::user()->name }}"
                                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-gray-400 focus:ring-gray-400 text-sm h-9 px-3">
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-600">Role</label>
                                <input type="text" value="{{ ucfirst(Auth::user()->role) }}" disabled
                                       class="mt-1 block w-full rounded border-gray-200 bg-gray-50 text-gray-500 text-sm h-9 px-3">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-600">First Name</label>
                                <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}"
                                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-gray-400 focus:ring-gray-400 text-sm h-9 px-3">
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-600">Last Name</label>
                                <input type="text" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}"
                                       class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-gray-400 focus:ring-gray-400 text-sm h-9 px-3">
                            </div>
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                            <input type="email" name="email" id="email" value="{{ Auth::user()->email }}"
                                   class="mt-1 block w-full rounded border-gray-300 shadow-sm focus:border-gray-400 focus:ring-gray-400 text-sm h-9 px-3">
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="flex items-center justify-end p-4 border-t gap-2">
                        <button type="submit" class="px-3 py-1.5 bg-black text-white text-sm rounded hover:bg-gray-800">
                            Save Changes
                        </button>
                        <button type="button" onclick="closeEditProfileModal()" class="px-3 py-1.5 bg-gray-100 text-gray-700 text-sm rounded hover:bg-gray-200">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
