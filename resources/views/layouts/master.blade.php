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
    .dropdown {
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
    /* footer {
      background-color: #2C3E50; 
      color: white;
    }

    footer a {
      color: #F1C40F;
      text-decoration: none;
    }

    footer a:hover {
      color: #1ABC9C; 
    } */
      
   .dropdown-menu {
         background-color: #2C3E50; 
    }

   .dropdown-item {
         color: #FFFFFF; 
    }
    .dropdown-item:hover {
         background-color: #F1C40F; 
         color: #2C3E50; 
      }
       
    footer {
      font-size: 14px;
     line-height: 1.6;
    }

    footer h6 {
     color: #F1C40F;
     font-size: 16px;
     font-weight: bold;
    }

    footer .btn-warning {
     background-color: #F1C40F;
     border: none;
     color: #fff;
    }

    footer .btn-warning:hover {
      background-color: #e5b700;
    }

    

      /* for button */
    html {
        scroll-behavior: smooth;
    }
    a:hover {
        transform: scale(1.1); /* Slightly enlarges the button on hover */
    }
    #scrollToTop {
        background: conic-gradient(#F1C40F 0%, transparent 0%);
    }


</style>

</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow margin-down">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold align-items-center me-auto" href="#" style="margin-left: 30px;">
            <img  src="{{ asset('build/assets/images/logo.jpg')}}" alt="Stay Sphere Logo"  style="height: 50px; width: 50px; margin-right: 10px;"></a>
        <!-- Logo -->
        <a class="navbar-brand fw-bold font-size: 1.5rem; font-weight: bold;" href="#">Stay Sphere</a>

      <!-- Toggler for Mobile -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Navbar Links -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('rooms') }}">Rooms</a></li>

            {{-- <li class="nav-item"><a class="nav-link" href="{{ route('reservations.create') }}" >Book Now</a></li> --}}
             
             {{-- services --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                  Services
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                <li><a class="dropdown-item" href="{{ route('services') }}">services</a></li>
                  {{-- <li><a class="dropdown-item" href="{{ route('rooms') }}">Rooms</a></li> --}}
                  <li><a class="dropdown-item" href="{{ route('events') }}">Events</a></li>

              </ul>
            </li>

            {{-- aboutus --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                  About Us
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                  <li><a class="dropdown-item" href="{{ route('contact.index') }}">Contact Us</a></li>
                  <li><a class="dropdown-item" href="{{ route('reviews') }}">Reviews</a></li>
              </ul>
            </li>

            {{-- otherpages --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                  Other pages
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('menu') }}">Menu of the Day</a></li>
                  <li><a class="dropdown-item" href="{{ route('blog.blog') }}">Blog</a></li>
                  <li><a class="dropdown-item" href="{{ route('packages') }}">Packages</a></li>

                </ul>
            </li>

                
            {{-- <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                 login
              </a>
              <ul class="dropdown-menu dropdown-menu-dark">
                  <li><a class="dropdown-item" href="{{ route('menu') }}">Menu of the Day</a></li>
                  <li><a class="dropdown-item" href="{{ route('blogs') }}">Blogs</a></li>
                  <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                  <li><a class="dropdown-item" href="{{ route('events') }}">Events</a></li>
                  <li><a class="dropdown-item" href="{{ route('services') }}">services</a></li>
                  <li><a class="dropdown-item" href="{{ route('faq') }}">FAQ</a></li>



              </ul>
            </li> --}}
          @yield('nav-content')

        </ul>
       
      </div>
    </div>
  </nav>

 

 



  @yield('content') 
  <!-- Footer -->
  {{-- <footer class="text-center text-lg-start shadow margin-top">
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
  </footer> --}}
  <footer class="bg-dark text-light pt-5 pb-4">
    <div class="container text-center text-md-start margin-top py-5">
      <div class="row">
        <!-- Logo and Description -->
        <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Stay Sphere</h6>
          <p>
            Providing a seamless platform for booking the best hotel rooms with comfort, ease, and luxury.

          </p>
          <div >
            <h5 class="text-uppercase fw-bold">Contact Us</h5>
            <ul class="list-unstyled mb-0">
              <li><i class="bi bi-telephone-fill"></i> +92 123 456 7890</li>
              <li><i class="bi bi-envelope-fill"></i> info@staysphere.com</li>
              <li><i class="bi bi-geo-alt-fill"></i> Lahore, Pakistan</li>
            </ul>
          </div>
        </div>
  
        <!-- Useful Links -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Links</h6>
          <p><a href="{{ route('about') }}" class="text-light text-decoration-none">About Us</a></p>
          <p><a href="{{ route('services') }}" class="text-light text-decoration-none">Services</a></p>
          <p><a href="{{ route('reservations.index') }}" class="text-light text-decoration-none">Book Now</a></p>
          <p><a href="{{ route('reservations.index') }}" class="text-light text-decoration-none">Rooms</a></p>
          <p><a href="{{ route('events') }}" class="text-light text-decoration-none">Events</a></p>
        </div>
  
        <!-- More Links -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Useful Links</h6>
          <p><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></p>
          <p><a href="{{ route('blog.blog') }}" class="text-light text-decoration-none">Blog</a></p>
          <p><a href="{{ route('reviews') }}" class="text-light text-decoration-none">Reviews</a></p>
          <p><a href="#" class="text-light text-decoration-none">Testimonials</a></p>
          <p><a href="{{ route('contact.index') }}" class="text-light text-decoration-none">Contact Us</a></p>
        </div>
  
        <!-- Newsletter -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Newsletter</h6>
          <p class=" mb-4 font-weight-bold">
            "Stay updated with the latest offers, exclusive discounts, and upcoming events at our hotel. Be the first to know about special packages and exciting services tailored just for you. Subscribe to our newsletter and let us bring the best of comfort and luxury right to your inbox!
          </p>
          <form>
            <div class="mb-3">
              <input type="email" class="form-control" placeholder="Your Email*" />
            </div>
            <button type="submit" class="btn btn-warning w-100">Subscribe Now</button>
          </form>
        </div>
      </div>
    </div>
  
    
    <div class="text-center p-3" style="background-color: var(--text-color); color: white;">
      © {{ date('Y') }} Stay Sphere. All rights reserved.
   </div>
  </footer>
  
  

  {{-- <a href="#" class="btn btn-primary position-fixed bottom-0 end-0 m-3">
    ↑ Top
 </a> --}}

 {{-- <a href="#" 
   class="btn position-fixed bottom-0 end-0 m-3" 
   style="background-color: #F1C40F; color: white; width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); transition: transform 0.2s ease;">
    ↑
 </a> --}}

 <a href="#" 
   id="scrollToTop" 
   class="btn position-fixed bottom-0 end-0 m-3" 
   style="background-color: transparent; color: #F1C40F; width: 60px; height: 60px; border-radius: 50%; border: 4px solid #F1C40F; display: flex; align-items: center; justify-content: center; font-weight: bold; transition: background-color 0.3s;background-color:#2C3E50">
    ↑
 </a>




</body>
</html>