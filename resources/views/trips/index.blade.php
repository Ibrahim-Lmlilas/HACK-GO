@extends('layout.admin.admin')

@section('content')
@extends('partials.profile.Profile_Information')
@extends('partials.profile.Edit_Profile')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2>Available Trips</h2>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('admin.trips.create') }}" class="btn btn-primary">Add New Trip</a>
        </div>
    </div>

    <div class="row">
        @foreach($trips as $trip)
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $trip->name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $trip->destination->name }}</h6>
                    <img src="{{ $trip->destination->image_url }}" alt="" class="card-img-top w-20 h-20 ">
                    <p class="card-text">{{ Str::limit($trip->description, 100) }}</p>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="h5">${{ number_format($trip->price, 2) }}</span>
                        <a href="{{ route('admin.trips.show', $trip) }}" class="btn btn-info">View Details</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
