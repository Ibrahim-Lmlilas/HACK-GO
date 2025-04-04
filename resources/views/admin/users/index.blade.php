@extends('layout.admin.admin')

@section('content')
<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">User Management</h1>
            <p class="mt-1 text-sm text-gray-600">Manage all users in your system</p>
        </div>

    </div>



    <!-- Users Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($users as $user)
        @if($user->role !== 'admin')
        <div class="user-card bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 hover:shadow-md transition-shadow duration-300">
            <div class="p-4 flex flex-col items-center">
                <!-- User Avatar -->
                <div class="relative">
                    @if($user->image)
                        <img class="h-20 w-20 rounded-full object-cover border-2 border-gray-200" src="{{ asset('uploads/images/' . $user->image) }}" alt="{{ $user->username }}">
                    @else
                        <div class="h-20 w-20 rounded-full bg-gray-700 flex items-center justify-center text-white text-xl font-bold border-2 border-gray-200">
                            {{ strtoupper(substr($user->first_name ?? '', 0, 1)) }}{{ strtoupper(substr($user->last_name ?? '', 0, 1)) }}
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="mt-4 text-center">
                    <h3 class="text-lg font-semibold text-gray-900">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    <p class="text-sm text-gray-500">{{ $user->username }}</p>
                    <p class="text-sm text-gray-500 mt-1">{{ $user->email }}</p>
                </div>

                <!-- Action Buttons -->
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('admin.users.show', $user) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-500 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-400">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </a>

                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md text-white bg-gray-500 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400" onclick="return confirm('Are you sure you want to delete this user?')">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @endif

        @empty
        <div class="col-span-full bg-white rounded-lg shadow-sm p-6 text-center text-gray-500">
            No users found
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="bg-white rounded-lg shadow-sm px-4 py-3 sm:px-6">
        <div class="flex items-center justify-between">
            <div class="flex-1 flex justify-between sm:hidden">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        Showing
                        <span class="font-medium">1</span>
                        to
                        <span class="font-medium">{{ count($users ?? []) }}</span>
                        of
                        <span class="font-medium">{{ $totalUsers ?? 0 }}</span>
                        results
                    </p>
                </div>
                <div>
                    {{ $users->links() ?? '' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const userCards = document.querySelectorAll('.user-card');

            userCards.forEach(card => {
                const userInfo = card.querySelector('.text-center');
                const userName = userInfo.querySelector('h3').textContent.toLowerCase();
                const userUsername = userInfo.querySelector('p:nth-of-type(1)').textContent.toLowerCase();
                const userEmail = userInfo.querySelector('p:nth-of-type(2)').textContent.toLowerCase();

                // Search in name, email, and username
                if (userName.includes(searchValue) ||
                    userEmail.includes(searchValue) ||
                    userUsername.includes(searchValue)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    } else {
        console.error('Search input element not found');
    }
});
</script>
@endsection
