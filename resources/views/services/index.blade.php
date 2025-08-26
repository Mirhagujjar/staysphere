@extends('layouts.app')

@section('content')

<style>
    .hero-section {
        background: url('{{ asset('build/assets/images/room27.jpg') }}') no-repeat center center;
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
        color: #f5f116;
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #546360;
    }

    .breadcrumb-container a:hover {
        color: #17e9c2;
    }

    .image {
        width: 450px;
        height: 400px;
        overflow: hidden;
    }

    .cardstyle {
        width: 90%;
        max-width: 500px;
        background: white;
        bottom: -70px;
        margin-right: 100%;
    }
</style>

{{-- main --}}
<div class="main hero-section">
    <div class="overlay-text">
        <h1>Services</h1>
        <p>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</p>
        <div class="breadcrumb-container">
            <a href="{{ asset('home') }}">Home</a> > services
        </div>
    </div>
</div>

{{-- 1 service housekeeping --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        <h2 class="text-center mb-4 text-dark">Our Hotel Services</h2>

        {{-- Background Room Image --}}
        <div class="image">
            <img src="{{ asset('build/assets/images/clean1.jpg') }}" class="img-fluid rounded" alt="Example Image">
        </div>

        {{-- card description --}}
        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded cardstyle">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2 text-dark">Housekeeping Services</h2>
            <p class="text-muted">"A Spotless Stay, Every Day"</p>

            {{-- Facilities List --}}
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-stack"></i> Daily cleaning, towel replacement.</span>
                <span><i class="bi bi-house-door"></i> Bed-making service.</span>
            </div>

            {{-- Buttons --}}
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services Now</button>
                <a href="{{ url('/services/housekeeping') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
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
                <button type="submit" class="btn btn-warning w-100">Submit Request</button>
            </form>
        </div>
    </div>
</div>

{{-- second service Wellness & Fitness Services --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        {{-- Background Room Image --}}
        <div class="image">
            <img src="{{ asset('build/assets/images/gym10.jpg') }}" class="img-fluid rounded" alt="Example Image">
        </div>

        {{-- card description --}}
        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded cardstyle">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2 text-dark">Wellness & Fitness Services</h2>
            <p class="text-muted">"A Wellness Experience Beyond the Ordinary"</p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-person-arms-up"></i> Relaxing treatments for guests.</span>
                <span><i class="bi bi-water"></i> Indoor or outdoor pool access.</span>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#fitness">Get services Now</button>
                <a href="{{ url('/services/Fitness') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
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

{{-- third service Guest Assistance & Security --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 mx-auto">
        {{-- Background Room Image --}}
        <div class="image">
            <img src="{{ asset('build/assets/images/security/se1.jpg') }}" class="img-fluid rounded" alt="Example Image">
        </div>

        {{-- card description --}}
        <div class="position-absolute start-50 translate-middle-x p-4 shadow-lg rounded cardstyle">
            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2 text-dark">Guest Assistance & Security</h2>
            <p class="text-muted">"Advanced Safety for a Worry-Free Stay"</p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-headset"></i> 24/7 Front Desk Service</span>
                <span><i class="bi bi-shield-lock"></i> 24/7 security and CCTV monitoring.</span>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <button class="btn btn-warning mt-3" data-bs-toggle="modal" data-bs-target="#security">Get services Now</button>
                <a href="{{ url('/services/Security') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
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