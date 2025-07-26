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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
      color: white;
    }
    .navbar .nav-link:hover {
      color: #1ABC9C;
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

    /* Sidebar styles */
    .sidebar {
      position: fixed;
      top: 0;
      left: -300px;
      width: 280px;
      height: 100vh;
      background-color: #2C3E50;
      z-index: 1000;
      transition: left 0.3s ease;
      overflow-y: auto;
      padding-top: 60px;
    }
    .sidebar.active {
      left: 0;
    }
    .sidebar .nav-link {
      color: white;
      padding: 10px 20px;
      border-bottom: 1px solid rgba(255,255,255,0.1);
    }
    .sidebar .nav-link:hover {
      color: #1ABC9C;
      background-color: rgba(255,255,255,0.05);
    }
    .sidebar-close {
      position: absolute;
      top: 10px;
      right: 10px;
      color: white;
      font-size: 1.5rem;
      cursor: pointer;
    }
    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0,0,0,0.5);
      z-index: 999;
    }
    .overlay.active {
      display: block;
    }

    /* Notification modal */
    #notificationModal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
    }
    .modal-content {
        background: white;
        padding: 20px;
        border-radius: 10px;
        max-width: 400px;
        text-align: center;
    }
    .modal-content button {
        margin: 10px;
        padding: 10px 20px;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
      .sidebar-toggle {
        display: block !important;
      }
      .navbar-nav {
        display: none;
      }
    }
    @media (min-width: 993px) {
      .sidebar-toggle {
        display: none !important;
      }
    }
  </style>
</head>
<body>
<!-- Sidebar -->
<div class="sidebar" id="sidebar">
  <span class="sidebar-close" id="sidebarClose">&times;</span>
  <ul class="nav flex-column">
    <li class="nav-item">
      <a class="nav-link" aria-current="page" href="/">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('user.rooms.index')}}">Rooms</a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="sidebarServices" role="button" data-bs-toggle="dropdown">
        Services
      </a>
      <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" href="{{route('user.services.index')}}">Services</a></li>
        <li><a class="dropdown-item" href="{{ route('events') }}">Events</a></li>
      </ul>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="sidebarAbout" role="button" data-bs-toggle="dropdown">
        About
      </a>
      <ul class="dropdown-menu dropdown-menu-dark">
        <li><a class="dropdown-item" href="{{route('user.contact')}}">Contact Us</a></li>
        <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
        <li><a class="dropdown-item" href="{{ route('user.review.review') }}">Reviews</a></li>
      </ul>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="sidebarPages" role="button" data-bs-toggle="dropdown">
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
<div class="overlay" id="overlay"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg shadow sticky-top">
  <div class="container">
    <!-- Logo and Sidebar Toggle -->
    <div class="d-flex align-items-center">
      <button class="btn sidebar-toggle me-2" id="sidebarToggle" style="color: white; background: none; border: none; font-size: 1.5rem;">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand fw-bold" href="#">
        <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="Stay Sphere Logo" width="50" height="50" style="border-radius: 50%;">
      </a>
      <a class="navbar-brand fw-bold" style="color: #F1C40F; font-size: 30px;" href="#">StaySphere</a>
    </div>

    <!-- Toggler for Mobile -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="color: white">
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
<<<<<<< HEAD
                    
=======
>>>>>>> 2fcfbcbdc883ef75f5de2b9dcd00e12bee55a97d

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

<!-- Notification Modal -->
<div id="notificationModal">
  <div class="modal-content">
    <h3>Enable Notifications</h3>
    <p>To stay updated, please enable browser notifications.</p>
    <button id="confirmBtn" class="btn btn-custom">Enable</button>
    <button id="cancelBtn" class="btn btn-secondary">Cancel</button>
  </div>
</div>

<!-- Main Content -->
<main>
  @yield('content')
</main>

<!-- Footer -->
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

<!-- Scroll to Top Button -->
{{-- <a href="#"
  id="scrollToTop"
  class="btn position-fixed bottom-0 end-0 m-3"
  style="background-color: transparent; color: #F1C40F; width: 60px; height: 60px; border-radius: 50%; border: 4px solid #F1C40F; display: flex; align-items: center; justify-content: center; font-weight: bold; transition: background-color 0.3s;background-color:#2C3E50">
  ↑
</a> --}}

