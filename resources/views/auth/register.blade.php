@extends('layouts.app')

@section('content')

<style>
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('build/assets/images/registration.jpg') no-repeat center center/cover;
    }

    .registration-box {
        background: rgba(14, 13, 13, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 40px 30px;
        width: 520px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        box-shadow: 0 8px 20px rgba(31, 19, 19, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: wipeIn 6s ease-in-out;
        color: #0a0a0a;
    }

    .registration-box h2 {
        margin-bottom: 10px;
        font-size: 28px;
        color: #fff;
        font-weight: bold;
    }

    .registration-box p.intro-text {
        font-size: 16px;
        margin-bottom: 20px;
        color: #f3efef;
    }

    .form-control {
        width: 100%;
        padding: 14px;
        margin-bottom: 18px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.15);
        font-size: 15px;
        color: #111010;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .form-control:focus {
        border-color: #F1C40F;
        outline: none;
        background: rgba(255, 255, 255, 0.25);
    }

    .btn-primary {
        width: 100%;
        padding: 12px;
        background-color: #F1C40F;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        color: #2C3E50;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #F39C12;
    }

    .invalid-feedback {
        color: #ff6b6b;
        font-size: 13px;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-login a {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: background 0.3s ease;
    }

    .social-login a:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .signup-link {
        color: #F1C40F;
        font-size: 14px;
        font-weight: bold;
        text-decoration: none;
    }

    .signup-link:hover {
        text-decoration: underline;
    }

</style>

<div class="registration-container">
    <div class="registration-box">
        <h2>Create Account</h2>
        <p class="intro-text">Join us and start your journey!</p>

        {{-- <div class="social-login">
            <a href="#" title="Register with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Register with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Register with Twitter"><i class="bi bi-twitter"></i></a>
        </div> --}}

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror"
                   name="name" required autocomplete="off" placeholder="Name">
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            {{-- Email --}}
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" required autocomplete="off" placeholder="Email Address">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            {{-- Password --}}
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password" placeholder="Password">
            @error('password')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            {{-- Confirm Password --}}
            <input id="password-confirm" type="password"
                   class="form-control"
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="Confirm Password">

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">{{ __('Register') }}</button>

            <p class="mt-3">Already have an account? <a href="{{ route('login') }}" class="signup-link">Login</a></p>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('name').value = '';
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
        document.getElementById('password-confirm').value = '';
    });
</script>

@endsection
