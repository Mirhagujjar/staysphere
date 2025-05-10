@extends('admin.dashboard')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>Admin Profile</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label><strong>Name:</strong></label>
                <p>{{ $admin->name }}</p>
            </div>

            <div class="mb-3">
                <label><strong>Email:</strong></label>
                <p>{{ $admin->email }}</p>
            </div>

            <div class="mb-3">
                <label><strong>Profile Image:</strong></label><br>
                @if ($admin->profile_image)
                    <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}" width="100">
                @else
                    <p>No profile image uploaded.</p>
                @endif
            </div>

            <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
        </div>
    </div>
</div>




@endsection
