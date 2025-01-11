@extends('layouts.master')

@section('content')
<div class="container">
    <h2>Hotel Bookings</h2>
    <div class="row">
        @foreach($hotel as $hotels)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotels->name }}</h5>
                    <p>Email: {{ $hotels->email }}</p>
                    <p>Phone: {{ $hotels->phone }}</p>
                    <p>Check-in: {{ $hotels->check_in }}</p>
                    <p>Check-out: {{ $hotels->check_out }}</p>
                    <p>Room Type: {{ $hotels->room_type }}</p>
                    <p>Guests: {{ $hotels->guests }}</p>

                    <!-- Edit Button -->
                    <a href="{{ route('hotel.edit', $hotels->id) }}" class="btn btn-warning">Edit</a>

                    <!-- Delete Button -->
                    <form action="{{ route('hotel.destroy', $hotels->id) }}" method="POST" style="display:inline;">
                        @csrf 
                        {{-- @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button> --}}
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
