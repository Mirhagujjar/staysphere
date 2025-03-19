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
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 10%;
        padding: 60px;
        width: 400px;
        height: 400px;
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


    /* @keyframes wipeIn {
        from {
            clip-path: circle(0% at 50% 50%);
        }
        to {
            clip-path: circle(100% at 50% 50%);
        }
    } */


    .reset-box h3 {
        margin-bottom: 20px;
        font-size: 24px;
        color: #343A40;
    }

    /* -----------------Form inputs -----------*/
    .form-control {
        /* width: 80%;
        padding: 12px; */
        margin-bottom: 20px;
        border: 1px solid rgba(44, 62, 80, 0.3);
        border-radius: 5px;
        background: rgba(255, 255, 255, 0.8);
        font-size: 16px;
        color: #343A40;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #1ABC9C;
        outline: none;
    }

    /*--------------- Reset button----------- */
    .btn-warning {
        width: 63%;
        padding: 12px;
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


    .invalid-feedback {
        color: #ff6b6b;
        font-size: 14px;
        margin-top: 5px;
    }
</style>

<div class="reset-container">
    <div class="reset-box">
        <h3>Reset Password</h3>
        <div class="social-login">
            <a href="#" title="Login with Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" title="Login with Google"><i class="bi bi-google"></i></a>
            <a href="#" title="Login with Twitter"><i class="bi bi-twitter"></i></a>
        </div>
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <input type="email" name="fake_email" style="display:none;">

            {{-- ------------ Email Field -------- --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="Email Address">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- ----------- Reset Button ---------- --}}
            <div class="row mb-0">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-warning">
                        {{ __('Send Password') }}
                    </button>
                </div>
            </div>
        </form>
        <script>

            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('email').value = '';

            });
        </script>
    </div>
</div>

@endsection