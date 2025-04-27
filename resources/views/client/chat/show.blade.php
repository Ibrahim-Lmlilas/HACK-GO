@extends('layout.client.client')

@section('content')

<div class="h-4/5 flex flex-col bg-gray-50">
    <!-- Channel Header -->
    <div class="bg-white px-6 py-4 border-b shadow-sm">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-2">
                <div>
                    <h1 class="text-xl font-semibold text-green-800">{{ $channel->trip->name }}</h1>
                    <p class="text-sm text-gray-600">{{ $channel->trip->destination->name }}</p>
                </div>
            </div>
            <a href="{{ route('client.chat') }}" class="text-green-700 hover:text-green-900 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Back
            </a>
        </div>
    </div>

    <!-- Messages Container - Fixed height to prevent page scrolling -->
    <div class="flex-1 overflow-y-auto p-4" id="messages-container">
        @foreach($messages as $message)
            <div class="mb-4 {{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                <div class="inline-block max-w-[70%] {{ $message->sender_id === Auth::id() ? 'bg-green-800 text-white' : 'bg-green-50 text-gray-900' }} rounded-lg px-4 py-2 shadow-sm">
                    @if($message->sender_id !== Auth::id())
                        <div class="text-xs font-medium mb-1">{{ $message->sender->name }}</div>
                    @endif
                    <div class="text-sm">{{ $message->content }}</div>
                    <div class="text-xs {{ $message->sender_id === Auth::id() ? 'text-green-200' : 'text-green-700' }} mt-1">
                        {{ $message->created_at->format('H:i') }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Message Input -->
    <div class="bg-white border-t p-4">
        <form action="{{ route('client.chat.store', $channel) }}" method="POST" class="flex gap-2">
            @csrf
            <input type="text" name="message"
                   class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-green-700 focus:border-transparent"
                   placeholder="Type your message..." required>
            <button type="submit"
                    class="bg-green-800 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition flex items-center">
                <span>Send
                    <i class="fas fa-paper-plane ml-2"></i>
                </span>
            </button>
        </form>
    </div>
</div>

@push('scripts')
<script>
    const messagesContainer = document.getElementById('messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
</script>
@endpush
@endsection
