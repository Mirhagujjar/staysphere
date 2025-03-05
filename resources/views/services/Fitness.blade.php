@extends('layouts.app')

@section('content')

<style>
    .hero-section {
        background: url('{{ asset('build/assets/images/gym10.jpg') }}') no-repeat center center;
        background-size: cover;
        color: white;
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
        font-size: 25px;
        font-weight: 500;
        color: #f8fcfb;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #e8f3f1;
    }

    .breadcrumb-container a:hover {
        color: #1ABC9C;
    }

    .hover-effect:hover {
        color: #cc8800 !important;
    }

    .floating-box {
        width: 90%;
        max-width: 500px;
        background: white;
        bottom: -50px;
    }

    /* Prevent horizontal overflow */
    body {
        overflow-x: hidden;
    }

    /* Responsive styles */
    @media (max-width: 769px) {
        .position-absolute {
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

    /* Medium screen styles */
    @media (min-width: 770px) and (max-width: 996px) {
        .hero-section {
            padding: 80px 15px; /* Adjust padding for medium screens */
        }

        .hero-section h1 {
            font-size: 2rem; /* Adjust font size for medium screens */
        }

        .breadcrumb-container {
            font-size: 20px; /* Adjust font size for medium screens */
        }

        .card {
            margin: 10px; /* Add margin to cards for better spacing */
        }

        .floating-box {
            width: 80%; /* Adjust width for medium screens */
        }

        .btn {
            width: 60%; /* Adjust button width for medium screens */
        }
    }

    /* Styles for screens 788px to 996px */
    @media (min-width: 788px) and (max-width: 996px) {
        .container-fluid {
            padding-left: 0; /* Remove left padding */
            padding-right: 0; /* Remove right padding */
        }

        .hero-section {
            padding: 60px 10px; /* Further adjust padding */
        }

        .hero-section h1 {
            font-size: 1.8rem; /* Smaller font size for better fit */
        }

        .breadcrumb-container {
            font-size: 18px; /* Smaller font size for breadcrumbs */
        }

        .card {
            margin: 5px; /* Reduce margin for tighter spacing */
        }

        .floating-box {
            width: 90%; /* Ensure floating box fits well */
        }

        .btn {
            width: 100%; /* Full width buttons for easier tapping */
        }

        img {
            max-width: 100%; /* Responsive images */
            height: auto; /* Maintain aspect ratio */
        }
    }
</style>

{{-- main --}}
<div class="main hero-section">
    <h1>Wellness & Fitness Services</h1>
    <p>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</p>
    <div class="breadcrumb-container">
        <a href="{{ route('services') }}">services</a> > Wellness & Fitness
    </div>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#fitness">Get services Now</button>
</div>

{{-- short links --}}
<div class="container-fluid mt-4 py-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>

        <div class="col-lg-7 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{asset('build/assets/images/gym2.jpg')}}" class="card-img-top" alt="Hotel Service">
                <div class="card-body p-2">
                    <h2 class="card-title">Wellness & Fitness Services</h2>
                    <p>Our Wellness & Fitness Services are designed to help guests maintain a healthy and rejuvenating lifestyle during their stay.</p>
                    <blockquote class="blockquote">
                        <h4>"Stay Fit, Stay Fresh – Your Health, Our Commitment."</h4>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> Fully Equipped Gym</li>
                        <li><i class="bi bi-check-circle"></i> Spa & Massage Therapy</li>
                        <li><i class="bi bi-check-circle"></i> Swimming Pool</li>
                        <li><i class="bi bi-check-circle"></i> Yoga & Meditation Sessions</li>
                        <li><i class="bi bi-check-circle"></i> Personalized Wellness Programs</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow-lg p-3">
                <h4 class="text-center">Other Services</h4>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <a href="{{ url('/services/housekeeping') }}" class="text-warning text-decoration-none fw-bold hover-effect">Housekeeping Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Fitness') }}" class="text-warning text-decoration-none fw-bold hover-effect">Wellness & Fitness Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Security') }}" class="text-warning text-decoration-none fw-bold hover-effect">Guest Assistance & Security</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{-- images in card form --}}
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/gym8.jpg') }}" class="card-img-top" alt="Service 1">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/gym9.jpg') }}" class="card-img-top" alt="Service 2">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/gym7.jpg') }}" class="card-img-top" alt="Service 3">
            </div>
        </div>
    </div>
</div>

{{-- card --}}
<div class="container-fluid my-5 py-5 ">
    <div class="position-relative col-md-8 mx-auto">
        <div style="width: 100%; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/gym6.png')}}" class="img-fluid rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <div class="position-absolute start-50 p-4 shadow-lg rounded floating-box">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">Wellness & Fitness Services</h2>
            <p class="text-muted">"A Wellness Experience Beyond the Ordinary"</p>
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-person-arms-up"></i> Relaxing treatments</span>
                <span><i class="bi bi-water"></i> Indoor/Outdoor pool access</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3 bi-arrow-right-circle rounded-pill" data-bs-toggle="modal" data-bs-target="#fitness">Get services Now</button>
            </div>
        </div>
    </div>
</div>

{{-- form --}}
<div class="modal fade" id="fitness">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Write a Review</h4>
            <form>
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            
                <!-- Select Service -->
                <div class="mb-3">
                    <label for="service_type" class="form-label">Select Service</label>
                    <select class="form-control" id="service_type" name="service_type" required>
                        <option value="Gym Access">Gym Access</option>
                        <option value="Personal Training">Personal Training</option>
                        <option value="Yoga Session">Yoga Session</option>
                        <option value="Spa & Massage">Spa & Massage</option>
                    </select>
                </div>
            
                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div>

@endsection