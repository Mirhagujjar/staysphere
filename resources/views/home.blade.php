@extends('layouts.master')

@section('content')

<style>
      .carousel-inner img {
      width: 100%;
      height: 600px; /* Set the height as per your requirement */
      object-fit: cover;
    }

    .carousel-caption {
        transform: translateY(20%);
        bottom: 40%; /* Adjust caption position */
     }

     .carousel-indicators .active {
    background-color: #0b0f0e; /* Light Teal */
    }

     .carousel-indicators button {
       width: 15px;
       height: 15px;
       border-radius: 50%; /* Make buttons circular */
       background-color: #f1c40f; /* Soft Gold */
       border: none; /* Remove default borders */
       margin: 5px;
     }

    .reservation-form {
       position: absolute;
       bottom: 0;
       left: 50%;
       transform: translate(-50%, 50%); /* Center and overlap */
       background-color: #ffffff; /* Solid white background */
       padding: 20px;
       border-radius: 10px;
       box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3); /* Subtle shadow for better visibility */
       width: 80%;
       z-index: 10; /* Ensure the form stays above the carousel */
    }
    
     /* img set window like shap */
     img {
        /* border: 3px solid #F1C40F;  */
        border-radius: 5px; /* Window Shape Effect */
     }

    .custom-image-container {
        width: 450px;
        height: 550px;
        overflow: hidden;
        border-radius: 150px 150px 0 0; /* Top rounded (circle), bottom square */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
      }

    .custom-image-container img {
        width: 150%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container properly */
        display: block;
    }
    
    /* practice */
    /* @media (min-width: 1200px) {
    .container, .container-lg, .container-md, .container-sm, .container-xl {
        max-width: 1200px;
    } */
   /* } */
      .img-fluid {
      max-width: 100%;
      height: auto;
    }
      
    .card {
    background: #fff;
    border-radius: 8px;
    overflow: hidden;
}

.card-body img {
    border-radius: 50%;
    background-color: #e9e6dc; 
    padding: 10px;
} 
.icon-wrapper {
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 10px;
    font-size: 1.5rem;
}

.card-body h4 {
    margin-top: 15px;
    font-weight: bold;
}

.card-body p {
    color: #6c757d;
}

       /* Testimonial Section */
       .testimonial-section {
         
         height: 110vh; 
         width: 100%;
         background-image: url('build/assets/images/mr6.jpg'); 
         background-size: cover;
         background-position: center;
         position: relative;
      }

      /* Semi-circular overlay */
    .testimonial-overlay {
         background-color: rgba(245, 238, 238, 0.7); /* Dark semi-transparent overlay */
         border-radius: 110px 110px 0 0; /* Semi-circular top */
         box-shadow: 0 4px 6px rgba(245, 243, 243, 0.2);
         color: black;
    }

       /* Blockquote Style */
    .blockquote {
         font-size: 1.5rem;
         font-style: italic;
         line-height: 1.9;
    }  

   .blockquote-footer {
         font-size: 1rem;
         font-weight: bold;
         color: #f1c40f; 
    }
    
     /* vedio */
     /* .pinned-image__container img, .pinned-image__container video, .pinned-image__container {
    height: 100%;
    left: 0;
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: center;
    object-position: center;
    position: absolute;
    top: 0;
    width: 100%;
    background-color: #ccc;
}
.pinned_over_content {
    text-align: center;
    padding: 0 60px;
    width: 100%;
    left: 50%;
    position: absolute;
    text-align: center;
    top: 50%;
    transform: translate3d(-50%, -50%, 0);
} */



</style>

