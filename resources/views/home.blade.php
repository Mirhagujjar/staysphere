@extends('layouts.master')

@section('content')
<div class="container">
    <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('build/assets/images/pic.png') }}" class="d-block w-100" alt="Hotel Image 1">
                <div class="carousel-caption">
                    <h3>Luxury Rooms</h3>
                    <p>Experience comfort and elegance</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('build/assets/images/pic1.png') }}" class="d-block w-100" alt="Hotel Image 2">
                <div class="carousel-caption">
                    <h3>Book Your Stay</h3>
                    <p>Reserve your dream room now</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>
</div>   

<div class="container-fluid welcome-section">
    <div class="row justify-content-center text-center text-white">
        <div class="col-12 col-md-8">
            <h1 class="display-3 welcome-title">Welcome to Stay Sphere</h1>
            <p class="lead">Your perfect getaway awaits at Stay Sphere. Relax, unwind, and experience luxury like never before.</p>
        </div>
    </div>
</div>

<!-- Hotel Services Section -->
<div class="container hotel-services">
    <div class="row text-center">
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">Luxurious Rooms</h4>
                <p>Comfortable, spacious rooms with breathtaking views. Your relaxation is our priority.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">24/7 Customer Service</h4>
                <p>We're here to assist you at all times, ensuring you have a seamless experience throughout your stay.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="service-box">
                <h4 class="service-title">Delicious Dining</h4>
                <p>Indulge in gourmet meals with fresh ingredients and exquisite flavors from around the world.</p>
            </div>
        </div>
    </div>
</div>

<!-- Call to Action -->
<div class="container text-center cta-section">
    <h2>Book Your Stay Now</h2>
    <p class="lead">Don't wait. Reserve your room today and experience the finest hospitality at Stay Sphere.</p>
    <a href="#" class="btn btn-lg btn-primary">Book Now</a>
</div>

@endsection
