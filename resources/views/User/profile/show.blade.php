@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Your Profile</h4>
                </div>

                <div class="card-body">
                    <div class="mb-4">
                        <h5 class="text-primary mb-3">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Name:</strong></label>
                                <p>{{ auth()->user()->name }}</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label"><strong>Email:</strong></label>
                                <p>{{ auth()->user()->email }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><strong>Profile Image:</strong></label><br>
                            @if(auth()->user()->profile_image)
                                <img src="{{ asset('assets/profile_images/' . auth()->user()->profile_image) }}" 
                                     class="rounded-circle border" width="100" height="100">
                            @else
                                <p>No profile image uploaded.</p>
                            @endif
                        </div>
                    </div>

                    <!-- 👇 Booking History Button -->
                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('user.profile.edit') }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i> Edit Profile
                        </a>

                        <a href="{{ route('user.reservations.index') }}" class="btn btn-primary">
                            <i class="fas fa-history me-1"></i> Your Booking History
                        </a>
                    </div>

                </div> <!-- end card-body -->
            </div> <!-- end card -->
        </div> <!-- end col -->
    </div> <!-- end row -->
</div> <!-- end container -->
@endsection
