@extends('layout.admin.admin')

@section('content')
<div class=" p-8 mb-8 max-w-7xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-3xl font-bold text-[#333333]">Reservation Details</h2>
        <a href="{{ route('admin.reservations') }}" class="bg-[#333333] hover:bg-[#222222] text-white py-2.5 px-5 rounded-lg transition duration-300 flex items-center">
            <i class="fas fa-arrow-left mr-2"></i> Back
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-[#b9d432] text-green-700 p-4 mb-6 rounded-r-md shadow-sm" role="alert">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Reservation Information -->
        <div class="bg-white p-6 rounded-xl border transform transition-all duration-300 hover:shadow-lg">
            <h3 class="text-xl font-bold mb-4 pb-2 border-b-2 border-[#b9d432]/30 text-[#333333]">Reservation Information</h3>
            <div class="space-y-4">

            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Date Created:</span>
                <span>{{ $reservation->created_at->format('M d, Y H:i') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Amount:</span>
                <span class="font-bold text-[#b9d432]">{{ $reservation->amount }} MAD</span>
            </div>

            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Status:</span>
                <span class="px-3 py-1 rounded-full text-sm font-medium {{
                $reservation->status === 'completed' ? 'bg-[#b9d432]/20 text-[#6b7819]' :
                ($reservation->status === 'cancelled' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800')
                }}">
                {{ ucfirst($reservation->status) }}
                </span>
            </div>
            @if($reservation->stripe_payment_id)
            <div class="flex justify-between items-center">
                <span class="font-semibold text-gray-700">Payment ID:</span>
                <span class="text-sm font-mono bg-gray-100 px-2 py-1 rounded">{{ $reservation->stripe_payment_id }}</span>
            </div>
            @endif
            </div>

            <!-- Status Update Form -->
            <div class="mt-8 pt-4 border-t border-gray-200">
            <h4 class="font-bold mb-3 text-[#333333]">Update Reservation Status</h4>
            <form action="{{ route('admin.reservations.update-status', $reservation) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex space-x-3">
                <select name="status" class="form-select rounded-lg border-gray-300 shadow-sm focus:border-[#b9d432] focus:ring focus:ring-[#b9d432] focus:ring-opacity-50 flex-grow">
                    <option value="pending" {{ $reservation->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $reservation->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ $reservation->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-[#b9d432] hover:bg-[#a8c129] text-white py-2 px-5 rounded-lg transition duration-300 shadow-md hover:shadow-lg">
                    Update Status
                </button>
                </div>
            </form>
            </div>
        </div>

        <!-- User Information -->
        <div class="bg-white p-6 rounded-xl shadow-md border transform transition-all duration-300 hover:shadow-lg">
            <h3 class="text-xl font-bold mb-4 pb-2 border-b-2 border-[#b9d432]/30 text-[#333333]">User Information</h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Name:</span>
                    <span>{{ $reservation->user->name }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Email:</span>
                    <span class="text-sm">{{ $reservation->user->email }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Phone:</span>
                    <span>{{ $reservation->user->phone ?? 'Not provided' }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="font-semibold text-gray-700">Member Since:</span>
                    <span>{{ $reservation->user->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Trip Information -->
        <div class="bg-light p-6 rounded-xl shadow-md border bg-white md:col-span-2 transform transition-all duration-300 hover:shadow-lg">
            <h3 class="text-xl font-bold mb-4 pb-2 border-b-2 border-[#b9d432]/30 text-[#333333]">Trip Information</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Trip Name:</span>
                        <span class="font-medium">{{ $reservation->trip->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Destination:</span>
                        <span>{{ $reservation->trip->destination->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Start Date:</span>
                        <span>{{ $reservation->trip->start_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">End Date:</span>
                        <span>{{ $reservation->trip->end_date->format('M d, Y') }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Duration:</span>
                        <span class="bg-[#b9d432]/10 text-[#6b7819] px-3 py-1 rounded-lg font-medium">{{ $reservation->trip->start_date->diffInDays($reservation->trip->end_date) + 1 }} days</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Price per Person:</span>
                        <span class="font-bold text-[#b9d432]">{{ $reservation->trip->price }} MAD</span>
                    </div>
                </div>
                <div>
                    <div class="mb-4">
                        <span class="font-semibold text-gray-700 block mb-2">Description:</span>
                        <p class="mt-1 text-gray-600 bg-white p-3 rounded-lg shadow-sm border border-gray-100">{{ $reservation->trip->description }}</p>
                    </div>
                    @if($reservation->trip->destination->image_url)
                    <div class="mt-6">
                        <span class="font-semibold text-gray-700 block mb-2">Destination:</span>
                        <div class="relative overflow-hidden rounded-xl shadow-md">
                            <img src="{{ $reservation->trip->destination->image_url }}" alt="{{ $reservation->trip->destination->name }}" class="w-full h-48 object-cover hover:scale-105 transition-transform duration-500">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-3">
                                <span class="text-white font-bold">{{ $reservation->trip->destination->name }}</span>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
