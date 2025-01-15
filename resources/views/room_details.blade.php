@extends('layouts.master')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('images/' . $room->image) }}" class="img-fluid" alt="{{ $room->name }}">
        </div>
        <div class="col-md-6">
            <h2>{{ $room->name }}</h2>
            <p><strong>Price:</strong> ${{ $room->price }} per night</p>
            <p><strong>Capacity:</strong> {{ $room->capacity }} guests</p>
            <p><strong>Room Type:</strong> {{ $room->type }}</p>
            <p><strong>Window View:</strong> {{ $room->window_view ? 'Yes' : 'No' }}</p>
            <p><strong>Services:</strong> {{ $room->services }}</p>
            <a href="{{ route('booking.form', $room->id) }}" class="btn btn-primary">Book Now</a>
        </div>
    </div>
</div>
@endsection
