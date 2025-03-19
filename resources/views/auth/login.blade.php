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
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 10%;
        padding: 40px;
        width: 500px;
        height: 450px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.2);
        animation: wipeIn 6s ease-in-out;
        overflow: hidden;
    }


    


    .login-box h2 {
        margin-bottom: 15px;
        font-size: 24px;
        color: #343A40;
    }


    .form-control {
        width: 90%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid rgba(44, 62, 80, 0.3);
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.8);
        font-size: 14px;
        color: #343A40;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #1ABC9C;
        outline: none;
    }


    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .social-login a {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.2);
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        color: #555;
        text-decoration: none;
        transition: background 0.3s ease;
    }

    .social-login a:hover {
        background: rgba(255, 255, 255, 0.3);
    }


    .btn-warning {
        width: 90%;
        padding: 10px;
        background-color: #F1C40F;
        border: none;
        border-radius: 5px;
        color: #2C3E50;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-warning:hover {
        background-color: #F39C12;
    }


    .forgot-password {
        display: block;
        margin-top: 15px;
        color: #1ABC9C;
        text-decoration: none;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .forgot-password:hover {
        color: #16A085;
        text-decoration: underline;
    }

    .form-check {
        margin-bottom: 15px;
        text-align: left;
        color: #1ABC9C;
        width: 90%;
    }

    .form-check-label {
        color: #343A40;
        font-size: 14px;
    }

    .signup-section {
        margin-top: 15px;
        text-align: center;
    }

    .signup-link {
        color: #1ABC9C;
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

            <input type="email" name="fake_email" style="display:none;">
            <input type="password" name="fake_password" style="display:none;">

            {{-- ------- Email Field -------- --}}
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

            {{-- --------- Password Field -------- --}}
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

            {{-- -------- Remember Me Checkbox ------- --}}
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


            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Login') }}
                    </button>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <div class="signup-section">
                        <p class="signup-text">New here? <a href="{{ route('register') }}" class="signup-link">Register</a></p>
                    </div>
                </div>
            </div>


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

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('email').value = '';
                document.getElementById('password').value = '';
            });
        </script>
    </div>
</div>

@endsection