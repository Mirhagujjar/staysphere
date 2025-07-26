@extends('layouts.master')

@section('nav-content')
   @guest
    <li class="nav-item">
        <a class="nav-link btn btn-outline-primary px-3" href="{{ route('login') }}">
            <i class="fas fa-sign-in-alt me-1"></i> {{ __('Login') }}
        </a>
    </li>
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <div class="position-relative me-2">
                @if(Auth::user()->profile_image && file_exists(public_path('assets/profile_images/' . Auth::user()->profile_image)))
                    <img src="{{ asset('assets/profile_images/' . Auth::user()->profile_image) }}"
                        class="rounded-circle shadow-sm"
                        alt="{{ Auth::user()->name }}"
                        width="36" 
                        height="36">
                @else
                    <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white"
                         style="width: 36px; height: 36px;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                @endif
                <span class="status-indicator bg-success"></span>
            </div>
            <span class="d-none d-lg-inline">{{ Auth::user()->name }}</span>
        </a>

        <div class="dropdown-menu dropdown-menu-end shadow-lg border-0" aria-labelledby="navbarDropdown" style="min-width: 240px;">
            <!-- User Header -->
            <div class="dropdown-header text-center py-3 bg-light">
                <div class="mx-auto mb-2">
                    @if(Auth::user()->profile_image && file_exists(public_path('assets/profile_images/' . Auth::user()->profile_image)))
                        <img src="{{ asset('assets/profile_images/' . Auth::user()->profile_image) }}"
                            class="rounded-circle shadow"
                            width="80"
                            height="80"
                            alt="{{ Auth::user()->name }}">
                    @else
                        <div class="avatar-placeholder rounded-circle d-flex align-items-center justify-content-center bg-primary text-white mx-auto"
                             style="width: 80px; height: 80px; font-size: 2rem;">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h6 class="mb-0 text-dark">{{ Auth::user()->name }}</h6>
                <small class="text-muted">
                    <i class="fas fa-user me-1"></i>
                    Member since {{ Auth::user()->created_at->format('M Y') }}
                </small>
            </div>
            
            <hr class="dropdown-divider my-1">
            
            <!-- Menu Items -->
            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('user.profile.show') }}">
                <i class="fas fa-user-circle me-2 text-primary"></i>
                <span>{{ __('Profile') }}</span>
            </a>
            <a class="dropdown-item d-flex align-items-center py-2" href="{{ route('user.dashboard') }}">
                <i class="fas fa-tachometer-alt me-2 text-info"></i>
                <span>Dashboard</span>
            </a>
            
            <hr class="dropdown-divider my-1">
            
            <!-- Logout -->
            <a class="dropdown-item d-flex align-items-center py-2 text-danger" href="#" 
               onclick="showLogoutConfirmation(event)">
                <i class="fas fa-sign-out-alt me-2"></i>
                <span>{{ __('Logout') }}</span>
            </a>
        </div>
    </li>
    
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endguest

@section('styles')
<style>
    /* User Dropdown Styles */
    .avatar-placeholder {
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .status-indicator {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        border: 2px solid #fff;
    }
    
    .dropdown-header {
        background-color: #f8f9fa;
    }
    
    .dropdown-menu {
        border: none;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .dropdown-item {
        border-radius: 0.25rem;
        margin: 0.25rem;
        transition: all 0.2s;
    }
    
    .dropdown-item:hover {
        background-color: #f8f9fa;
    }
    
    .nav-link img {
        transition: transform 0.2s;
    }
    
    .nav-link:hover img {
        transform: scale(1.1);
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function showLogoutConfirmation(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Ready to leave?',
            text: "Are you sure you want to log out?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#2C3E50',
            cancelButtonColor: '#F1C40F',
            confirmButtonText: 'Yes, log out',
            cancelButtonText: 'Cancel',
            customClass: {
                confirmButton: 'btn btn-primary me-2',
                cancelButton: 'btn btn-outline-secondary'
            },
            buttonsStyling: false,
            showClass: {
                popup: 'animate__animated animate__fadeIn'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOut'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logout-form').submit();
            }
        });
    }
</script>
@endsection
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