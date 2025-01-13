@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Reserved Rooms</h2>
    <div class="row">
        @foreach($hotel as $room)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <img src="{{ asset($room->image) }}" class="card-img-top" alt="Image of {{ $room->name }}">
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
<div class="container mt-4">
    <h2 class="text-center">Our Hotel Rooms</h2>
    <div class="row">
        @foreach($hotel as $rooms)
        <div class="col-md-4">
            <div class="card shadow-sm">
                <img src="{{ asset('images/pic.jpg') }}" class="card-img-top" alt="Room">
                <div class="card-body">
                    <h5 class="card-title">{{ $rooms->room_type }}</h5>
                    <p>Guests: {{ $rooms->guests }}</p>
                    <p>Check-in: {{ $rooms->check_in }}</p>
                    <a href="{{ route('hotel.show', $rooms->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
