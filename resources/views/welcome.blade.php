@extends('layouts.master')  <!-- Extending the master layout file -->

@section('content')  <!-- Content section that will be placed in the master layout -->
   


<style>
    /* General Body and Background */
body {
    background-color: #F8F9FA; /* Off-White */
    color: #343A40; /* Dark Gray */
    font-family: Arial, sans-serif;
}

/* Welcome Section */
.welcome-section {
    background-color: #2C3E50; /* Midnight Blue */
    padding: 100px 0;
}

.welcome-title {
    color: #FFFFFF;
    font-size: 3.5rem;
}

.lead {
    font-size: 1.25rem;
    color: #FFFFFF;
}

/* Hotel Services Section */
.hotel-services {
    margin-top: 50px;
    padding: 50px 0;
}

.service-box {
    background-color: #FFFFFF;
    border: 1px solid #E5E5E5;
    padding: 30px;
    margin-bottom: 30px;
    border-radius: 8px;
}

.service-title {
    color: #2C3E50; /* Midnight Blue */
    font-size: 1.75rem;
    margin-bottom: 15px;
}

/* Call to Action */
.cta-section {
    background-color: #F1C40F; /* Soft Gold */
    padding: 60px 0;
    color: #FFFFFF;
}

.btn-primary {
    background-color: #1ABC9C; /* Light Teal */
    border-color: #1ABC9C;
    color: white;
}

.btn-primary:hover {
    background-color: #16A085; /* Slightly darker teal */
    border-color: #16A085;
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-title {
        font-size: 2.5rem;
    }
}

</style>
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
    <a href="{{ url('/book') }}" class="btn btn-lg btn-primary">Book Now</a>
</div>

   

    
@endsection
