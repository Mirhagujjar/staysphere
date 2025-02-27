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
        /* height: 50%;
        width: 450px; */
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
        <!-- Package 1 -->
        <div class="col-md-6 mb-4 package-card">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/l1.jpg') }}" class="img-fluid rounded-start" alt="Luxury Stay">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Luxury Stay (2 Persons)</h5>
                            <p class="card-text">King-size suite with private spa<br> Airport pickup <br> Gourmet meals.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 75,000/night</del> | Package Price: <strong>PKR 60,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package 2 -->
        <div class="col-md-6 mb-4 package-card">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/co3.jpg') }}" class="img-fluid rounded-start" alt="Honeymoon Special">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Honeymoon Special (Couple)</h5>
                            <p class="card-text">Romantic suite with jacuzzi<br> Candlelight dinner<br> Flower decor.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 90,000/night</del> | Package Price: <strong>PKR 72,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>                     
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package 3 -->
        <div class="col-md-6 mb-4 package-card">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/fa1.jpg') }}" class="img-fluid rounded-start" alt="Family Fun">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Family Fun (4 Persons)</h5>
                            <p class="card-text">Spacious family suite with fun activities<br> Amusement park tickets<br> Meals.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 65,000/night</del> | Package Price: <strong>PKR 50,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>   
                         </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package 4 -->
        <div class="col-md-6 mb-4 package-card">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/ad1.jpg') }}" class="img-fluid rounded-start" alt="Adventure Getaway">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Adventure Getaway (2 Persons)</h5>
                            <p class="card-text">Hiking<br> Snorkeling, zip-lining<br> A special adventure suite.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 70,000/night</del> | Package Price: <strong>PKR 55,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package 5 -->
        <div class="col-md-6 mb-4 package-card">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/m1.jpg') }}" class="img-fluid rounded-start" alt="Wellness Escape">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Wellness Escape (1 Person)</h5>
                            <p class="card-text">Spa treatments<br> Yoga sessions<br> All-day wellness center access.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 80,000/night</del> | Package Price: <strong>PKR 65,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Package 6 -->
        <div class="col-md-6 mb-4 package-card ">
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-6">
                        <img src="{{ asset('build/assets/images/pakages/c2.jpg') }}" class="img-fluid rounded-start" alt="Corporate Retreat">
                    </div>
                    <div class="col-6">
                        <div class="card-body h-100">
                            <h5 class="card-title">Corporate Retreat (10 Persons)</h5>
                            <p class="card-text">Conference rooms<br> Team activities<br> High-speed internet.</p>
                            <p class="card-text">
                                💰 Regular Price: <del>PKR 150,000/night</del> | Package Price: <strong>PKR 120,000/night</strong>
                            </p>
                            <button class="btn btn-book mt-3" data-bs-toggle="modal" data-bs-target="#pakages">Get Package Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- Booking Form --}}
<div class="modal fade" id="pakages">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <h4 class="mb-3">Book a Package</h4>
            <form>
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fullName" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullName" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" required>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>           
                <div class="mb-3">
                    <label for="packageSelect" class="form-label">Select Package</label>
                    <select class="form-select" id="packageSelect" required>
                        <option value="" disabled selected>Select a package</option>
                        <option value="Luxury Stay">Luxury Stay (PKR 60,000/night)</option>
                        <option value="Honeymoon Special">Honeymoon Special (PKR 72,000/night)</option>
                        <option value="Family Fun">Family Fun (PKR 50,000/night)</option>
                        <option value="Adventure Getaway">Adventure Getaway (PKR 55,000/night)</option>
                        <option value="Wellness Escape">Wellness Escape (PKR 65,000/night)</option>
                        <option value="Corporate Retreat">Corporate Retreat (PKR 120,000/night)</option>
                    </select>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="checkInDate" class="form-label">Check-in Date</label>
                        <input type="date" class="form-control" id="checkInDate" required>
                    </div>
                
                    <div class="col-md-6">
                        <label for="checkOutDate" class="form-label">Check-out Date</label>
                        <input type="date" class="form-control" id="checkOutDate" required>
                    </div>

                </div> 
               
            
                <div class="mb-3">
                    <label for="specialRequests" class="form-label">Special Requests</label>
                    <textarea class="form-control" id="specialRequests" rows="2" placeholder="Any special requests or requirements"></textarea>
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
@endsection
