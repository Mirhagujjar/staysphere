@extends('layouts.app')

@section('content')
<div class="form-page">
    <div class="form-container">
        <h2 class="heading mb-4 text-center">Update Reservation</h2>

        <form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="room_id" value="{{ $reservation->room->id ?? '' }}">

            <!-- User Information Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Your Information</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                        <input type="tel" id="phone" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                               value="{{ old('phone', $reservation->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Room Assignment Status -->
            @if($reservation->status === 'confirmed' && $reservation->room_id)
                <div class="alert alert-success mb-4">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong>Assigned Room:</strong> {{ $reservation->room->name ?? 'Room details unavailable' }}
                    <div class="mt-1"><strong>Room Capacity:</strong> {{ $reservation->room->room_capacity ?? 2 }} guests</div>
                </div>
            @else
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    Your room will be assigned after confirmation by our staff.
                </div>
            @endif

            <!-- Room Details Section -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">Reservation Details</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Room Type</label>
                        <select name="rooms[0][room_type]" class="form-control" required disabled>
                            <option value="{{ $reservation->room_type }}" selected>
                                {{ ucfirst($reservation->room_type) }} (Capacity: {{ $reservation->room->room_capacity ?? 2 }})
                            </option>
                        </select>
                        <small class="text-muted">Room type cannot be changed after booking</small>
                    </div>

                    <div class="mb-3">
                        <label for="guests" class="form-label">Number of Guests <span class="text-danger">*</span></label>
                        <input type="number" id="guests" name="rooms[0][guests]" class="form-control @error('rooms.0.guests') is-invalid @enderror"
                               min="1" max="{{ $reservation->room->room_capacity ?? 2 }}"
                               value="{{ old('rooms.0.guests', $reservation->guests) }}" required>
                        <small class="text-muted">Maximum capacity: {{ $reservation->room->room_capacity ?? 2 }} guests</small>
                        @error('rooms.0.guests')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="check_in" class="form-label">Check-in Date <span class="text-danger">*</span></label>
                            <input type="date" id="check_in" name="check_in" class="form-control @error('check_in') is-invalid @enderror"
                                   value="{{ old('check_in', $reservation->check_in->format('Y-m-d')) }}"
                                   required min="{{ now()->toDateString() }}">
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="check_out" class="form-label">Check-out Date <span class="text-danger">*</span></label>
                            <input type="date" id="check_out" name="check_out" class="form-control @error('check_out') is-invalid @enderror"
                                   value="{{ old('check_out', $reservation->check_out->format('Y-m-d')) }}"
                                   required min="{{ now()->addDay()->toDateString() }}">
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Submission -->
            @if($reservation->status === 'pending')
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-submit btn-lg py-2">
                        <i class="bi bi-check-circle me-1"></i> Update Reservation
                    </button>
                    <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-secondary py-2">
                        <i class="bi bi-x-circle me-1"></i> Cancel
                    </a>
                </div>
            @else
                <div class="alert alert-warning mb-4">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Only pending reservations can be modified. Please contact support for any changes.
                </div>
                <div class="d-grid gap-2">
                    <button type="button" class="btn btn-secondary w-100 py-2" disabled>
                        Update Reservation
                    </button>
                    <a href="{{ route('user.reservations.index') }}" class="btn btn-outline-primary py-2">
                        <i class="bi bi-arrow-left me-1"></i> Back to Reservations
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Date validation for edit form
    const checkInInput = document.getElementById('check_in');
    const checkOutInput = document.getElementById('check_out');
    const guestsInput = document.getElementById('guests');
    const maxCapacity = {{ $reservation->room->room_capacity ?? 2 }};
    
    // Validate check-in/check-out dates
    checkInInput.addEventListener('change', function() {
        if (checkInInput.value) {
            const nextDay = new Date(checkInInput.value);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOutInput.min = nextDay.toISOString().split('T')[0];
            
            if (checkOutInput.value && new Date(checkOutInput.value) <= new Date(checkInInput.value)) {
                checkOutInput.value = '';
            }
        }
    });
    
    // Validate guest count doesn't exceed capacity
    guestsInput.addEventListener('change', function() {
        if (parseInt(guestsInput.value) > maxCapacity) {
            guestsInput.value = maxCapacity;
            alert(`Maximum capacity for this room is ${maxCapacity} guests.`);
        }
    });
});
</script>
@endsection

<style>
    .form-page {
        min-height: 80vh;
        background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url("{{ asset('build/assets/images/bg2.jpg') }}");
        background-size: cover;
        background-position: center;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 2rem 0;
    }
    .form-container {
        margin: 15px auto;
        background-color: rgba(255, 255, 255, 0.95);
        padding: 2.5rem;
        border-radius: 15px;
        width: 100%;
        max-width: 700px;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .form-label, .heading {
        color: #2C3E50;
        font-weight: 600;
    }
    .heading {
        font-weight: 700;
    }
    .btn-submit {
        background-color: #F1C40F;
        color: #2C3E50;
        font-size: 1.1rem;
        font-weight: 600;
        border: none;
        border-radius: 5px;
        transition: all 0.3s ease;
    }
    .btn-submit:hover {
        background-color: #1ABC9C;
        color: white;
        transform: translateY(-2px);
    }
    .card-header {
        font-weight: 600;
    }
    .text-danger {
        color: #e74c3c;
    }
</style>