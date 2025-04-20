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
                {{-- 👤 Profile Image --}}
                <img src="{{ asset('assets/profile_images/' . Auth::user()->profile_image) }}"
                     onerror="this.onerror=null;this.src='{{ asset('assets/profile_images/default-user.png') }}';"
                     class="rounded-circle me-2"
                     alt="Profile"
                     width="30" height="30">

                {{-- 🙋‍♀️ User Name --}}
                <span>{{ Auth::user()->name }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('user.profile') }}">
                    {{ __('Profile') }}
                </a>

                <a class="dropdown-item" href="#" onclick="confirmLogout(event)">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
@endsection

@section('scripts')
    <script>
        function confirmLogout(event) {
            event.preventDefault();
            if (confirm("Are you sure you want to logout?")) {
                document.getElementById('logout-form').submit();
            }
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