<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Notifications') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if($notifications->count() > 0)
                        <div class="space-y-4">
                            @foreach($notifications as $notification)
                                <div class="flex items-center justify-between p-4 {{ $notification->is_read ? 'bg-gray-50' : 'bg-white' }} border rounded-lg">
                                    <div class="flex-1">
                                        <p class="text-gray-800 {{ $notification->is_read ? 'font-normal' : 'font-semibold' }}">
                                            {{ $notification->message }}
                                        </p>
                                        <p class="text-sm text-gray-500">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                    @if(!$notification->is_read)
                                        <form action="{{ route('notifications.mark-read', $notification) }}" method="POST" class="ml-4">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-sm text-blue-600 hover:text-blue-800">
                                                Mark as read
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">No notifications yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