{{-- slider --}}
<div id="carouselExampleDark" class="carousel slide carousel-fade" data-bs-ride="carousel">
  <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
      <!-- First Slide -->
      <div class="carousel-item  active" data-bs-interval="2000">
          <img src="{{ asset('build/assets/images/slider.jpg') }}" class="d-block w-100" alt="First slide">
          <div class="carousel-caption d-none d-md-block text-center">
              <h1>StaySphere</h1>
              <h4>"Experience the Art of Hospitality"</h4>
          </div>
      </div>
      <!-- Second Slide -->
      <div class="carousel-item " data-bs-interval="2000">
          <img src="{{ asset('build/assets/images/slider3.jpg') }}" class="d-block w-100" alt="Second slide">
          <div class="carousel-caption  d-none d-md-block text-center">
              <h1>StaySphere</h1>
              <h4>"Stay Easy, Live Luxuriously"</h4>
          </div>
      </div>
      <!-- Third Slide -->
      <div class="carousel-item " data-bs-interval="2000">
          <img src="{{ asset('build/assets/images/slider4.jpg') }}" class="d-block w-100" alt="Third slide">
          <div class="carousel-caption d-none d-md-block text-center">
              <h1>StaySphere</h1>
              <h4>"Your Stay, Our Priority"</h4>
          </div>
      </div>
      
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
  </button>

  <!-- Reservation Form -->
  <div class="reservation-form position-absolute">
      <form class="d-flex justify-content-center align-items-center">
          <label for="date" class="me-2">Date</label>
          <input type="date" class="form-control me-2" placeholder="Choose Date">
          <label for="number" class="me-2">Adults</label>
          <input type="number" class="form-control me-2" placeholder="Adult" min="1" value="1">
          <label for="number" class="me-2">Children</label>
          <input type="number" class="form-control me-2" placeholder="Children" min="0" value="0">
          <a href="{{ route('rooms') }}" class="btn btn-lg btn-warning">Check Availability</a>
      </form>
  </div>
</div>





{{-- Exceptional Hospitality --}}
<div class="container text-center py-5">
  <div class="row align-items-center">
      <!-- Left Image -->
      <div class="col-md-4 d-flex justify-content-center">
          <div class="custom-image-container">
              <img src="{{asset('build/assets/images/room.jpg')}}" class="img-fluid" alt="Hotel Lobby">
          </div>
      </div>

      <!-- Center Text -->
      <div class="col-md-4 d-flex flex-column justify-content-center">
          <h2 class="fw-bold">Exceptional Hospitality</h2>
          <p class="text-muted">and Unmatched Relaxation</p>
          <p class="fs-4">4.9 out of 5</p>
      </div>

      <!-- Right Image -->
      <div class="col-md-4 d-flex justify-content-center">
          <div class="custom-image-container">
              <img src="{{asset('build/assets/images/mr.jpg')}}" class="img-fluid" alt="Dining Area">
          </div>
      </div>
  </div>
</div>



<!-- Hotel Services Section -->
<div class="container my-5">
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-bed fs-3"></i>
                    </div>
                    <h4 class="mt-3">Luxurious Rooms</h4>
                    <p>Comfortable, spacious rooms with breathtaking views.</p>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-swimmer fs-3"></i>
                    </div>
                    <h4 class="mt-3">Swimming Pool</h4>
                    <p>Relax and rejuvenate in our luxurious pool area.</p>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-dumbbell fs-3"></i>
                    </div>
                    <h4 class="mt-3">Fitness Center</h4>
                    <p>Stay active with state-of-the-art fitness equipment.</p>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-headset fs-3"></i>
                    </div>
                    <h4 class="mt-3">24/7 Customer Service</h4>
                    <p>We're here to assist you at all times.</p>
                </div>
            </div>
        </div>

        <!-- Card 5 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-users fs-3"></i>
                    </div>
                    <h4 class="mt-3">Meeting Room</h4>
                    <p>Host professional meetings with state-of-the-art facilities.</p>
                </div>
            </div>
        </div>

        <!-- Card 6 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-calendar-alt fs-3"></i>
                    </div>
                    <h4 class="mt-3">Event Management</h4>
                    <p>Manage events like conferences, weddings, and parties.</p>
                </div>
            </div>
        </div>
        {{-- card 7 --}}
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-parking fs-3"></i>
                    </div>
                    <h4 class="mt-3">Private Parking</h4>
                    <p>Safe and secure parking for your convenience.</p>
                </div>
            </div>
        </div>

        <!-- Card 8 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-wifi fs-3"></i>
                    </div>
                    <h4 class="mt-3">Free WiFi</h4>
                    <p>Stay connected with high-speed internet access.</p>
                </div>
            </div>
        </div>
        <!-- Card 9 -->
        <div class="col-lg-4 col-md-6">
            <div class="card border-0 shadow h-100 text-center">
                <div class="card-body">
                    <div class="icon-wrapper text-center mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background-color: #1ABC9C; color: #ffffff; border-radius: 50%;">
                        <i class="fas fa-concierge-bell fs-3"></i>
                    </div>
                    <h4 class="mt-3">Room Service</h4>
                    <p>Enjoy the comfort of meals served in your room.</p>
                </div>
            </div>
        </div>
    </div>
</div>










