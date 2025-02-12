@extends('layouts.app')

@section('content')


<style>
     
    .half-screen-image {
     position: relative;
     height: 70vh;
     background: url('{{ asset('build/assets/images/food4.jpg') }}')  top/cover no-repeat;
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
</style>    

<div class="main">
    <div class="half-screen-image">
        <div class="half-screen-image">
            <div class="overlay-text">
                <h1>Services</h1>
                <h3>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</h3>
                <div class="breadcrumb-container">
                    <a href="{{ route('services') }}">Home</a> > services
                </div>
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
                <img src="{{asset('build/assets/images/food5.jpg')}}" class="card-img-top" alt="Hotel Service">
                <div class="card-body">
                    <h2 class="card-title">Food & Dining Services</h2>
                    <p>Our Food & Dining Services offer a delightful culinary experience, ensuring guests enjoy delicious meals in a warm and elegant setting.  <p>
                    <blockquote class="blockquote">
                        <p>"A Taste of Luxury, A Bite of Happiness."</p>
                    </blockquote>
                    <h4>Our Facilities</h4>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-check-circle"></i> Multi-Cuisine Restaurant – Exquisite dishes prepared with fresh ingredients.</li>
                        <li><i class="bi bi-check-circle"></i> 24/7 In-Room Dining – Delicious meals delivered to your room anytime.</li>
                        <li><i class="bi bi-check-circle"></i> Café & Lounge – A cozy space for coffee, snacks, and socializing.</li>
                        <li><i class="bi bi-check-circle"></i> Private Dining – Customized menus and exclusive setups for special occasions.</li>
                        <li><i class="bi bi-check-circle"></i> Themed Nights & Buffets – Unique dining experiences with diverse flavors.
                        </li>
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
                <img src="{{ asset('build/assets/images/food7.png') }}" class="card-img-top" alt="Service 1">
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
                <img src="{{ asset('build/assets/images/food3.jpg') }}" class="card-img-top" alt="Service 2">
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
                <img src="{{ asset('build/assets/images/food6.jpg') }}" class="card-img-top" alt="Service 3">
                {{-- <div class="card-body">
                    <h5 class="card-title">Service 3</h5>
                    <p class="card-text">Short description of the service.</p>
                    <a href="#" class="btn btn-primary">Read More</a>
                </div> --}}
            </div>
        </div>
    </div>
</div>

{{-- second services  Food & Dining--}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 ">

        <!-- Background Room Image -->
         <div style="width: 500px; height: 400px; overflow: hidden;">
                    <img src="{{asset('build/assets/images/food1.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
                  </div>
        {{-- <img src="{{asset('build/assets/images/food3.jpg')}}" class="img-fluid w-100 rounded" alt="Room Image" style="max-height: 450px;  object-fit: cover;"> --}}

        <!-- Floating Room Details Box (Overlapping Image) -->
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">Food & Dining</h2>
            <p class="text-muted">
               " Enjoy delicious gourmet meals prepared by top chefs"
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-egg-fried"></i> Private dining in guest rooms.</span>
                <span"><i class="bi bi-slash-circle"></i> Vegetarian, gluten-free, and halal options.</span>
                
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a>
                
            </div>
        </div>
    </div>
</div>

@endsection