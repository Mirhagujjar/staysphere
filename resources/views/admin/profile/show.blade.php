@extends('admin.dashboard')

@section('content')

<style>
    body {
        background: url('{{ asset('uploads/profile/' . ($admin->profile_image ?? "default.jpg")) }}') no-repeat center center fixed;
        background-size: cover;
    }

    .profile-view-card {
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        max-width: 700px;
        margin: auto;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
    }

    .profile-view-card h4 {
        color: #ffc107;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .profile-info-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .profile-info-row label {
        color: #ffc107;
        font-weight: 500;
        margin-bottom: 0;
    }

    .profile-info-row p {
        margin-bottom: 0;
        color: #fff;
    }

    .profile-image-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid white;
    }

    .btn-warning {
        background-color: #ffc107;
        border: none;
        color: #000;
        padding: 10px 25px;
        font-weight: bold;
        border-radius: 25px;
        transition: 0.3s;
    }

    .btn-warning:hover {
        background-color: #e0a800;
    }
</style>

<div class="container py-5">
    <div class="profile-view-card">
        <h4>Admin Profile</h4>

        <div class="profile-info-row">
            <label>Name:</label>
            <p>{{ $admin->name }}</p>
        </div>

        <div class="profile-info-row">
            <label>Email:</label>
            <p>{{ $admin->email }}</p>
        </div>

        <div class="profile-info-row">
            <label>Profile Image:</label>
            @if ($admin->profile_image)
                <div class="profile-image-preview">
                    <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}" alt="Admin Image">
                </div>
            @else
                <p>No profile image uploaded.</p>
            @endif
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('admin.profile.edit') }}" class="btn btn-warning">
                <i class="fas fa-edit me-2"></i>Edit Profile
            </a>
        </div>
    </div>
</div>

@endsection
