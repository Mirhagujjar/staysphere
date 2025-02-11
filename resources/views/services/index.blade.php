@extends('layouts.app')

@section('content')

<div class="container my-5 py-5">
    <div class="position-relative">
        <!-- Background Room Image -->
        <img src="{{asset('build/assets/images/room20.jpg')}}" class="img-fluid w-100 rounded" alt="Room Image" style="max-height: 450px;  object-fit: cover;">

        <!-- Floating Room Details Box (Overlapping Image) -->
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260/NIGHT</small>
            <h2 class="mt-2" style="color: #2C3E50;">Junior Suite</h2>
            <p class="text-muted">
                Beautiful design with modern furnishings including a glamorous bay window with your own private view of Lucerne.
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-3 mb-3">
                <span><i class="bi bi-bed"></i> King Size Bed</span>
                <span><i class="bi bi-wifi"></i> Free Wifi</span>
                <span><i class="bi bi-tv"></i> 32 Inc TV</span>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a>
                <a href="#" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>


<div class="container my-5 py-5">
    <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>

    <div class="row g-5">
        <!-- Food & Dining Services -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room16.jpg')}}" class="img-fluid w-100 rounded" alt="Food & Dining" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Food & Dining</h4>
                    <p class="text-muted">Enjoy delicious gourmet meals prepared by top chefs.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Wellness & Fitness Services -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room17.jpg')}}" class="img-fluid w-100 rounded" alt="Wellness & Fitness" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Wellness & Fitness</h4>
                    <p class="text-muted">Stay fit with our modern gym and wellness facilities.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Event & Conference Services -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room18.jpg')}}" class="img-fluid w-100 rounded" alt="Events & Conferences" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Event & Conference</h4>
                    <p class="text-muted">Book meeting rooms, event halls, and corporate spaces.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Parking Service -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room19.jpg')}}" class="img-fluid w-100 rounded" alt="Parking Service" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Secure Parking</h4>
                    <p class="text-muted">Safe and convenient parking for all our guests.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Entertainment & Leisure -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room20.jpg')}}" class="img-fluid w-100 rounded" alt="Entertainment & Leisure" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Entertainment & Leisure</h4>
                    <p class="text-muted">Enjoy live performances, games, and exclusive activities.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Guest Assistance & Security -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room16.jpg')}}" class="img-fluid w-100 rounded" alt="Guest Assistance & Security" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Guest Assistance & Security</h4>
                    <p class="text-muted">24/7 security and guest assistance for your comfort.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>

        <!-- Housekeeping -->
        <div class="col-md-12">
            <div class="position-relative">
                <img src="{{asset('build/assets/images/room15.jpg')}}" class="img-fluid w-100 rounded" alt="Housekeeping" 
                     style="max-height: 450px; object-fit: cover;">
                
                <div class="position-absolute start-50 p-4 shadow-lg rounded"
                     style="width: 90%; max-width: 500px; background: white; bottom: -50px;">
                    <h4 style="color: #2C3E50;">Housekeeping</h4>
                    <p class="text-muted">Daily cleaning, towel replacement, and bed-making services.</p>
                    <a href="#" class="btn btn-warning rounded-pill"><i class="bi bi-arrow-right-circle"></i> View Details</a>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="container my-5 py-5">
    <div class="position-relative">
        <!-- Background Image -->
        <img src="{{ asset('build/assets/images/room.jpg') }}" class="img-fluid w-100 rounded" alt="Services Image" style="max-height: 450px; object-fit: cover;">

        <!-- Floating Services Details Box (Overlapping Image) -->
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">OUR PREMIUM SERVICES</small>
            <h2 class="mt-2" style="color: #2C3E50;">Experience Excellence</h2>
            <p class="text-muted">
                Enjoy world-class amenities and top-notch hospitality, ensuring a luxurious and comfortable stay.
            </p>

            <!-- Services List -->
            <div class="d-flex flex-column gap-2 mb-3">
                <span><i class="bi bi-cone-striped"></i> Housekeeping – Daily cleaning & bed-making</span>
                <span><i class="bi bi-cup-hot"></i> Food & Dining Services</span>
                <span><i class="bi bi-heart-pulse"></i> Wellness & Fitness Services</span>
                <span><i class="bi bi-calendar-event"></i> Event & Conference Services</span>
                <span><i class="bi bi-car-front-fill"></i> Parking Service – Secure parking for guests</span>
                <span><i class="bi bi-controller"></i> Entertainment & Leisure</span>
                <span><i class="bi bi-shield-lock"></i> Guest Assistance & Security</span>
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a>
                <a href="#" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>



@endsection



































{{-- @extends('layouts.master')

@section('content')
<div class="container py-5">
    <h2 class="text-center mb-4">Our Services</h2>
    <div class="row">
        @foreach ($services as $service)
        <div class="col-md-6 mb-4">
            <div class="card text-white">
                <img src="{{ asset('build/assets/images/room.jpg' . $service->image) }}" class="card-img" alt="{{ $service->name }}">
                <div class="card-img-overlay d-flex flex-column justify-content-end" style="background: rgba(0, 0, 0, 0.5);">
                    <h3 class="card-title">{{ $service->name }}</h3>
                    <p class="card-text">{{ $service->description }}</p>
                    <a href="{{ route('service.details', $service->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection --}}
