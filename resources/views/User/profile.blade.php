@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Update Your Profile</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <h5 class="text-primary mb-3">Basic Information</h5>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ auth()->user()->name }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ auth()->user()->email }}" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="profile_image" class="form-label">Profile Image</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                                @if(auth()->user()->profile_image)
                                    <div class="mt-3">
                                        <p class="mb-1">Current Profile Image:</p>
                                        <img src="{{ asset('assets/profile_images/' . auth()->user()->profile_image) }}" 
                                             class="rounded-circle border" width="100" height="100">
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="mb-4">
                            <h5 class="text-primary mb-3">Change Password</h5>
                            <p class="text-muted">Leave these fields blank if you don't want to change your password.</p>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="password" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="password_confirmation" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password_confirmation" 
                                           name="password_confirmation">
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-save me-2"></i>Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 1.5rem;
    }
    
    .form-control {
        border-radius: 5px;
        padding: 0.75rem 1rem;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
    }
    
    .btn-primary {
        background-color: #0d6efd;
        border: none;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: 5px;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #0b5ed7;
        transform: translateY(-2px);
    }
    
    hr {
        opacity: 0.1;
    }
</style>
@endsection