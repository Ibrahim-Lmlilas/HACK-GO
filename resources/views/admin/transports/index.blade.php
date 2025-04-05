@extends('layout.admin.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-indigo-800">Transport Management</h1>
        <div class="flex items-center space-x-4">
            
            <a href="{{ route('admin.transports.create') }}" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition duration-300">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add New Transport
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <!-- No results message -->
        <div id="noResultsMessage" class="col-span-full hidden">
            <div class="bg-white rounded-lg shadow-md p-6 text-center">
                <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-gray-600 mt-4">No transports match your search.</p>
                <button onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchInput').dispatchEvent(new Event('keyup'));"
                    class="mt-4 inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    Clear Search
                </button>
            </div>
        </div>

        @forelse($transports as $transport)
            <div class="transport-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative h-56 bg-gray-200">
                    @if($transport->image)
                        <img src="{{ asset('storage/' . $transport->image) }}" alt="{{ $transport->name }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-200 text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m7 0a2 2 0 104 0"/>
                            </svg>
                        </div>
                    @endif

                    <!-- Type badge at top left -->
                    <div class="absolute top-2 left-2 bg-black bg-opacity-50 rounded-lg px-2 py-1 flex items-center">
                        <span class="text-white text-xs font-medium capitalize">{{ $transport->type }}</span>
                    </div>

                    <!-- Price badge at top right -->
                    <div class="absolute top-2 right-2 bg-indigo-600 text-white px-2 py-1 rounded-lg font-bold">
                        ${{ number_format($transport->price_per_day, 2) }}/day
                    </div>

                    <!-- Status badge -->
                    <div class="absolute bottom-2 left-2 rounded-lg px-2 py-1 text-xs font-bold
                        @if($transport->availability_status == 'available') bg-green-500 text-white
                        @elseif($transport->availability_status == 'booked') bg-red-500 text-white
                        @else bg-yellow-500 text-white @endif">
                        {{ ucfirst($transport->availability_status) }}
                    </div>

                    <!-- Transport name overlay at bottom of image -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-white">{{ $transport->name }}</h3>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.transports.edit', $transport) }}" class="text-white bg-green-500 hover:bg-green-600 p-2 rounded-lg transition duration-300">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </a>

                                <form action="{{ route('admin.transports.destroy', $transport) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this transport?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-white bg-red-500 hover:bg-red-600 p-2 rounded-lg transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-4">
                    <!-- Capacity info -->
                    <div class="flex items-center text-gray-600 mb-2">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="text-sm">Capacity: {{ $transport->capacity }} {{ $transport->capacity > 1 ? 'persons' : 'person' }}</span>
                    </div>

                    <div class="mt-2">
                        <p class="text-gray-600 text-sm line-clamp-2">{{ $transport->description }}</p>
                    </div>

                    @if($transport->features)
                        <div class="mt-3 flex flex-wrap gap-2">
                            @foreach(array_slice($transport->features, 0, 3) as $feature)
                                <span class="bg-gray-100 text-gray-800 text-xs px-2 py-1 rounded-full">{{ $feature }}</span>
                            @endforeach
                            @if(count($transport->features) > 3)
                                <span class="bg-indigo-100 text-indigo-800 text-xs px-2 py-1 rounded-full">+{{ count($transport->features) - 3 }} more</span>
                            @endif
                        </div>
                    @endif

                    @if($transport->destination)
                        <div class="mt-3 pt-3 border-t border-gray-100 flex items-center text-indigo-600">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-sm font-medium">Destination: {{ $transport->destination->location }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m7 0a2 2 0 104 0"/>
                    </svg>
                    <p class="text-gray-600 mt-4">No transports found.</p>
                    <a href="{{ route('admin.transports.create') }}" class="mt-4 inline-block bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                        Add Your First Transport
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $transports->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const transportCards = document.querySelectorAll('.transport-card');

            let visibleCount = 0;

            transportCards.forEach(card => {
                const nameElement = card.querySelector('h3');
                const typeElement = card.querySelector('.capitalize');

                const name = nameElement ? nameElement.textContent.toLowerCase() : '';
                const type = typeElement ? typeElement.textContent.toLowerCase() : '';

                // Search in transport name and type
                if (name.includes(searchValue) || type.includes(searchValue)) {
                    card.style.display = '';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Show a message if no results found
            const noResultsMessage = document.getElementById('noResultsMessage');
            if (noResultsMessage) {
                if (visibleCount === 0 && searchValue !== '') {
                    noResultsMessage.classList.remove('hidden');
                } else {
                    noResultsMessage.classList.add('hidden');
                }
            }
        });
    }
});
</script>
@endsection