<!-- Scroll To Top Button -->
<!-- Scroll Button -->
{{-- <a href="#" id="scrollBtn"
   class="position-fixed bottom-4 end-4 d-flex align-items-center justify-content-center rounded-4 shadow"
   style="z-index: 1050; width: 3.3rem; height: 3.3rem; background-color: #1A1A40; display: none; overflow: hidden;">

  <!-- Progress Fill -->
  <div class="position-absolute top-0 start-0 w-100 scroll-fill"
       style="height: 0%; background-color: rgba(255, 255, 255, 0.3); z-index: 1;"></div>

  <!-- Icon (changes dynamically) -->
  <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
       style="z-index: 2;" id="scrollIcon">
    <!-- Default: arrow up -->
    <svg width="20" height="20" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M8.87975 23.0051C9.50041 23.6398 10.5084 23.6398 11.129 23.0051L19.0735 14.8801C19.6941 14.2453 19.6941 13.2145 19.0735 12.5797C18.4528 11.9449 17.4449 11.9449 16.8242 12.5797L11.5908 17.9371V2.35742C11.5908 1.45859 10.8808 0.732422 10.0019 0.732422C9.12305 0.732422 8.41301 1.45859 8.41301 2.35742V17.932L3.17961 12.5848C2.55895 11.95 1.551 11.95 0.930339 12.5848C0.309679 13.2195 0.309679 14.2504 0.930339 14.8852L8.87478 23.0102L8.87975 23.0051Z"
            fill="white" />
    </svg>
  </div>
</a>

<!-- Script -->
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const scrollBtn = document.getElementById("scrollBtn");
    const scrollFill = scrollBtn.querySelector(".scroll-fill");
    const scrollIcon = document.getElementById("scrollIcon");

    // Initialize button state
    updateScrollButton();

    window.addEventListener("scroll", updateScrollButton);

    function updateScrollButton() {
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
      const scrollPercent = Math.min(100, (scrollTop / scrollHeight) * 100);

      // Show button after 200px
      scrollBtn.style.display = scrollTop > 200 ? "flex" : "none";

      // Progress Fill
      scrollFill.style.height = `${scrollPercent}%`;

      // Change icon (top or bottom)
      scrollIcon.innerHTML = scrollTop < scrollHeight - 300
        ? `
          <!-- Scroll to Bottom Icon -->
          <svg width="20" height="20" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M11.1203 0.994906C10.4996 0.360194 9.49165 0.360194 8.871 0.994906L0.926513 9.11994C0.305853 9.75465 0.305853 10.7855 0.926513 11.4203C1.54717 12.0551 2.55512 12.0551 3.17578 11.4203L8.40918 6.06294V21.6426C8.40918 22.5414 9.11922 23.2676 9.99805 23.2676C10.8769 23.2676 11.587 22.5414 11.587 21.6426V6.06801L16.8204 11.4152C17.4411 12.05 18.449 12.05 19.0697 11.4152C19.6903 10.7805 19.6903 9.74963 19.0697 9.11491L11.1252 0.989844L11.1203 0.994906Z"
              fill="white" />
          </svg>`
        : `
          <!-- Scroll to Top Icon -->
          <svg width="20" height="20" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M8.87975 23.0051C9.50041 23.6398 10.5084 23.6398 11.129 23.0051L19.0735 14.8801C19.6941 14.2453 19.6941 13.2145 19.0735 12.5797C18.4528 11.9449 17.4449 11.9449 16.8242 12.5797L11.5908 17.9371V2.35742C11.5908 1.45859 10.8808 0.732422 10.0019 0.732422C9.12305 0.732422 8.41301 1.45859 8.41301 2.35742V17.932L3.17961 12.5848C2.55895 11.95 1.551 11.95 0.930339 12.5848C0.309679 13.2195 0.309679 14.2504 0.930339 14.8852L8.87478 23.0102L8.87975 23.0051Z"
              fill="white" />
          </svg>`;
    }

    scrollBtn.addEventListener("click", function (e) {
      e.preventDefault();
      const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      const scrollHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;

      if (scrollTop < scrollHeight - 300) {
        // Scroll to Bottom
        window.scrollTo({ top: scrollHeight, behavior: "smooth" });
      } else {
        // Scroll to Top
        window.scrollTo({ top: 0, behavior: "smooth" });
      }
    });
  });
</script> --}}






@yield('scripts')

<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
  import {
    getMessaging,
    getToken
  } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging.js";
  
  // Your web app's Firebase configuration
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
  const messaging = getMessaging(app);
</script>

    @include('components.scroll-to-top')

</body>
</html>