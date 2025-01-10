@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Available Rooms</h2>
    <div class="row">
        @foreach($hotel as $room)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $room->name }}</h5>
                    <p><h4>Email:</h4> {{ $room->email }}</p>
                    <p><h4>Phone:</h4> {{ $room->phone }}</p>
                    <p><h4>Check-in:</h4> {{ $room->check_in }}</p>
                    <p><h4>Check-out:</h4> {{ $room->check_out }}</p>
                    <p><h4>Room Type:</h4> {{ $room->room_type }}</p>
                    <p><h4>Guests:</h4> {{ $room->guests }}</p>
                    

                    <!-- Edit Button -->
                    <a href="{{ route('hotel.edit', $room->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('hotel.destroy', $room->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
