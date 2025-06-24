@extends('layouts.app')

@section('content')

<style>
    .reset-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #121212;
        background-image: url('{{ asset('build/assets/images/login.jpg') }}');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .reset-box {
        background-color: rgba(40, 40, 40, 0.85);
        backdrop-filter: blur(8px);
        border-radius: 12px;
        padding: 40px;
        width: 100%;
        max-width: 450px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: #ffffff;
    }

    .reset-box h3 {
        margin-bottom: 16px;
        font-size: 26px;
        font-weight: 600;
        color: #ffffff;
    }

    .reset-box .intro-text {
        font-size: 15px;
        margin-bottom: 30px;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.5;
    }

    .form-control {
        width: 100%;
        padding: 14px 16px;
        margin-bottom: 20px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 6px;
        background-color: rgba(255, 255, 255, 0.1);
        font-size: 15px;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }

    /* Chrome autofill fix */
    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-text-fill-color: #ffffff !important;
        -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.1) inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-control:focus {
        border-color: #F1C40F;
        outline: none;
        background-color: rgba(255, 255, 255, 0.15);
        box-shadow: 0 0 0 2px rgba(241, 196, 15, 0.2);
    }

    .btn-primary {
        width: 100%;
        padding: 14px;
        background-color: #F1C40F;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        font-weight: 600;
        color: #2C3E50;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .btn-primary:hover {
        background-color: #F39C12;
    }

    .invalid-feedback {
        display: block;
        margin-top: -15px;
        margin-bottom: 15px;
        color: #ff6b6b;
        font-size: 13px;
        text-align: left;
    }

    .is-invalid {
        border-color: #ff6b6b !important;
    }

    .is-invalid:focus {
        box-shadow: 0 0 0 2px rgba(255, 107, 107, 0.2) !important;
    }

    .alert-success {
        padding: 12px 16px;
        margin-bottom: 20px;
        background-color: rgba(46, 204, 113, 0.2) !important;
        border: 1px solid rgba(46, 204, 113, 0.3);
        color: #2ecc71 !important;
        border-radius: 6px;
        font-size: 14px;
    }
</style>

<div class="reset-container">
    <div class="reset-box">
        <h3>Reset Password</h3>
        <p class="intro-text">Enter your email address and we'll send you a link to reset your password.</p>

        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Anti-autofill fields --}}
            <input type="email" name="fake_email" style="display:none;">

            {{-- Email Field --}}
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" 
                   autofocus placeholder="Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">
                Send Password Reset Link
            </button>

            {{-- Back to login link --}}
            <div class="text-center mt-3">
                <a href="{{ route('login') }}" style="color: #F1C40F; text-decoration: none; font-size: 14px;">
                    Back to login
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Force white text in all inputs immediately
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            // Set initial white color
            input.style.color = '#ffffff';
            
            // Add event listeners to maintain white text
            ['input', 'change', 'blur', 'focus'].forEach(event => {
                input.addEventListener(event, function() {
                    this.style.color = '#ffffff';
                });
            });
        });

        // Clear any autofilled values
        document.getElementById('email').value = '';

        // Additional check for autofilled fields
        setTimeout(() => {
            document.querySelectorAll('.form-control').forEach(input => {
                if(input.value) {
                    input.style.color = '#ffffff';
                }
            });
        }, 200);
    });
</script>

@endsection