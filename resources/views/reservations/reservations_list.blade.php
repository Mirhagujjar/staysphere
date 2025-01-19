@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Reservations List</h2>
    <div class="row">
        @foreach($reservation as $reservations)
        <div class="col-md-4 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">{{ $reservations->name }}</h5>
                    <p>Email: {{ $reservations->email }}</p>
                    <p>Phone: {{ $reservations->phone }}</p>
                    <p>Check-in: {{ $reservations->check_in }}</p>
                    <p>Check-out: {{ $reservations->check_out }}</p>
                    <p>Room Type: {{ $reservations->room_type }}</p>
                    <p>Guests: {{ $reservations->guests }}</p>

                    <a href="{{ route('reservations.show', $reservations->id) }}" class="btn btn-primary">View Details</a>
                    <a href="{{ route('reservations.edit', $reservations->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('reservations.destroy', $reservations->id) }}" method="POST" style="display: inline-block;">
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
