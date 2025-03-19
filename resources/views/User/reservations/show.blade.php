@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center">Reservation Details</h2>
    <div class="card shadow">
        <div class="card-body">
            <h5 class="card-title">{{ $reservation->name }}</h5>
            <p>Email: {{ $reservation->email }}</p>
            <p>Phone: {{ $reservation->phone }}</p>
            <p>Check-in: {{ $reservation->check_in }}</p>
            <p>Check-out: {{ $reservation->check_out }}</p>
            <p>Room Type: {{ $reservation->room_type }}</p>
            <p>Guests: {{ $reservation->guests }}</p>

            <a href="{{ route('user.reservations.index') }}" class="btn btn-secondary">Back to Reservations</a>
        </div>
    </div>
</div>
@endsection
