@extends('layouts.master')

@section('nav-content')
<style>
    .nav-item img {
        object-fit: cover;
        border-radius: 50%;
        width: 40px;
        height: 40px;
    }
    
    /* Custom SweetAlert styling */
    .swal2-popup {
        border-radius: 12px !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    .swal2-title {
        font-size: 1.5rem !important;
        color: #333;
    }
    
    .swal2-actions button {
        padding: 0.5rem 1.5rem !important;
        border-radius: 8px !important;
        font-weight: 500 !important;
    }
</style>
<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
               
                <!-- Display the user profile image -->
                <img src="{{ Auth::user()->profile_image ? asset('assets/profile_images/' . Auth::user()->profile_image) : asset('images/default-avatar.png') }}" 
                     alt="User Profile" class="rounded-circle me-2" width="40" height="40">
                <!-- Display the user's name -->
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <!-- Profile Link -->
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    <i class="fas fa-user-circle me-2"></i>{{ __('Profile') }}
                </a>

                <!-- Logout Link -->
                <a class="dropdown-item" href="#" id="logout-link">
                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
@endsection

@section('scripts')
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get the logout link
        const logoutLink = document.getElementById('logout-link');
        
        if (logoutLink) {
            logoutLink.addEventListener('click', function(e) {
                e.preventDefault();
                
                Swal.fire({
                    title: 'Logout Confirmation',
                    text: "Are you sure you want to logout?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Logout',
                    cancelButtonText: 'Cancel',
                    customClass: {
                        popup: 'animated fadeIn'
                    },
                    buttonsStyling: true,
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('logout-form').submit();
                    }
                });
            });
        }
    });
</script>
@endsection






















{{-- @extends('layouts.master')

@section('nav-content')
<ul class="navbar-nav ms-auto"> --}}
    <!-- Authentication Links -->
    {{-- @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif --}}

        {{-- @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif --}}
    {{-- @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf

                    @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('user.profile') }}">Profile</a>
                </li>
            @endauth
                </form>
            </div>
        </li>
    @endguest
</ul>
@endsection --}}