{{-- text on pic --}}
<section class="testimonial-section d-flex align-items-center justify-content-center" style="background-image: url('build/assets/images/mr6.jpg'); background-size: cover; height: 100vh;">
    <div class="py-5">
      <div class="container position-relative">
        <div id="testimonialsCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="1000">
              <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="testimonial-overlay text-center p-4">
                    <blockquote class="blockquote">
                      "Experience unparalleled luxury and personalized service at our Hotel, where every stay is a journey into sophistication, comfort, and unforgettable memories."
                    </blockquote>
                    <footer class="blockquote-footer text-warning mt-3">
                      Donette Fondren
                    </footer>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="1000">
              <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="testimonial-overlay text-center p-4">
                    <blockquote class="blockquote">
                      "The staff was incredibly attentive and made our stay truly special. Highly recommend!"
                    </blockquote>
                    <footer class="blockquote-footer text-warning mt-3">
                      John Doe
                    </footer>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item" data-bs-interval="1000">
              <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-8">
                  <div class="testimonial-overlay text-center p-4">
                    <blockquote class="blockquote">
                      "A perfect getaway! The amenities were top-notch and the ambiance was relaxing."
                    </blockquote>
                    <footer class="blockquote-footer text-warning mt-3">
                      Jane Smith
                    </footer>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Carousel Controls -->
          <button class="carousel-control-prev" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#testimonialsCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
          <!-- Carousel Indicators -->
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#testimonialsCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
        </div>
      </div>
    </div>
</section>


<!-- Call to Action -->
{{-- <div class="container text-center cta-section">
    <h2>Book Your Stay Now</h2>
    <p class="lead">Don't wait. Reserve your room today and experience the finest hospitality at Stay Sphere.</p>
    <a href="{{route('reservations.create')}}" class="btn btn-lg btn-primary">Book Now</a>
</div> --}}



{{-- <div class="pinned-image pinned-image--medium">
    <div class="pinned-image__container" id="section_video" style="translate: none; rotate: none; scale: none; transform: scale(1.05, 1.05);">
        <video loop="loop" muted="muted" id="loadvideo" webkit-playsinline="" playsinline="">
            <source src="video/swimming_pool_2.mp4" type="video/mp4">
            <source src="video/swimming_pool_2.webm" type="video/webm">
            <source src="video/swimming_pool_2.ogv" type="video/ogg">
        </video>
        <div class="pinned-image__container-overlay" style="opacity: 1; visibility: inherit;"></div>
    </div>
    <div class="pinned_over_content" style="opacity: 1; visibility: inherit;">
        <div class="title white">
            <small data-cue="slideInUp" data-delay="200" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 200ms; animation-direction: normal; animation-fill-mode: both;"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Luxury Hotel Experience</font></font></small>
            <h2 data-cue="slideInUp" data-delay="300" data-show="true" style="animation-name: slideInUp; animation-duration: 600ms; animation-timing-function: ease; animation-delay: 300ms; animation-direction: normal; animation-fill-mode: both;">Enjoy in a very<br> Immersive Relax</h2>
        </div>
    </div>
</div> --}}















<div class="container py-5">
    <div class="row align-items-center justify-content-between flex-lg-row-reverse">
      <!-- Image Section -->
      <div class="col-lg-5">
        <div class="position-relative">
          <img src="{{asset('build/assets/images/room6.jpg')}}" alt="Main Image" class="img-fluid rounded">
          <img src="{{asset('build/assets/images/slider2.jpg')}}" alt="Overlay Image" 
               class="img-fluid rounded position-absolute" 
               {{-- style="top: 20px; left: 20px; width: 80%; z-index: 1;"> --}}
               style="top: 30%; right: 70%; width: 75%; z-index: 1; border: 2px solid white;">

        </div>
      </div>
  
      <!-- Text Section -->
      <div class="col-lg-5">
        <div>
          <small class="text-muted">About us</small>
          <h2 class="mt-2">Tailored services and the experience of unique holidays</h2>
          <p >We live the life of a eros pulvinar, we want a laoreet, we are a lover of poverty and we have earned it.</p>
          <p>But so that you may see where all this error of those who accuse pleasure and praise pain comes from, I will reveal the whole matter, and I will explain the very things that were said by that discoverer of truth and, as it were, the architect of a happy life.</p>
          <p><em>Maria...the Owner</em></p>
        </div>
      </div>
    </div>
  </div>
  

@endsection
