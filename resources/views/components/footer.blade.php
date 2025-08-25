<!-- Footer -->
<footer class="text-light pt-5 pb-4 mt-auto">
  <div class="container text-center text-md-start">
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

<style>
    /* Layout fix so footer stays at bottom */
   html, body 
   {
        height: 100%;
        margin: 0;
     }

     body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;  /* full viewport height */
     }

     main {
        flex: 1;   /* grows to take available space */
        display: flex;
        flex-direction: column;
    }


    /* footer styling */
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
