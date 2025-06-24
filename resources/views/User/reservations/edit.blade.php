@extends('layouts.app')

@section('content')

<style>
    .form-page {
        height: 60%;
        background: url({{ asset('build/assets/images/bg2.jpg') }}) ;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        margin-top: 15px;
        margin-bottom: 15px;
        background-color: rgba(255, 255, 255, 0.8);
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
        border:none;
        border-radius: 5px;
    }

    .btn-submit:hover {
        background-color: #1ABC9C;
        color: white;
    }

    .btn-cancel {
        background-color: #e74c3c;
        color: white;
        font-size: 16px;
        border:none;
        border-radius: 5px;
    }

    .btn-cancel:hover {
        background-color: #c0392b;
        color: white;
    }
</style>

<div class="form-page">
    <div class="form-container">
        <h2 class="text-center heading mb-4">Edit Reservation</h2>
        
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

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

            <input type="hidden" name="room_id" value="{{ $reservation->room_id }}">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ $reservation->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $reservation->email }}" readonly required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="tel" name="phone" class="form-control" 
                    value="{{ $reservation->phone }}"
                    pattern="[0-9]{10,15}" 
                    title="Please enter a valid phone number (10-15 digits)" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-in Date</label>
                <input type="date" name="check_in" class="form-control" 
                    value="{{ $reservation->check_in }}" 
                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Check-out Date</label>
                <input type="date" name="check_out" class="form-control" 
                    value="{{ $reservation->check_out }}" 
                    min="{{ \Carbon\Carbon::today()->toDateString() }}" required>
            </div>

            <div class="mb-3">
                <label>Room Type</label>
                <input type="text" name="room_type" class="form-control" 
                    value="{{ $reservation->room->roomType->label }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Number of Guests</label>
                <input type="number" name="guests" class="form-control" 
                    value="{{ $reservation->guests }}" min="1" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-submit">Update Reservation</button>
                <a href="{{ route('user.reservations.index') }}" class="btn btn-cancel">Cancel</a>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkIn = document.querySelector('input[name="check_in"]');
    const checkOut = document.querySelector('input[name="check_out"]');
    
    // Set initial min date for check-out based on check-in value
    if (checkIn.value) {
        checkOut.min = checkIn.value;
    }
    
    checkIn.addEventListener('change', function() {
        checkOut.min = this.value;
        if(new Date(checkOut.value) < new Date(this.value)) {
            checkOut.value = this.value;
        }
    });
});
</script>

@endsection