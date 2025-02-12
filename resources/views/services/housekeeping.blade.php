@extends('layouts.app')

@section('content')


<style>
     
    .half-screen-image {
     position: relative;
     height: 70vh;
     background: url('{{ asset('build/assets/images/clean1.jpg') }}')  top/cover no-repeat;
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
    font-size: 18px;
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

   /* Initially hide the form */
   #bookingForm {
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }
</style>    

<div class="main">
    <div class="half-screen-image">
        <div class="half-screen-image">
            <div class="overlay-text">
                <h1> Housekeeping Servies</h1>
                <h3>"A Spotless Stay, Every Day"</h3>
                <div class="breadcrumb-container">
                    <a href="{{ route('services') }}">Home</a> > services
                </div>
                <button class="btn btn-warning" id="bookNowBtn">Book Now</button>

            </div>
        </div>
  </div>
</div>


{{-- description --}}
<div class="container mt-4 py-5">
    <div class="row justify-content-center">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>

        <!-- Main Service Content -->
        <div class="col-lg-8">
            <div class="card shadow-lg">
                {{-- <div style="width: 500px; height: 400px; overflow: hidden;">
                    <img src="{{asset('build/assets/images/clean2.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
                  </div> --}}
                <img src="{{asset('build/assets/images/clean6.jpg')}}" class="card-img-top" alt="Hotel Service">
                <div class="card-body">
                    <h2 class="card-title">Housekeeping services</h2>
                    <p>Housekeeping services ensure a clean, comfortable, and hygienic stay for guests. Daily room cleaning includes dusting, vacuuming, and sanitizing to maintain a fresh environment. <p>
                    <blockquote class="blockquote">
                        <p>"Awesome experience with top-notch services and hospitality!"</p>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> Daily Room Cleaning – Regular cleaning, dusting, and sanitization of rooms.</li>
                        <li><i class="bi bi-check-circle"></i> Linen & Towel Replacement – Fresh linens, towels, and bedding replacements</li>
                        <li><i class="bi bi-check-circle"></i> Turn-down Service – Evening room refresh, bed preparation, and amenities setup.</li>
                        <li><i class="bi bi-check-circle"></i> In-Room Maintenance – Quick fixes for minor maintenance issues.</li>
                        <li><i class="bi bi-check-circle"></i> Waste Collection & Disposal – Proper garbage collection and disposal.</li>
                    </ul>
                    {{-- <h4>Related Services</h4> --}}
                    {{-- <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <h5>Resort Reservation</h5>
                                    <p>Book a resort in your preferred location for a relaxing stay.</p>
                                    <a href="#" class="btn btn-primary btn-sm">Get Service</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-sm">
                                <div class="card-body text-center">
                                    <h5>Book Now</h5>
                                    <p>Secure your hotel booking in advance for the best experience.</p>
                                    <a href="#" class="btn btn-primary btn-sm">Get Service</a>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>

        <!-- Sidebar -->
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
        
        <style>
            .hover-effect:hover {
                color: #cc8800 !important; /* Darker Warning Color on Hover */
            }
        </style>
    </div>
</div>



{{-- images --}}
<div class="container mt-5">
    <div class="row">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean3.jpg') }}" class="card-img-top" alt="Service 1">
                {{-- <div class="card-body">
                    <h5 class="card-title">Service 1</h5>
                    <p class="card-text">Short description of the service.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div> --}}
            </div>
        </div>
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean4.jpg') }}" class="card-img-top" alt="Service 2">
                {{-- <div class="card-body">
                    <h5 class="card-title">Service 2</h5>
                    <p class="card-text">Short description of the service.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div> --}}
            </div>
        </div>
        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card">
                <img src="{{ asset('build/assets/images/clean2.jpg') }}" class="card-img-top" alt="Service 3">
                {{-- <div class="card-body">
                    <h5 class="card-title">Service 3</h5>
                    <p class="card-text">Short description of the service.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>




{{-- service card --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/clean5.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        {{-- <img src="{{asset('build/assets/images/clean3.jpg')}}" class="img-fluid w-100 rounded" alt="Room Image" style="max-height: 450px;  object-fit: cover;"> --}}

        <!-- Floating Room Details Box (Overlapping Image) -->
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">  Housekeeping Servies</h2>
            <p class="text-muted">
                "A Spotless Stay, Every Day"
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-stack"></i>  Daily cleaning, towel replacement.</span>
                <span><i class="bi bi-house-door"></i> bed-making service.</span>
                
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <a  class="btn btn-warning rounded-pill">
                    <button class="btn btn-warning bi bi-arrow-right-circle" id="bookNowBtn">Book Now</button>

                    {{-- <i class="bi bi-arrow-right-circle"></i> Book Now --}}
                </a>
               
            </div>
        </div>
    </div>
</div>




 <!-- Booking Form (Initially Hidden) -->
 <div class="container mt-5">
    <div id="bookingForm" class="mt-4 p-4 border rounded shadow bg-light">
        <h4 class="mb-3">Book Housekeeping Service</h4>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" placeholder="Enter your full name" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="roomNumber" class="form-label">Room Number</label>
                <input type="text" class="form-control" id="roomNumber" placeholder="Enter your room number" required>
            </div>
            <div class="mb-3">
                <label for="serviceDate" class="form-label">Date of Service</label>
                <input type="date" class="form-control" id="serviceDate" required>
            </div>
            <button type="submit" class="btn btn-success">Confirm Booking</button>
            <button type="button" class="btn btn-danger ms-2" id="closeForm">Cancel</button>
        </form>
    </div>
</div>

<script>
$(document).ready(function(){
    $("#bookNowBtn").click(function(){
        $("#bookingForm").fadeIn().css("opacity", "1");
    });

    $("#closeForm").click(function(){
        $("#bookingForm").fadeOut().css("opacity", "0");
    });
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


@endsection
































































{{-- @extends('layouts.master')

@section('content')
<div class="container py-5">
    <div class="card">
        <img src="{{ asset('images/' . $service->image) }}" class="card-img-top" alt="{{ $service->name }}">
        <div class="card-body">
            <h2 class="card-title">{{ $service->name }}</h2>
            <ul>
                @foreach ($service->details as $detail)
                <li>{{ $detail }}</li>
                @endforeach
            </ul>
            <a href="{{ route('services') }}" class="btn btn-secondary">Back to Services</a>
        </div>
    </div>
</div>
@endsection --}}
