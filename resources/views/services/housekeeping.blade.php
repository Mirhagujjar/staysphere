@extends('layouts.app')

@section('content')

<style>
    .hero-section {
        background: url('{{ asset('build/assets/images/clean1.jpg') }}') no-repeat center center;
        background-size: cover;
        color: white;
        text-align: center;
        padding: 100px 20px;
        height: auto;
    }

    .hero-section h1 {
        font-size: 2.5rem;
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
</style>

{{-- main --}}
<div class="main hero-section">
    <h1 class="display-4">Housekeeping Services</h1>
    <p class="lead">"A Spotless Stay, Every Day"</p>
    <div class="breadcrumb-container">
        <a href="{{ route('services') }}">services</a> > Housekeeping Services
    </div>
    <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services Now</button>
</div>

{{-- short links --}}
<div class="container-fluid mt-4 py-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4 text-dark">Our Hotel Services</h2>

        <div class="col-lg-7 col-md-12 p-2">
            <div class="card shadow-lg p-2">
                <img src="{{ asset('build/assets/images/clean2.jpg') }}" class="card-img-top" alt="Hotel Service">
                <div class="card-body p-2">
                    <h2 class="card-title">Housekeeping Services</h2>
                    <p>Housekeeping services ensure a clean, comfortable, and hygienic stay for guests. Daily room cleaning includes dusting, vacuuming, and sanitizing to maintain a fresh environment.</p>
                    <blockquote class="blockquote">
                        <h4>"Awesome experience with top-notch services and hospitality!"</h4>
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

        <div class="col-lg-4 col-md-12">
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
{{-- <div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-4 col-12 mb-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean3.jpg') }}" class="card-img-top" alt="Service 1">
            </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean4.jpg') }}" class="card-img-top" alt="Service 2">
            </div>
        </div>
        <div class="col-md-4 col-12 mb-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean.jpg') }}" class="card-img-top" alt="Service 3">
            </div>
        </div>
    </div>
</div> --}}

{{-- card --}}
{{-- <div class="container-fluid my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        <div style="width: 100%; height: 400px; overflow: hidden;">
            <img src="{{ asset('build/assets/images/clean5.jpg') }}" class="img-fluid rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
        </div>

        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded floating-box">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2 text-dark">Housekeeping Services</h2>
            <p class="text-muted">"A Spotless Stay, Every Day"</p>
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-stack"></i> Daily cleaning, towel replacement.</span>
                <span><i class="bi bi-house-door"></i> Bed-making service.</span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3 bi-arrow-right-circle rounded-pill" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services Now</button>
            </div>
        </div>
    </div>
</div> --}}

{{-- form --}}
{{-- <div class="modal fade" id="housekeeping">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Request Housekeeping Services</h4>
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
            
                <!-- Submit Button -->
                <button type="submit" class="btn btn-warning w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div> --}}

@endsection