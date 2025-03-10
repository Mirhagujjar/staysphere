@extends('layouts.app')

@section('content')

<style>
    /* Background and overall layout */
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
        background: url('build/assets/images/slider5.jpg') no-repeat center center/cover; /* Add your background image */
    }

    /* Transparent circular login box */
    .login-box {
        background: rgba(255, 255, 255, 0.1); /* Transparent white background */
        backdrop-filter: blur(10px); /* Blur effect */
        border-radius: 50%; /* Circular shape */
        padding: 40px; /* Reduced padding */
        width: 500px; /* Increased width */
        height: 500px; /* Increased height */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.2); /* Light border */
        animation: wipeIn 6s ease-in-out; /* Wipe animation */
        overflow: hidden; /* Ensure content stays within the circle */
    }

    /* Wipe animation */
    @keyframes wipeIn {
        from {
            clip-path: circle(0% at 50% 50%);
        }
        to {
            clip-path: circle(100% at 50% 50%);
        }
    }

    /* Heading */
    .login-box h2 {
        margin-bottom: 15px; /* Reduced margin */
        font-size: 24px;
        color: #343A40; /* Dark Gray */
    }

    /* Form inputs */
    .form-control {
        width: 90%; /* Adjusted width for circular form */
        padding: 10px; /* Reduced padding */
        margin-bottom: 15px; /* Reduced spacing */
        border: 1px solid rgba(44, 62, 80, 0.3); /* Midnight Blue with transparency */
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.8); /* Semi-transparent white */
        font-size: 14px; /* Reduced font size */
        color: #343A40; /* Dark Gray */
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #1ABC9C; /* Light Teal */
        outline: none;
    }

    /* Social login buttons */
    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px; /* Reduced margin */
    }

    .social-login a {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        color: #555;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .social-login a:hover {
        background: rgba(255, 255, 255, 0.3); /* Lighter on hover */
    }

    /* Login button */
    .btn-warning {
        width: 90%; /* Adjusted width for circular form */
        padding: 10px; /* Reduced padding */
        background-color: #F1C40F; /* Soft Gold */
        border: none;
        border-radius: 5px;
        color: #2C3E50; /* Midnight Blue */
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-warning:hover {
        background-color: #F39C12; /* Darker Gold on hover */
    }

    /* Forgot password link */
    .forgot-password {
        display: block;
        margin-top: 15px; /* Increased spacing */
        color: #1ABC9C; /* Light Teal */
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #16A085; /* Darker Teal on hover */
        text-decoration: underline;
    }

    /* Remember Me checkbox */
    .form-check {
        margin-bottom: 15px; /* Reduced margin */
        text-align: left;
        color: #1ABC9C
        width: 90%; /* Adjusted width for circular form */
    }

    .form-check-label {
        color: #343A40; /* Dark Gray */
        font-size: 14px;
    }

    /* Signup section */
    .signup-section {
        margin-top: 15px; /* Increased spacing */
        text-align: center;
    }

    .signup-link {
        color: #1ABC9C; /* Light Teal */
        text-decoration: none;
        font-weight: bold;
    }

    .signup-link:hover {
        text-decoration: underline;
    }
</style>

<div class="login-container">
    <div class="login-box">
        <h2>LOGIN</h2>
        <div class="social-login">
            <a href="#" title="Login with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Login with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Login with Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Fake hidden fields to prevent auto-fill -->
            <input type="email" name="fake_email" style="display:none;">
            <input type="password" name="fake_password" style="display:none;">

            <!-- Email Field -->
            <div class="row">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Password Field -->
            <div class="row">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Remember Me Checkbox -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <!-- Login Button -->
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>

            <!-- Signup Section -->
            <div class="row">
                <div class="col-md-12">
                    <div class="signup-section">
                        <p class="signup-text">New here? <a href="{{ route('register') }}" class="signup-link">Register</a></p>
                    </div>
                </div>
            </div>

            <!-- Forgot Password Link -->
            @if (Route::has('password.request'))
                <div class="row">
                    <div class="col-md-12">
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    </div>
                </div>
            @endif
        </form>
        <script>
            // Clear email and password fields on page load
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
            });
        </script>
    </div>
</div>

@endsection