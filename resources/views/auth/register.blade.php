@extends('layouts.app')

@section('content')

<style>
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #121212;
        background-image: url('build/assets/images/registration.jpg');
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
    }

    .registration-box {
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

    .registration-box h2 {
        margin-bottom: 16px;
        font-size: 28px;
        font-weight: 600;
        color: #ffffff;
    }

    .registration-box .intro-text {
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
        color: #ffffff !important; /* Force white text */
        transition: all 0.3s ease;
    }

    /* Fix for Chrome autofill */
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

    .link-text {
        color: #F1C40F;
        font-size: 14px;
        font-weight: 500;
        text-decoration: none;
        transition: color 0.2s;
    }

    .link-text:hover {
        color: #F39C12;
        text-decoration: underline;
    }

    .password-strength {
        margin-top: -15px;
        margin-bottom: 15px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.7);
        text-align: left;
    }

    .password-strength.weak {
        color: #ff6b6b;
    }

    .password-strength.medium {
        color: #f1c40f;
    }

    .password-strength.strong {
        color: #2ecc71;
    }
</style>

<div class="registration-container">
    <div class="registration-box">
        <h2>Create Your Account</h2>
        <p class="intro-text">Join our community and start your journey with us today.</p>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Anti-autofill fields --}}
            <input type="text" name="fake_name" style="display:none;">
            <input type="email" name="fake_email" style="display:none;">
            <input type="password" name="fake_password" style="display:none;">

            {{-- Name --}}
            <input id="name" type="text" 
                   class="form-control @error('name') is-invalid @enderror"
                   name="name" value="{{ old('name') }}" required autocomplete="name" 
                   placeholder="Full Name">
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Email --}}
            <input id="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autocomplete="email" 
                   placeholder="Email Address">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            {{-- Password --}}
            <input id="password" type="password" 
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required autocomplete="new-password" 
                   placeholder="Password (min. 8 characters)">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div id="password-strength" class="password-strength"></div>

            {{-- Confirm Password --}}
            <input id="password-confirm" type="password" class="form-control"
                   name="password_confirmation" required autocomplete="new-password"
                   placeholder="Confirm Password">

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary">
                Create Account
            </button>

            {{-- Login Link --}}
            <div class="text-center mt-3">
                <span style="color: rgba(255, 255, 255, 0.7); font-size: 14px;">Already have an account?</span>
                <a href="{{ route('login') }}" class="link-text ml-2">
                    Sign in
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

        // Password strength indicator
        const passwordInput = document.getElementById('password');
        const strengthText = document.getElementById('password-strength');
        
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            
            // Check length
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Check for mixed case
            if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
            
            // Check for numbers
            if (/\d/.test(password)) strength++;
            
            // Check for special chars
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            // Update display
            if (password.length === 0) {
                strengthText.textContent = '';
                strengthText.className = 'password-strength';
            } else if (strength <= 2) {
                strengthText.textContent = 'Weak password';
                strengthText.className = 'password-strength weak';
            } else if (strength <= 4) {
                strengthText.textContent = 'Medium strength password';
                strengthText.className = 'password-strength medium';
            } else {
                strengthText.textContent = 'Strong password';
                strengthText.className = 'password-strength strong';
            }
        });

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