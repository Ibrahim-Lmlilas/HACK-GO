@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container mx-auto px-4">
    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header and Search -->
        <div class="flex justify-between items-center mb-6">
            <div class="relative w-1/2">
                <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#92472B] transition-colors" placeholder="Search trips...">
                <div class="absolute left-3 top-2.5 text-gray-400">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <button onclick="openAddModal()" class="bg-[#92472B] text-white px-4 py-2 rounded-lg hover:bg-[#7d3c25] flex items-center gap-2">
                <i class="fas fa-plus"></i>
                Add New Trip
            </button>
        </div>

        <!-- Trips Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($activities as $activity)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($activity->destination && $activity->destination->image_url)
                    <img src="{{ $activity->destination->image_url }}" alt="{{ $activity->destination->name }}" class="w-full h-48 object-cover">
                @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <i class="fas fa-route text-gray-400 text-4xl"></i>
                    </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center mb-2">
                        <h3 class="text-lg font-semibold">{{ $activity->name }}</h3>
                        <span class="ml-2 text-sm text-gray-600">{{ $activity->destination->name }}</span>
                    </div>
                    <p class="text-gray-600 text-sm mb-2">{{ Str::limit($activity->description, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-[#92472B] font-bold">{{ number_format($activity->price, 2) }} MAD</span>
                            <span class="text-sm text-gray-500">/person</span>
                        </div>
                        <div class="flex space-x-2">
                            <button onclick="openEditModal({{ $activity->id }})" class="text-blue-500 hover:text-blue-700">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="openDeleteModal({{ $activity->id }})" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    <div class="mt-2 flex justify-between text-sm text-gray-500">
                        <span><i class="far fa-calendar"></i> {{ $activity->start_date->format('M d, Y') }}</span>
                        <span><i class="fas fa-users"></i> {{ $activity->capacity }} travelers</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Add/Edit Modal -->
        <div id="activityModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
            <div class="bg-white rounded-lg p-8 max-w-2xl w-full">
                <h2 class="text-2xl font-bold mb-4" id="modalTitle">Add New Trip</h2>
        <form id="activityForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Trip Name</label>
                    <input type="text" name="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Destination</label>
                    <select name="destination_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                        <option value="">Select a destination</option>
                        @foreach($destinations as $destination)
                            <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-span-2">
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea name="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Capacity</label>
                    <input type="number" name="capacity" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Start Date</label>
                    <input type="datetime-local" name="start_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">End Date</label>
                    <input type="datetime-local" name="end_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#92472B] focus:ring focus:ring-[#92472B] focus:ring-opacity-50">
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <button type="button" onclick="closeModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400">Cancel</button>
                <button type="submit" class="bg-[#92472B] text-white px-4 py-2 rounded-md hover:bg-[#7d3c25]">Save Trip</button>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-sm w-full">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this trip? This action cannot be undone.</p>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-center">
                    <button type="button" onclick="closeDeleteModal()" class="bg-gray-300 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-400 mr-2">Cancel</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal functions
    function openAddModal() {
        document.getElementById('modalTitle').textContent = 'Add New Trip';
        document.getElementById('activityForm').reset();
        document.getElementById('activityForm').action = '{{ route("admin.activities.store") }}';
        document.getElementById('activityModal').classList.remove('hidden');
    }

    function openEditModal(id) {
        document.getElementById('modalTitle').textContent = 'Edit Trip';
        // Fetch trip data and populate form
        fetch(`/admin/activities/${id}/edit`)
            .then(response => response.json())
            .then(data => {
                const form = document.getElementById('activityForm');
                form.action = `/admin/activities/${id}`;
                form.name.value = data.name;
                form.description.value = data.description;
                form.price.value = data.price;
                form.capacity.value = data.capacity;
                form.start_date.value = data.start_date;
                form.end_date.value = data.end_date;
                form.destination_id.value = data.destination_id;

                // Add method spoofing for PUT request
                if (!form.querySelector('input[name="_method"]')) {
                    const methodInput = document.createElement('input');
                    methodInput.type = 'hidden';
                    methodInput.name = '_method';
                    methodInput.value = 'PUT';
                    form.appendChild(methodInput);
                }
            });
        document.getElementById('activityModal').classList.remove('hidden');
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const trips = document.querySelectorAll('.activity-card');

        trips.forEach(trip => {
            const name = trip.querySelector('h3').textContent.toLowerCase();
            const description = trip.querySelector('p').textContent.toLowerCase();

            if (name.includes(searchValue) || description.includes(searchValue)) {
                trip.style.display = '';
            } else {
                trip.style.display = 'none';
            }
        });
    });
</script>
@endsection
