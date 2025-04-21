@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="container mx-auto px-4">
        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex justify-between items-center mb-6">
                <div class="relative w-1/2">
                    <input type="text" id="searchInput" class="w-full pl-10 pr-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#92472B] transition-colors" placeholder="Search users...">
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        <i class="fas fa-search"></i>
                    </div>
                </div>

            </div>



                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full divide-y divide-gray-200 text-center">
                        <thead class="">
                            <tr>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="py-2 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class=" divide-y " id="userTableBody">
                            @foreach($users as $user)
                            <tr class=" mr-12 ">
                                <td class="py-2  px-4">
                                    <div class="w-8 h-8 mx-auto rounded-full overflow-hidden">
                                        @if($user->profile_photo)
                                            <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=92472B&color=ffffff" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                </td>
                                <td class="py-2 px-4 text-sm">{{ $user->first_name }}</td>
                                <td class="py-2 px-4 text-sm">{{ $user->last_name }}</td>
                                <td class="py-2 px-4 text-sm">{{ $user->email }}</td>
                                <td class="py-2 px-4">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $user->role === 'admin' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>
                                <td class="py-2 px-4">
                                    <button onclick="openDeleteModal({{ $user->id }})" class="text-white mx-auto     bg-red-500 hover:bg-red-600 rounded-lg px-3 py-1.5 transition duration-300 ease-in-out flex items-center gap-2">
                                        <i class="fas fa-trash text-xs"></i>
                                        <span class="text-sm">Delete</span>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    {{ $users->links() }}
                </div>
</div>

<!-- Add User Modal -->


<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg p-8 max-w-sm w-full">
        <div class="text-center">
            <i class="fas fa-exclamation-triangle text-red-500 text-5xl mb-4"></i>
            <h3 class="text-xl font-semibold mb-2">Confirm Deletion</h3>
            <p class="text-gray-600 mb-6">Are you sure you want to delete this user? This action cannot be undone.</p>
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
    function openAddUserModal() {
        document.getElementById('addUserModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAddUserModal() {
        document.getElementById('addUserModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function openDeleteModal(userId) {
        const deleteModal = document.getElementById('deleteModal');
        const deleteForm = document.getElementById('deleteForm');
        deleteForm.action = `/admin/users/${userId}`;
        deleteModal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modals when clicking outside
    window.onclick = function(event) {
        const addUserModal = document.getElementById('addUserModal');
        const deleteModal = document.getElementById('deleteModal');
        if (event.target === addUserModal) {
            closeAddUserModal();
        }
        if (event.target === deleteModal) {
            closeDeleteModal();
        }
    }

    // Search functionality
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const searchValue = this.value.toLowerCase();
        const rows = document.getElementById('userTableBody').getElementsByTagName('tr');

        for (let row of rows) {
            const cells = row.getElementsByTagName('td');
            let found = false;

            for (let cell of cells) {
                if (cell.textContent.toLowerCase().includes(searchValue)) {
                    found = true;
                    break;
                }
            }

            row.style.display = found ? '' : 'none';
        }
    });
</script>
@endsection
