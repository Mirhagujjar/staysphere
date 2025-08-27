@extends('layouts.app')

@section('content')
<style>
    /*------------------section 1------------------->
    /* hero section */
    .hero-section {
        background: url('{{ asset('build/assets/images/pakages/1.png') }}') no-repeat center center;
        background-size: cover;
        color: black;
        text-align: center;
        padding: 100px 20px; /* Adjusted padding for smaller screens */
        height: auto; /* Changed to auto for better responsiveness */
    }
    .hero-section h1 {
        font-size: 2.5rem; /* Adjusted font size for smaller screens */
    }
    .overlay-text h1 {
        font-size: 3rem;
        margin: 0;
    }
    .breadcrumb-container {
        margin-top: 10px;
        font-size: 18px;
        font-weight: 500;
        color: #0d0d4d ;
    }
    .breadcrumb-container a {
        text-decoration: none;
        color: #45c987 ;
    }
    .breadcrumb-container a:hover {
        color: #45c987;
    }
    body {
        background-color: #F8F9FA;
        color: #343A40;
    }
    .package-card {
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
        background-color: #F1C40F;
        transform: scale(1.03);
    }

     /* -----------------------Facilities----------------------------- */
     .facilities-section {
        margin-top: 100px;
        margin-bottom: 100px;
        padding: 50px 20px;
        background: url('{{ asset('build/assets/images/nature2.jpg') }}') center/cover no-repeat;
        position: relative;
        color: #fff;
    }

    .facilities-section h2 {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 30px;
        color: #161515;
    }

    .facility-item {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
        transition: transform 0.3s ease;
        color: #fff;
    }

    .facility-item i {
        font-size: 2rem;
        color: #F1C40F;
        margin-bottom: 10px;
    }

    .facility-item:hover {
        transform: scale(1.1);
    }
    /* responsive */
    @media(max-width: 1195px){
        .package-card {
        height: 100%;
        width: 100%;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .package-card:hover {
        transform: scale(1.03);
    }
    }
</style>

{{-- Header Section --}}
<div class="main hero-section">
    <h1>Exclusive Packages</h1>
    <h3>"Unforgettable Stays, Unbeatable Prices <br> Find Your Perfect Getaway Today!"</h3>
    <div class="breadcrumb-container">
        <a href="{{ route('services') }}">Home</a> > Packages
    </div>                 
    <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>  
</div>

{{-- Packages Section --}}

<div class="container mt-5 py-5">
    <h2 class="text-center mb-4">Our Exclusive Packages</h2>

    <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 g-4">
        @foreach($packages as $package)
            <div class="col">
                <div class="card h-100 shadow-sm package-card">
                    <div class="row g-0 h-100">
                        <div class="col-6 d-flex align-items-center justify-content-center">
                            @php
                                $imagePath = public_path('assets/images/packages/' . $package->image);
                            @endphp
                            @if(file_exists($imagePath) && $package->image)
                                <div class="h-100 overflow-hidden">
                                    <img src="{{ asset('assets/images/packages/' . $package->image) }}" 
                                         alt="{{ $package->name }}" 
                                         class="img-fluid h-100 w-100 object-fit-cover">
                                </div>
                            @else
                                <div class="h-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                    Image not found
                                </div>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="card-body d-flex flex-column h-100">
                                <h5 class="card-title">{{ $package->name }}</h5>
                                <p class="card-text flex-grow-1">{!! $package->description !!}</p>

                                <div class="mt-auto">
                                    <p class="text-decoration-line-through text-muted mb-1">Regular Price: PKR {{ $package->regular_price }} /night</p>
                                    <p class="fw-bold mb-2">Package Price: PKR {{ $package->price }}</p>
                                    <button class="btn btn-success w-100" onclick="showBookingForm({{ $package->id }})">
                                        Get Package Now
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<style>
    /* Ensure all package cards have the same height */
    .package-card .card {
        min-height: 300px; /* Adjust as needed */
    }

    /* Optional: make buttons consistent */
    .btn-book, .btn-success {
        background-color: #28a745;
        border-color: #28a745;
    }
    .btn-book:hover, .btn-success:hover {
        background-color: #218838;
        border-color: #1e7e34;
    }

    /* Make images cover the div nicely */
    .object-fit-cover {
        object-fit: cover;
    }
</style>


{{-- ----------------------------Facilities------------------------------ --}}
<div class="facilities-section">
    <h2 class="text-center mb-4">Free Facilities</h2>
    <div class="container">
        <div class="row g-4">
            <!-- Facility 1 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-car-front"></i>
                    <h5>Car Parking</h5>
                </div>
            </div>
            <!-- Facility 2 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-wifi"></i>
                    <h5>High-Speed Wifi</h5>
                </div>
            </div>
            <!-- Facility 3 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-water"></i>
                    <h5>Swimming Pool</h5>
                </div>
            </div>
            <!-- Facility 4 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-cup-straw"></i>
                    <h5>Free Breakfast</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection