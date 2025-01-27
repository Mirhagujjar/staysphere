

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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/icofont/1.0.1/css/icofont.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">


  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

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
      border-color: white;
    }
   .navbar-toggler-icon {
     background-color: white; 
    }
    .navbar-toggler:hover,
    .navbar-toggler:focus {
       background-color: #1ABC9C; 
     }
      
    /* Footer Styling */
    footer {
      background-color: #2C3E50; 
      color: white;
    }

    footer a {
      color: #F1C40F;
      text-decoration: none;
    }

    footer a:hover {
      color: #1ABC9C; 
    }

   

   
   
 
   

   
  
   
   
      
   .dropdown-menu {
         background-color: #2C3E50; /* Midnight Blue background for dropdown */
    }

   .dropdown-item {
         color: #FFFFFF; /* White text for dropdown items */
    }
    .dropdown-item:hover {
         background-color: #F1C40F; /* Soft Gold highlight */
         color: #2C3E50; /* Midnight Blue text on hover */
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