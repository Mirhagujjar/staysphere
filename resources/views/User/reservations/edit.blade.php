@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card p-4 shadow rounded">
        <h3 class="text-center mb-4">Edit Reservation</h3>
        

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Add success message display --}}
       @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Room ID (hidden) --}}
            <input type="hidden" name="room_id" value="{{ $reservation->room_id }}">

            {{-- Display room info for reference --}}
            <div class="mb-3">
                <label class="form-label">Room</label>
                <p class="form-control-plaintext">
                    {{ $reservation->room->name }} ({{ $reservation->room->room_type }})
                </p>
            </div>

            {{-- Name --}}
            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $reservation->name }}" readonly>
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $reservation->email }}" readonly>
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ $reservation->phone }}" readonly>
            </div>

            {{-- Check-in --}}
            <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" name="check_in" class="form-control" value="{{ $reservation->check_in }}" required>
            </div>

            {{-- Check-out --}}
            <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" name="check_out" class="form-control" value="{{ $reservation->check_out }}" required>
            </div>

            {{-- Room Type --}}
            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <select name="room_type" class="form-select" required>
                    @php
                        $roomTypes = \App\Models\Room::distinct()->pluck('room_type');
                    @endphp

                    @foreach($roomTypes as $type)
                        <option value="{{ $type }}" {{ $reservation->room_type == $type ? 'selected' : '' }}>
                            {{ ucfirst($type) }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Guests --}}
            <div class="mb-3">
                <label class="form-label">Number of Guests</label>
                <input type="number" name="guests" class="form-control" value="{{ $reservation->guests }}" min="1" required>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Update Reservation</button>
                <a href="{{ route('user.reservations.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>

{{-- Date validation - ensure check_out is after check_in --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');
    
    checkIn.addEventListener('change', function() {
        checkOut.min = this.value;
        if(new Date(checkOut.value) < new Date(this.value)) {
            checkOut.value = this.value;
        }
    });
});
</script>
@endsection
