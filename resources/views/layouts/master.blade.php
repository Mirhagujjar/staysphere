

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stay Sphere</title>
  <!-- Bootstrap CSS -->
  {{-- <link rel="stylesheet" href="{{asset ('css/bootstrap.min.css') }}"> --}}
  {{-- <script src="{{ asset('js/bootstrap.bundle.min.js')}}"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
  <link rel="stylesheet" href="{{ asset('build/assets/css/bootstrap.min.css') }}">
  <script src="{{ asset('build/assets/js/bootstrap.bundle.min.js')}}"></script>
  <style>
    /* Navbar Styling */
    .navbar {
      background-color: #2C3E50; /* Midnight Blue */
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: white ;
    }
    .navbar .nav-link:hover {
      color: #1ABC9C ; /* Light Teal */
    }
    .navbar a {
      color: white !important;
       }
   .navbar-brand img {
        border-radius: 20%;
        width: 50px;
     }
   .navbar-toggler {
      border-color: white; /* Border color */
    }
   .navbar-toggler-icon {
     background-color: white; /* Button color */
    }
    .navbar-toggler:hover,
    .navbar-toggler:focus {
       background-color: #1ABC9C; /* Light Teal */
     }
      
     .card:hover {
    transform: scale(1.05);
    transition: 0.3s ease-in-out;
    box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
    }

    a {
    color: inherit; /* Keep default text color */
}

.card {
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

.card:hover {
    transform: scale(1.05); /* Slightly enlarge on hover */
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
}

    /* Video Background
    .video-background {
      position: relative;
      height: 100vh;
      overflow: hidden;
    }
    #bg-video {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .content {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      color: white;
      text-align: center;
    } */

    /* Footer Styling */
    footer {
      background-color: #2C3E50; /* Midnight Blue */
      color: white;
    }
    footer a {
      color: #F1C40F; /* Soft Gold */
      text-decoration: none;
    }
    footer a:hover {
      color: #1ABC9C; /* Light Teal */
    }

    /* Button Styling */
    .btn-custom {
      background-color: #F1C40F; /* Soft Gold */
      color: #2C3E50; /* Midnight Blue */
    }
    .btn-custom:hover {
      background-color: #1ABC9C; /* Light Teal */
      color: white;
    }

    body {
    background-color: #F8F9FA; /* Off-White */
    color: #343A40; /* Dark Gray */
    font-family: Arial, sans-serif;
   } 

/* Welcome Section */
.welcome-section {
    background-color: #2C3E50; /* Midnight Blue */
    padding: 100px 0;
}

.welcome-title {
    color: #FFFFFF;
    font-size: 3.5rem;
}

.lead {
    font-size: 1.25rem;
    color: #FFFFFF;
}

/* Hotel Services Section */
.hotel-services {
    margin-top: 50px;
    padding: 50px 0;
}

.service-box {
    background-color: #FFFFFF;
    border: 1px solid #E5E5E5;
    padding: 30px;
    margin-bottom: 30px;
    border-radius: 8px;
}

.service-title {
    color: #2C3E50; /* Midnight Blue */
    font-size: 1.75rem;
    margin-bottom: 15px;
}

/* Call to Action */
.cta-section {
    background-color: #F1C40F; /* Soft Gold */
    padding: 60px 0;
    color: #FFFFFF;
}

.btn-primary {
    background-color: #1ABC9C; /* Light Teal */
    border-color: #1ABC9C;
    color: white;
}

.btn-primary:hover {
    background-color: #16A085; /* Slightly darker teal */
    border-color: #16A085;
}

/* Responsive Design */
@media (max-width: 768px) {
    .welcome-title {
        font-size: 2.5rem;
    }
}

.carousel-inner img {
      width: 100%;
      height: 500px; /* Set the height as per your requirement */
      object-fit: cover;
}
.section {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
      overflow: hidden;
    }

    .section h1 {
      font-size: 3rem;
      color: #343A40;
    }

    .image-window {
      display: flex;
      gap: 20px;
    }

    .image-window img {
      height: 300px;
      width: 200px;
      object-fit: cover;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }
    .background {
      background: white;
      height: 100%;
      width: 50%;
      position: absolute;
      left: 25%;
      z-index: -1;
    }
    
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow margin-down">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold " href="#">
            <img src="{{ asset('build/assets/images/logo.jpg')}}" alt="Stay Sphere Logo" width="40" height="40" style="border-radius: 50%;">

          </a>

      <!-- Logo -->
      <a class="navbar-brand fw-bold" href="#">Stay Sphere</a>

      <!-- Toggler for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('reservations.create') }}" >Book Now</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('rooms') }}">Rooms</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('events') }}">Events</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contact.index') }}">Contact Us</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
        </ul>
      </div>
    </div>
  </nav>

 

 



  @yield('content') 
  {{-- <div class="video-background">
    <video autoplay muted loop id="bg-video">
        <source src="{{ asset('assets/videos/vd1.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="content">
         <!-- Content Placeholder -->
  <div class="container my-5">
    <h1 style="color: var(--background-color);">Welcome to Stay Sphere</h1>
    <p style="color: var(--background-color);">
      Your comfort, our priority. Explore our rooms and book your stay today!
    </p>
    <button class="btn btn-custom">Explore Now</button>
  </div>
    </div>
</div> --}}




  <!-- Footer -->
  <footer class="text-center text-lg-start shadow margin-top">
    <div class="container p-4">
      <div class="row">

        <div class="col-lg-6 col-md-12 mb-4">
          <h5 class="text-uppercase fw-bold">Stay Sphere</h5>
          <p>
            Providing a seamless platform for booking the best hotel rooms with comfort, ease, and luxury.
          </p>
        </div>


        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="text-uppercase fw-bold">Quick Links</h5>
          <ul class="list-unstyled mb-0">
            <li><a href="#">start of the page</a></li>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('reservations.index') }}">Book now</a></li>
            <li><a href="{{ route('reservations.index') }}">Rooms</a></li>
            <li><a href="{{ route('events') }}">Events</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('contact.index') }}">Contact Us</a></li>
          </ul>
        </div>


        <div class="col-lg-3 col-md-6 mb-4">
          <h5 class="text-uppercase fw-bold">Contact Us</h5>
          <ul class="list-unstyled mb-0">
            <li><i class="bi bi-telephone-fill"></i> +92 123 456 7890</li>
            <li><i class="bi bi-envelope-fill"></i> info@staysphere.com</li>
            <li><i class="bi bi-geo-alt-fill"></i> Lahore, Pakistan</li>
          </ul>
        </div>
      </div>
    </div>
    <div class="text-center p-3" style="background-color: var(--text-color); color: white;">
       © {{ date('Y') }} Stay Sphere. All rights reserved.
    </div>
  </footer>


</body>
</html>