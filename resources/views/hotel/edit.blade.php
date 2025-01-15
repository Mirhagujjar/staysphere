{{-- @extends('layouts.master')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Edit Booking</h2>

    <div class="card shadow p-4">
        <form action="{{ route('hotel.update', $hotel->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $hotel->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $hotel->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ $hotel->phone }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" name="check_in" class="form-control" value="{{ $hotel->check_in }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" name="check_out" class="form-control" value="{{ $hotel->check_out }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <select name="room_type" class="form-control" required>
                    <option value="Single" {{ $hotel->room_type == 'Single' ? 'selected' : '' }}>Single Room</option>
                    <option value="Double" {{ $hotel->room_type == 'Double' ? 'selected' : '' }}>Double Room</option>
                    <option value="Suite" {{ $hotel->room_type == 'Suite' ? 'selected' : '' }}>Suite</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Number of Guests</label>
                <input type="number" name="guests" class="form-control" min="1" value="{{ $hotel->guests }}" required>
            </div>

            <button type="submit" class="btn btn-primary w-100">Update Booking</button>
        </form>
    </div>
</div>
@endsection --}}
