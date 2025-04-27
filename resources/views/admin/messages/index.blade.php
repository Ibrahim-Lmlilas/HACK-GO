@extends('layout.admin.admin')

@section('content')
<div class=" p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Message Channels</h2>
    </div>



    <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Channel Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trip</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participants</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($channels as $channel)
                <tr class="hover:bg-gray-50 channel-row">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900 channel-name">{{ $channel->name }}</div>
                        @if($channel->description)
                        <div class="text-sm text-gray-500 channel-desc">{{ Str::limit($channel->description, 50) }}</div>
                        @endif
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        @if($channel->trip)
                        <div class="text-sm text-gray-900 trip-name">{{ $channel->trip->name }}</div>
                        <div class="text-xs text-gray-500">{{ $channel->trip->start_date->format('M d, Y') }} - {{ $channel->trip->end_date->format('M d, Y') }}</div>
                        @else
                        <span class="text-sm text-gray-500">No trip associated</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 participants">
                        <div class="flex flex-wrap gap-1">
                            @foreach($channel->users as $user)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $user->name }}
                            </span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $channel->created_at->format('M d, Y') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.messages.show', $channel) }}" class="text-indigo-600 hover:text-indigo-900">View Messages</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                        No message channels found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('.channel-row');

            rows.forEach(row => {
                const channelName = row.querySelector('.channel-name')?.textContent.toLowerCase() || '';
                const channelDesc = row.querySelector('.channel-desc')?.textContent.toLowerCase() || '';
                const tripName = row.querySelector('.trip-name')?.textContent.toLowerCase() || '';
                const participants = row.querySelector('.participants')?.textContent.toLowerCase() || '';

                if (channelName.includes(searchValue) ||
                    channelDesc.includes(searchValue) ||
                    tripName.includes(searchValue) ||
                    participants.includes(searchValue)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</div>
@endsection
