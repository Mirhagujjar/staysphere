@extends('layouts.app')
@section('content')

<style>
     
    .half-screen-image {
     position: relative;
     height: 70vh;
     background: url('{{ asset('build/assets/images/service4.jpg') }}')  center/cover no-repeat;
    } 

    .overlay-text {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      text-align: center;
      color: rgb(232, 232, 238);
    }

    .overlay-text h1 {
      font-size: 3rem;
      margin: 0;
    }

    .breadcrumb-container {
      margin-top: 10px;
      font-size: 18px;
      font-weight: 500;
      color: #526b67;
    }

   .breadcrumb-container a {
     text-decoration: none;
     color: #546360;
    }

    .breadcrumb-container a:hover {
      color: #d5f5ef;
    }
 
  
</style>    

{{-- main --}}
<div class="main">
    <div class="half-screen-image">
        <div class="half-screen-image">
            <div class="overlay-text">
                <h1>Services</h1>
                <h3>"Experience Luxury, Comfort, and Excellence <br> Our Services, Your Satisfaction!"</h3>
                <div class="breadcrumb-container">
                    <a href="{{asset('home')}}">Home</a> > services
                </div>
            </div>
        </div>
  </div>
</div>

{{-- 1 service  housekeeping--}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">
        <h2 class="text-center mb-4" style="color: #2C3E50;">Our Hotel Services</h2>

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/clean1.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
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
                {{-- <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Get services
                </a> --}}
                {{-- <button class="btn btn-warning mt-3 bi bi-arrow-right-circle" data-bs-toggle="modal" data-bs-target="#housekeeping">Get services</button> --}}

                <a href="{{ url('/services/housekeeping') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- second services  Food & Dining--}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8 ">

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/food4.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
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
                {{-- <a href="{{ route('menu') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a> --}}
                <a href="{{ url('/services/Dining') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- third servies  Wellness & Fitness Services--}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/gym1.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">Wellness & Fitness Services</h2>
            <p class="text-muted">
                "A Wellness Experience Beyond the Ordinary"
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-person-arms-up"></i>  Relaxing treatments for guests.</span>
                <span><i class="bi bi-water"></i> Indoor or outdoor pool access.</span>
                
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                {{-- <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a> --}}
                <a href="{{ url('/services/Fitness') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- fourth service Event & Conference Services --}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/meeting1.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;"> Event & Conference Services</h2>
            <p class="text-muted">
                "Professional Spaces for Productive Meetings"
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-music-note-beamed"></i>  Venue for weddings, parties, and events.</span>
                <span><i class="bi bi-gift"></i> Special celebrations with decorations.</span>
                
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                {{-- <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a> --}}
                <a href="{{ url('/services/Conference') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

{{-- fifth service  Guest Assistance & Security--}}
<div class="container my-5 py-5">
    <div class="position-relative col-md-8">

        <!-- Background Room Image -->
        <div style="width: 500px; height: 400px; overflow: hidden;">
            <img src="{{asset('build/assets/images/security/se1.jpg')}}" class="img-fluid  rounded" alt="Example Image" style="width: 100%; height: 100%; object-fit: cover;">
          </div>
        <div class="position-absolute start-50 p-4 shadow-lg rounded" 
            style="width: 90%; max-width: 500px; background: white; bottom: -50px;">

            <small style="color: #b2956e; font-weight: bold;">FROM $260</small>
            <h2 class="mt-2" style="color: #2C3E50;">  Guest Assistance & Security</h2>
            <p class="text-muted">
                "Advanced Safety for a Worry-Free Stay"
            </p>

            <!-- Facilities List -->
            <div class="d-flex justify-content-start gap-4 mb-4">
                <h6>Facilities:</h6>
                <span><i class="bi bi-headset"></i> 24/7 Front Desk Service</span>
                <span><i class="bi bi-shield-lock"></i> 24/7 security and CCTV monitoring.</span>
                
            </div>

            <!-- Buttons -->
            <div class="d-flex justify-content-between align-items-center">
                {{-- <a href="{{ route('reservations.create') }}" class="btn btn-warning rounded-pill">
                    <i class="bi bi-arrow-right-circle"></i> Book Now
                </a> --}}
                <a href="{{ url('/services/Security') }}" class="text-decoration-none text-warning fw-bold">
                    Read more →
                </a>
            </div>
        </div>
    </div>
</div>

@endsection

