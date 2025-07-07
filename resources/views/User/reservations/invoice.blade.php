@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Invoice</h2>

    <p><strong>Name:</strong> {{ $reservation->name }}</p>
    <p><strong>Email:</strong> {{ $reservation->email }}</p>
    <p><strong>Phone:</strong> {{ $reservation->phone }}</p>

    <h4>Room Details:</h4>
    <p><strong>Room:</strong> {{ $reservation->room->room_name }}</p>
    <p><strong>Type:</strong> {{ $reservation->room->roomType->label ?? '-' }}</p>
    <p><strong>Price/night:</strong> Rs {{ $reservation->room->price }}</p>

    <h4>Dates:</h4>
    <p><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
    <p><strong>Check-out:</strong> {{ $reservation->check_out }}</p>

    <h4>Services:</h4>
    <ul>
        @forelse($reservation->services as $service)
            <li>{{ $service->name }} - Rs {{ $service->price }}</li>
        @empty
            <li>No services selected</li>
        @endforelse
    </ul>

    <h4>Total:</h4>
    @php
        $days = \Carbon\Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out);
        $roomTotal = $days * $reservation->room->price;
        $servicesTotal = $reservation->services->sum('price');
        $total = $roomTotal + $servicesTotal;
    @endphp

    <p><strong>Room Total ({{ $days }} nights):</strong> Rs {{ $roomTotal }}</p>
    <p><strong>Services Total:</strong> Rs {{ $servicesTotal }}</p>
    <p><strong>Grand Total:</strong> Rs {{ $total }}</p>

    <a href="{{ route('user.reservations.invoice.pdf', $reservation->id) }}" class="btn btn-primary">
        Download PDF
    </a>

</div>
@endsection
