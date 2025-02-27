@extends('layouts.app')
@section('content')

<style>
     .containerbox {
        width: 70%;
        max-width: 1200px;
        height: auto;
        display: flex;
        flex-wrap: wrap;
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        justify-content: center;
        margin: 3% auto;
        padding: 20px;
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
        padding: 40px;
    }

    .left-section h2 {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .left-section p {
        font-size: 1rem;
        line-height: 1.5;
    }

    .right-section {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .right-section h3 {
        text-align: center;
        margin-bottom: 20px;
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

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .containerbox {
            flex-direction: column;
            text-align: center;
            padding: 10px;
        }

        .left-section {
            flex: none;
            height: 200px;
            background-size: cover;
            padding: 20px;
        }

        .right-section {
            padding: 30px;
        }
    }

    @media (max-width: 480px) {
        .left-section h2 {
            font-size: 1.5rem;
        }

        .left-section p {
            font-size: 0.9rem;
        }

        .right-section {
            padding: 20px;
        }
    }

</style>

<div class="containerbox">
    <!-- Left Section -->
    <div class="left-section">
        <h2>Welcome!</h2>

    </div>

    <!-- Right Section -->
    <div class="right-section ">
        <h3>Register to Your Account</h3>
        <div class="social-login">
            <a href="#" title="Login with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Login with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Login with Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                </div>

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-warning">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection