@extends('layouts.master') 

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Book a Room</h2>

  
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow p-4">
        <form action="{{ route('reservations.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" placeholder="Enter your phone number" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" name="check_in" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" name="check_out" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <select name="room_type" class="form-control" required>
                    <option value="Single">Single Room</option>
                    <option value="Double">Double Room</option>
                    <option value="Suite">Suite</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Number of Guests</label>
                <input type="number" name="guests" class="form-control" min="1" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Book Now</button>
        </form>
    </div>
</div>
@endsection
