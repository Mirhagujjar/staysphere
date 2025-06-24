@extends('layouts.app')

@section('content')

<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('build/assets/images/login1.jpg') no-repeat center center/cover;
    }

    .login-box {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 40px 30px;
        width: 520px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: wipeIn 6s ease-in-out;
        color: #080808;
    }

    .login-box h2 {
        margin-bottom: 10px;
        font-size: 28px;
        color: #fff;
        font-weight: bold;
    }

    .login-box p.intro-text {
        font-size: 16px;
        margin-bottom: 20px;
        color: #3a3737;
    }

    .form-control {
        width: 100%;
        padding: 14px;
        margin-bottom: 18px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 6px;
        background: rgba(255, 255, 255, 0.15);
        font-size: 15px;
        color: #fff;
    }

    .form-control::placeholder {
        color: #ddd;
    }

    .form-control:focus {
        border-color: #F1C40F;
        outline: none;
        background: rgba(255, 255, 255, 0.25);
    }

    .btn-warning {
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

    .btn-warning:hover {
        background-color: #F39C12;
    }

    .forgot-password,
    .signup-link {
        color: #F1C40F;
        font-size: 14px;
    }

    .forgot-password:hover,
    .signup-link:hover {
        text-decoration: underline;
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

    .form-check {
        text-align: left;
        margin-bottom: 15px;
        color: #fff;
    }

    .form-check-label {
        color: #ddd;
    }
</style>

<div class="login-container">
    <div class="login-box">
        <h2>Welcome Back!</h2>
        <p class="intro-text">You seem new here. Please login or sign up to continue exploring.</p>

        {{-- <div class="social-login">
            <a href="#"><i class="bi bi-facebook"></i></a>
            <a href="#"><i class="bi bi-google"></i></a>
            <a href="#"><i class="bi bi-twitter"></i></a>
        </div> --}}

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="email" name="fake_email" style="display:none;">
            <input type="password" name="fake_password" style="display:none;">

            {{-- Email --}}
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                   name="email" required autocomplete="off" placeholder="Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert" style="color: #030303;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Password --}}
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password" placeholder="Password">
            @error('password')
                <span class="invalid-feedback" role="alert" style="color: #0f0f0f;">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Remember Me --}}
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                       {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-warning">
                {{ __('Login') }}
            </button>

            {{-- Signup --}}
            <p class="mt-3">New here? <a href="{{ route('register') }}" class="signup-link">Create an account</a></p>

            {{-- Forgot password --}}
            @if (Route::has('password.request'))
                <p class="mt-2">
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </p>
            @endif
        </form>
    </div>
</div>

<script>
    // Just to ensure fields are empty even if browser tries to autofill
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('email').value = '';
        document.getElementById('password').value = '';
    });
</script>

@endsection
