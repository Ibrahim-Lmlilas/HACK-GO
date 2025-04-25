@extends('layout.client.client')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">My Trip Channels</h1>

        @if($channels->isEmpty())
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <p class="text-gray-600">You haven't joined any trip channels yet.</p>
                <a href="{{ route('client.trips.index') }}" class="mt-4 inline-block bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
                    Browse Trips
                </a>
            </div>
        @else
            <div class="grid gap-6">
                @foreach($channels as $channel)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div>
                                    <h2 class="text-xl font-semibold mb-2">{{ $channel->trip->name }}</h2>
                                    <p class="text-gray-600 text-sm mb-4">{{ $channel->trip->destination->name }}</p>

                                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <div class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-2"></i>
                                            <span>{{ $channel->trip->start_date->format('M d, Y') }} - {{ $channel->trip->end_date->format('M d, Y') }}</span>
                                        </div>
                                        <div class="flex items-center">
                                            <i class="fas fa-users mr-2"></i>
                                            <span>{{ $channel->users->count() }} members</span>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ route('client.chat', ['channel' => $channel->id]) }}"
                                   class="bg-black text-white px-4 py-2 rounded-lg hover:bg-gray-800 transition">
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
