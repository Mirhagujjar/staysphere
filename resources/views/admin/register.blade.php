
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    @include('admin.includes.head')
    <style>
        :root {
            --primary: #2C3E50;
            --secondary: #F1C40F; /* Soft Gold */
            --accent: #1ABC9C;
            --facebook: #1877F2; /* Facebook blue */
            --google: #DB4437; /* Google red */
        }
        
        .bg-custom {
            background-color: #F8F9FA;
        }
        
        .register-logo {
            font-size: 2rem; /* Consistent font size */
        }
        
        .register-logo a {
            color: var(--secondary); /* Soft Gold for StaySphere */
            font-weight: 700;
        }
        
        .btn-facebook {
            background-color: var(--facebook) !important;
            border-color: var(--facebook) !important;
            color: white !important;
        }
        
        .btn-google {
            background-color: var(--google) !important;
            border-color: var(--google) !important;
            color: white !important;
        }
        
        .input-group-text {
            background-color: var(--primary);
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 0.2rem rgba(26, 188, 156, 0.25);
        }
        
        a {
            color: var(--accent);
        }
        
        .form-check-input:checked {
            background-color: var(--accent);
            border-color: var(--accent);
        }
    </style>
</head>
<body class="bg-custom">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="w-100" style="max-width: 400px;">
            <div class="text-center mb-4">
                <h1 class="register-logo"><a href="../index2.html" class="text-decoration-none"><b>Stay</b>Sphere</a></h1>
            </div>
            
            <div class="card shadow-sm rounded-3">
                <div class="card-body p-4">
                    <h5 class="card-title text-center mb-4">Register a new membership</h5>
                    
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    
                    <form action="{{ route('admin.superadmin.register.submit') }}" method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <span class="input-group-text rounded-start-3"><i class="bi bi-person"></i></span>
                            <input type="text" name="name" class="form-control rounded-end-3" placeholder="Full Name">
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text rounded-start-3"><i class="bi bi-envelope"></i></span>
                            <input type="email" name="email" class="form-control rounded-end-3" placeholder="Email">
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text rounded-start-3"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password" class="form-control rounded-end-3" placeholder="Password">
                        </div>
                        
                        <div class="input-group mb-4">
                            <span class="input-group-text rounded-start-3"><i class="bi bi-lock-fill"></i></span>
                            <input type="password" name="password_confirmation" class="form-control rounded-end-3" placeholder="Confirm Password" required>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-8 d-flex align-items-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        I agree to the <a href="#">terms</a>
                                    </label>
                                </div>
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100 rounded-3">Register</button>
                            </div>
                        </div>
                    </form>
                    
                    <div class="text-center mb-3">
                        <span class="text-muted">- OR -</span>
                    </div>
                    
                    <div class="d-grid gap-2 mb-3">
                        <a href="https://www.facebook.com/" class="btn btn-facebook rounded-3">
                            <i class="bi bi-facebook me-2"></i> Sign in with Facebook
                        </a>
                        <a href="#" class="btn btn-google rounded-3">
                            <i class="bi bi-google me-2"></i> Sign in with Google
                        </a>
                    </div>
                    
                    <p class="text-center mb-0">
                        <a href="login.html" class="text-decoration-none">I already have a membership</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
  <!--end::Body-->
   <!--begin::Third Party Plugin(OverlayScrollbars)-->
   <script
   src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
   integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ="
   crossorigin="anonymous"
 ></script>
 <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
 <script
   src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
   integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
   crossorigin="anonymous"
 ></script>
 <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
 <script
   src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
   integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
   crossorigin="anonymous"
 ></script>
 <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
 <script src="../../../dist/js/adminlte.js"></script>
 <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
 <script>
   const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
   const Default = {
     scrollbarTheme: 'os-theme-light',
     scrollbarAutoHide: 'leave',
     scrollbarClickScroll: true,
   };
   document.addEventListener('DOMContentLoaded', function () {
     const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
     if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
       OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
         scrollbars: {
           theme: Default.scrollbarTheme,
           autoHide: Default.scrollbarAutoHide,
           clickScroll: Default.scrollbarClickScroll,
         },
       });
     }
   });
 </script>
 <!--end::OverlayScrollbars Configure-->
 <!--end::Script-->
</html>
