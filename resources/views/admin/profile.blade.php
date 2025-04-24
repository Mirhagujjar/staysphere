@extends('admin.dashboard')

@section('content')
<div class="container py-4">
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h4>Edit Profile</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
                </div>


                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
                </div>


                <div class="mb-3">
                    <label>Profile Image</label>
                    <input type="file" name="profile_image" class="form-control">
                    @if ($admin->profile_image)
                        <img src="{{ asset('uploads/profile/' . $admin->profile_image) }}" width="100" class="mt-2">
                    @endif
                </div>


                <div class="mb-3">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

              
                <div class="mb-3">
                    <label>Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>

        </div>
    </div>
</div>
@endsection

