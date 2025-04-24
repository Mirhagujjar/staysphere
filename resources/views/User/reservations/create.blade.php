
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

</style>


<div class="form-page">
    <div class="form-container">
        <h2 class="text-center heading mb-4">Book a Room</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('user.reservations.store') }}" method="POST">
            @csrf
            <input type="hidden" name="room_id" value="{{ $room_id }}">

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


            <button type="submit" class="btn btn-submit w-100">Book Now</button>
        </form>
    </div>
</div>

@endsection
