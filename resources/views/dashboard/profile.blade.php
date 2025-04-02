@extends('layout.dashboard')

@section('content')
<div class="container mx-auto px-4 py-4">
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <!-- Profile Header -->
        <div class="relative bg-gradient-to-r from-amber-600 to-orange-800 p-4">
            @if($user->banner_image)
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('uploads/images/' . $user->banner_image) }}" alt="Banner" class="w-full h-full object-cover opacity-40">
                </div>
            @endif
            <div class="flex items-center space-x-4 relative z-10">
                <div class="relative flex-shrink-0">
                    @if($user->image)
                        <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-16 h-16 rounded-full border-2 border-white">
                    @else
                        <div class="w-16 h-16 rounded-full bg-gray-700 flex items-center justify-center text-white text-xl font-bold border-2 border-white">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <h1 class="text-xl font-bold text-white">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-orange-200 text-sm">{{ '@' . $user->username }}</p>
                    <div class="mt-1 flex flex-wrap gap-2">
                        <span class="px-2 py-0.5 bg-orange-700 rounded-full text-xs text-white">{{ ucfirst($user->role) }}</span>
                        <span class="px-2 py-0.5 bg-orange-700 rounded-full text-xs text-white">Member since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="bg-gray-900 text-white border-b border-gray-700">
            <div class="container mx-auto">
                <ul class="flex overflow-x-auto text-sm">
                    <li class="px-4 py-2 font-medium border-b-2 border-orange-500">Profile</li>
                    <li class="px-4 py-2 font-medium text-gray-400 hover:text-white"><a href="{{ route('profile.preferences') }}">Travel Preferences</a></li>
                    <li class="px-4 py-2 font-medium text-gray-400 hover:text-white">Bookings</li>
                    <li class="px-4 py-2 font-medium text-gray-400 hover:text-white">Reviews</li>
                    <li class="px-4 py-2 font-medium text-gray-400 hover:text-white">Messages</li>
                </ul>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-4">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-3 py-2 rounded mb-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Personal Information -->
                <div class="md:col-span-2">
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-white mb-4">Personal Information</h2>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-300 mb-1">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-300 mb-1">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-300 mb-1">Username</label>
                                    <input type="text" name="username" id="username" value="{{ $user->username }}" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-300 mb-1">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-300 mb-1">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-300 mb-1">Bio</label>
                                <textarea name="bio" id="bio" rows="3" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">{{ $user->bio }}</textarea>
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-300 mb-1">Profile Image</label>
                                <input type="file" name="image" id="image" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm">
                            </div>

                            <div>
                                <label for="banner_image" class="block text-sm font-medium text-gray-300 mb-1">Banner Image</label>
                                <input type="file" name="banner_image" id="banner_image" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent text-sm">
                                <p class="text-xs text-gray-400 mt-1">Recommended size: 1200 x 300 pixels</p>
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div>
                    <div class="bg-gray-700 rounded-lg p-4">
                        <h2 class="text-lg font-semibold text-white mb-4">Security Settings</h2>
                        <form action="{{ route('profile.update.password') }}" method="POST" class="space-y-4">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-300 mb-1">Current Password</label>
                                <input type="password" name="current_password" id="current_password" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                @error('current_password')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-300 mb-1">New Password</label>
                                <input type="password" name="password" id="password" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                                @error('password')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-1">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-3 py-2 bg-gray-600 text-white rounded-lg border border-gray-500 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent">
                            </div>

                            <div class="flex justify-end pt-2">
                                <button type="submit" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-colors">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
