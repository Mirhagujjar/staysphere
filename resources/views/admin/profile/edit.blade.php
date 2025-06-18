@extends('admin.dashboard')

@section('content')

<style>
    body {
        background: url('{{ asset('uploads/profile/' . ($admin->profile_image ?? "default.jpg")) }}') no-repeat center center fixed;
        background-size: cover;
    }

    .profile-edit-card {
        background: rgba(0, 0, 0, 0.75);
        color: #fff;
        border-radius: 15px;
        padding: 40px 30px;
        max-width: 700px;
        margin: auto;
        box-shadow: 0 0 30px rgba(0,0,0,0.5);
    }

    .profile-edit-card h4 {
        color: #ffc107;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .form-label {
        color: #ffc107;
        font-weight: 500;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #fff;
        border-radius: 6px;
        padding: 10px 14px;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.6);
    }

    .form-control:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: #ffc107;
        color: #fff;
    }

    .current-img-preview img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid white;
        margin-top: 10px;
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
    <div class="profile-edit-card">
        <h4>Edit Profile</h4>

        <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control"
                       value="{{ old('name', $admin->name ?? '') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control"
                       value="{{ old('email', $admin->email) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
                @if ($admin->profile_image)
                    <div class="current-img-preview">
                        <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}" alt="Admin Image">
                    </div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label">New Password (optional)</label>
                <input type="password" name="password" class="form-control" placeholder="Enter new password">
            </div>

            <div class="mb-4">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password">
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-warning">
                    <i class="fas fa-save me-2"></i> Update Profile
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
