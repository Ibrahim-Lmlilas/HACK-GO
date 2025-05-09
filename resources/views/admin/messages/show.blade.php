@extends('layout.admin.admin')

@section('content')
<div class="bg-white rounded-lg shadow-md p-4 sm:p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h2 class="text-xl sm:text-2xl font-bold text-gray-800">{{ $channel->name }}</h2>
            @if($channel->description)
                <p class="text-gray-600 mt-1 text-sm sm:text-base">{{ $channel->description }}</p>
            @endif
            @if($channel->trip)
                <div class="mt-2">
                    <span class="text-xs sm:text-sm text-gray-500">Associated Trip: </span>
                    <span class="text-xs sm:text-sm font-medium text-gray-700">{{ $channel->trip->name }}</span>
                    <span class="text-xs text-gray-500 ml-2">({{ $channel->trip->start_date->format('M d, Y') }} - {{ $channel->trip->end_date->format('M d, Y') }})</span>
                </div>
            @endif
        </div>
        <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors text-sm whitespace-nowrap">
            <i class="fas fa-arrow-left mr-2"></i>Back to Channels
        </a>
    </div>

    <div class="mb-6">
        <h3 class="text-md sm:text-lg font-semibold text-gray-700 mb-2">Participants</h3>
        <div class="flex flex-wrap gap-2">
            @foreach($channel->users as $user)
                <span class="inline-flex items-center px-2 sm:px-3 py-1 rounded-full text-xs sm:text-sm font-medium bg-blue-100 text-blue-800">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}" class="w-4 h-4 sm:w-5 sm:h-5 rounded-full mr-1 sm:mr-2">
                    @else
                        <i class="fas fa-user mr-1 sm:mr-2 text-blue-600"></i>
                    @endif
                    {{ $user->name }}
                </span>
            @endforeach
        </div>
    </div>

    <div class="border-t border-gray-200 pt-4 sm:pt-6">
        <h3 class="text-md sm:text-lg font-semibold text-gray-700 mb-3 sm:mb-4">Messages</h3>

        <div class="space-y-3 sm:space-y-4 max-h-[400px] sm:max-h-[600px] overflow-y-auto p-1 sm:p-2">
            @forelse($channel->messages->sortBy('created_at') as $message)
                <div class="flex items-start {{ $message->sender->is_admin ? 'justify-end' : '' }}">
                    <div class="max-w-[85%] sm:max-w-[70%] {{ $message->sender->is_admin ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }} rounded-lg px-3 sm:px-4 py-2 shadow-sm">
                        <div class="flex items-center mb-1 flex-wrap">
                            @if(!$message->sender->is_admin)
                                @if($message->sender->profile_photo)
                                    <img src="{{ Storage::url($message->sender->profile_photo) }}" alt="{{ $message->sender->name }}" class="w-4 h-4 sm:w-5 sm:h-5 rounded-full mr-1 sm:mr-2">
                                @else
                                    <i class="fas fa-user mr-1 sm:mr-2 text-gray-600"></i>
                                @endif
                            @endif
                            <span class="font-medium text-xs sm:text-sm">{{ $message->sender->name }}</span>
                            <span class="text-xs text-gray-500 ml-1 sm:ml-2">{{ $message->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <p class="text-xs sm:text-sm">{{ $message->content }}</p>
                    </div>
                </div>
            @empty
                <div class="text-center py-6 sm:py-8 text-gray-500">
                    <i class="fas fa-comments text-3xl sm:text-4xl mb-2 sm:mb-3 opacity-30"></i>
                    <p class="text-sm sm:text-base">No messages in this channel yet.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
