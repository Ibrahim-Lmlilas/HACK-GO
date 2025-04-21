@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $trip->name }}</h2>
                    <h5 class="text-muted">{{ $trip->destination->name }}</h5>

                    <div class="my-4">
                        <p>{{ $trip->description }}</p>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Start Date:</strong> {{ $trip->start_date->format('M d, Y') }}
                        </div>
                        <div class="col-md-6">
                            <strong>End Date:</strong> {{ $trip->end_date->format('M d, Y') }}
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <strong>Price:</strong> ${{ number_format($trip->price, 2) }}
                        </div>
                        <div class="col-md-6">
                            <strong>Capacity:</strong> {{ $trip->capacity }} persons
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.trips') }}" class="btn btn-secondary">Back to Trips</a>
                        <div>
                            <a href="{{ route('admin.trips.edit', $trip) }}" class="btn btn-primary">Edit Trip</a>
                            <form action="{{ route('admin.trips.destroy', $trip) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
