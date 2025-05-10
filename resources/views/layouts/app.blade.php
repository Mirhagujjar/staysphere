@extends('layouts.master')

@section('nav-content')
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif
    @else
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                @if(Auth::user()->profile_image && file_exists(public_path('assets/profile_images/' . Auth::user()->profile_image)))
                    <img src="{{ asset('assets/profile_images/' . Auth::user()->profile_image) }}"
                        class="rounded-circle me-2"
                        alt="Profile"
                        width="30" height="30">
                @else
                    <i class="fas fa-user-circle fa-2x text-secondary me-2"></i>
                @endif

                <span>{{ Auth::user()->name }}</span>
            </a>


            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile.show') }}">
                    <i class="fas fa-user-circle me-2"></i> {{ __('Profile') }}
                </a>
                <a class="dropdown-item text-danger" href="#" onclick="showLogoutConfirmation(event)">
                    <i class="fas fa-sign-out-alt me-2"></i> {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
                confirmButtonColor: '#2C3E50', // Midnight Blue
                cancelButtonColor: '#F1C40F', // Soft Gold
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