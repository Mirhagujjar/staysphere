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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


{{-- <h2>Notifications</h2> --}}
  <div id="notificationModal">
    <div class="modal-content">
      <h3>Enable Notifications</h3>
      <p>To stay updated, please enable browser notifications.</p>
      <button id="confirmBtn">Enable</button>
      <button id="cancelBtn">Cancel</button>
    </div>
  </div>

</body>

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








@yield('scripts')

<script type="module">
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-app.js";
  import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/10.12.0/firebase-messaging.js";

  // ✅ Your Firebase Config
  const firebaseConfig = {
       apiKey: "AIzaSyD_zZ4AcUMmXr3K86dHhdo6LeacNdgk7W4",
  authDomain: "staysphere-6a0b7.firebaseapp.com",
  projectId: "staysphere-6a0b7",
  storageBucket: "staysphere-6a0b7.firebasestorage.app",
  messagingSenderId: "863989000171",
  appId: "1:863989000171:web:1f53a2a1d879c43c551bae",
  measurementId: "G-Z1JJT7C6CY"
  };

  // ✅ Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const messaging = getMessaging(app);

  // ✅ Handle foreground messages
  onMessage(messaging, (payload) => {
    console.log('📩 Message received:', payload);
    Toastify({
      text: `${payload.notification?.title || payload.data.title}: ${payload.notification?.body || payload.data.body}`,
      duration: 4000,
      gravity: "top",
      position: "right",
    }).showToast();
  });

  // ✅ Register service worker
  navigator.serviceWorker.register('/firebase-messaging-sw.js').then((registration) => {
    console.log("Service Worker registered:", registration.scope);

    // ✅ Get FCM Token
    getToken(messaging, {
      vapidKey: 'BALVfi0N8H64t2MF-0C2-fvwi8_fJWLNGchnxRWdBJ_cJ3SqQqPCNmKAxXfBVN8vV7aiNmMnx35GDTLIPFO07uE',
      serviceWorkerRegistration: registration,
    })
    .then(token => {
      console.log('✅ FCM Token:', token);

      // Send token to server
      fetch("/subscribe-topic", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": '{{ csrf_token() }}'
        },
        body: JSON.stringify({ token })
      })
      .then(response => response.json())
      .then(data => console.log('Server response:', data));
    })
    .catch(err => console.error('❌ Error getting token:', err));
  });

  // ✅ Permission modal logic
  const modal = document.getElementById('notificationModal');
  const confirmBtn = document.getElementById('confirmBtn');
  const cancelBtn = document.getElementById('cancelBtn');

  if (Notification.permission !== 'granted') {
    modal.style.display = 'flex';
  }

  confirmBtn.addEventListener('click', async () => {
    modal.style.display = 'none';
    try {
      const permission = await Notification.requestPermission();
      if (permission === 'granted') {
        console.log('✅ Permission granted');
      } else {
        console.log('❌ Permission not granted');
      }
    } catch (err) {
      console.error('Error requesting permission:', err);
    }
  });

  cancelBtn.addEventListener('click', () => {
    modal.style.display = 'none';
    console.log('User dismissed notification modal.');
  });
</script>



    @include('components.scroll-to-top')
    @include('components.logout-confirmation')



</body>
</html>