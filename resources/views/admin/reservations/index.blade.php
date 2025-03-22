@extends('admin.dashboard') {{-- Apni layout file include karein --}}

@section('content')

<style>
    .room-img {
        width: 100%; /* Full width */
        height: 200px; /* Fixed height */
        object-fit: cover; /* Prevents distortion */
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }
</style>

<div class="container">
    <h2 class="text-center">Reservations List</h2>
    <div class="row">
        @foreach($reservations as $reservation)
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <!-- Room Image -->
                @if($reservation->room && $reservation->room->image)
                    <img src="{{ asset('storage/' . $reservation->room->image) }}" class="card-img-top room-img" alt="Room Image">
                @else
                    <img src="https://via.placeholder.com/300x200?text=No+Image" class="card-img-top room-img" alt="No Image">
                @endif
    
                <div class="card-body">
                    <h5 class="card-title">{{ $reservation->name }}</h5>
                    <p class="card-text"><strong>Email:</strong> {{ $reservation->email }}</p>
                    <p class="card-text"><strong>Phone:</strong> {{ $reservation->phone }}</p>
                    <p class="card-text"><strong>Room:</strong> {{ $reservation->room->name }}</p>
                    <p class="card-text"><strong>Check-in:</strong> {{ $reservation->check_in }}</p>
                    <p class="card-text"><strong>Check-out:</strong> {{ $reservation->check_out }}</p>
                    <p class="card-text"><strong>Guests:</strong> {{ $reservation->guests }}</p>
                    <span class="badge bg-success">{{ $reservation->status }}</span>
    
                    <div class="mt-3">
                        <a href="{{ route('admin.reservations.edit', $reservation->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.reservations.destroy', $reservation->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
</div>
@endsection
