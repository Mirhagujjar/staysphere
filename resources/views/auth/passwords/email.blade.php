@extends('layouts.app')

@section('content')

<style>
    .reset-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: url('{{ asset('build/assets/images/login.jpg') }}') no-repeat center center/cover;
    }

    .reset-box {
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(12px);
        border-radius: 20px;
        padding: 40px 30px;
        width: 500px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: center;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: wipeIn 6s ease-in-out;
        color: #fff;
    }

    .reset-box h3 {
        margin-bottom: 10px;
        font-size: 26px;
        color: #fff;
        font-weight: bold;
    }

    .reset-box p.intro-text {
        font-size: 16px;
        margin-bottom: 20px;
        color: #eee;
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

</style>

<div class="reset-container">
    <div class="reset-box">
        <h3>Reset Password</h3>
        <p class="intro-text">Forgot your password? Let’s help you reset it.</p>

        {{-- <div class="social-login">
            <a href="#" title="Login with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Login with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Login with Twitter"><i class="bi bi-twitter"></i></a>
        </div> --}}

        @if (session('status'))
            <div class="alert alert-success" role="alert" style="color: #0f0; background: rgba(0,0,0,0.3); border: none;">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="fake_email" style="display:none;">

            {{-- Email Field --}}
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" required autocomplete="off" autofocus placeholder="Email Address">
            @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror

            {{-- Submit --}}
            <button type="submit" class="btn btn-warning">
                {{ __('Send Password Reset Link') }}
            </button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('email').value = '';
    });
</script>

@endsection
