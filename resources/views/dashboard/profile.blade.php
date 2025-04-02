@extends('layout.dashboard')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div class="relative bg-gray-50/50 p-6">
            @if($user->banner_image)
                <div class="absolute inset-0 z-0 overflow-hidden">
                    <img src="{{ asset('uploads/images/' . $user->banner_image) }}" alt="Banner" class="w-full h-full object-cover opacity-40">
                </div>
            @endif
            <div class="flex items-center space-x-4">
                <div class="relative flex-shrink-0">
                    @if($user->image)
                        <img src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}" class="w-16 h-16 rounded-full border-2 border-white">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 text-xl font-bold border-4 border-gray-50">
                            {{ strtoupper(substr($user->first_name, 0, 1)) }}{{ strtoupper(substr($user->last_name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <div class="flex-grow">
                    <h1 class="text-2xl  text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h1>
                    <p class="text-gray-900 ">{{ '@' . $user->username }}</p>
                    <div class="mt-2 flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-gray-50 text-gray-900 rounded-full text-sm">Member since {{ $user->created_at->format('M Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Navigation -->
        <div class="bg-white border-b">
            <div class="px-6">
                <ul class="flex overflow-x-auto -mb-px text-sm font-medium">
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-[#FF5722] border-b-2 border-[#FF5722]">Profile</a>
                    </li>
                    <li class="mr-6">
                        <a href="{{ route('profile.preferences') }}" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Travel Preferences</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Bookings</a>
                    </li>
                    <li class="mr-6">
                        <a href="#" class="inline-block py-4 text-gray-500 hover:text-[#FF5722] transition-colors">Reviews</a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Profile Content -->
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-600 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Personal Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white border rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Personal Information</h2>
                        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" name="first_name" id="first_name" value="{{ $user->first_name }}"
                                           class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                </div>
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" name="last_name" id="last_name" value="{{ $user->last_name }}"
                                           class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="username" class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                                    <input type="text" name="username" id="username" value="{{ $user->username }}"
                                           class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ $user->email }}"
                                           class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                </div>
                            </div>

                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                                <input type="text" name="phone" id="phone" value="{{ $user->phone }}"
                                       class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                            </div>

                            <div>
                                <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Bio</label>
                                <textarea name="bio" id="bio" rows="4"
                                          class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">{{ $user->bio }}</textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Image</label>
                                    <div class="mt-1 flex items-center">
                                        <input type="file" name="image" id="image"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#cb2768]     hover:file:bg-orange-100">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Banner Image</label>
                                    <div class="mt-1 flex items-center">
                                        <input type="file" name="banner_image" id="banner_image"
                                               class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-orange-50 file:text-[#cb2768] hover:file:bg-orange-100">
                                    </div>
                                    <p class="text-xs text-gray-500 mt-2">Recommended size: 1200 x 300 pixels</p>
                                </div>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                        class="px-6 py-2.5 bg-[#FF5722] text-white rounded-lg hover:bg-[#F4511E] focus:outline-none focus:ring-2 focus:ring-[#FF5722] focus:ring-offset-2 transition-colors">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div>
                    <div class="bg-white border rounded-lg p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-6">Security Settings</h2>
                        <form action="{{ route('profile.update.password') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <div>
                                <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                                <input type="password" name="current_password" id="current_password"
                                       class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                @error('current_password')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                                <input type="password" name="password" id="password"
                                       class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                                @error('password')
                                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                       class="w-full px-4 py-2.5 bg-gray-50 text-gray-900 rounded-lg border border-gray-200 focus:outline-none focus:ring-2 focus:ring-[#000] focus:border-transparent">
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit"
                                        class="px-6 py-2.5 bg-[#FF5722] text-white rounded-lg hover:bg-[#F4511E] focus:outline-none focus:ring-2 focus:ring-[#000] focus:ring-offset-2 transition-colors">
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
