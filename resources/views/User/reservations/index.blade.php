@extends('layouts.app')
@section('content')
<div class="container">
    <h2 class="text-center">Reservations List</h2>
    <div class="row">
        @foreach($reservations as $reservation) {{-- Fixed variable name --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->name }}</h5>
                    <p>Email: {{ $reservation->email }}</p>
                    <p>Phone: {{ $reservation->phone }}</p>
                    <p>Check-in: {{ $reservation->check_in }}</p>
                    <p>Check-out: {{ $reservation->check_out }}</p>
                    <p>Room Type: {{ $reservation->room_type }}</p>
                    <p>Guests: {{ $reservation->guests }}</p>

                    <a href="{{ route('user.reservations.show', $reservation->id) }}" class="btn btn-primary">View Details</a>
                    <a href="{{ route('user.reservations.edit', $reservation->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('user.reservations.destroy', $reservation->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
