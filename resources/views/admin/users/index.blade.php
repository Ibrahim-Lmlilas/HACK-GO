@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')

<div class="container mx-auto px-4 py-6">

        <div class="overflow-hidden rounded-xl border border-gray-100 bg-white">
            <!-- Scrollable table container -->
            <div class="max-h-[500px] overflow-auto">
                <table class="min-w-full divide-y divide-gray-100">
                    <thead class="bg-gray-50 sticky top-0">
                        <tr>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Profile</th>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">First Name</th>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Last Name</th>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="py-3 px-4 text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100" id="userTableBody">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="py-3 px-4">
                                <div class="w-10 h-10 mx-auto rounded-full overflow-hidden border-2 border-green-100">
                                    @if($user->profile_photo)
                                        <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=92C919&color=ffffff" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                    @endif
                                </div>
                            </td>
                            <td class="py-3 px-4 text-sm text-center font-medium text-gray-700">{{ $user->first_name }}</td>
                            <td class="py-3 px-4 text-sm text-center font-medium text-gray-700">{{ $user->last_name }}</td>
                            <td class="py-3 px-4 text-sm text-center text-gray-500">{{ $user->email }}</td>
                            <td class="py-3 px-4 text-center">
                                @if($user->role === 'admin')
                                    <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                        Admin
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        {{ $user->role }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-center">
                                <button onclick="openDeleteModal({{ $user->id }})" class="text-white bg-red-500 hover:bg-red-600 rounded-full px-4 py-1.5 transition duration-300 ease-in-out flex items-center gap-2 mx-auto">
                                    <i class="fas fa-trash text-xs"></i>
                                    <span class="text-xs font-medium">Delete</span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">
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
