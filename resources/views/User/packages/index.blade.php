@extends('layouts.app')

@section('content')
<style>
    /*------------------section 1------------------->
    /* hero section */
    .hero-section {
        background: url('{{ asset('build/assets/images/pakages/1.png') }}') no-repeat center center;
        background-size: cover;
        color: black;
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
        color: #0d0d4d ;
    }
    .breadcrumb-container a {
        text-decoration: none;
        color: #45c987 ;
    }
    .breadcrumb-container a:hover {
        color: #45c987;
    }
    body {
        background-color: #F8F9FA;
        color: #343A40;
    }
    .package-card {
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .package-card:hover {
        transform: scale(1.03);
    }
    .btn-book {
        background-color: #F1C40F;
        color: #2C3E50;
        font-weight: bold;
        border-radius: 8px;
    }
    .btn-book:hover {
        background-color: #F1C40F;
        transform: scale(1.03);
    }

     /* -----------------------Facilities----------------------------- */
     .facilities-section {
        margin-top: 100px;
        margin-bottom: 100px;
        padding: 50px 20px;
        background: url('{{ asset('build/assets/images/nature2.jpg') }}') center/cover no-repeat;
        position: relative;
        color: #fff;
    }

    .facilities-section h2 {
        font-size: 4rem;
        text-align: center;
        margin-bottom: 30px;
        color: #161515;
    }

    .facility-item {
        background-color: rgba(0, 0, 0, 0.6);
        padding: 20px;
        border-radius: 10px;
        transition: transform 0.3s ease;
        color: #fff;
    }

    .facility-item i {
        font-size: 2rem;
        color: #F1C40F;
        margin-bottom: 10px;
    }

    .facility-item:hover {
        transform: scale(1.1);
    }
    /* responsive */
    @media(max-width: 1195px){
        .package-card {
        height: 100%;
        width: 100%;
        overflow: hidden;
        transition: transform 0.3s ease-in-out;
    }
    .package-card:hover {
        transform: scale(1.03);
    }
    }
</style>

{{-- Header Section --}}
<div class="main hero-section">
    <h1>Exclusive Packages</h1>
    <h3>"Unforgettable Stays, Unbeatable Prices <br> Find Your Perfect Getaway Today!"</h3>
    <div class="breadcrumb-container">
        <a href="{{ route('services') }}">Home</a> > Packages
    </div>                 
    <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>  
</div>

{{-- Packages Section --}}
<div class="container mt-5 py-5">
    <h2 class="text-center mb-4">Our Exclusive Packages</h2>
    <div class="row">
        @foreach($packages as $package)
            <div class="col-md-6 mb-4 package-card">
                <div class="card mb-3" style="max-width: 540px;">
                    <div class="row g-0">
                        <div class="col-6">
                            @if (file_exists(public_path('assets/images/packages/' . $package->image)))
                            <img src="{{ asset('assets/images/packages/' . $package->image) }}" alt="Package Image" width="150" class="mt-2">

                            @else
                                <p>Image not found</p>
                            @endif
                        </div>
                        <div class="col-6">
                            <div class="card-body h-100">
                                <h5 class="card-title">{{ $package->name }}</h5>
                                <p class="card-text">{{ $package->description }}</p>
                                <p class="card-text">
                                    <p>Regular Price: PKR {{ $package->regular_price }} /night</p>
                                    <p>Package Price: PKR {{ $package->price }}</p>

                                </p>
                                <button class="btn btn-book mt-3" onclick="showBookingForm({{ $package->id }})">Get Package Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Booking Form --}}
<div class="modal fade" id="pakages">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Book a Package</h4>
            <form action="{{ route('user.book.package') }}" method="POST">
                @csrf
                <input type="hidden" id="package_id" name="package_id">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" name="user_name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="user_email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="user_phone" required>
                </div>           
                <div class="mb-3">
                    <label for="packageSelect" class="form-label">Select Package</label>
                    <select class="form-select" id="packageSelect" name="package_id" required>
                        <option value="" disabled selected>Select a package</option>
                        @foreach($packages as $package)
                            <option value="{{ $package->id }}">{{ $package->name }} (PKR {{ $package->price }}/night)</option>
                        @endforeach
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="checkInDate" class="form-label">Check-in Date</label>
                        <input type="date" class="form-control" id="checkInDate" name="check_in" required>
                    </div>
                    <div class="col-md-6">
                        <label for="checkOutDate" class="form-label">Check-out Date</label>
                        <input type="date" class="form-control" id="checkOutDate" name="check_out" required>
                    </div>
                </div> 
                <div class="mb-3">
                    <label for="paymentMethod" class="form-label">Payment Method</label>
                    <select class="form-select" id="paymentMethod" name="payment_method" required>
                        <option value="Pay at Arrival">Pay at Arrival</option>
                        <option value="Online Payment">Online Payment</option>
                        <option value="Partial Payment">Partial Payment</option>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="specialRequests" class="form-label">Special Requests</label>
                    <textarea class="form-control" id="specialRequests" name="special_requests" rows="2" placeholder="Any special requests or requirements"></textarea>
                </div>

                <div class="text-center col-mb-6">
                    <button type="submit" class="btn btn-book">Submit Booking</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ----------------------------Facilities------------------------------ --}}
<div class="facilities-section">
    <h2 class="text-center mb-4">Free Facilities</h2>
    <div class="container">
        <div class="row g-4">
            <!-- Facility 1 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-car-front"></i>
                    <h5>Car Parking</h5>
                </div>
            </div>
            <!-- Facility 2 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-wifi"></i>
                    <h5>High-Speed Wifi</h5>
                </div>
            </div>
            <!-- Facility 3 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-water"></i>
                    <h5>Swimming Pool</h5>
                </div>
            </div>
            <!-- Facility 4 -->
            <div class="col-md-3">
                <div class="facility-item text-center">
                    <i class="bi bi-cup-straw"></i>
                    <h5>Free Breakfast</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showBookingForm(packageId) {
        document.getElementById('package_id').value = packageId;
        new bootstrap.Modal(document.getElementById('pakages')).show();
    }
</script>
@endsection