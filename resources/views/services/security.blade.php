@extends('layouts.app')

@section('content')

<style>
     .hero-section {
        background: url('{{ asset('build/assets/images/security/se1.jpg') }}') no-repeat center center;
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
        font-size: 18px;
        font-weight: 500;
        color: #021411;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #05362d;
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
        /* responsive */
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
    
</style>    

<div class="main hero-section">
    <h1>Guest Assistance & Security services</h1>
    <h3>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</h3>
    <div class="breadcrumb-container">
        <a href="{{ route('services') }}">services</a> > Security services
    </div>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#security">Get services Now</button>
</div>

{{-- description --}}
<div class="container mt-4 py-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>

        <div class="col-lg-8 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{asset('build/assets/images/security/se3.jpg')}}" class="card-img-top" alt="Hotel Service">
                <div class="card-body p-2">
                    <h2 class="card-title">Guest Assistance & Security services</h2>
                    <p>Guest Assistance & Security services ensure a safe, comfortable, and hassle-free experience for all guests...</p>
                    <blockquote class="blockquote">
                        <p>"Your Safety, Our Priority – Assistance Anytime, Anywhere."</p>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> 24/7 Front Desk Support</li>
                        <li><i class="bi bi-check-circle"></i> Concierge Services</li>
                        <li><i class="bi bi-check-circle"></i> CCTV & Security Personnel</li>
                        <li><i class="bi bi-check-circle"></i> Key Card Access</li>
                        <li><i class="bi bi-check-circle"></i> Emergency Response Team</li>
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

{{-- images --}}
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/security/se4.png') }}" class="card-img-top" alt="Service 1">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/security/se5.jpg') }}" class="card-img-top" alt="Service 2">
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/security/se6.jpg') }}" class="card-img-top" alt="Service 3">
            </div>
        </div>
    </div>
</div>

{{-- service card --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">
        <img src="{{asset('build/assets/images/security/se2.jpg')}}" class="img-fluid w-100 rounded" alt="Room Image" style="max-height: 450px; object-fit: cover;">
        <div class="position-absolute start-50 p-4 shadow-lg rounded floating-box">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;"> Guest Assistance & Security</h2>
            <p class="text-muted">"Advanced Safety for a Worry-Free Stay"</p>
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-headset"></i> 24/7 Front Desk Service</span>
                <span><i class="bi bi-shield-lock"></i> 24/7 security and CCTV monitoring.</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3 rounded-pill bi-arrow-right-circle" data-bs-toggle="modal" data-bs-target="#security">Get services Now</button>

            </div>
        </div>
    </div>
</div>
{{-- form --}}
<div class="modal fade" id="security">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Get services</h4>
            <form>
                @csrf
                <!-- Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
            
                <!-- Room Number -->
                <div class="mb-3">
                    <label for="room_number" class="form-label">Room Number</label>
                    <input type="text" class="form-control" id="room_number" name="room_number" required>
                </div>
            
                <!-- Select Service -->
                <div class="mb-3">
                    <label for="service_type" class="form-label">Select Service</label>
                    <select class="form-control" id="service_type" name="service_type" required>
                        <option value="Personal Assistance">Personal Assistance</option>
                        <option value="Security Escort">Security Escort</option>
                        <option value="Lost & Found">Lost & Found</option>
                        <option value="Emergency Assistance">Emergency Assistance</option>
                    </select>
                </div>
            
                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning w-100">Request Service</button>
            </form>
        </div>
    </div>
</div>

@endsection



