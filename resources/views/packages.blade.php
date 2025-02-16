@extends('layouts.app')
@section('content')
<style>
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/pakages/1.png') }}') top/cover no-repeat;
    }
    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgb(6, 6, 8);
    }
    .overlay-text h1 {
        font-size: 3rem;
        margin: 0;
    }
    .breadcrumb-container {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 500;
        color: rgb(69, 201, 135);
    }
    .breadcrumb-container a {
        text-decoration: none;
        color: #1ddab7;
    }
    .breadcrumb-container a:hover {
        color: #1ABC9C;
    }
    body {
        background-color: #F8F9FA;
        color: #343A40;
    }
    .package-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .package-card:hover {
        transform: scale(1.03);
    }
    .btn-book {
        background-color: #F1C40F;
        color: #2C3E50;
        font-weight: bold;
        border-radius: 8px;
    }
    .btn-book:hover {
        background-color: #D4AC0D;
    }
</style>

{{-- Header Section --}}
<div class="main">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>Exclusive Packages</h1>
            <h3>"Unforgettable Stays, Unbeatable Prices <br> Find Your Perfect Getaway Today!"</h3>
            <div class="breadcrumb-container">
                <a href="{{ route('services') }}">Home</a> > Packages
            </div>                 
            <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>
        </div>
    </div>
</div>

{{-- Packages Section --}}
<div class="container mt-5 py-5">
    <h2 class="text-center mb-4">Our Exclusive Packages</h2>
    <div class="row">

        @php
            $packages = [
                ["Luxury Stay (2 Persons)", "King-size suite with private spa<br> Airport pickup <br> Gourmet meals.", "l1.jpg", "75,000", "60,000"],
                ["Honeymoon Special (Couple)", "Romantic suite with jacuzzi<br> Candlelight dinner<br> Flower decor.", "co3.jpg", "90,000", "72,000"],
                ["Family Fun (4 Persons)", "Spacious family suite with fun activities<br> Amusement park tickets<br> Meals.", "fa1.jpg", "65,000", "50,000"],
                ["Adventure Getaway (2 Persons)", "Hiking<br> Snorkeling, zip-lining<br> A special adventure suite.", "ad1.jpg", "70,000", "55,000"],
                ["Wellness Escape (1 Person)", "Spa treatments<br> Yoga sessions<br> All-day wellness center access.", "m1.jpg", "80,000", "65,000"],
                ["Corporate Retreat (10 Persons)", "Conference rooms<br> Team activities<br> High-speed internet.", "c2.jpg", "150,000", "120,000"],
            ];
        @endphp

        @foreach ($packages as $package)
            <div class="col-6 mb-4">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-6">
                            <img src="{{ asset('build/assets/images/pakages/' . $package[2]) }}" class="img-fluid rounded-start" alt="{{ $package[0] }}">
                        </div>
                        <div class="col-6">
                            <div class="card-body">
                                <h5 class="card-title">{{ $package[0] }}</h5>
                                <p class="card-text">{!! $package[1] !!}</p>
                                <p class="card-text">
                                    💰 Regular Price: <del>PKR {{ $package[3] }}/night</del> | Package Price: <strong>PKR {{ $package[4] }}/night</strong>
                                </p>
                                <a href="#" class="btn btn-book d-block text-center">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>

{{-- Booking Form --}}
<div class="modal fade" id="pakages">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Book a Package</h4>
            <form>
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="package" class="form-label">Select Package</label>
                    <select class="form-control" id="package" name="package" required>
                        @foreach ($packages as $package)
                            <option value="{{ $package[0] }}">{{ $package[0] }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-book">Submit Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Call to Action --}}
<div class="text-center my-5">
    <h4>Want to stay with us?</h4>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>
</div>
@endsection
