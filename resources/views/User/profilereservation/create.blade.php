@extends('user.layout.master')

@section('content')
<div class="container mt-4">
    <h2>Make a Reservation</h2>

    <form action="{{ route('user.reservations.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="room_id" class="form-label">Select Room</label>
            <select name="room_id" class="form-control" required>
                <option value="">-- Select Room --</option>
                @foreach($rooms as $room)
                    <option value="{{ $room->id }}">{{ $room->room_number }} - {{ $room->type }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="guests" class="form-label">Number of Guests</label>
            <input type="number" name="guests" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_in" class="form-label">Check-In Date</label>
            <input type="date" name="check_in" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="check_out" class="form-label">Check-Out Date</label>
            <input type="date" name="check_out" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>
@endsection
