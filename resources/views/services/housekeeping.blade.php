@extends('layouts.app')

@section('content')

{{-- <link rel="stylesheet" href="{{ asset('build/assets/css/services.css') }}"> --}}
<style>
    /* General Styles */
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{asset('build/assets/images/clean1.jpg')}}') top/cover no-repeat;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgb(211, 211, 226);
    }

    .overlay-text h1 {
        font-size: 3rem;
        margin: 0;
    }

    .breadcrumb-container {
        margin-top: 10px;
        font-size: 25px;
        font-weight: 500;
        color: white;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #1ddab7;
    }

    .breadcrumb-container a:hover {
        color: #1ABC9C;
    }

    /* Sidebar Links */
    .service-link {
        color: #ffbb00;
        text-decoration: none;
        font-weight: bold;
    }

    .service-link:hover {
        color: #cc8800;
    }

    /* Service Images */
    .service-img {
        width: 100%;
        border-radius: 8px;
    }

    /* Floating Service Card */
    .image-container {
        width: 450px;
        height: 400px;
        overflow: hidden;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .floating-card {
        position: absolute;
        start: 50%;
        transform: translateX(50%);
        padding: 20px;
        background: white;
        bottom: -50px;
        width: 90%;
        max-width: 450px;
    }

    .price-tag {
        color: #b2956e;
        font-weight: bold;
    }

    .service-title {
        color: #2C3E50;
    }

    .py-6 {
        padding-top: 3rem;
        padding-bottom: 4rem;
    }

     /* responsive */
     @media (max-width: 769px) {
        .floating-card {
            position: static !important; /* Absolute position hatane ke liye */
            transform: none !important; 
            margin-top: -10px; /* Card ko neeche shift karne ke liye */
            z-index: 10 !important; 
            background: white; /* Ensure karein ke transparent na ho */
            padding: 20px; /* Spacing improve karne ke liye */
        }
        h2 {
            font-size: 1.5rem; /* Adjust font size for mobile */
        }
        .btn {
            width: 75%; /* Make button full width on mobile */
        
        }
        
    }

</style>

<div class="main">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1> Housekeeping Services</h1>
            <p>"A Spotless Stay, Every Day"</p>
            <div class="breadcrumb-container">
                <a href="{{ route('services') }}">services</a> >Housekeeping services
            </div>
            <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services Now</button>
        </div>
    </div>   
</div>

<!-- Service Description -->
<div class="container mt-4">
    <div class="row justify-content-center" >
        <h2 class="text-center mb-4 section-title">Our Hotel Services</h2>

        <div class="col-lg-7 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{ asset('build/assets/images/clean2.jpg') }}" class="card-img-top" alt="Hotel Service">
                <div class="card-body p-2">
                    <h2 class="card-title">Housekeeping Services</h2>
                    <p>Housekeeping services ensure a clean, comfortable, and hygienic stay for guests. Daily room cleaning includes dusting, vacuuming, and sanitizing to maintain a fresh environment.</p>
                    <blockquote class="blockquote">
                        <p>"Awesome experience with top-notch services and hospitality!"</p>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> Daily Room Cleaning</li>
                        <li><i class="bi bi-check-circle"></i> Linen & Towel Replacement</li>
                        <li><i class="bi bi-check-circle"></i> Turn-down Service</li>
                        <li><i class="bi bi-check-circle"></i> In-Room Maintenance</li>
                        <li><i class="bi bi-check-circle"></i> Waste Collection & Disposal</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card shadow-lg p-3">
                <h4 class="text-center">Other Services</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ url('/services/housekeeping') }}" class="service-link">Housekeeping Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Fitness') }}" class="service-link">Wellness & Fitness Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Security') }}" class="service-link">Guest Assistance & Security</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Service Images -->
<div class="container mt-5 ">
    <div class="row">
        <div class="col-md-4"><img src="{{ asset('build/assets/images/clean3.jpg') }}" class="service-img"></div>
        <div class="col-md-4"><img src="{{ asset('build/assets/images/clean4.jpg') }}" class="service-img"></div>
        <div class="col-md-4"><img src="{{ asset('build/assets/images/clean.jpg') }}" class="service-img"></div>
    </div>
</div>

<!-- Floating Service Card -->
<div class="container py-6">
    <div class="position-relative col-md-8">
        <div class="image-container">
            <img src="{{ asset('build/assets/images/clean5.jpg') }}" class="img-fluid rounded">
        </div>
        <div class="floating-card shadow-lg rounded">
            <small class="price-tag">FROM $260</small>
            <h2 class="service-title">Housekeeping Services</h2>
            <p class="text-muted">"A Spotless Stay, Every Day"</p>
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-stack"></i> Daily cleaning, towel replacement.</span>
                <span><i class="bi bi-house-door"></i> Bed-making service.</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3 bi bi-arrow-right-circle" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services</button>
            </div>
        </div>
    </div>
</div>


{{-- form --}}
<div class="modal fade" id="housekeeping">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-2">Form for housekeeping</h4>
            <form>
                @csrf
                <!-- Name -->
                <div class="mb-2">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <!-- Phone -->
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>

                <!-- Room Number -->
                <div class="mb-3">
                    <label for="room_number" class="form-label">Room Number</label>
                    <input type="text" class="form-control" id="room_number" name="room_number" required>
                </div>

                <!-- Service Type -->
                <div class="mb-3">
                    <label for="service_type" class="form-label">Select Service Type</label>
                    <select class="form-control" id="service_type" name="service_type" required>
                        <option value="Daily Cleaning">Daily Cleaning</option>
                        <option value="Deep Cleaning">Deep Cleaning</option>
                        <option value="Laundry Service">Laundry Service</option>
                        <option value="Room Sanitization">Room Sanitization</option>
                    </select>
                </div>

                <!-- Additional Requests -->
                <div class="mb-3">
                    <label for="requests" class="form-label">Additional Requests</label>
                    <textarea class="form-control" id="requests" name="requests" rows="3"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div>
@endsection
