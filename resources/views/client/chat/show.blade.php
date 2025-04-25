@extends('layout.client.client')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <!-- Channel Header -->
            <div class="bg-gray-50 px-6 py-4 border-b">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl font-semibold">{{ $channel->trip->name }}</h1>
                        <p class="text-sm text-gray-600">{{ $channel->trip->destination->name }}</p>
                    </div>
                    <a href="{{ route('client.chat') }}" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left"></i> Back to Channels
                    </a>
                </div>
            </div>

            <!-- Messages Container -->
            <div class="h-[600px] overflow-y-auto p-6" id="messages-container">
                @foreach($messages as $message)
                    <div class="mb-4 {{ $message->sender_id === Auth::id() ? 'text-right' : 'text-left' }}">
                        <div class="inline-block max-w-[70%] {{ $message->sender_id === Auth::id() ? 'bg-black text-white' : 'bg-gray-100 text-gray-900' }} rounded-lg px-4 py-2">
                            @if($message->sender_id !== Auth::id())
                                <div class="text-xs text-gray-500 mb-1">{{ $message->sender->name }}</div>
                            @endif
                            <div class="text-sm">{{ $message->content }}</div>
                            <div class="text-xs {{ $message->sender_id === Auth::id() ? 'text-gray-300' : 'text-gray-500' }} mt-1">
                                {{ $message->created_at->format('M d, H:i') }}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Message Input -->
            <div class="border-t p-4">
                <form action="{{ route('client.chat.store', $channel) }}" method="POST" class="flex gap-2">
                    @csrf
                    <input type="text" name="message"
                           class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-black focus:border-transparent"
                           placeholder="Type your message..." required>
                    <button type="submit"
                            class="bg-black text-white px-6 py-2 rounded-lg hover:bg-gray-800 transition">
                        Send
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Scroll to bottom of messages container
    const messagesContainer = document.getElementById('messages-container');
    messagesContainer.scrollTop = messagesContainer.scrollHeight;
</script>
@endpush
@endsection
