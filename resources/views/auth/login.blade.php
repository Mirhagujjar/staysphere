@extends('layouts.app')

@section('content')
{{-- <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

  

<style>
    /* body, html {

        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        height: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #f0f0f0;
    } */

    .containerbox  {
        width: 70%;
        /* max-width: 1200px; */
        height: 10%;
        display: flex;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        justify-content: center;
        margin-left: 15%;
        margin-right: 10%;
        margin-top: 3%;
        margin-bottom: 3%;
       
    }

    .left-section {
        flex: 1;
        background: url('build/assets/images/slider5.jpg') no-repeat center center/cover;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 30px;
    }

    .left-section h2 {
        font-size: 3rem;
        margin-bottom: 10px;
    
    }

    .left-section p {
        font-size: 1rem;
        line-height: 1.5;
        margin: 0 20px;
    }

    .right-section {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .right-section h3 {
        margin-bottom: 20px;
        text-align: center;
    }

    .social-login {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .social-login a {
        display: inline-block;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ddd;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        color: #555;
        text-decoration: none;
    }

    .form-control {
        margin-bottom: 20px;
        border-radius: 5px;
    }

    .btn-submit {
        background-color: #F1C40F;
        color: #1ABC9C;
        border: none;
        width: 100%;
        padding: 10px;
        border-radius: 5px;
    }

    .btn-submit:hover {
        background-color: #4b2bdb;
    }

    .signup-section {
        text-align: center;
        margin-top: 20px;
    }

    .signup-section a {
        color: #2848d6;
        text-decoration: none;
        font-weight: bold;
    }

    .signup-section a:hover {
        text-decoration: underline;
    }
</style>

<div class="containerbox">
    <!-- Left Section -->
    <div class="left-section">
        <h2>Welcome Back!</h2>
        <p>Login to your account and continue exploring amazing features.</p>
    </div>

    <!-- Right Section -->
    <div class="right-section ">
        <h3>Login to Your Account</h3>
        <div class="social-login">
            <a href="#" title="Login with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Login with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Login with Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        <div >
            
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
         
        </div>
        <div class="signup-section">
            <p>New here? <a href="{{ route('register') }}">Register </a></p>
        </div>
    </div>
</div>

{{-- <!-- Font Awesome for social icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script> --}}




@endsection
