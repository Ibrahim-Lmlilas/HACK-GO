@extends('layout.admin.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-indigo-800">Destinations</h1>
        <a href="{{ route('admin.destinations.create') }}" class="bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg flex items-center transition duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Add New Destination
        </a>
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
                <p class="text-gray-600 mt-4">No destinations match your search.</p>
                <button onclick="document.getElementById('searchInput').value = ''; document.getElementById('searchInput').dispatchEvent(new Event('keyup'));"
                    class="mt-4 inline-block bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                    Clear Search
                </button>
            </div>
        </div>

        @forelse($destinations as $destination)
            <div class="destination-card bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="relative h-56 bg-gray-200">
                    @if($destination->image)
                        <img src="{{ asset('storage/' . $destination->image) }}" alt="{{ $destination->location }}" class="w-full h-full object-cover">
                    @else
                        <div class="flex items-center justify-center h-full bg-gray-200 text-gray-400">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    

                    <!-- Location overlay at bottom of image -->
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                            <div class="flex justify-between items-center">
                                <h3 class="text-xl font-bold text-white">{{ $destination->location }}</h3>

                                <div class="flex space-x-2">

                                    <a href="{{ route('admin.destinations.edit', $destination) }}" class="text-white bg-green-500 hover:bg-green-600 p-2 rounded-lg transition duration-300">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                    </a>

                                    <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this destination?')">
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


            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-white rounded-lg shadow-md p-6 text-center">
                    <svg class="w-16 h-16 mx-auto text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-gray-600 mt-4">No destinations found.</p>
                    <a href="{{ route('admin.destinations.create') }}" class="mt-4 inline-block bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-medium py-2 px-4 rounded-lg transition duration-300">
                        Add Your First Destination
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $destinations->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const destinationCards = document.querySelectorAll('.destination-card');

            let visibleCount = 0;

            destinationCards.forEach(card => {
                const locationElement = card.querySelector('h3');
                const location = locationElement ? locationElement.textContent.toLowerCase() : '';

                // Search in location name
                if (location.includes(searchValue)) {
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
    } else {
        console.error('Search input element not found');
    }
});
</script>
@endsection
