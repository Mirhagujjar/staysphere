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

      /* Sidebar Styles */
      .sidebar {
        position: fixed;
        top: 0;
        left: -280px;
        width: 280px;
        height: 100%;
        background: #212529;
        transition: all 0.3s ease;
        z-index: 2000;
        padding: 20px;
        overflow-y: auto;
      }
      .sidebar.active {
        left: 0;
      }
      .sidebar .nav-link {
        color: #f8f9fa;
        padding: 10px 12px;
        border-radius: 6px;
      }
      .sidebar .nav-link:hover {
        background: #343a40;
      }
      .sidebar-close {
        font-size: 2rem;
        color: #fff;
        cursor: pointer;
        position: absolute;
        top: 15px;
        right: 20px;
      }
      .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1500;
        display: none;
      }
      .overlay.active {
        display: block;
      }


      /* footer */
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

          /* Notification Modal */
      .notification-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.6);
        justify-content: center;
        align-items: center;
        z-index: 9999;
      }
      
      .notification-modal.active {
        display: flex;
      }
      
      .notification-content {
        background: white;
        padding: 30px;
        border-radius: 15px;
        text-align: center;
        max-width: 450px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        border-top: 5px solid var(--secondary-color);
      }
      
      .notification-logo {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
        display: block;
        border-radius: 50%;
        background-color: var(--secondary-color);
        padding: 15px;
      }
      
      .notification-title {
        color: var(--primary-color);
        font-weight: 700;
        margin-bottom: 15px;
      }
      
      .notification-text {
        color: #666;
        margin-bottom: 25px;
      }
      
      .notification-btn {
        padding: 10px 25px;
        border-radius: 50px;
        font-weight: 600;
        transition: all 0.3s;
        border: none;
      }
      
      .btn-confirm {
        background-color: rgb(38, 103, 116);
        color: rgb(255, 251, 251);
      }
      
      .btn-confirm:hover {
        background-color: #16a085;
        transform: translateY(-2px);
      }
      
      .btn-cancel {
        background-color: #e74c3c;
        color: white;
      }
      
      .btn-cancel:hover {
        background-color: #c0392b;
        transform: translateY(-2px);
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
    <ul class="nav flex-column mt-4">
      <li class="nav-item">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('user.rooms.index')}}">Rooms</a>
      </li>

      <!-- Services -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#sidebarServices" role="button">
          Services
        </a>
        <ul class="collapse list-unstyled ps-3" id="sidebarServices">
          <li><a class="nav-link" href="{{route('user.services.index')}}">Services</a></li>
          <li><a class="nav-link" href="{{ route('events') }}">Events</a></li>
        </ul>
      </li>

      <!-- About -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#sidebarAbout" role="button">
          About
        </a>
        <ul class="collapse list-unstyled ps-3" id="sidebarAbout">
          <li><a class="nav-link" href="{{route('user.contact')}}">Contact Us</a></li>
          <li><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
          <li><a class="nav-link" href="{{ route('user.review.review') }}">Reviews</a></li>
        </ul>
      </li>

      <!-- Other Pages -->
      <li class="nav-item">
        <a class="nav-link dropdown-toggle" data-bs-toggle="collapse" href="#sidebarPages" role="button">
          Other Pages
        </a>
        <ul class="collapse list-unstyled ps-3" id="sidebarPages">
          <li><a class="nav-link" href="{{route('menu')}}">Menu of the Day</a></li>
          <li><a class="nav-link" href="{{ route('user.blogs.index') }}">Blog</a></li>
          <li><a class="nav-link" href="{{ route('user.packages.index') }}">Packages</a></li>
          <li><a class="nav-link" href="{{ route('user.gallery') }}">Gallery</a></li>
        </ul>
      </li>

      @yield('nav-content')
    </ul>
  </div>
  <div class="overlay" id="overlay"></div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow sticky-top bg-dark">
    <div class="container">
      <!-- Logo and Sidebar Toggle -->
      <div class="d-flex align-items-center">
        <button class="btn sidebar-toggle me-2" id="sidebarToggle" style="color: white; font-size: 1.5rem;">
          <i class="bi bi-list"></i>
        </button>
        <a class="navbar-brand fw-bold d-flex align-items-center" href="#">
          <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="Stay Sphere Logo" width="50" height="50" style="border-radius: 50%; margin-right: 8px;">
          <span style="color:#F1C40F; font-size: 28px;">StaySphere</span>
        </a>
      </div>

      <!-- Normal Navbar Links (desktop) -->
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link text-white" href="/">Home</a></li>
          <li class="nav-item"><a class="nav-link text-white" href="{{route('user.rooms.index')}}">Rooms</a></li>

          <!-- Services -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Services</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('user.services.index')}}">Services</a></li>
              <li><a class="dropdown-item" href="{{ route('events') }}">Events</a></li>
            </ul>
          </li>

          <!-- About -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">About</a>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li><a class="dropdown-item" href="{{route('user.contact')}}">Contact Us</a></li>
              <li><a class="dropdown-item" href="{{ route('about') }}">About Us</a></li>
              <li><a class="dropdown-item" href="{{ route('user.review.review') }}">Reviews</a></li>
            </ul>
          </li>

          <!-- Other Pages -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" data-bs-toggle="dropdown">Other Pages</a>
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



  <!-- Sidebar Script -->
  <script>
    const sidebar = document.getElementById("sidebar");
    const overlay = document.getElementById("overlay");
    const sidebarToggle = document.getElementById("sidebarToggle");
    const sidebarClose = document.getElementById("sidebarClose");

    sidebarToggle.addEventListener("click", () => {
      sidebar.classList.add("active");
      overlay.classList.add("active");
    });

    sidebarClose.addEventListener("click", () => {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });

    overlay.addEventListener("click", () => {
      sidebar.classList.remove("active");
      overlay.classList.remove("active");
    });
  </script>


  <!-- Notification Modal -->
  <div class="notification-modal" id="notificationModal">
    <div class="notification-content">
      <img src="{{ asset('build/assets/images/SSlogo9.png') }}" alt="StaySphere Logo" class="notification-logo">
      <h4 class="notification-title">Stay Updated with StaySphere</h4>
      <p class="notification-text">Enable notifications to receive exclusive offers, booking confirmations, and important updates about your stay.</p>
      <div class="d-flex justify-content-center">
        <button class="notification-btn btn-confirm me-2" id="confirmBtn">Enable</button>
        <button class="notification-btn btn-cancel ms-2" id="cancelBtn">Not Now</button>
      </div>
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








  @yield('scripts')
  <!-- Firebase Messaging -->
  <script type="module">
      // Import Firebase SDKs
      import { initializeApp } from "https://www.gstatic.com/firebasejs/11.10.0/firebase-app.js";
      import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/11.10.0/firebase-messaging.js";

      // Your Firebase config
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

      // Foreground message handler
      onMessage(messaging, (payload) => {
          console.log('📩 Message received: ', payload);

          if (typeof Toastify !== 'undefined') {
              Toastify({
                  text: `${payload.notification?.title || payload.data?.title}: ${payload.notification?.body || payload.data?.body}`,
                  duration: 4000,
                  gravity: "top",
                  position: "right",
              }).showToast();
          } else {
              alert(`${payload.notification?.title || payload.data?.title}: ${payload.notification?.body || payload.data?.body}`);
          }
      });

      // Register Service Worker + get FCM token
      navigator.serviceWorker.register('/firebase-messaging-sw.js')
          .then((registration) => {
              console.log('✅ Service Worker registered:', registration.scope);

              getToken(messaging, {
                  vapidKey: 'BDoVrdle2s9PfzTAtMe3Dmhs4FPMtacceJVaLEHzVvQLbAnZXE8FsrOsILhNq_t8rX6312Kyv37qnRDWBQyB86E',
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
                  .then(data => {
                      console.log('✅ Server response:', data);
                  })
                  .catch(err => console.error('❌ Error sending token:', err));
              })
              .catch(err => console.error('❌ Permission denied or token error:', err));
          })
          .catch(err => console.error('❌ Service Worker registration failed:', err));

      // Notification permission modal logic
      const modal = document.getElementById('notificationModal');
      const confirmBtn = document.getElementById('confirmBtn');
      const cancelBtn = document.getElementById('cancelBtn');

      if (modal && Notification.permission !== 'granted') {
          modal.style.display = 'flex';
      }

      if (confirmBtn) {
          confirmBtn.addEventListener('click', async () => {
              if (modal) modal.style.display = 'none';
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
      }

      if (cancelBtn) {
          cancelBtn.addEventListener('click', () => {
              if (modal) modal.style.display = 'none';
              console.log('User dismissed notification modal.');
          });
      }
  </script>

  @include('components.scroll-to-top')
  @include('components.logout-confirmation')

</body>
</html>