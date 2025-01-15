@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Reserved Rooms</h2>
    <div class="row">
        @foreach($hotel as $room)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p>Email: {{ $room->email }}</p>
                    <p>Phone: {{ $room->phone }}</p>
                    <p>Check-in: {{ $room->check_in }}</p>
                    <p>Check-out: {{ $room->check_out }}</p>
                    <p>Room Type: {{ $room->room_type }}</p>
                    <p>Guests: {{ $room->guests }}</p>

                    <!-- View Details Button -->
                    <a href="{{ route('hotel.show', $room->id) }}" class="btn btn-primary">View Details</a>

                    <!-- Edit Button -->
                    <a href="{{ route('hotel.edit', $room->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('hotel.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection













{{-- @extends('layouts.master')

@section('content')
<div class="container">
    <h1>Our Rooms</h1>
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('storage/' . $room->image) }}" class="card-img-top" alt="Room Image">
                    <div class="card-body">
                        <h5 class="card-title">{{ $room->name }}</h5>
                        <p class="card-text">Price: ${{ $room->price }}</p>
                        <p class="card-text">Services: {{ $room->services }}</p>
                        <p class="card-text">View: {{ $room->view }}</p>
                        <a href="{{ route('room.details', $room->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection --}}
