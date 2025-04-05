@extends('layout.admin.admin')

@section('content')
<div class="container mx-auto px-4">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold text-indigo-800">Edit Transport: {{ $transport->name }}</h1>
        <a href="{{ route('admin.transports.index') }}" class="bg-indigo-500 hover:bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg flex items-center transition duration-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to Transports
        </a>
    </div>

    @if($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6 border-t-4 border-indigo-500">
        <form action="{{ route('admin.transports.update', $transport) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <!-- Type Field -->
                <div>
                    <label for="type" class="block text-sm font-medium text-indigo-700 mb-1">Type</label>
                    <select name="type" id="type"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required>
                        <option value="">Select a type</option>
                        @foreach(['car', 'bus', 'van', 'motorcycle', 'bicycle', 'boat', 'other'] as $type)
                            <option value="{{ $type }}" {{ old('type', $transport->type) == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Capacity Field -->
                <div>
                    <label for="capacity" class="block text-sm font-medium text-indigo-700 mb-1">Capacity (persons)</label>
                    <input type="number" name="capacity" id="capacity" min="1"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required placeholder="Number of persons" value="{{ old('capacity', $transport->capacity) }}">
                </div>

                <!-- Price Per Day Field -->
                <div>
                    <label for="price_per_day" class="block text-sm font-medium text-indigo-700 mb-1">Price Per Day ($)</label>
                    <input type="number" name="price_per_day" id="price_per_day" step="0.01" min="0"
                        class="w-full py-3 px-4 rounded-md border-indigo-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                        required placeholder="0.00" value="{{ old('price_per_day', $transport->price_per_day) }}">
                </div>
            </div>

            <!-- Image Upload Field -->
            <div class="mt-6">
                <label for="image" class="block text-sm font-medium text-indigo-700 mb-1">Transport Image</label>

                @if($transport->image)
                    <div class="mb-3">
                        <p class="text-sm text-gray-600 mb-2">Current image:</p>
                        <img src="{{ asset('storage/' . $transport->image) }}" alt="{{ $transport->name }}" class="h-40 w-auto object-cover rounded-md shadow-sm">
                    </div>
                @endif

                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-indigo-300 border-dashed rounded-md hover:border-indigo-500 transition-colors bg-indigo-50">
                    <div class="space-y-1 text-center">
                        <svg class="mx-auto h-12 w-12 text-indigo-400" stroke="currentColor" fill="none" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a3 3 0 01-3-3V6a3 3 0 013-3h10a3 3 0 013 3v7a3 3 0 01-3 3H7zm.293 1.293a1 1 0 011.414 0L11 19.586V14h2v5.586l2.293-2.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                        </svg>
                        <div class="flex text-sm text-indigo-600 justify-center">
                            <label for="image" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500 px-2 py-1 shadow-sm">
                                <span>Upload a new image</span>
                                <input id="image" name="image" type="file" class="sr-only" accept="image/*">
                            </label>
                            <p class="pl-1 self-center">or drag and drop</p>
                        </div>
                        <p class="text-xs text-indigo-500">PNG, JPG, GIF up to 2MB</p>
                        <p id="selected-file" class="text-sm text-indigo-600 mt-2 hidden"></p>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex justify-end space-x-3">
                <a href="{{ route('admin.transports.index') }}" class="py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                    Cancel
                </a>
                <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-300">
                    Update Transport
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File input functionality
        const imageInput = document.getElementById('image');
        const selectedFileText = document.getElementById('selected-file');

        if (imageInput) {
            imageInput.addEventListener('change', function(e) {
                const fileName = e.target.files[0]?.name || 'No file selected';
                selectedFileText.textContent = 'Selected file: ' + fileName;
                selectedFileText.classList.remove('hidden');
            });
        }
    });
</script>
@endpush