@extends('layouts.app')

@section('content')

<style>
    .form-page {
        height: 60%;
        background: url({{ asset('build/assets/images/bg2.jpg') }});
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .form-container {
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: rgba(255, 255, 255, 0.9);
        padding: 30px;
        border-radius: 15px;
        width: 100%;
        max-width: 700px;
    }
    .form-label, .heading {
        color: #2C3E50;
    }
    .btn-submit {
        background-color: #F1C40F;
        color: #2C3E50;
        font-size: 16px;
        border: none;
        border-radius: 5px;
    }
    .btn-submit:hover {
        background-color: #1ABC9C;
        color: white;
    }
</style>

<form action="{{ route('user.reservations.update', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="room_id" value="{{ $reservation->room->id }}">

    <div class="mb-3">
        <label class="form-label">Your Name</label>
        <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Your Email</label>
        <input type="email" class="form-control" value="{{ auth()->user()->email }}" readonly>
    </div>

    <div class="mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" 
               value="{{ old('phone', $reservation->phone) }}" required>
    </div>

    <div id="rooms-container">
        <div class="room-block border p-3 mb-4 rounded">
            <h5>Room Details</h5>
            
            @if($reservation->status === 'confirmed' && $reservation->room_id)
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>
                    <strong>Assigned Room:</strong> {{ $reservation->room->name }}
                </div>
            @else
                <div class="alert alert-info mb-3">
                    <i class="bi bi-info-circle me-2"></i>
                    Your room will be assigned after confirmation by our staff.
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Room Type</label>
                <select name="rooms[0][room_type]" class="form-control" required disabled>
                    <option value="{{ $reservation->room_type }}" selected>
                        {{ $reservation->room_type }} (Capacity: {{ $reservation->room->room_capacity ?? 2 }})
                    </option>
                </select>
                <small class="text-muted">Room type cannot be changed after booking</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Guests</label>
                <input type="number" name="rooms[0][guests]" class="form-control"
                       min="1" max="{{ $reservation->room->room_capacity ?? 2 }}"
                       value="{{ old('rooms.0.guests', $reservation->guests) }}" required>
                <small class="text-muted">Maximum capacity: {{ $reservation->room->room_capacity ?? 2 }} guests</small>
            </div>

            <div class="mb-3">
                <label class="form-label">Optional Service</label>
                <select name="rooms[0][service_id]" class="form-control">
                    <option value="">-- None --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}"
                            {{ $reservation->services->contains($service->id) ? 'selected' : '' }}>
                            {{ $service->title }} (Rs. {{ $service->price }})
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Check-in</label>
            <input type="date" name="check_in" class="form-control"
                   value="{{ old('check_in', $reservation->check_in->format('Y-m-d')) }}"
                   required min="{{ now()->toDateString() }}">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Check-out</label>
            <input type="date" name="check_out" class="form-control"
                   value="{{ old('check_out', $reservation->check_out->format('Y-m-d')) }}"
                   required min="{{ now()->addDay()->toDateString() }}">
        </div>
    </div>

    @if($reservation->status === 'pending')
        <button type="submit" class="btn btn-primary w-100 py-2">
            <i class="bi bi-check-circle me-1"></i> Update Reservation
        </button>
    @else
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle me-2"></i>
            Only pending reservations can be modified. Please contact support for any changes.
        </div>
        <button type="button" class="btn btn-secondary w-100 py-2" disabled>
            Update Reservation
        </button>
    @endif
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Date validation for edit form
    const checkInInput = document.querySelector('input[name="check_in"]');
    const checkOutInput = document.querySelector('input[name="check_out"]');
    
    checkInInput.addEventListener('change', function() {
        if (checkInInput.value) {
            const nextDay = new Date(checkInInput.value);
            nextDay.setDate(nextDay.getDate() + 1);
            checkOutInput.min = nextDay.toISOString().split('T')[0];
            
            if (checkOutInput.value && checkOutInput.value <= checkInInput.value) {
                checkOutInput.value = '';
            }
        }
    });
});
</script>
@endsection