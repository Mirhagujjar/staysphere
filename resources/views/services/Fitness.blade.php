@extends('layouts.app')

@section('content')

<style>
    .half-screen-image {
        position: relative;
        height: 70vh;
        background: url('{{ asset('build/assets/images/gym1.jpg') }}') center/cover no-repeat;
    }

    .overlay-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: rgb(9, 9, 41);
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
</style>

<div class="main">
    <div class="half-screen-image">
        <div class="overlay-text">
            <h1>Wellness & Fitness Services</h1>
            <h3>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</h3>
            <div class="breadcrumb-container">
                <a href="{{ route('services') }}">Home</a> > services
            </div>
            <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#fitness">Get services Now</button>

        </div>
    </div>
</div>

<div class="container mt-4 py-5">
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
                        <a href="{{ url('/services/Dining') }}" class="text-warning text-decoration-none fw-bold hover-effect">Food & Dining</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Fitness') }}" class="text-warning text-decoration-none fw-bold hover-effect">Wellness & Fitness Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Conference') }}" class="text-warning text-decoration-none fw-bold hover-effect">Event & Conference Services</a>
                    </li>
                    <li class="list-group-item">
                        <a href="{{ url('/services/Security') }}" class="text-warning text-decoration-none fw-bold hover-effect">Guest Assistance & Security</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
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

<div class="container my-5 py-5 ">
    <div class="position-relative col-md-8">
        <div style="width: 500px; height: 400px; overflow: hidden;">
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
                <button class="btn btn-warning mt-3  bi-arrow-right-circle rounded-pill" data-bs-toggle="modal" data-bs-target="#fitness">Get services Now</button>

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


