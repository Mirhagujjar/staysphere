@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Edit Reservation</h2>
    <form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $reservation->name }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $reservation->email }}" required>
        </div>
        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ $reservation->phone }}" required>
        </div>
        <div class="mb-3">
            <label>Check-in</label>
            <input type="date" name="check_in" class="form-control" value="{{ $reservation->check_in }}" required>
        </div>
        <div class="mb-3">
            <label>Check-out</label>
            <input type="date" name="check_out" class="form-control" value="{{ $reservation->check_out }}" required>
        </div>
        <div class="mb-3">
            <label>Room Type</label>
            <input type="text" name="room_type" class="form-control" value="{{ $reservation->room_type }}" required>
        </div>
        <div class="mb-3">
            <label>Guests</label>
            <input type="number" name="guests" class="form-control" value="{{ $reservation->guests }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('user.reservations.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
