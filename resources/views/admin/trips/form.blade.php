@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2>{{ isset($trip) ? 'Edit Trip' : 'Create New Trip' }}</h2>

                    <form action="{{ isset($trip) ? route('admin.trips.update', $trip) : route('admin.trips.store') }}" method="POST">
                        @csrf
                        @if(isset($trip))
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label for="name" class="form-label">Trip Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                                value="{{ old('name', $trip->name ?? '') }}">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="destination_id" class="form-label">Destination</label>
                            <select class="form-control @error('destination_id') is-invalid @enderror" id="destination_id" name="destination_id">
                                <option value="">Select Destination</option>
                                @foreach($destinations as $destination)
                                    <option value="{{ $destination->id }}"
                                        {{ old('destination_id', $trip->destination_id ?? '') == $destination->id ? 'selected' : '' }}>
                                        {{ $destination->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="4">{{ old('description', $trip->description ?? '') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control @error('start_date') is-invalid @enderror"
                                    id="start_date" name="start_date"
                                    value="{{ old('start_date', isset($trip) ? $trip->start_date->format('Y-m-d\TH:i') : '') }}">
                                @error('start_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control @error('end_date') is-invalid @enderror"
                                    id="end_date" name="end_date"
                                    value="{{ old('end_date', isset($trip) ? $trip->end_date->format('Y-m-d\TH:i') : '') }}">
                                @error('end_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">Price</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror"
                                    id="price" name="price" value="{{ old('price', $trip->price ?? '') }}">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="capacity" class="form-label">Capacity</label>
                                <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                    id="capacity" name="capacity" value="{{ old('capacity', $trip->capacity ?? '') }}">
                                @error('capacity')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.trips') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">{{ isset($trip) ? 'Update' : 'Create' }} Trip</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
