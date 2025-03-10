@extends('layouts.app')

@section('content')

<style>
    /* Background and overall layout */
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh; /* Full viewport height */
        background: url('build/assets/images/registration.jpg') no-repeat center center/cover; /* Add your background image */
    }

    /* Transparent circular registration box */
    .registration-box {
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
    .registration-box h2 {
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

    /* Register button */
    .btn-primary {
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

    .btn-primary:hover {
        background-color: #F39C12; /* Darker Gold on hover */
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

    /* Error messages */
    .invalid-feedback {
        color: #ff6b6b; /* Light red for errors */
        font-size: 12px; /* Reduced font size */
        margin-top: 5px;
    }
</style>

<div class="registration-container">
    <div class="registration-box">
        <h2>Register</h2>
        <div class="social-login">
            <a href="#" title="Register with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Register with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Register with Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name Field -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Email Field -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Password Field -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <!-- Confirm Password Field -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                </div>
            </div>

            <!-- Register Button -->
            <div class="row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection