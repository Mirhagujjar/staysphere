@extends('admin.dashboard')

@section('content')
<div class="container">
    <h2>Reservation Details</h2>
    <p><strong>Room:</strong> {{ $reservation->room->room_name }}</p>
    <p><strong>Check-in:</strong> {{ $reservation->checkin_date }}</p>
    <p><strong>Check-out:</strong> {{ $reservation->checkout_date }}</p>
    <p><strong>Guest Name:</strong> {{ $reservation->guest_name }}</p>
    <p><strong>Guest Email:</strong> {{ $reservation->guest_email }}</p>
</div>
@endsection
