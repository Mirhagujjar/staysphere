{{-- @extends('layouts.master')

@section('content')
<div class="container mt-4">
    <h2 class="text-center">Hotel Bookings</h2>
    <div class="row">
        @foreach($hotels as $hotel)
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $hotel->name }}</h5>
                    <p>Email: {{ $hotel->email }}</p>
                    <p>Phone: {{ $hotel->phone }}</p>
                    <p>Check-in: {{ $hotel->check_in }}</p>
                    <p>Check-out: {{ $hotel->check_out }}</p>
                    <p>Room Type: {{ $hotel->room_type }}</p>
                    <p>Guests: {{ $hotel->guests }}</p>
                   
                    <a href="{{ route('hotel.edit', $hotel->id) }}" class="btn btn-warning">Edit</a>
                   
                    <form action="{{ route('hotel.destroy', $hotel->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
