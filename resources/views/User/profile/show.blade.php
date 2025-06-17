@extends('layouts.app')

@section('content')
<style>
     body {
        margin: 0;
        padding: 0;
        min-height: 100vh;
        background: #000 url('{{ asset('assets/profile_images/' . (auth()->user()->profile_image ?? "default.jpg")) }}') no-repeat center center fixed;
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .profile-card {
        background: rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        padding: 40px 30px;
        width: 100%;
        max-width: 500px;
        margin: auto;
        text-align: center;
        color: white;
        box-shadow: 0 0 25px rgba(0,0,0,0.4);
    }

    .profile-img {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 50%;
        border: 3px solid white;
        margin-bottom: 20px;
    }

    .profile-info {
        font-size: 16px;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        padding: 8px 15px;
        background-color: rgba(255, 255, 255, 0.05);
        border-radius: 8px;
        text-align: left;
    }

    .profile-info label {
        color: #ffc107;
        margin-right: 10px;
        font-weight: 600;
        min-width: 80px;
    }

    .btn-group-custom {
        margin-top: 30px;
        display: flex;
        justify-content: center;
        gap: 15px;
        flex-wrap: wrap;
    }

    .btn-custom {
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 500;
        text-decoration: none;
        transition: 0.2s;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;
    }

    .btn-primary {
        background-color: #007bff;
        color: #fff;
    }

    .btn-warning:hover, .btn-primary:hover {
        opacity: 0.9;
    }
</style>

<div class="container py-5">
    <div class="profile-card">
        {{-- Profile Image --}}
        @if(auth()->user()->profile_image)
            <img src="{{ asset('assets/profile_images/' . auth()->user()->profile_image) }}" 
                 class="profile-img" alt="Profile Image">
        @else
            <p>No profile image uploaded.</p>
        @endif

        {{-- Name --}}
        <div class="profile-info">
            <label>Name:</label>
            <span>{{ auth()->user()->name }}</span>
        </div>

        {{-- Email --}}
        <div class="profile-info">
            <label>Email:</label>
            <span>{{ auth()->user()->email }}</span>
        </div>

        {{-- Action Buttons --}}
        <div class="btn-group-custom">
            <a href="{{ route('user.profile.edit') }}" class="btn btn-warning btn-custom">
                <i class="fas fa-edit me-1"></i> Edit Profile
            </a>

            <a href="{{ route('user.reservations.index') }}" class="btn btn-primary btn-custom">
                <i class="fas fa-history me-1"></i> Booking History
            </a>
        </div>
    </div>
</div>
@endsection
