@extends('layout.client.client')

@section('content')
<div class="container mx-auto px-2 sm:px-4 py-4 sm:py-6">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-lg sm:text-xl font-bold mb-3 sm:mb-4 text-gray-800">My Trip Channels</h1>

        @if($channels->isEmpty())
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-5 text-center">
                <p class="text-gray-600">You haven't joined any trip channels yet.</p>
                <a href="{{ route('client.trips.index') }}" class="mt-3 inline-block bg-green-600 text-white px-4 py-1.5 rounded hover:bg-green-700 text-sm transition">
                    Browse Trips
                </a>
            </div>
        @else
            <div class="grid gap-4">
                @foreach($channels as $channel)
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-100">
                        <div class="p-3 sm:p-4">
                            <div class="flex flex-col sm:flex-row items-start justify-between">
                                <div class="flex-1 mr-0 sm:mr-4 mb-3 sm:mb-0 w-full">
                                    <h2 class="text-lg text-black font-semibold mb-1">{{ $channel->trip->name }}</h2>
                                    <h6 class="text-gray-500 text-xs mb-2">{{ $channel->trip->destination->name }}</h6>

                                    <div class="flex flex-wrap items-center text-xs text-gray-500 gap-3 sm:gap-6">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            <span>{{ $channel->trip->start_date->format('M d') }} - {{ $channel->trip->end_date->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-users mr-1"></i>
                                            <span>{{ $channel->users->count() }} members</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('client.chat.show', $channel) }}"
                                   class="bg-green-600 text-white px-3 py-1.5 rounded text-sm hover:bg-green-700 transition w-full sm:w-auto text-center">
                                    Open Chat
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
