@extends('layouts.master')

@section('content')
<div class="container my-5">
    <h1 class="text-center">Rooms</h1>
    <div class="row">
        @forelse($rooms as $room)
        <div class="col-8 mb-4"> <!-- Each card takes the full width -->
            <div class="card">
                <div class="row g-0">
                    <div class="col-md-6">
                        <img src="{{ asset($room->image ?? 'build/assets/images/default.jpg') }}" 
                             class="img-fluid rounded-start" 
                             alt="{{ $room->name }}">
                    </div>
                    <div class="col-md-4">
                        <button type="button" class="btn btn-primary">
                            New <span class="badge text-bg-secondary"></span>
                          </button>
                        <div class="card-body">
                            <h5 class="card-title">{{ $room->name }}</h5>
                            <p class="card-text">{{ $room->type }}</p>
                            <p class="card-text"><strong>${{ $room->price }}/night</strong></p>
                            <p class="card-text">Capacity: {{ $room->capacity }} persons</p>
                            <p class="card-text">View: {{ $room->window_view ? 'Yes' : 'No' }}</p>
                            <p class="card-text">Services: {{ $room->services }}</p>
                            <a href="{{route('reservations.create')}}" class="btn btn-lg btn-primary">Book Now</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center">No rooms available.</p>
        @endforelse
    </div>
</div>
@endsection
