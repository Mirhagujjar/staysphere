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

    .profile-edit-card {
        background: rgba(0, 0, 0, 0.75);
        border-radius: 12px;
        padding: 40px 30px;
        width: 100%;
        max-width: 600px;
        margin: auto;
        color: white;
        box-shadow: 0 0 25px rgba(0,0,0,0.4);
    }

    .profile-edit-card h4 {
        color: #ffc107;
        margin-bottom: 20px;
    }

    .profile-edit-card .form-label {
        color: #ffc107;
        font-weight: 600;
    }

    .form-control {
        border-radius: 6px;
        padding: 10px 14px;
        background-color: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: white;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15);
        color: white;
        border-color: #ffc107;
        box-shadow: none;
    }

    .current-img-preview {
        margin-top: 15px;
        text-align: center;
    }

    .current-img-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid white;
    }

    .section-heading {
        font-size: 18px;
        margin-bottom: 15px;
        color: #0dcaf0;
    }

    .note {
        font-size: 14px;
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 10px;
    }

    .btn-warning {
        background-color: #ffc107;
        color: #000;
        border: none;
        padding: 10px 25px;
        font-weight: 600;
        border-radius: 25px;
        transition: 0.3s;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }

    hr {
        border-top: 1px solid rgba(255,255,255,0.2);
    }
</style>

<div class="container py-5">
    <div class="profile-edit-card">
        <h4>Update Your Profile</h4>

        <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- Basic Information --}}
            <div class="mb-4">
                <div class="section-heading">Basic Information</div>

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ auth()->user()->name }}" required>
                </div>

                <div class="mb-3">
                    <label for="profile_image" class="form-label">Profile Image</label>
                    <input type="file" class="form-control" id="profile_image" name="profile_image">

                    @if(auth()->user()->profile_image)
                        <div class="current-img-preview">
                            <p class="note">Current Profile Image:</p>
                            <img src="{{ asset('assets/profile_images/' . auth()->user()->profile_image) }}" alt="Profile Image">
                        </div>
                    @endif
                </div>
            </div>

            <hr>

            {{-- Authentication Section --}}
            <div class="mb-4">
                <div class="section-heading">Authentication</div>
                <p class="note">To change your password, please confirm your current password.</p>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save me-2"></i>Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
