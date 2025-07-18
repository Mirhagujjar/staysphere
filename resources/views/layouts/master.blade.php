<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StaySphere</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset ('build/assets/css/bootstrap.min.css') }}">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <script src="{{ asset('build/assets/js/bootstrap.bundle.min.js')}}"></script>
  <link rel="icon" type="image/x-icon" href="{{ asset('build/assets/images/SSlogo9.png')}}">
  <style>
    * {
        font-family: Arial, sans-serif;
    }
    .navbar {
      background-color: #2C3E50;
      padding: 0.3rem 1rem;
    }
    .navbar .navbar-brand,
    .navbar .nav-link {
      color: white ;
    }
    .navbar .nav-link:hover {
      color: #1ABC9C ;
    }

    footer {
        background-color: #2C3E50;
      font-size: 14px;
     line-height: 1.6;
    }

    footer h6 {
     color: #F1C40F;
     font-size: 16px;
     font-weight: bold;
    }
    footer a {

      text-decoration: none;
      color: white;
    }
    footer a:hover {
        color: #F1C40F;
    }
    .btn-custom {
      background-color: #F1C40F;
      color: #2C3E50;
    }
    .btn-custom:hover {
      background-color: #1ABC9C;
      color: white;
    }

  </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow sticky-top">
    <div class="container">
              <!-- Logo -->
        <a class="navbar-brand fw-bold" href="#">
          <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="Stay Sphere Logo" width="50" height="50" style="border-radius: 50%;">
        </a>
        <a class="navbar-brand fw-bold" style="color: #F1C40F; font-size: 30px;" href="#">StaySphere</a>

        <!-- Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"style="color: white">
            <span class="navbar-toggler-icon" style="color: white"></span>
        </button>

        <!-- Navbar Links -->

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('user.rooms.index')}}">Rooms</a>
                </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                       Services
                    </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li><a class="dropdown-item" href="{{route('user.services.index')}}">Services</a></li>
                    <li><a class="dropdown-item" href="{{ route('events') }}">Events</a></li>

                </ul>
            </li>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                       About
                    </a>
                <ul class="dropdown-menu dropdown-menu-dark">
                    <li class="nav-item">
                        <a class="dropdown-item" href="{{route('user.contact')}}">Contact Us</a>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
                    <li><a class="dropdown-item" href="{{ route('user.review.review') }}">Reviews</a></li>

                </ul>
               </li>




                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="extraMenu" role="button" data-bs-toggle="dropdown">
                        Other pages
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="{{route('menu')}}">Menu of the Day</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.blogs.index') }}">Blog</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.packages.index') }}">Packages</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.gallery') }}">Gallery</a></li>

                    </ul>
                  </li>


                @yield('nav-content')

            </ul>
        </div>
    </div>
</nav>


  @yield('content')


  <footer class="text-light pt-5 pb-4">
    <div class="container text-center text-md-start margin-top">
      <div class="row">
        <!-- Logo and Description -->
        <div class="col-md-4 col-lg-4 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Stay Sphere</h6>
          <p>
            Providing a seamless platform for booking the best hotel rooms with comfort, ease, and luxury.
          </p>
          <div class="mt-4">
            <h6 class="text-uppercase fw-bold">Contact Us</h6>
            <ul class="list-unstyled mb-0">
              <li><i class="bi bi-telephone-fill me-2"></i> +92 123 456 7890</li>
              <li><i class="bi bi-envelope-fill me-2"></i> info@staysphere.com</li>
              <li><i class="bi bi-geo-alt-fill me-2"></i> Lahore, Pakistan</li>
            </ul>
          </div>
        </div>

        <!-- Quick Links -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Explore</h6>
          <p><a href="{{ route('about') }}" class="text-decoration-none">About Us</a></p>
          <p><a href="{{ route('user.rooms.index') }}" class="text-decoration-none">Rooms</a></p>
          <p><a href="{{ route('user.packages.index') }}" class="text-decoration-none">Packages</a></p>
          <p><a href="{{ route('events') }}" class="text-decoration-none">Events</a></p>
        </div>

        <!-- Support & Legal -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Support</h6>
          <p><a href="{{ route('user.contact') }}" class="text-decoration-none">Contact</a></p>
          <p><a href="{{ route('user.review.review') }}" class="text-decoration-none">Reviews</a></p>
          <p><a href="{{ route('user.blogs.index') }}" class="text-decoration-none">Blog</a></p>
          <p><a href="#" class="text-decoration-none">FAQs</a></p>
        </div>

        <!-- Social Media & Legal -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
          <h6 class="text-uppercase mb-4 font-weight-bold">Connect</h6>
          <div class="social-icons mb-4">
            <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
            <a href="#" class="text-light me-3"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-light"><i class="bi bi-linkedin"></i></a>
          </div>
          <h6 class="text-uppercase mb-3 font-weight-bold">Legal</h6>
          <p><a href="#" class="text-decoration-none">Privacy Policy</a></p>
          <p><a href="#" class="text-decoration-none">Terms of Service</a></p>
        </div>
      </div>
    </div>

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © {{ date('Y') }} Stay Sphere. All rights reserved.
    </div>
</footer>

{{-------------------scroll to top ------------------- --}}
  <a href="#"
  id="scrollToTop"
  class="btn position-fixed bottom-0 end-0 m-3"
  style="background-color: transparent; color: #F1C40F; width: 60px; height: 60px; border-radius: 50%; border: 4px solid #F1C40F; display: flex; align-items: center; justify-content: center; font-weight: bold; transition: background-color 0.3s;background-color:#2C3E50">
   ↑
</a>



<!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
  var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
  (function(){
  var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
  s1.async=true;
  s1.src='https://embed.tawk.to/680fc732d22d79190b3eba68/1ipuq4804';
  s1.charset='UTF-8';
  s1.setAttribute('crossorigin','*');
  s0.parentNode.insertBefore(s1,s0);
  })();
  </script> --}}
  <!--End of Tawk.to Script-->



  <script>
    let scrollBtn = document.getElementById("scrollToTop");

    window.onscroll = function () {
        let scrollTop = document.documentElement.scrollTop;
        let scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrollPercentage = (scrollTop / scrollHeight) * 100;

        scrollBtn.style.display = scrollPercentage > 10 ? "flex" : "none";

    };

</script>

@yield('scripts')
</body>



<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.10.0/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.10.0/firebase-analytics.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyD_zZ4AcUMmXr3K86dHhdo6LeacNdgk7W4",
    authDomain: "staysphere-6a0b7.firebaseapp.com",
    projectId: "staysphere-6a0b7",
    storageBucket: "staysphere-6a0b7.firebasestorage.app",
    messagingSenderId: "863989000171",
    appId: "1:863989000171:web:1f53a2a1d879c43c551bae",
    measurementId: "G-Z1JJT7C6CY"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);
</script>

</html>



































































































